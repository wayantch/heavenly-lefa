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
    <title>Heavenly - Data Produk</title>

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
            <h3>Produk</h3>
            <div class="box">
                <p class="tambah-data"><a href="tambah-produk.php" >+Tambah Produk</a></p>
                <div class="table-container">
                    <table border="1" cellspacing="0" class="table-produk">
                        <thead>
                            <tr>
                                <th width="50px">No</th>
                                <th>Kategori</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Status</th>
                                <th>Stok</th>
                                <th width="150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $produk = mysqli_query($conn, "SELECT * FROM produk LEFT JOIN kategori USING (id_kategori) ORDER BY  id_produk DESC");
                            if (mysqli_num_rows($produk) > 0) {

                                while ($row = mysqli_fetch_array($produk)) { ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td class="kategori" style="text-align: left;"><?php echo ucwords($row['nama_kategori']) ?></td>
                                        <td class="kategori" style="text-align: left;"><?php echo ucwords($row['nama_produk']) ?></td>
                                        <td class="kategori" style="text-align: left;">Rp. <?php echo number_format(ucwords($row['harga_produk'])) ?></td>
                                        <td class="kategori" style="text-align: left;"><?php echo ucwords($row['deskripsi_produk']) ?></td>
                                        <td><img src="produk/<?php echo $row['gambar_produk'] ?>" alt="" width="50px"></td>
                                        <td class="kategori" style="text-align: left;"><?php echo ucwords(($row['status_produk'] == 0) ? 'Tidak Aktif' : 'Aktif') ?></td>
                                        <td class="kategori"><?php echo $row['stok_produk'] ?></td>
                                        <td>
                                            <a href="edit-produk.php?id=<?php echo $row['id_produk'] ?>">Edit</a>|| <a href="hapus.php?idp=<?php echo $row['id_produk'] ?>" onclick="return confirm('Yakin???')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php } 
                            } else { ?>
                                <tr>
                                    <td colspan="8">Tidak Ada Produk</td>
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