<?php 
    include "../kepala.php";
    include "../proses/koneksi.php";
    // print_r($_SESSION);
    $query_lelang = mysqli_query($connect, "select * from tb_lelang join tb_barang on tb_barang.id_barang=tb_lelang.id_barang where id_lelang = ".$_GET['id_lelang']);
    $data_lelang = mysqli_fetch_assoc($query_lelang);
    $query_pemenang = mysqli_query($connect, "select * from tb_lelang join tb_masyarakat on tb_masyarakat.id_user = tb_lelang.id_user where id_lelang = ".$_GET['id_lelang']);
    if(mysqli_num_rows($query_pemenang) > 0) {
        $data_pemenang = mysqli_fetch_assoc($query_pemenang);
        if(empty($data_pemenang['username'])) {
            $nama_pemenang = $data_pemenang['nama_lengkap'];
        } else {
            $nama_pemenang = $data_pemenang['username'];
        }
    }
    $query_peserta = mysqli_query($connect, "select * from tb_peserta_lelang join tb_masyarakat on tb_masyarakat.id_user=tb_peserta_lelang.id_user where id_lelang = ".$_GET['id_lelang']." order by id_peserta_lelang desc");
?>

<title>Lelang <?=$data_lelang['nama_barang']?></title>

<table width=80% align="center" style="text-align: center;">
    <tr>
        <td colspan=4><center><img src="../foto_barang/<?=$data_lelang['foto_barang']?>" alt="<?=$data_lelang['foto_barang']?>" width=400></center></td>
    </tr>
    <tr>
        <td colspan=4>
            <h2><?=$data_lelang['nama_barang']?></h2>
            Deskripsi: <br>
            <h3><?=$data_lelang['deskripsi_barang']?></h3>
            Harga akhir: <br>
            <h3><?=$data_lelang['harga_akhir']?></h3>
            <?php if(mysqli_num_rows($query_pemenang) > 0) { ?>
            Penawar dengan harga tertinggi: <br>
            <h3><?=$nama_pemenang?></h3>
            <?php } ?>
            <br>
        </td>
    </tr>
    <?php
        if($data_lelang['status'] == "diakhiri") {
            echo "<tr><td colspan=4><h3> Lelang sudah ditutup </h3><p> anda dapat melihat daftar peserta lelang yang ikut serta </p></td></tr>";
        } else {
    ?>
    <tr>
        <th colspan=4><h5>Peserta lelang: </h5></th>
    </tr>
    <tr>
        <?php if($data_pemenang['id_user'] == $_SESSION['id_user'] and $data_lelang['id_user'] != null) { ?>
        <td colspan=4><p class="btn btn-outline-warning">Anda adalah pemenang lelang saat ini, mohon tunggu sampai waktu lelang habis</p></td>
        <?php } else { ?>
        <form action="../proses/proses_lelang.php" method="post">
        <input type="hidden" name="tipe_proses" value="penawaran">
        <input type="hidden" name="id_lelang" value="<?=$_GET['id_lelang']?>">
        <td colspan=2>Penawaran anda: <br><input type="number" name="harga_tawar" class="form-control" placeholder="Masukkan penawaran anda disini (jumlah penawaran harus lebih besar dari harga akhir barang)" required></td>
        <td>Komentar: (opsional)<br><input type="text" name="komentar" class="form-control"></td>
        <td><button type="submit" class="btn btn-warning">Tawar</button></td>
        </form>
        <?php } ?>
    </tr>
    <?php } ?>
    <tr>
        <td colspan = 4><hr></td>
    </tr>
    <tr>
        <th>Nomor</th>
        <th>Nama</th>
        <th>Harga penawaran</th>
        <th>Komentar</th>
    </tr>
    <?php 
        $nomor = 0;
        while($data_peserta = mysqli_fetch_assoc($query_peserta)) { $nomor++;
            if(empty($data_peserta['username'])) {
                $nama = $data_peserta['nama_lengkap'];
            } else {
                $nama = $data_peserta['username'];
            }
    ?>
    <tr>
        <td><br></td>
    </tr>
    <tr>
        <td><?=$nomor?></td>
        <td><?=$nama?></td>
        <td><?=$data_peserta['harga_tawar']?></td>
        <td><?=$data_peserta['komentar']?></td>
    </tr>
    <?php } ?>
</table>