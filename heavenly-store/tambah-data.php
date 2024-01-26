<?php
session_start();
include 'db.php';

if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heavenly - Tambah Data</title>

    <!-- ICON -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="/heavenly-store/css/dasboard.css">
    <link rel="stylesheet" href="/heavenly-store/css/responsive.css">
    <link rel="shortcut icon" href="/heavenly-store/img/logo.png" type="image/x-icon">

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
            <li><a href="keluar.php?id_admin=1"><i data-feather="log-out" onclick="return confirm('yakin?')"></i></a></li>
        </ul>
    </header>
    <!-- HEADER -->

    <!-- SECTION -->
    <div class="section">
        <div class="container">
            <a href="data-kategori.php"><i data-feather="arrow-left"></i></a>
            <h3>Tambah Kategori</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" required>
                    <input type="file" name="gambar_kategori" class="input-control">
                    <input type="submit" name="submit" class="btn" value="Tambah Data">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $nama = ucwords($_POST['nama']);

                    // Proses upload gambar
                    $gambar_kategori = $_FILES['gambar_kategori'];
                    $nama_file = $gambar_kategori['name'];
                    $tmp_file = $gambar_kategori['tmp_name'];
                    $path = "kategori/" . $nama_file;

                    // Pindahkan gambar ke direktori yang ditentukan
                    move_uploaded_file($tmp_file, $path);

                    $insert = mysqli_query($conn, "INSERT INTO kategori (nama_kategori, gambar_kategori) VALUES
                    ('" . $nama . "', '" . $nama_file . "' )
                    ");

                    if ($insert) {
                        echo "<script>alert('Kategori Di Tambahkan')</script>";
                        echo "<script>window.location='data-kategori.php'</script>";
                    } else {
                        echo "<script>alert('Gagal Menambahkan Kategori')</script>";
                        echo "<script>window.location='data-kategori.php'</script>";
                    }
                }
                ?>
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
