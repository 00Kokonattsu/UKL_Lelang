<?php 
    include "../kepala.php";
    include "../proses/koneksi.php";
    $query_petugas = mysqli_query($connect, "select * from tb_petugas join tb_level on tb_level.id_level=tb_petugas.id_level where id_petugas = ".$_GET['id_petugas']);
    $data_petugas = mysqli_fetch_assoc($query_petugas);
?>

<title>Ubah petugas</title>

<table align="center" width=60%>
    <tr>
        <td>
            <h1 align="center">Ubah Data Petugas <?=$data_petugas['nama_petugas']?></h1> <br>
            <form action="../proses/proses_petugas.php" method="post">
                <input type="hidden" name="tipe_proses" value="ubah">
                <input type="hidden" name="id_petugas" value="<?=$_GET['id_petugas']?>">
                <input type="hidden" name="id_level" value="<?=$data_petugas['id_level']?>">
                Nama petugas: <br>
                <input type="text" name="nama_petugas" value="<?=$data_petugas['nama_petugas']?>" class="form-control" required> <br>
                Username: <br>
                <input type="text" name="username" value="<?=$data_petugas['username']?>" class="form-control" required> <br>
                Kata sandi: <br>
                <input type="password" name="kata_sandi" value="<?=$data_petugas['password']?>"  class="form-control" required> <br>
                Pekerjaan: <br>
                <select name="level" class="form-control">
                    <?php if($data_petugas['level'] == 'administrator') { ?>
                    <option value="administrator">Administrator</option>
                    <option value="petugas">Petugas</option>
                    <?php } elseif($data_petugas['level'] == 'petugas') { ?>
                    <option value="petugas">Petugas</option>
                    <option value="administrator">Administrator</option>
                    <?php } ?>
                </select><br>
                <button type="submit" class="btn btn-outline-warning">Ubah</button>
            </form>
        </td>
    </tr>
</table>