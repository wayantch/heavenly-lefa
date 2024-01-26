<?php
session_start();
include 'db.php';

if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

$query = mysqli_query($conn, "SELECT * FROM admin WHERE id_admin = '" . $_SESSION['id'] . "'");
$d = mysqli_fetch_object($query)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heavenly - Profil</title>

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
            <li><a href="keluar.php?id_admin = 1"><i data-feather="log-out" onclick="return confirm('yakin?')"></i></a></li>
        </ul>
    </header>
    <!-- HEADER -->

    <!-- SECTION -->
    <div class="section">
    <div class="container">
        <h3>Profil</h3>
        <div class="box">
            <form action="" method="POST">
                <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo ucwords($d->nama_admin) ?>" required>
                <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo ucwords($d->username) ?>" required>
                <input type="text" name="hp" placeholder="No Hp" class="input-control" value="<?php echo ucwords($d->telp_admin) ?>" required>
                <input type="text" name="email" placeholder="Email" class="input-control" value="<?php echo $d->email_admin ?>" required>
                <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo ucwords($d->alamat_admin) ?>" required>
                <input type="submit" name="submit" class="btn" value="Ubah Profil">
            </form>
            <?php
            if (isset($_POST['submit'])) {
                $nama = $_POST['nama'];
                $user = $_POST['user'];
                $hp = $_POST['hp'];
                $email = $_POST['email'];
                $alamat = $_POST['alamat'];

                $update = mysqli_query($conn, "UPDATE admin SET 
                    nama_admin = '" . $nama . "',
                    username = '" . $user . "',
                    telp_admin = '" . $hp . "',
                    email_admin = '" . $email . "',
                    alamat_admin = '" . $alamat . "'
                    WHERE id_admin = '" . $d->id_admin . "'");

                if ($update) {
                    echo "<script>alert('Ubah data berhasil')</script>";
                    echo "<script>window.location='profil.php'</script>";
                } else {
                    echo "Gagal " . mysqli_error($conn);
                }
            }
            ?>
        </div>
        <h3>Ubah Password</h3>
        <div class="box">
            <form action="" method="POST">
                <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
                <input type="password" name="pass2" placeholder="Konfirmasi Password" class="input-control" required>
                <input type="submit" name="ubah_password" class="btn" value="Ubah Password">
            </form>
            <?php
if (isset($_POST['ubah_password'])) {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if ($pass2 != $pass1) {
        echo "<script>alert('Konfirmasi Salah')</script>";
    } else {
        $uPass = mysqli_query($conn, "UPDATE admin SET 
            password = '" . md5($pass1) . "'
            WHERE id_admin = '" . $d->id_admin . "'");

        if ($uPass) {
            echo "<script>alert('Ubah data berhasil')</script>";
            echo "<script>window.location='profil.php'</script>";
        } else {
            echo "Gagal " . mysqli_error($conn);
        }
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