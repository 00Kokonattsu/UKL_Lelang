<?php 
    include "koneksi.php";
    session_start();
    if($_SESSION['status_masuk'] != true) {
        header("location: ../masuk.php");
    } else {
        if(empty($_POST['tipe_proses'])) {
            $tipe_proses = $_GET['tipe_proses'];
        } elseif(empty($_GET['tipe_proses'])) {
            $tipe_proses = $_POST['tipe_proses'];
        }
        if($tipe_proses == 'tambah') {
            $temp = $_FILES['foto_barang']['tmp_name'];
            $unggah_foto = move_uploaded_file($temp, "../foto_barang/".$_FILES['foto_barang']['name']);
            if($unggah_foto) {
                $tambah = mysqli_query($connect, "insert into tb_barang(nama_barang, tanggal, harga_awal, deskripsi_barang, foto_barang) value('".$_POST['nama_barang']."', '".date("y-m-d")."', ".$_POST['harga_awal'].", '".$_POST['deskripsi_barang']."', '".$_FILES['foto_barang']['name']."')");
                if($tambah) {
                    echo "<script> alert ('Berhasil menambahkan barang');</script>";
                    echo "<script> location.href='../petugas/semua_barang.php';</script>";
                } else {
                    echo "Gagal memasukkan data ke database";
                }
            } else {
                echo "Gagal mengunggah foto/gambar";
            }
        } elseif($tipe_proses == 'ubah') {
            $ubah = mysqli_query($connect, "update tb_barang set nama_barang = '".$_POST['nama_barang']."', harga_awal = '".$_POST['harga_awal']."', deskripsi_barang = '".$_POST['deskripsi_barang']."' where id_barang = ".$_POST['id_barang']);
            if($_FILES['foto_barang']['tmp_name']) {
                $temp = $_FILES['foto_barang']['tmp_name'];
                $unggah_foto = move_uploaded_file($temp, "../foto_barang/".$_FILES['foto_barang']['name']);
                $ganti_gambar = mysqli_query($connect, "update tb_barang set foto_barang = '".$_FILES['foto_barang']['name']."' where id_barang = ".$_POST['id_barang']);
                if($ubah and $ganti_gambar) {
                    echo "<script> alert ('Berhasil mengubah data barang');</script>";
                    echo "<script> location.href='../petugas/semua_barang.php';</script>";
                } else {
                    echo "Gagal mengubah data barang dan foto";
                }
            }
            if($ubah) {
                echo "<script> alert ('Berhasil mengubah data barang');</script>";
                echo "<script> location.href='../petugas/semua_barang.php';</script>";
            } else {
                echo "Gagal mengubah data barang";
            }
        } elseif($tipe_proses == 'hapus') {
            $hapus = mysqli_query($connect, "delete from tb_barang where id_barang = ".$_GET['id_barang']);
            if($hapus) {
                echo "<script> alert ('Berhasil menghapus data barang'); </script>";
                echo "<script> location.href='../petugas/semua_barang.php'; </script>";
            } else {
                echo "Gagal menghapus data barang";
            }
        }
    }
?>