<?php 
    include "kepala_index.html";
?>

<div class="row">
    <div class="col"></div>
    <div class="col">
        <center><h1>Daftar akun</h1></center>
        <form action="proses/proses_daftar.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="tipe_daftar" value="masyarakat">
            Masukkan nama lengkapmu: <br>
            <input type="text" name="nama_lengkap" class="form-control" required><br>
            Masukkan usernamemu: (optional) <br>
            <input type="text" name="username" class="form-control"><br>
            Masukkan kata sandimu: <br>
            <input type="password" name="kata_sandi" class="form-control" required><br>
            Masukkan nomor teleponmu: <br>
            <input type="number" name="nomor_telepon" class="form-control" required><br>
            Masukkan foto: (optional) <br>
            <input type="file" name="foto" class="form-control"><br>
            <center><button type="submit" class="btn">Daftar</button></center>
        </form>
    </div>
    <div class="col"></div>
</div>