<?php
    include "../kepala.php";
    include "../proses/koneksi.php";
    $query_barang = mysqli_query($connect, "select * from tb_barang");
?>

<title>Tambah lelang</title>

<h1 align="center">Tambah lelang</h1>

<table width=60% align="center">
    <tr>
        <td>
            <form action="../proses/proses_lelang.php" method="post">
                Barang yang dilelang: <br>
                <select name="id_barang" class="form-control" required>
                    <?php while($data_barang = mysqli_fetch_assoc($query_barang)) {
                        $query_saring_barang = mysqli_query($connect, "select * from tb_lelang where id_barang = ".$data_barang['id_barang']);
                        if(mysqli_num_rows($query_saring_barang) > 0){
                        } else {
                            echo "<option value='".$data_barang['id_barang']."'>".$data_barang['nama_barang']." ".$data_lelang['id_barang']."</option>";
                        }
                    } ?>
                </select> <br>
                Tanggal buka: (opsional) <br>
                <input type="date" name="tanggal_buka" class="form-control"><br>
                Tanggal tutup: (opsional) <br>
                <input type="date" name="tanggal_tutup" class="form-control"> <br>
                <input type="hidden" name="tipe_proses" value="tambah">
                <button type="submit" class="btn btn-outline-success">Tambah</button>
            </form>
        </td>
    </tr>
</table>