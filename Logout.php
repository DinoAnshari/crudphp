<?php
session_reset();

// Membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
          alert('Logout berhasil. Silahkan login ulang untuk masuk kembali ke akun anda.');
          document.location.href = 'Form-login.php';
        </script>";
    exit;
}

// Kosongkan $_SESSION user login
$_SESSION = [];

session_unset();
session_destroy();
header("Location: Form-login.php");
