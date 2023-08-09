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

$title = 'Detail Mahasiswa';

include 'Layout/Header.php';

// Mengambil id mahasiswa dari url
$id_mahasiswa = (int)$_GET['id_mahasiswa'];

// menampilkan data mahasiswa
$mahasiswa = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];
?>

<div class="container mt-5">
    <div class="mt-5">
        <h1>Data <?= $mahasiswa['nama']; ?></h1>
    </div>
    <hr>
    <table class="table table-bordered table-striped mt-3">
        <tr>
            <td>Nama</td>
            <td><?= $mahasiswa['nama']; ?></td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td><?= $mahasiswa['prodi']; ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td><?= $mahasiswa['jenis_kelamin']; ?></td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td><?= $mahasiswa['telepon']; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><?= $mahasiswa['alamat']; ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?= $mahasiswa['email']; ?></td>
        </tr>
        <tr>
            <td width="50%">Foto</td>
            <td>
                <a href="assetss/img/<?= $mahasiswa['foto']; ?>">
                    <img src="assets/img/<?= $mahasiswa['foto']; ?>" alt="Foto <?= $mahasiswa['nama']; ?>" width="50%">
                </a>
            </td>
        </tr>
    </table>
    <a href="Data-mahasiswa.php" class="btn btn-secondary btn-sm mb-5" style="float: right ;">Kembali</a>
</div>

<?php
include 'Layout/Footer.php';
?>