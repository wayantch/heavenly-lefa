<?php
session_start();
include 'db.php';

if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

$kategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori = '" . $_GET['id'] . "'");
if (mysqli_num_rows($kategori) == 0) {
    echo "<script>window.location='data-kategori.php'</script>";
}
$k = mysqli_fetch_object($kategori);

if (isset($_POST['submit'])) {
    $nama = ucwords($_POST['nama']);

    // Periksa apakah ada file yang diunggah
    if (!empty($_FILES['gambar_kategori']['name'])) {
        // Jika ada file yang diunggah, proses gambar
        $nama_file = $_FILES['gambar_kategori']['name'];
        $temp = $_FILES['gambar_kategori']['tmp_name'];
        move_uploaded_file($_FILES['gambar_kategori']['tmp_name'], 'kategori/' . $nama_file);
    } else {
        // Jika tidak ada file yang diunggah, gunakan nama file sebelumnya
        $nama_file = $_POST['gambar_kategori_sebelumnya'];
    }

    // Menggunakan parameterisasi query
    $stmt = $conn->prepare("UPDATE kategori SET nama_kategori = ?, gambar_kategori = ? WHERE id_kategori = ?");
    $stmt->bind_param("ssi", $nama, $nama_file, $k->id_kategori);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Edit Data Berhasil')</script>";
        echo "<script>window.location='data-kategori.php'</script>";
    } else {
        echo "<script>alert('Edit Data Gagal')</script>";
        echo "<script>window.location='data-kategori.php'</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heavenly - Edit Kategori</title>

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
            <h3>Edit Data Kategori</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="text" name="nama" placeholder="Nama Kategori" value="<?php echo $k->nama_kategori ?>" class="input-control" required>
                    <img src="./kategori/<?php echo $k->gambar_kategori; ?>" alt="Gambar Kategori" width="50">
                    <input type="file" name="gambar_kategori" class="input-control">
                    <input type="hidden" name="gambar_kategori_sebelumnya" value="<?php echo $k->gambar_kategori; ?>">
                    <input type="submit" name="submit" class="btn" value="Edit Kategori">
                </form>
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