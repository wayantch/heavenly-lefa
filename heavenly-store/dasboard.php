<?php
// Memulai sesi
session_start();

// Jika status login tidak benar, redirect ke halaman login
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

// Memasukkan file koneksi database
include 'db.php';

// Mengambil data admin dari database
$admin = mysqli_query($conn, "SELECT * FROM admin");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heavenly - Dasboard</title>

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- CSS -->
    <link rel="shortcut icon" href="/heavenly-store/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/heavenly-store/css/dasboard.css">
    <link rel="stylesheet" href="/heavenly-store/css/responsive.css">

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">

</head>

<body>
    <!-- HEADER -->
    <header>
        <h1><a href="dasboard.php">Heavenly Store</a></h1>
        <div class="menu">
            <i data-feather="menu" id="menu"></i>
        </div>
        <ul id="menu-list" class="hidden">
            <li><a href="dasboard.php">Dasboard</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="data-kategori.php">Data Kategori</a></li>
            <li><a href="data-produk.php">Data Produk</a></li>
            <li class="logout"><a href="keluar.php?id_admin = 1" onclick="return confirm('yakin?')"><i data-feather="log-out"></i></a></li>
        </ul>

    </header>
    <!-- HEADER -->

    <!-- SECTION -->
    <div class="section">
        <div class="container">
            <h3>Dasboard</h3>
            <div class="box">
                                                    <!-- Memanggil nama admin yang di input di login -->
                <h4>Selamat Datang <?php echo ucfirst($_SESSION['a_global']->nama_admin) ?> Di Heavenly Store</h4>
            </div>
        </div>
    </div>
    <!-- SECTION -->

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <small>CopyRight &copy; 2024 - Heavenly</small>
        </div>
    </footer>
    <!-- FOOTER -->

    <script>
        feather.replace();
    </script>

    <script src="/heavenly-store/js/script.js"></script>
</body>

</html>