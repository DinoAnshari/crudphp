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

$title = 'Tambah mahasiswa';

include 'Layout/Header.php';

// Cek apabila tombol tambah ditekan
if (isset($_POST['tambah'])) {
    if (create_mahasiswa($_POST) > 0) {
        echo "<script>
                alert('Data mahasiswa berhasil ditambahkan');
                document.location.href = 'Data-mahasiswa.php'
            </script>";
    } else {
        echo "<script>
                alert('Data mahasiswa gagal ditambahkan');
                document.location.href = 'Data-mahasiswa.php'
            </script>";
    }
}
?>

<div class="container mt-5">
    <div class="mt-5">
        <h1>Tambah mahasiswa</h1>
    </div>
    <hr>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="namamahasiswa" class="form-label">Nama mahasiswa</label>
            <input type="text" class="form-control" id="namamahasiswa" name="namamahasiswa" placeholder="Nama..." require>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <label for="prodi" class="form-label">Program Studi</label>
                <select class="form-control" id="prodi" name="prodi">
                    <option value="">---Pilih Program Studi---</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Teknik Industri">Teknik Industri</option>
                    <option value="Teknik Sipil">Teknik Sipil</option>
                    <option value="Teknik Mesin">Teknik Mesin</option>
                </select>
            </div>

            <div class="mb-3 col-6">
                <label for="jenis_kelamin" class="form-label">jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                    <option value="">---Pilih Jenis Kelamin---</option>
                    <option value="L">L</option>
                    <option value="P">P</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" placeholder="08XXXXXXXXXX" require>
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat..." require></textarea>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="name@gmail.com" require>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" placeholder="foto.jpg" onchange="previewimg()" require>
            <img src="" alt="" class="img-thumbnail img-preview mt-2" width="15%">
        </div>
        <button type="submit" name="tambah" class="btn btn-primary mb-5" style="float: right;">Tambah</button>
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