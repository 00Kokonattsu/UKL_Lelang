<?php 
    include "../kepala.php";
    include "../proses/koneksi.php";
    $query_barang = mysqli_query($connect, "select * from tb_barang order by id_barang desc");
    $nomor = 0;
?>

<title>Daftar semua barang</title>

<center><h1>Daftar semua barang</h1></center> <br>
<center><a href="tambah_barang.php" class="btn btn-outline-success"> + Tambah barang </a></center> <br>
<table width=80% align="center" style="text-align: center">
    <tr>
        <th>Nomor</th>
        <th>Foto barang</th>
        <th>Nama barang</th>
        <th>Tanggal terdaftar</th>
        <th>Harga awal</th>
        <th>Deskripsi</th>
        <th>Ubah</th>
        <th>Hapus</th>
    </tr>
    <?php 
        while($data_barang = mysqli_fetch_assoc($query_barang)) { 
            $nomor++; 
            $query_lelang = mysqli_query($connect, "select * from tb_barang join tb_lelang on tb_lelang.id_barang = tb_barang.id_barang where tb_barang.id_barang = ".$data_barang['id_barang']);
            $tombol_ubah = "<a href='ubah_barang.php?id_barang=".$data_barang['id_barang']."' class='btn btn-warning'>Ubah</a>";
            $tombol_hapus = "<a href='../proses/proses_barang.php?id_barang=".$data_barang['id_barang']."&tipe_proses=hapus' class='btn btn-danger'>Hapus</a>";
            if(mysqli_num_rows($query_lelang) > 0) {
                $data_lelang = mysqli_fetch_assoc($query_lelang);
                if($data_lelang['status'] != 'diakhiri' or $data_lelang['status'] == null) {
                    $tombol_ubah = "<a href='ubah_barang.php?id_barang=".$data_barang['id_barang']."' class='btn btn-warning'>Ubah</a>";
                } else {
                    $tombol_ubah = "Barang sudah selesai dilelangkan";
                }
                if($data_lelang['status'] == null) {
                    $tombol_hapus = "<a href='../proses/proses_barang.php?id_barang=".$data_barang['id_barang']."&tipe_proses=hapus' class='btn btn-danger'>Hapus</a>";
                } elseif($data_lelang['status'] == 'ditutup') {
                    $tombol_hapus = "Barang sudah masuk pelelangan,<br> hapus melalui lelang";
                } elseif($data_lelang['status'] == 'dibuka') {
                    $tombol_hapus = "Barang dalam proses pelelangan";
                } else {
                    $tombol_hapus = "Barang sudah selesai dilelangkan";
                }
            }
    ?>
    <tr>
        <td><?=$nomor?></td>
        <td><img src="../foto_barang/<?=$data_barang['foto_barang']?>" alt="<?=$data_barang['foto_barang']?>" width=100></td>
        <td><?=$data_barang['nama_barang']?></td>
        <td><?=$data_barang['tanggal']?></td>
        <td><?=$data_barang['harga_awal']?></td>
        <td><?=$data_barang['deskripsi_barang']?></td>
        <td><?=$tombol_ubah?></td>
        <td><?=$tombol_hapus?></td>
    </tr>
    <?php } ?>
</table>
