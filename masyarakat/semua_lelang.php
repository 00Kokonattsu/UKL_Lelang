<?php 
    include "../kepala.php";
    include "../proses/koneksi.php";
    $query_lelang = mysqli_query($connect, "select * from tb_lelang join tb_barang on tb_barang.id_barang=tb_lelang.id_barang where status = 'dibuka'");
?>

<title>Daftar Lelang yang Berlangsung</title>

<!-- <table align="center" width=80%>
    <tr>
        <th>Nomor</th>
    </tr>
</table> -->

<div class="row">
    <?php 
        while($data_lelang = mysqli_fetch_assoc($query_lelang)) {
            if($data_lelang['tanggal_tutup'] == null or $data_lelang['tanggal_tutup'] == "0000-00-00") {
                $tanggal_tutup = "Tanggal tutup belum ditentukan";
            } else {
                $tanggal_tutup = $data_lelang['tanggal_tutup'];
            }
            $harga = number_format($data_lelang['harga_akhir']);
    ?>
    <div class="col-3">
        <div class="card">
            <img src="../foto_barang/<?=$data_lelang['foto_barang']?>" alt="<?=$data_lelang['foto_barang']?>">
            <div class="card-body">
                <h4 class="card-title"><?$data_lelang['nama_barang']?></h4>
                Deskripsi: 
                <p class="card-text"><?=$data_lelang['deskripsi_barang']?></p>
                Harga akhir: 
                <p class="card-text">Rp<?=$harga?>,00,-</p>
                Ditutup tanggal: 
                <p class="card-text"><?=$tanggal_tutup?></p>
                <a href="lelang.php?id_lelang=<?=$data_lelang['id_lelang']?>" class="btn btn-outline-primary">Ikuti lelang</a>
            </div>
        </div>
    </div>
    <?php } ?>
</div>