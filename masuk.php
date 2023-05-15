<?php 
    include "kepala_index.html";
?>

<title>Masuk</title>

    <form action="proses/proses_masuk.php" method="post"><br>
        <div class="row">
            <div class="col-md"></div>
            <div class="col-md">
                <h1 align="center">Lelang</h1><br>
                Masukkan nama lengkap atau usernamemu: <br>
                <input type="text" name="nama" required class="form-control"><br><br>
                Masukkan kata sandimu: <br>
                <input type="password" name="kata_sandi" required class="form-control"><br><br>
                <center><button type="submit" class="btn btn-light">Masuk</button></center><br>
                <center>Belum memiliki akun? <a href="daftar.php" style="text-decoration: none;">Daftar disini</a></center>
            </div>
            <div class="col-md"></div>
        </div>
    </form>