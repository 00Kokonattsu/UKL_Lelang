<?php 
    include "../kepala.php";
    include "../proses/koneksi.php";
    if(empty($_SESSION['username'])) {
        $nama = $_SESSION['nama_lengkap'];
    } else {
        $nama = $_SESSION['username'];
    }
?>
<center><h1>Histori lelang <?=$nama?></h1></center>
<?php
    $query_peserta = mysqli_query($connect, "select * from tb_peserta_lelang join tb_lelang on tb_lelang.id_lelang = tb_peserta_lelang.id_lelang join tb_barang on tb_barang.id_barang = tb_lelang.id_barang where tb_peserta_lelang.id_user = ".$_SESSION['id_user']." order by tb_lelang.id_lelang desc");
    while($data_peserta = mysqli_fetch_assoc($query_peserta)) {
        $query_pemenang = mysqli_query($connect, "select * from tb_lelang where id_lelang = ".$data_peserta['id_lelang']);
        $data_pemenang = mysqli_fetch_assoc($query_pemenang);
?>

    <a href="lelang.php?id_lelang=<?=$data_peserta['id_lelang']?>" style="text-decoration: none; color: black;">
        <div class="row" style="margin-bottom: 10pt">
            <?php 
                    if($data_peserta['tanggal_tutup'] == null or $data_peserta['tanggal_tutup'] == "0000-00-00") {
                        $tanggal_tutup = "Tanggal tutup belum ditentukan";
                    } else {
                        $tanggal_tutup = $data_peserta['tanggal_tutup'];
                    }
                    if(date("y-m-d") < $data_peserta['tanggal_tutup'] or $data_peserta['tanggal_tutup'] == "0000-00-00") {
                        if($data_pemenang['id_user'] != $_SESSION['id_user']) {
                            $kondisi = "kalah";
                        } elseif($data_pemenang['id_user'] == $_SESSION['id_user']) {
                            $kondisi = "menang";
                        }
                    } elseif(date("y-m-d") >= $data_peserta['tanggal_tutup']) {
                        if($data_pemenang['id_user'] != $_SESSION['id_user']) {
                            $kondisi = "<h4 style='color: red;'>Kalah</h4>";
                        } elseif($data_pemenang['id_user'] == $_SESSION['id_user']) {
                            $kondisi = "<h4 style='color: orange;'>Menang</h4>";
                        }
                    }
            ?>
            <center>
            <div class="col-6">
                <div class="card">
                    <center><img src="../foto_barang/<?=$data_peserta['foto_barang']?>" alt="<?=$data_peserta['foto_barang']?>" width=400></center>
                    <div class="card-body">
                        <h4 class="card-title"><?=$data_peserta['nama_barang']?></h4>                        
                        Harga akhir: 
                        <p class="card-text"><?=$data_peserta['harga_akhir']?></p>
                        Ditutup tanggal: 
                        <p class="card-text"><?=$tanggal_tutup?></p>
                        Kondisimu:
                        <p class="card-text"><?=$kondisi?></p>
                    </div>
                </div>
            </div>
            </center>
        </div>
    </a>
<?php } ?>

<title>Histori lelang <?=$nama?></title>