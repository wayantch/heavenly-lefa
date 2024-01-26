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
    <title>Heavenly - Tambah Produk</title>

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
            <a href="data-produk.php"><i data-feather="arrow-left"></i></a>
            <h3>Tambah Data Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select name="kategori" class="input-control" required>
                        <option value="">=== Pilih ===</option>
                        <?php
                        $kategori = mysqli_query($conn, "SELECT * FROM kategori  ORDER BY id_kategori DESC");
                        while ($r = mysqli_fetch_array($kategori)) { ?>
                            <option value="<?php echo $r['id_kategori'] ?>"><?php echo $r['nama_kategori'] ?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                    <input type="file" name="gambar" class="input-control" required>
                    <textarea name="deskripsi" class="input-control" placeholder="Deskripsi Produk" required></textarea>
                    <input type="number" name="stok" class="input-control" placeholder="Stok" required>
                    <select name="status" class="input-control">
                        <option value="">=== Pilih ===</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" class="btn" value="Tambah Produk">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    // print_r($_FILES['gambar']);
                    //menampung inputan dari form
                    $kategori = $_POST['kategori'];
                    $nama = $_POST['nama'];
                    $harga = $_POST['harga'];
                    $deskripsi = $_POST['deskripsi'];
                    $status = $_POST['status'];
                    $stok = $_POST['stok'];

                    //menampung data file yang di upload
                    $fileName = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];
                    $tipe1 = explode('.', $fileName);
                    $tipe2 = end($tipe1);

                    $newName = 'produk' . time() . '.' . $tipe2;

                    //menampung data format file yang diizinkan
                    $tipe_izinkan = array('jpg', 'jpeg', 'png', 'gif');

                    //validasi format file
                    if (!in_array($tipe2, $tipe_izinkan)) {
                        echo '<script>alert("Format file tidak diizinkan")</script>';
                    } else {
                        move_uploaded_file($tmp_name, './produk/' . $newName);

                        $insert = mysqli_query($conn, "INSERT INTO produk VALUES(
            null, '" . $kategori . "', '" . $nama . "','" . $harga . "','" . $deskripsi . "','" . $newName . "','" . $status . "','" . $stok . "', null
        )");    

                        if ($insert) {
                            echo '<script>alert("Data Produk Berhasil Ditambah")</script>';
                            echo '<script>window.location="data-produk.php"</script>';
                        } else {
                            echo 'Data Produk Gagal Disimpan' . mysqli_error($conn);
                        }
                    }
                }
                ?>

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