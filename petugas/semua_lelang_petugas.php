<?php
    include "../kepala.php";
    include "../proses/update_status.php";
?>

<title>Daftar lelang saat ini</title>

<center><h1>Daftar lelang saat ini</h1></center><br>
<center><a href="tambah_lelang.php" class="btn btn-outline-success">+ Tambah lelang</a></center><br>
<table align="center" width=80% style="text-align: center">
    <tr>
        <th>ID Lelang</th>
        <th>Foto</th>
        <th>Nama Barang</th>
        <th>Tanggal buka lelang</th>
        <th>Tanggal tutup lelang</th>
        <th>Harga akhir</th>
        <th>Pembeli dengan penawaran tertinggi</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    <?php 
        include "../proses/koneksi.php";
        $query_lelang = mysqli_query($connect, "select * from tb_lelang join tb_barang on tb_barang.id_barang = tb_lelang.id_barang order by tb_lelang.id_lelang desc");
        while($data_lelang = mysqli_fetch_array($query_lelang)) {
            $query_masyarakat = mysqli_query($connect, "select * from tb_lelang join tb_masyarakat on tb_masyarakat.id_user = tb_lelang.id_user where id_lelang = ".$data_lelang['id_lelang']);
            $data_masyarakat = mysqli_fetch_assoc($query_masyarakat);
            if(mysqli_num_rows($query_masyarakat) == 0) {
                $nama_masyarakat = "Belum ada penawar";
            } elseif($data_masyarakat['username'] != null) {
                $nama_masyarakat = $data_masyarakat['username'];
            } else {
                $nama_masyarakat = $data_masyarakat['nama_lengkap'];
            }
    ?>
    <tr>
        <td><?=$data_lelang['id_lelang']?></td>
        <td><img src="../foto_barang/<?=$data_lelang['foto_barang']?>" alt="<?=$data_lelang['foto_barang']?>" width=100></td>
        <td><?=$data_lelang['nama_barang']?></td>
        <td><?=$data_lelang['tanggal_buka']?></td>
        <td><?=$data_lelang['tanggal_tutup']?></td>
        <td><?=$data_lelang['harga_akhir']?></td>
        <td><?=$nama_masyarakat?></td>
        <td><?=$data_lelang['status']?></td>
        <td>
            <?php if($data_lelang['status'] != "diakhiri") { ?>
            <a href="ubah_lelang.php?id_lelang=<?=$data_lelang['id_lelang']?>" class="btn btn-outline-success">Ubah</a>
            <?php } ?> | 
            <a href="../proses/proses_lelang.php?id_lelang=<?=$data_lelang['id_lelang']?>&tipe_proses=hapus" onclick="return confirm('Apakah anda yakin akan menghapus lelang ini?');" class="btn btn-outline-danger">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>