<?php 
    session_start();
    include "../proses/update_status.php";
    if($_SESSION['status_masuk'] != true) {
        header("location: ../masuk.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap-5.0.2-dist/js/bootstrap.js">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <?php 
                if($_SESSION['status_masuk'] == true) { 
                    if ($_SESSION['level'] == 'masyarakat') { 
            ?>
            <a class="navbar-brand" href="rumah_masyarakat.php">Lelang</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="semua_lelang.php">Daftar lelang saat ini</a></li>
                <li class="nav-item"><a href="histori_lelang.php" class="nav-link">Histori</a></li>
                <li class="nav-item"><a href="../proses/keluar.php" class="nav-link">Keluar</a></li>
            </ul>
            </div>
            <?php } elseif($_SESSION['level'] == 'petugas') { ?>
            <a class="navbar-brand" href="rumah_petugas.php">Lelang</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="semua_lelang_petugas.php">Daftar lelang saat ini</a></li>
                <li class="nav-item"><a href="../petugas/semua_barang.php" class="nav-link">Daftar barang-barang</a></li>
                <li class="nav-item"><a href="../proses/keluar.php" class="nav-link">Keluar</a></li>
            </ul>
            </div>
            <?php } elseif($_SESSION['level'] == 'administrator') { ?>
            <a class="navbar-brand" href="rumah_administrator.php">Lelang</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="../petugas/semua_lelang_petugas.php">Daftar lelang saat ini</a></li>
                <li class="nav-item"><a href="../petugas/semua_barang.php" class="nav-link">Daftar barang-barang</a></li>
                <li class="nav-item"><a href="../administrator/semua_petugas.php" class="nav-link">Semua petugas & administrator</a></li>
                <li class="nav-item"><a href="../proses/keluar.php" class="nav-link">Keluar</a></li>
            <?php } } ?>
        </div>
    </nav>
</body>
</html>