<?php 
    session_start();
    include "koneksi.php";
    if($_SESSION['status_masuk'] != true) {
        header("location: ../masuk.php");
    } else {
        if(empty($_POST['tipe_proses'])) {
            $tipe_proses = $_GET['tipe_proses'];
        } elseif(empty($_GET['tipe_proses'])) {
            $tipe_proses = $_POST['tipe_proses'];
        }
        if($tipe_proses == "tambah") {
            $query_barang = mysqli_query($connect, "select * from tb_barang where id_barang = ".$_POST['id_barang']);
            $data_barang = mysqli_fetch_assoc($query_barang);
            $tambah = mysqli_query($connect, "insert into tb_lelang(id_barang, tanggal_buka, tanggal_tutup, harga_akhir) value(".$_POST['id_barang'].", '".$_POST['tanggal_buka']."', '".$_POST['tanggal_tutup']."', ".$data_barang['harga_awal'].");");
            include "update_status.php";
            if($tambah) {
                echo "<script> alert ('Berhasil menambahkan lelang');</script>";
                echo "<script> location.href='../petugas/semua_lelang_petugas.php';</script>";
            } else {
                echo "<script> alert ('Gagal menambahkan lelang');</script>";
            }
        } elseif($tipe_proses == "ubah") {
            if($_POST['tanggal_buka']) {
                $ubah = mysqli_query($connect, "update tb_lelang set tanggal_buka = '".$_POST['tanggal_buka']."', tanggal_tutup = '".$_POST['tanggal_tutup']."' where id_lelang = ".$_POST['id_lelang']);
            } else {
                $ubah = mysqli_query($connect, "update tb_lelang set tanggal_tutup = '".$_POST['tanggal_tutup']."' where id_lelang = ".$_POST['id_lelang']);
            }
            include "update_status.php";
            if($ubah) {
                echo "<script> alert ('Berhasil mengubah lelang');</script>";
                echo "<script> location.href='../petugas/semua_lelang_petugas.php';</script>";
            } else {
                echo "<script> alert ('Gagal mengubah lelang');</script>";
            }
        } elseif($tipe_proses == "hapus") {
            $hapus = mysqli_query($connect, "delete from tb_lelang where id_lelang = ".$_GET['id_lelang']);
            if($hapus) {
                echo "<script> alert ('Berhasil menghapus lelang');</script>";
                echo "<script> location.href='../petugas/semua_lelang_petugas.php';</script>";
            } else {
                echo "<script> alert ('Gagal menghapus lelang'); </script>";
            }
        } elseif($tipe_proses == 'penawaran') {
            $query_lelang = mysqli_query($connect, "select * from tb_lelang where id_lelang = ".$_POST['id_lelang']);
            $data_lelang = mysqli_fetch_assoc($query_lelang);
            if($_POST['harga_tawar'] <= $data_lelang['harga_akhir']) {
                echo "<script> alert ('Harga penawaran tidak boleh sama atau lebih kecil dari harga akhir'); </script>";
                echo "<script> location.href='../masyarakat/lelang.php?id_lelang=".$_POST['id_lelang']."'; </script>";
            } else {
                $penawaran = mysqli_query($connect, "insert into tb_peserta_lelang(id_lelang, id_user, harga_tawar, komentar) value(".$_POST['id_lelang'].", ".$_SESSION['id_user'].", ".$_POST['harga_tawar'].", '".$_POST['komentar']."')");
                if($penawaran) {
                    $update_harga = mysqli_query($connect, "update tb_lelang set id_user = ".$_SESSION['id_user'].", harga_akhir = ".$_POST['harga_tawar']." where id_lelang = ".$_POST['id_lelang']);
                } else {
                    echo "Gagal melakukan penawaran";
                }
                if($penawaran and $update_harga) {
                    echo "<script> alert ('Berhasil melakukan penawaran'); </script>";
                    echo "<script> location.href='../masyarakat/lelang.php?id_lelang=".$_POST['id_lelang']."'; </script>";
                } else {
                    echo "Gagal memperbarui harga";
                }
            }
        }
    }
?>