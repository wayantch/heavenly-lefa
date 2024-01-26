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
    <title>Heavenly - Data Kategori</title>

    <!-- ICON -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="/heavenly-store/css/dasboard.css">
    <link rel="stylesheet" href="/heavenly-store/css/data-kategori.css">
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
            <h3>Kategori</h3>
            <div class="box">
                <p class="tambah-data"><a href="tambah-data.php">+Tambah Kategori</a></p>
                <div class="table-container">
                    <table border="1" cellspacing="0" class="table-kategori">
                        <thead>
                            <tr>
                                <th width="50px">No</th>
                                <th>Kategori</th>
                                <th>Gambar</th>
                                <th width="150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY  id_kategori DESC");
                            while ($row = mysqli_fetch_array($kategori)) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td class="kategori"><?php echo ucwords($row['nama_kategori']) ?></td>
                                    <td><img src="./kategori/<?php echo $row['gambar_kategori']; ?>" alt="" width="50px"></td>
                                    <td>
                                        <!-- redirect ke edit/hapus dengan menngambil id -->
                                        <a href="edit-kategori.php?id=<?php echo $row['id_kategori'] ?>">Edit</a>|| <a href="hapus.php?idk=<?php echo $row['id_kategori'] ?>" onclick="return confirm('Yakin???')">Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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