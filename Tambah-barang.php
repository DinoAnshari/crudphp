<?php

session_start();

// Membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
          alert('Silahkan login terlebih dulu.');
          document.location.href = 'Form-login.php';
        </script>";
    exit;
}

$title = 'Tambah Barang';

include 'Layout/Header.php';

// Cek apabila tombol tambah ditekan
if (isset($_POST['tambah'])) {
    if (create_barang($_POST) > 0) {
        echo "<script>
                alert('Data barang berhasil ditambahkan');
                document.location.href = 'Data-barang.php'
            </script>";
    } else {
        echo "<script>
                alert('Data barang gagal ditambahkan');
                document.location.href = 'Data-barang.php'
            </script>";
    }
}
?>

<div class="container mt-5">
    <div class="mt-5">
        <h1>Tambah Barang</h1>
    </div>
    <hr>
    <form action="" method="post">
        <div class="mb-3">
            <label for="namabarang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="namabarang" name="namabarang">
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga">
        </div>
        <button type="submit" name="tambah" class="btn btn-primary mb-5" style="float: right;">Tambah</button>
    </form>
</div>

<?php
include 'Layout/Footer.php';
?>