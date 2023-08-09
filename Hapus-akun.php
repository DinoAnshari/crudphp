<?php
include 'config/App.php';

// Menerima id akun yang dipilih
$id_akun = (int)$_GET['id_akun'];


if (delete_akun($id_akun) > 0) {
    echo "<script>
                alert('Data akun berhasil dihapus');
                document.location.href = 'Data-akun.php'
            </script>";
} else {
    echo "<script>
                alert('Data akun gagal dihapus');
                document.location.href = 'Data-akun.php'
            </script>";
}
