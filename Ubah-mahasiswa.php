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

$title = 'Bbah mahasiswa';

include 'Layout/Header.php';

// Mengabil id mahasiswa dari url
$id_mahasiswa = (int)$_GET['id_mahasiswa'];

$mahasiswa = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];

// Cek apabila tombol ubah ditekan
if (isset($_POST['ubah'])) {
    if (update_mahasiswa($_POST) > 0) {
        echo "<script>
                alert('Data mahasiswa berhasil ubah');
                document.location.href = 'Data-mahasiswa.php'
            </script>";
    } else {
        echo "<script>
                alert('Data mahasiswa gagal ubah');
                document.location.href = 'Data-mahasiswa.php'
            </script>";
    }
}
?>

<div class="container mt-5">
    <div class="mt-5">
        <h1>Ubah mahasiswa</h1>
    </div>
    <hr>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_mahasiswa" value="<?= $mahasiswa['id_mahasiswa']; ?>">
        <input type="hidden" name="fotolama" value="<?= $mahasiswa['foto']; ?>">

        <div class="mb-3">
            <label for="namamahasiswa" class="form-label">Nama mahasiswa</label>
            <input type="text" class="form-control" id="namamahasiswa" name="namamahasiswa" placeholder="Nama..." value="<?= $mahasiswa['nama']; ?>" require>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <label for="prodi" class="form-label">Program Studi</label>
                <select class="form-control" id="prodi" name="prodi">
                    <?php $prodi = $mahasiswa['prodi']; ?>
                    <option value="">---Pilih Program Studi---</option>
                    <option value="Teknik Informatika" <?= $prodi == 'Teknik Informatika' ? 'selected' : null ?>>Teknik Informatika</option>
                    <option value="Teknik Industri" <?= $prodi == 'Teknik Industri' ? 'selected' : null ?>>Teknik Industri</option>
                    <option value="Teknik Sipil" <?= $prodi == 'Teknik Sipil' ? 'selected' : null ?>>Teknik Sipil</option>
                    <option value="Teknik Mesin" <?= $prodi == 'Teknik Mesin' ? 'selected' : null ?>>Teknik Mesin</option>
                </select>
            </div>

            <div class="mb-3 col-6">
                <label for="jenis_kelamin" class="form-label">jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                    <option value="">---Pilih Jenis Kelamin---</option>
                    <?php $jenis_kelamin = $mahasiswa['jenis_kelamin']; ?>
                    <option value="L" <?= $jenis_kelamin == 'L' ? 'selected' : null ?>>L</option>
                    <option value="P" <?= $jenis_kelamin == 'P' ? 'selected' : null ?>>P</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Telepon..." value="<?= $mahasiswa['telepon']; ?>" require>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="name@gmail.com" value="<?= $mahasiswa['email']; ?>" require>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" placeholder="foto.jpg" onchange="previewimg()" require>

            <img src="assetss/img/<?= $mahasiswa['foto']; ?>" alt="" class="img-thumbnail img-preview mt-2" width="15%">
        </div>
        <button type="submit" name="ubah" class="btn btn-primary mb-5" style="float: right;">Ubah</button>
    </form>
</div>

<!-- Preview img -->

<script>
    function previewimg() {
        const foto = document.querySelector('#foto');
        const imgpreview = document.querySelector('.img-preview');

        const filefoto = new FileReader();
        filefoto.readAsDataURL(foto.files[0]);

        filefoto.onload = function(e) {
            imgpreview.src = e.target.result;
        }
    }
</script>

<?php
include 'Layout/Footer.php';
?>