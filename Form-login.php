<?php
session_start();

include 'config/App.php';

// Cek apakah tombol login ditekan
if (isset($_POST['login'])) {
    // Ambil input username dan password
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // cek username
    $result = mysqli_query($koneksi, "SELECT * FROM akun WHERE username = '$username'");

    // Jika ada user
    if (mysqli_num_rows($result) == 1) {

        $hasil = mysqli_fetch_assoc($result);

        // cek password
        if (password_verify($password, $hasil['password'])) {
            // Set session
            $_SESSION['login'] = true;
            $_SESSION['id_akun'] = $hasil['id_akun'];
            $_SESSION['nama'] = $hasil['nama'];
            $_SESSION['username'] = $hasil['username'];
            $_SESSION['email'] = $hasil['email'];
            $_SESSION['level'] = $hasil['level'];

            header("Location:Data-barang.php");
            exit;
        }
    }
    // Jika tidak ad user/login salah
    $error = true;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">



    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assetss/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assetss/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assetss/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assetss/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assetss/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assetss/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="assets/css/signin.css" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin">
        <form action="" method="POST">
            <img class="mb-4" src="assets/logo/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Admin Login</h1>
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger text-center">
                    <b>Username/Password SALAH</b>
                </div>
            <?php endif; ?>
            <div class="mb-3 form-floating">
                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username...">
                <label for="floatingInput" require>Username</label>
            </div>
            <div class="mb-3 form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password...">
                <label for="floatingPassword" require>Password</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="ingat-saya"> ingat saya
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Login</button>
            <p class="mt-5 mb-3 text-muted">Copyright&copy; Dino <?= date('Y'); ?></p>
        </form>
    </main>

</body>

</html>