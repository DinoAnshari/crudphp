<?php
include 'config/App.php';

// Menerima id barang yang dipilih
$id_barang = (int)$_GET['id_barang'];


if (delete_barang($id_barang) > 0) {
    echo "<script>
                alert('Data barang berhasil dihapus');
                document.location.href = 'Data-barang.php'
            </script>";
} else {
    echo "<script>
                alert('Data barang gagal dihapus');
                document.location.href = 'Data-barang.php'
            </script>";
}
