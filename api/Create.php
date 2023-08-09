<?php

header('Content-Type: application/json');

require '../config/App.php';

$namabarang = $_POST['nama'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];

// Validasi barang
if ($namabarang == null) {
    echo json_encode(['pesan' => 'Nama barang tidak boleh kosong']);
    exit;
}

// Query tambah data
$query = "INSERT INTO barang VALUES(null, '$namabarang', $jumlah, $harga, CURRENT_TIMESTAMP())";
mysqli_query($koneksi, $query);

// Cek status data
if ($query) {
    echo json_encode(['pesan' => 'Data barang berhasil ditambahkan']);
} else {
    echo json_encode(['pesan' => 'Data barang berhasil ditambahkan']);
}
