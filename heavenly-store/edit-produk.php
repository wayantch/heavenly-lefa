<?php
session_start();
include 'db.php';

if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

$produk_query = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '" . $_GET['id'] . "'");
$produk = mysqli_fetch_object($produk_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heavenly - Edit Produk</title>

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
            <h3>Edit Data Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select name="kategori" class="input-control" required>
                        <option value="">=== Pilih ===</option>
                        <?php
                        $kategori = mysqli_query($conn, "SELECT * FROM kategori  ORDER BY id_kategori DESC");
                        while ($r = mysqli_fetch_array($kategori)) { ?>
                            <option value="<?php echo $r['id_kategori'] ?>" <?php echo ($r['id_kategori'] == $produk->id_kategori) ? 'selected' : ''; ?>><?php echo $r['nama_kategori'] ?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $produk->nama_produk ?>" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $produk->harga_produk ?>" required>

                    <img src="./produk/<?php echo $produk->gambar_produk ?>" style="max-width: 200px; max-height: 200px;">
                    <input type="hidden" name="foto" value="<?php echo $produk->gambar_produk ?>">
                    <input type="file" name="gambar" class="input-control">
                    <textarea name="deskripsi" class="input-control" placeholder="Deskripsi Produk" required><?php echo $produk->deskripsi_produk ?></textarea>
                    <input type="number" name="stok" class="input-control" value="<?php echo $produk->stok_produk ?>" required>
                    <select name="status" class="input-control">
                        <option value="">=== Pilih ===</option>
                        <option value="1" <?php echo ($produk->status_produk == 1) ? 'selected' : ''; ?>>Aktif</option>
                        <option value="0" <?php echo ($produk->status_produk == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" class="btn" value="Edit Produk">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    // Data inputan dari form
                    $kategori = $_POST['kategori'];
                    $nama = $_POST['nama'];
                    $harga = $_POST['harga'];
                    $deskripsi = $_POST['deskripsi'];
                    $status = $_POST['status'];
                    $stok = $_POST['stok'];
                    $foto = $_POST['foto'];

                    // Jika admin ganti gambar
                    $fileName = $_FILES['gambar']['name'];
                    
                    if ($fileName != '') {
                        // Data gambar yang baru
                        $tmp_name = $_FILES['gambar']['tmp_name'];
                        $tipe1 = explode('.', $fileName);
                        $tipe2 = end($tipe1);

                        $newName = 'produk' . time() . '.' . $tipe2;
                        // Menampung data format file yang diizinkan
                        $tipe_izinkan = array('jpg', 'jpeg', 'png', 'gif');

                        // Validasi format file
                        if (!in_array($tipe2, $tipe_izinkan)) {
                            echo '<script>alert("Format file tidak diizinkan")</script>';
                        } else {
                            unlink('./produk/' . $foto);
                            move_uploaded_file($tmp_name, './produk/' . $newName);
                            $namaGambar = $newName;
                        }
                    } else {
                        // Jika admin tidak ganti gambar
                        $namaGambar = $foto;
                    }
                    // Query update data produk
                    $update = mysqli_query($conn, "UPDATE produk SET
                        id_kategori = '" . $kategori . "',
                        nama_produk = '" . $nama . "',
                        deskripsi_produk = '" . $deskripsi . "',
                        harga_produk = '" . $harga . "',
                        status_produk = '" . $status . "',
                        gambar_produk = '" . $namaGambar . "',
                        stok_produk = '" . $stok . "'
                        WHERE id_produk = '" . $produk->id_produk . "'
                    ");

                    if ($update) {
                        echo '<script>alert("Data Produk Berhasil Diedit")</script>';
                        echo '<script>window.location="data-produk.php"</script>';
                    } else {
                        echo 'Data Produk Gagal Diedit' . mysqli_error($conn);
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