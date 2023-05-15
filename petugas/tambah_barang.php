<?php
    include "../kepala.php";
?>

<title>Tambah data barang</title>

<table width=60% align="center">
    <tr>
        <td>
            <h2>Tambah data barang</h2>
            <form action="../proses/proses_barang.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="tipe_proses" value="tambah">
                Nama barang: <br>
                <input type="text" name="nama_barang" class="form-control" required> <br>
                Harga awal: <br>
                <input type="number" name="harga_awal" class="form-control" required> <br>
                Deskripsi barang: <br>
                <textarea name="deskripsi_barang" cols="30" rows="10" class="form-control"></textarea> <br>
                Foto barang: <br>
                <input type="file" name="foto_barang" class="form-control" required> <br>
                <button type="submit" class="btn btn-success"> + Tambah barang </button>
            </form>
        </td>
    </tr>
</table>