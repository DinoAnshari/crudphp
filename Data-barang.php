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
if ($_SESSION["level"] != 1 and $_SESSION["level"] != 2) {
  echo "<script>
          alert('Perhatian!! anda tidak punya hak akses.');
          document.location.href = 'Data-mahasiswa.php';
        </script>";
  exit;
}

$title = 'Daftar Barang';

include 'Layout/Header.php';

// Menampilkan data barang
$data_barang = select("SELECT * FROM barang");
?>

<div class="container mt-5">
  <div class="mt-5">
    <h1><i class="fa fa-box"></i> Data Barang</h1>
  </div>
  <hr>
  <a href="Tambah-barang.php" class="btn btn-primary mb-2 mt-2"><i class="fas fa-plus"></i> Tambah</a>
  <table class="table table-bordered table-striped mt-3" id="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Barcode</th>
        <th>Tanggal</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; ?>
      <?php foreach ($data_barang as $barang) : ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $barang['nama_barang']; ?></td>
          <td><?= $barang['jumlah']; ?></td>
          <td>Rp<?= number_format($barang['harga'], 0, ',', '.'); ?></td>
          <td class="text-center">
            <img alt="testing" src="Barcode.php?codetype=Code128&size=20&text=<?= $barang['barcode']; ?>&print=true" />
          </td>
          <td><?= date('d/m/Y | H:i:s', strtotime($barang['tanggal'])); ?></td>
          <td width="20%" class="text-center">
            <a href="Ubah-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-success"><i class="fas fa-edit"></i> Ubah</a>
            <a href="Hapus-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-danger" onclick="return confirm('Yakin data barang akan dihapus?.');"><i class="fas fa-trash"></i> Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php
include 'Layout/Footer.php';
?>