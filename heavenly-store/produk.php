<?php
error_reporting(0);
include 'db.php';

$Kontak = mysqli_query($conn, "SELECT telp_admin, email_admin, alamat_admin FROM admin WHERE id_admin = 1");
$a = mysqli_fetch_object($Kontak);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heavenly - Produk</title>

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/heavenly-store/css/dasboard.css">
    <link rel="shortcut icon" href="/heavenly-store/img/logo.png" type="image/x-icon">

    <!-- ANIMATE -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />


    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>

<style>
        .card:hover {
            box-shadow: 4px 6px 10px rgba(0, 0, 0, 0.4);
        }

        .sold-out-container {
            position: relative;
            display: inline-block;
        }
        .sold-out {
            opacity: 0.8;
            filter: blur(1px);
        }

        .sold-out-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            z-index: 1;
        }
    </style>

<style>
    .card:hover {
        box-shadow: 4px 6px 10px rgba(0, 0, 0, 0.4);
    }
</style>

<body>
    <!-- HEADER -->
    <header class="bg-primary text-light p-3">
        <div class="container">
            <h1><a href="#" class="text-light text-decoration-none">Heavenly Store</a></h1>
            <ul id="menu-list" class="">
                <li class="nav-item"><a href="produk.php" class="nav-link text-light"> Semua Produk</a></li>
            </ul>
        </div>
    </header>
    <!-- HEADER -->

    <!-- SEARCH -->
    <div class="search mt-2">
        <div class="container" >
            <form action="produk.php" method="GET">
                <div class="input-group mb-3">
                    <a href="index.php" class="text-decoration-none input-group-text" data-aos="fade-right" style="background-color: transparent;"><i data-feather="arrow-left"></i></a>
                    <input type="text" name="search" class="form-control" data-aos="zoom-out" placeholder="Cari Disini..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    <input type="hidden" name="kat" value="<?php echo isset($_GET['kat']) ? $_GET['kat'] : ''; ?>">
                    <div class="input-group-append ">
                        <button type="submit" name="cari" class="btn btn-primary" data-aos="fade-left">Cari Produk</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- SEARCH -->



    <!-- NEW PRODUK -->
    <div class="section">
        <div class="container">
            <h3 data-aos="fade-right">Semua Produk</h3>
            <div class="row" data-aos="fade-up">
                <?php
                if ($_GET['search'] != '' || $_GET['kat'] != '') {
                    $where = "AND nama_produk LIKE '%" . $_GET['search'] . "%' AND id_kategori LIKE '%" . $_GET['kat'] . "%' ";
                }
                $produk_query = mysqli_query($conn, "SELECT * FROM produk WHERE status_produk = 1 $where ORDER BY id_produk DESC ");
                if (mysqli_num_rows($produk_query) > 0) {
                    while ($produk = mysqli_fetch_array($produk_query)) { ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                            <a href="detail-produk.php?id=<?php echo $produk['id_produk'] ?>" class="text-decoration-none text-dark">
                                <div class="card">
                                <?php if ($produk['stok_produk'] >= 1) { ?>
                                    <img src="./produk/<?php echo $produk['gambar_produk'] ?>" class="card-img-top" alt="">
                                <?php } else { ?>
                                    <div class="sold-out-container">
                                        <img src="./produk/<?php echo $produk['gambar_produk'] ?>" class="card-img-top sold-out" alt="">
                                        <img src="./img/soldout.png" class="sold-out-overlay" alt="Sold Out">
                                    </div>
                                <?php } ?>
                                    <div class="card-body">
                                        <p class="card-title fs-5" style="color: #858585;"><?php echo ucwords($produk['nama_produk']) ?></p>
                                        <p class=""><?php echo $produk['stok_produk'] ?> Pcs</p>
                                        <p class="card-text text-danger text-end">Rp. <?php echo number_format($produk['harga_produk']) ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                } else { ?>
                    <p class="col-12">Produk Tidak Ada...</p>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- NEW PRODUK -->

    <!-- FOOTER -->
    <div class="footer bg-primary text-light p-3">
        <div class="container">
            <h4>Alamat:</h4>
            <p><?php echo ucwords($a->alamat_admin) ?></p>

            <h4>Email:</h4>
            <p><?php echo $a->email_admin ?></p>

            <h4>No HP:</h4>
            <p><?php echo $a->telp_admin ?></p>
            <small>CopyRight &copy; 2024 - Heavenly</small>
        </div>
    </div>
    <!-- FOOTER -->

    <!-- ANIMATE -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script>
        feather.replace();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy6pW9R+8WQTnD36dce726+Y4nE4fsyPsU" crossorigin="anonymous"></script>
    <script src="/heavenly-store/js/script.js"></script>
</body>

</html>