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

$title = 'Daftar Akun';

include 'Layout/Header.php';

// Tampilkan seluruh data
$data_akun = select("SELECT * FROM akun");

// Tampilkan data berdasarkan user login
$id_akun = $_SESSION['id_akun'];
$data_bylogin = select("SELECT * FROM akun WHERE id_akun = $id_akun");

// Cek apabila tombol tambah ditekan
if (isset($_POST['tambah'])) {
    if (create_akun($_POST) > 0) {
        echo "<script>
                alert('Data akun berhasil ditambahkan');
                document.location.href = 'Data-akun.php'
            </script>";
    } else {
        echo "<script>
                alert('Data akun gagal ditambahkan');
                document.location.href = 'Data-akun.php'
            </script>";
    }
}

// Cek apabila tombol ubah ditekan
if (isset($_POST['ubah'])) {
    if (update_akun($_POST) > 0) {
        echo "<script>
                alert('Data akun berhasil diubah');
                document.location.href = 'Data-akun.php'
            </script>";
    } else {
        echo "<script>
                alert('Data akun gagal diubah');
                document.location.href = 'Data-akun.php'
            </script>";
    }
}
?>

<div class="container mt-5">
    <div class="mt-5">
        <h1><i class="fas fa-user-circle"></i> Data Akun</h1>
    </div>
    <hr>
    <?php if ($_SESSION['level'] == 1) : ?>
        <button type="button" class="btn btn-primary mb-2 mt-2" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus"></i> Tambah</button>
    <?php endif; ?>
    <table class="table table-bordered table-striped mt-3" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <!-- Tampil seluruh data -->
            <?php if ($_SESSION['level'] == 1) : ?>
                <?php foreach ($data_akun as $akun) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $akun['nama']; ?></td>
                        <td><?= $akun['username']; ?></td>
                        <td>Password ter-enkripsi</td>
                        <td><?= $akun['email']; ?></td>
                        <td width="20%" class="text-center">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_akun']; ?>"><i class="fas fa-edit"></i> Ubah</button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $akun['id_akun']; ?>"><i class="fas fa-trash"></i> Hapus</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Tampil data berdasarkan user login -->
                <?php foreach ($data_bylogin as $akun) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $akun['nama']; ?></td>
                        <td><?= $akun['username']; ?></td>
                        <td>Password ter-enkripsi</td>
                        <td><?= $akun['email']; ?></td>
                        <td width="10%" class="text-center">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_akun']; ?>"><i class="fas fa-edit"></i> Ubah</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" require>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" require>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" require>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" require>
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select class="form-control" id="level" name="level">
                            <option value="">---Pilih Level---</option>
                            <option value="1">Admin</option>
                            <option value="2">Operator Barang</option>
                            <option value="3">Operator Mahasiswa</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<?php foreach ($data_akun as $akun) : ?>
    <div class="modal fade" id="modalHapus<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin data akun <b><?= $akun['nama']; ?></b> akan dihapus?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="Hapus-akun.php?id_akun=<?= $akun['id_akun']; ?>" class="btn btn-danger" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Ubah -->
<?php foreach ($data_akun as $akun) : ?>
    <div class="modal fade" id="modalUbah<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah data akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" class="form-control" id="id_akun" name="id_akun" value="<?= $akun['id_akun']; ?>" require>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $akun['nama']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $akun['username']; ?>" require>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password <small>(masukan password baru/lama)</small></label>
                            <input type="password" class="form-control" id="password" name="password" value="<?= $akun['password']; ?>" minlength="5" require>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $akun['email']; ?>" require>
                        </div>
                        <?php if ($_SESSION['level'] == 1) : ?>
                            <div class="mb-3">
                                <label for="level" class="form-label">Level</label>
                                <select class="form-control" id="level" name="level">
                                    <?php $level = $akun['level']; ?>
                                    <option value="1" <?= $level == '1' ? 'selected' : null ?>>Admin</option>
                                    <option value="2" <?= $level == '2' ? 'selected' : null ?>>Operator Barang</option>
                                    <option value="3" <?= $level == '3' ? 'selected' : null ?>>Operator Mahasiswa</option>
                                </select>
                            </div>
                        <?php else : ?>
                            <input type="hidden" name="level" value="<?php $level = $akun['level']; ?>">
                        <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
<?php endforeach; ?>

<?php
include 'Layout/Footer.php';
?>