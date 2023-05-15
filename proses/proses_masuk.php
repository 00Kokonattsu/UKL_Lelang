<?php
    include "koneksi.php";
    if($_POST) {
        $nama = $_POST['nama'];
        $kata_sandi = $_POST['kata_sandi'];
        if(empty($nama)) {
            echo "<script> alert ('Nama tidak boleh kosong');</script>";
            echo "<script> location.href= '../masuk.php' ;</script>";
        } elseif(empty($kata_sandi)) {
            echo "<script> alert ('Kata sandi tidak boleh kosong');</script>";
            echo "<script> location.href= '../masuk.php' ;</script>";
        } else {
            include "update_status.php";
            $query_masyarakat = mysqli_query($connect, "select * from tb_masyarakat where nama_lengkap = '".$nama."' or username = '".$nama."' and password = '".md5($kata_sandi)."';");
            $query_petugas = mysqli_query($connect, "select * from tb_petugas join tb_level on tb_level.id_level = tb_petugas.id_level where nama_petugas or username = '".$nama."' and password = '".md5($kata_sandi)."';");
            session_start();
            if(mysqli_num_rows($query_masyarakat) > 0) {
                $data_masyarakat = mysqli_fetch_array($query_masyarakat);
                $_SESSION['id_user'] = $data_masyarakat['id_user'];
                $_SESSION['nama_lengkap'] = $data_masyarakat['nama_lengkap'];
                $_SESSION['username'] = $data_masyarakat['username'];
                $_SESSION['nomor_telepon'] = $data_masyarakat['telp'];
                $_SESSION['foto_masyarakat'] = $data_masyarakat['foto'];
                $_SESSION['level'] = "masyarakat";
                $_SESSION['status_masuk'] = true;
                header("location: ../masyarakat/rumah_masyarakat.php");
            } elseif(mysqli_num_rows($query_petugas) > 0) {
                $data_petugas = mysqli_fetch_array($query_petugas);
                $_SESSION['id_petugas'] = $data_petugas['id_petugas'];
                $_SESSION['nama_petugas'] = $data_petugas['nama_petugas'];
                $_SESSION['username'] = $data_petugas['username'];
                $_SESSION['level'] = $data_petugas['level'];
                $_SESSION['status_masuk'] = true;
                if($data_petugas['level'] == 'petugas') {
                    header("location: ../petugas/rumah_petugas.php");
                } elseif($data_petugas['level'] == 'administrator') {
                    header("location: ../administrator/rumah_administrator.php");
                }
            } else {
                echo "<script> alert ('Nama atau kata sandimu salah');</script>";
                echo "<script> location.href= '../masuk.php' ;</script>";
            }
        }
    } else {
        header("location: ../masuk.php ");
    }
?>