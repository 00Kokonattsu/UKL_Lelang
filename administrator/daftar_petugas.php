<?php
    include "../kepala.php";
?>

<title>Pendaftaran Petugas & Administrator</title>

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>Pendaftaran Petugas & Administrator</h1>
        <form action="../proses/proses_daftar.php" method="post">
            <input type="hidden" name="tipe_daftar" value="petugas">
            Masukkan nama petugas: <br>
            <input type="text" name="nama_petugas" class="form-control" required> <br>
            Masukkan username petugas: (optional) <br>
            <input type="text" name="username" class="form-control"> <br>
            Masukkan kata sandi petugas: <br>
            <input type="password" name="kata_sandi" class="form-control" required> <br>
            Pilih pekerjaan: <br>
            <select name="level" class="form-control" required>
                <option value="petugas">Petugas</option>
                <option value="administrator">Administrator</option>
            </select>
            <button type="submit" class="btn">Daftarkan</button>
        </form>
    </div>
    <div class="col"></div>
</div>