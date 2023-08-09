<?php
function select($query)
{
    global $koneksi;

    $result = mysqli_query($koneksi, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// Fungsi menambahkan data barang
function create_barang($post)
{
    global $koneksi;

    $namabarang = strip_tags($post['namabarang']);
    $jumlah = strip_tags($post['jumlah']);
    $harga = strip_tags($post['harga']);
    $barcode = rand(100000, 999999);

    // Query tambah data
    $query = "INSERT INTO barang VALUES(null, '$namabarang', '$jumlah', '$harga', '$barcode', CURRENT_TIMESTAMP())";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Fungsi mengubah data barang
function update_barang($post)
{
    global $koneksi;

    $id_barang = strip_tags($post['id_barang']);
    $namabarang = strip_tags($post['namabarang']);
    $jumlah = strip_tags($post['jumlah']);
    $harga = strip_tags($post['harga']);
    $barcode = rand(100000, 999999);

    // Query ubah data
    $query = "UPDATE barang SET nama_barang = '$namabarang', jumlah = '$jumlah', harga = '$harga', barcode = '$barcode' WHERE id_barang = $id_barang";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Fungsi menghapus data barang
function delete_barang($id_barang)
{
    global $koneksi;

    // Query hapus data
    $query = "DELETE FROM barang WHERE id_barang = $id_barang";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Fungsi menambahkan data mahasiswa
function create_mahasiswa($post)
{
    global $koneksi;

    $namamahasiswa = strip_tags($post['namamahasiswa']);
    $prodi = strip_tags($post['prodi']);
    $jenis_kelamin = strip_tags($post['jenis_kelamin']);
    $telepon = strip_tags($post['telepon']);
    $alamat = $post['alamat'];
    $email = strip_tags($post['email']);
    $foto = upload_file();

    // Cek upload foto
    if (!$foto) {
        return false;
    }

    // Query tambah data
    $query = "INSERT INTO mahasiswa VALUES(null, '$namamahasiswa', '$prodi', '$jenis_kelamin', $telepon, '$alamat', '$email', '$foto')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Fungsi mengubah data mahasiswa
function update_mahasiswa($post)
{
    global $koneksi;

    $id_mahasiswa = strip_tags($post['id_mahasiswa']);
    $namamahasiswa = strip_tags($post['namamahasiswa']);
    $prodi = strip_tags($post['prodi']);
    $jenis_kelamin = strip_tags($post['jenis_kelamin']);
    $telepon = strip_tags($post['telepon']);
    $alamat = $post['alamat'];
    $email = strip_tags($post['email']);
    $fotolama = strip_tags($post['fotolama']);

    // Cek upload foto baru atau tidak
    if ($_FILES['foto']['error'] == 4) {
        $foto = $fotolama;
    } else {
        $foto = upload_file();
    }

    // Query ubah data
    $query = "UPDATE mahasiswa SET nama = '$namamahasiswa', prodi = '$prodi', jenis_kelamin = '$jenis_kelamin', telepon = $telepon, alamat = '$alamat', email = '$email', foto = '$foto' WHERE id_mahasiswa = $id_mahasiswa";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Fungsi upload file
function upload_file()
{
    $namafile = $_FILES['foto']['name'];
    $ukuranfile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpnama = $_FILES['foto']['tmp_name'];

    // Cek file yang diupload
    $extensifilevalid = ['jpg', 'jpeg', 'png'];
    $extensifile = explode('.', $namafile);
    $extensifile = strtolower(end($extensifile));

    // Cek format/extensi file
    if (!in_array($extensifile, $extensifilevalid)) {
        // pesan gagal
        echo "<script>
                alert('Format file tidak valid');
                document.location.href = 'Tambah-mahasiswa.php'
            </script>";
        die();
    }

    // Cek ukuran file 2 mb
    if ($ukuranfile > 2048000) {
        echo "<script>
                alert('Ukuran file max 2 MB');
                document.location.href = 'Tambah-mahasiswa.php'
            </script>";
        die();
    }

    // Generate nama file baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $extensifile;

    // Pindahkan ke folder lokal
    move_uploaded_file($tmpnama, 'assets/img/' . $namafilebaru);
    return $namafilebaru;
}



// Fungsi menghapus data barang
function delete_mahasiswa($id_mahasiswa)
{
    global $koneksi;

    // Ambil foto sesuai data yang dipilih
    $foto = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];
    unlink("assets/img/" . $foto['foto']);

    // Query hapus data
    $query = "DELETE FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Fungsi menambahkan data akun
function create_akun($post)
{
    global $koneksi;

    $nama = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $password = strip_tags($post['password']);
    $email = strip_tags($post['email']);
    $level = strip_tags($post['level']);

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Query tambah data
    $query = "INSERT INTO akun VALUES(null, '$nama', '$username', '$password', '$email', '$level')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Fungsi mengubah data akun
function update_akun($post)
{
    global $koneksi;

    $id_akun = strip_tags($post['id_akun']);
    $nama = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $password = strip_tags($post['password']);
    $email = strip_tags($post['email']);
    $level = strip_tags($post['level']);

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Query ubah data
    $query = "UPDATE akun SET nama = '$nama', username = '$username', password = '$password', email = '$email', level = '$level' WHERE id_akun = $id_akun";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


// Fungsi menghapus data akun
function delete_akun($id_akun)
{
    global $koneksi;

    // Query hapus data
    $query = "DELETE FROM akun WHERE id_akun = $id_akun";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
