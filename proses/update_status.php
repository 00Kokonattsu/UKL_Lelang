<?php 
    include "koneksi.php";
    $query_lelang = mysqli_query($connect, "select * from tb_lelang");
    while($data_lelang = mysqli_fetch_assoc($query_lelang)) {
        if($data_lelang['status'] == 'ditutup') {
            if(date("Y-m-d") == $data_lelang['tanggal_buka']) {
                $update = mysqli_query($connect, "update tb_lelang set status = 'dibuka' where id_lelang = ".$data_lelang['id_lelang']);
                if($update == false) {
                    echo "gagal update status membuka lelang";
                }
            } else {}
        } elseif($data_lelang['status'] == 'dibuka') {
            if(date("Y-m-d") == $data_lelang['tanggal_tutup']) {
                $update = mysqli_query($connect, "update tb_lelang set status = 'diakhiri' where id_lelang = ".$data_lelang['id_lelang']);
                if($update == false) {
                    echo "gagal update status mengakhiri lelang";
                }
            } else {}
        }
    }
?>