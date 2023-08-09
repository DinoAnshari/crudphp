<?php

header('Content-Type: application/json');

require '../config/App.php';

// Menerima request input put/update
parse_str(file_get_contents('php://input'), $put);

$id_barang = $put['id_barang'];
$namabarang = $put['nama'];
$jumlah = $put['jumlah'];
$harga = $put['harga'];

// Validasi barang
if ($namabarang == null) {
    echo json_encode(['pesan' => 'Nama barang tidak boleh kosong']);
    exit;
}

// Query ubah data
$query = "UPDATE barang SET nama_barang = '$namabarang', jumlah = $jumlah, harga = $harga WHERE id_barang = $id_barang";
mysqli_query($koneksi, $query);

// Cek status data
if ($query) {
    echo json_encode(['pesan' => 'Data barang berhasil diubah']);
} else {
    echo json_encode(['pesan' => 'Data barang berhasil diubah']);
}
