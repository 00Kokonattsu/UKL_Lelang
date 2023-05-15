<?php 
    include "../kepala.php";
    include "../proses/koneksi.php";
    $query_barang = mysqli_query($connect, "select * from tb_barang where id_barang = ".$_GET['id_barang']);
    $data_barang = mysqli_fetch_assoc($query_barang);
?>

<title>Ubah data barang <?=$data_barang['nama_barang']?></title>

<table width=60% align="center">
    <tr>
        <td>
            <center><h2>Ubah data barang <?=$data_barang['nama_barang']?></h2></center>
            <form action="../proses/proses_barang.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="tipe_proses" value="ubah">
                <input type="hidden" name="id_barang" value="<?=$_GET['id_barang']?>">
                Nama barang: <br>
                <input type="text" name="nama_barang" value="<?=$data_barang['nama_barang']?>" class="form-control" required> <br>
                Harga awal: <br>
                <input type="number" name="harga_awal" value="<?=$data_barang['harga_awal']?>" class="form-control" required> <br>
                Deskripsi barang: <br>
                <textarea name="deskripsi_barang" cols="30" rows="10" class="form-control"><?=$data_barang['deskripsi_barang']?></textarea> <br>
                Foto barang: <br>
                <?=$data_barang['foto_barang']?><br>
                <img src="../foto_barang/<?=$data_barang['foto_barang']?>" alt="<?=$data_barang['foto_barang']?>" width=200> <br>
                <input type="file" name="foto_barang" class="form-control"> <br>
                <button type="submit" class="btn btn-warning">Ubah data barang</button>
            </form>
        </td>
    </tr>
</table>