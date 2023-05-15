<title>Rumah Lelang Masyarakat</title>

<?php
    include "../kepala.php";
    if(empty($_SESSION['username'])) {
        $nama = $_SESSION['nama_lengkap'];
    } else {
        $nama = $_SESSION['username'];
    }
?>

<h1 align="center">Selamat datang <?=$nama?></h1>