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
// Membatasi halaman sesuai user login
if ($_SESSION["level"] != 1 and $_SESSION["level"] != 3) {
    echo "<script>
          alert('Perhatian!! anda tidak punya hak akses.');
          document.location.href = 'Data-barang.php';
        </script>";
    exit;
}
$title = 'Daftar Mahasiswa';

include 'Layout/Header.php';

// menampilkan data mahasiswa
$data_mahasiswa = select("SELECT * FROM mahasiswa")
?>

<div class="container mt-5">
    <div class="mt-5">
        <h1><i class="fas fa-users"></i> Data Mahasiswa</h1>
    </div>
    <hr>
    <a href="Tambah-mahasiswa.php" class="btn btn-primary mb-2 mt-2"><i class="fas fa-plus"></i> Tambah</a>
    <a href="Download-excel-mahasiswa.php" class="btn btn-success mb-2 mt-2"><i class="fas fa-file-excel"></i> Download Excel</a>
    <a href="Download-pdf-mahasiswa.php" class="btn btn-danger mb-2 mt-2"><i class="fas fa-file-pdf"></i> Download PDF</a>
    <table class="table table-bordered table-striped mt-3" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Program Studi</th>
                <th>Jenis Kelamin</th>
                <th>Telepon</th>
                <th>Foto</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data_mahasiswa as $mahasiswa) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $mahasiswa['nama']; ?></td>
                    <td><?= $mahasiswa['prodi']; ?></td>
                    <td><?= $mahasiswa['jenis_kelamin']; ?></td>
                    <td><?= $mahasiswa['telepon']; ?></td>
                    <td><?= $mahasiswa['foto']; ?></td>
                    <td width="25%" class="text-center">
                        <a href="Detail-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-info"></i> Detail</a>
                        <a href="Ubah-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                        <a href="Hapus-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin data mahasiswa akan dihapus?.');"><i class="fas fa-trash"></i> Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
include 'Layout/Footer.php';
?>