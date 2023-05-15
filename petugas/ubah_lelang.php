<?php 
    include "../kepala.php";
    include "../proses/koneksi.php";
    $query_lelang = mysqli_query($connect, "select * from tb_lelang join tb_barang on tb_barang.id_barang=tb_lelang.id_barang where id_lelang = ".$_GET['id_lelang']);
    $data_lelang = mysqli_fetch_assoc($query_lelang);
    $query_masyarakat = mysqli_query($connect, "select * from tb_lelang join tb_masyarakat on tb_masyarakat.id_user = tb_lelang.id_user where id_lelang = ".$_GET['id_lelang']);
    $data_masyarakat = mysqli_fetch_assoc($query_masyarakat);
    if(!empty($data_masyarakat['id_user'])) {
        if(empty($data_masyarakat['username'])) {
            $nama_masyarakat = $data_masyarakat['nama_lengkap'];
        } else {
            $nama_masyarakat = $data_masyarakat['username'];
        }
    } else {
        $nama_masyarakat = "Belum ada penawar";
    }
    if($data_lelang['harga_akhir'] == null) {
        $harga_akhir = "";
    } else {
        $harga_akhir = $data_lelang['harga_akhir'];
    }
    $query_barang = mysqli_query($connect, "select * from tb_barang");
    // if($data_lelang['status'] == 'ditutup')
?>

<title>Ubah lelang <?=$data_lelang['nama_barang']?></title>

<table align="center" width=60%>
    <tr>
        <td>
            <h1 align='center'>Ubah lelang</h1>
            <form action="../proses/proses_lelang.php" method="post">
                <input type="hidden" name="tipe_proses" value="ubah">
                <input type="hidden" name="id_lelang" value="<?=$_GET['id_lelang']?>">
                Barang yang dilelang: 
                <p class="form-control"><?=$data_lelang['nama_barang']?></p>
                <input type="hidden" name="id_barang" value="<?=$data_lelang['id_barang']?>">
                Tanggal lelang dibuka: <br>
                <?php if($data_lelang['status'] == 'ditutup') { ?>
                <input type="date" name="tanggal_buka" class="form-control" value="<?=$data_lelang['tanggal_buka']?>"> <br>
                <?php } else { ?>
                <p class="form-control"><?=$data_lelang['tanggal_buka']?></p><br><hr><br>
                <?php } ?>
                Tanggal lelang ditutup: <br>
                <input type="date" name="tanggal_tutup" class="form-control" value="<?=$data_lelang['tanggal_tutup']?>"> <br>
                <!-- Status lelang: <br>
                <select name="status" class="form-control">
                    <?php if($data_lelang['status'] == "ditutup") { ?>
                        <option value="ditutup">Ditutup</option>
                        <option value="dibuka">Dibuka</option>
                    <?php } elseif($data_lelang['status'] == "dibuka") { ?>
                        <option value="dibuka">Dibuka</option>
                        <option value="diakhiri">Diakhiri</option>
                    <?php } elseif($data_lelang['status'] == "diakhiri") { ?>
                        <option value="diakhiri">Diakhiri</option>
                    <?php } ?>
                </select> <br> -->
                <hr><br>
                Pengguna yang memenangkan lelang<?php if($data_lelang['status'] == "dibuka") { ?> saat ini<?php } ?>:
                <p class="form-control"><?=$nama_masyarakat?></p>
                Harga akhir dari lelang: 
                <p class="form-control"><?=$harga_akhir?></p>
                <button type="submit" class="btn btn-outline-warning">Ubah lelang</button>
            </form>
        </td>
    </tr>
</table>