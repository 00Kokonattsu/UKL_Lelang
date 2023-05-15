<?php
    include "../kepala.php";
?>
<title>Semua Petugas & Administrator</title>
<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
    <br><center><h1>Semua Petugas & Administrator</h1></center>
    <br><center><a href="daftar_petugas.php" class="btn btn-outline-success"> + Daftarkan Petugas</a></center><br>

    <table align="center" style="text-align: center" class="table table-striped">
        <tr>
            <th>Nomor</th>
            <th>ID Petugas</th>
            <th>Nama Petugas</th>
            <th>Username</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
        <?php 
            include "../proses/koneksi.php";
            $query_petugas = mysqli_query($connect, "select * from tb_petugas join tb_level on tb_level.id_level = tb_petugas.id_level;");
            $nomor = 0;
            while($data_petugas = mysqli_fetch_assoc($query_petugas)) {
                echo $data_petugas['nama_petugas'];
            if(mysqli_num_rows($query_petugas) > 1){
                $hapus = '<a href="../proses/proses_petugas.php?id_petugas='.$data_petugas['id_petugas'].'&tipe_proses=hapus" class="btn btn-danger" onclick="return confirm (';
                $hapus .= "'apakah anda yakin akan menghapus petugas ".$data_petugas['nama_petugas']."?');";
                $hapus .= '">Hapus</a>';
            } else {
                $hapus = "";
            }
                $nomor++;
        ?>
        <tr>
            <td><?=$nomor?></td>
            <td><?=$data_petugas['id_petugas']?></td>
            <td><?=$data_petugas['nama_petugas']?></td>
            <td><?=$data_petugas['username']?></td>
            <td><?=$data_petugas['level']?></td>
            <td><a href="ubah_petugas.php?id_petugas=<?=$data_petugas['id_petugas']?>" class="btn btn-warning">Ubah</a> | <?=$hapus?></td>
        </tr>
        <?php } ?>
    </table>
    </div>
    <div class="col-2"></div>
</div>