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

$title = 'Ubah Data Barang';

include 'Layout/Header.php';

// Mengambil id_barang dari url
$id_barang = (int)$_GET['id_barang'];

$barang = select("SELECT * FROM barang WHERE id_barang = $id_barang")[0];

// Cek apabila tombol tambah ditekan
if (isset($_POST['ubah'])) {
    if (update_barang($_POST) > 0) {
        echo "<script>
                alert('Data barang berhasil diubah');
                document.location.href = 'Data-barang2.php'
            </script>";
    } else {
        echo "<script>
                alert('Data barang gagal diubah');
                document.location.href = 'Data-barang2.php'
            </script>";
    }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ubah Data Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Data-barang2.php">Data Barang</a></li>
                        <li class="breadcrumb-item active">Ubah Data Barang</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post">
                <input type="hidden" name="id_barang" value="<?= $barang['id_barang'] ?>">
                <div class="mb-3">
                    <label for="namabarang" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="namabarang" name="namabarang" value="<?= $barang['nama_barang'] ?>">
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $barang['jumlah'] ?>">
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="<?= $barang['harga'] ?>">
                </div>
                <button type="submit" name="ubah" class="btn btn-primary mb-5" style="float: right;">Ubah</button>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>

<?php

require 'layout/Footer.php';

?>