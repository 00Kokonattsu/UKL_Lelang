<?php 
session_start();
include "koneksi.php";
if($_POST['tipe_daftar'] == "masyarakat") {
    $nama_lengkap = $_POST['nama_lengkap'];
        if($_POST['username']) {
            $username = $_POST['username'];
        } else {
            $username = "";
        }
        $kata_sandi = $_POST['kata_sandi'];
        $nomor_telepon = $_POST['nomor_telepon'];
        if($_FILES['foto']['tmp_name']) {
            $temp = $_FILES['foto']['tmp_name'];
            $nama_foto = $_FILES['foto']['name'];
            move_uploaded_file($temp, "../foto_profil/".$nama_foto);
        }

        if($_FILES['foto']['tmp_name']) {
            $tambah_akun = mysqli_query($connect, "insert into tb_masyarakat value('', '".$nama_lengkap."', '".$username."', '".md5($kata_sandi)."', '".$nomor_telepon."', '".$nama_foto."');");
        } else {
            $tambah_akun = mysqli_query($connect, "insert into tb_masyarakat(nama_lengkap, username, password, telp) value('".$nama_lengkap."', '".$username."', '".md5($kata_sandi)."', '".$nomor_telepon."');");
        }

        if($tambah_akun) {
            echo "<script> alert ('Berhasil menambahkan akun');</script>";
            echo "<script> location.href= '../masuk.php' ;</script>";
        } else {
            echo "<script> alert ('Gagal menambahkan akun');</script>";
        }
} elseif($_POST['tipe_daftar'] == "petugas" and $_SESSION['status_masuk'] == true) {
    $nama_petugas = $_POST['nama_petugas'];
    if($_POST['username'] == null) {
        $username = $_POST['username'];
    } else {
        $username = "";
    }
    $kata_sandi = $_POST['kata_sandi'];
    $level = $_POST['level'];
    $tambah_level = mysqli_query($connect, "insert into tb_level(level) value('".$_POST['level']."');");
    $id_level = mysqli_insert_id($connect);
    $tambah_petugas = mysqli_query($connect, "insert into tb_petugas(nama_petugas, username, password, id_level) value('".$_POST['nama_petugas']."', '".$_POST['username']."', md5('".$_POST['kata_sandi']."'), '".$id_level."');");
    if($tambah_petugas and $tambah_level){
        echo "<script> alert ('Berhasil menambahkan petugas');</script>";
        echo "<script> location.href= '../administrator/semua_petugas.php';</script>";
    } else {
        echo '<script> alert ("Gagal menambahkan petugas");</script>';
        echo $tambah_level;
        echo $tambah_petugas;
        mysqli_error($connect);
    }
}
?>