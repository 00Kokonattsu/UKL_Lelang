<?php
    include "koneksi.php";
    // print_r($_POST);
    session_start();
    if($_SESSION['status_masuk']) {
        if($_POST['tipe_proses'] == "ubah") {
            $query_petugas = mysqli_query($connect, "select * from tb_petugas join tb_level on tb_level.id_level = tb_petugas.id_level where id_petugas = ".$_POST['id_petugas']);
            $data_petugas = mysqli_fetch_assoc($query_petugas);
            // print_r($data_petugas);
            if($_POST['kata_sandi'] == $data_petugas['password']){
                // echo "i";
                $ubah_petugas = mysqli_query($connect, "update tb_petugas set nama_petugas = '".$_POST['nama_petugas']."', username = '".$_POST['username']."' where id_petugas = ".$_POST['id_petugas']);
                $ubah_level = mysqli_query($connect, "update tb_level set level = '".$_POST['level']."' where id_level = ".$_POST['id_level']);
            } else {
                // echo "a";
                $ubah_petugas = mysqli_query($connect, "update tb_petugas set nama_petugas = '".$_POST['nama_petugas']."', username = '".$_POST['username']."', password = '".md5($_POST['kata_sandi'])."' where id_petugas = ".$_POST['id_petugas']);
                $ubah_level = mysqli_query($connect, "update tb_level set level = '".$_POST['level']."' where id_level = ".$_POST['id_level']);
            }

            if($ubah_petugas) {
                if($ubah_level) {
                echo "<script> alert ('Berhasil mengubah petugas');</script>";
                echo "<script> location.href='../administrator/semua_petugas.php';</script>";
            }
            } else {
                echo "<script> alert ('Gagal mengubah petugas');</script>";
                if($ubah_level == null) {
                    echo "level gagal";
                } if($ubah_petugas == null) {
                    echo "petugas gagal";
                }
                mysqli_error($connect);
            }
        } elseif($_GET['tipe_proses'] == "hapus") {
            $hapus = mysqli_query($connect, "delete from tb_petugas where id_petugas = ".$_GET['id_petugas']);

            if($hapus) {
                echo "<script> alert ('Berhasil menghapus data'); </script>";
                echo "<script> location.href='../administrator/semua_petugas.php';</script>";
            } else {
                echo "<script> alert ('Gagal menghapus petugas');</script>";
            }
        }
    }
?>