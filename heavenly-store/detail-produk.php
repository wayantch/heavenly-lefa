<?php
error_reporting(0);
include 'db.php';

$Kontak = mysqli_query($conn, "SELECT telp_admin, email_admin, alamat_admin FROM admin WHERE id_admin = 1");
$a = mysqli_fetch_object($Kontak);

$produk_query = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '" . $_GET['id'] . "'");
$produk  = mysqli_fetch_object($produk_query);

function getProdukImage($produk)
{
    return "./produk" . $produk->gambar_produk;
}

$penggunaan_gambar_produk =  getProdukImage($produk);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heavenly - Detail Produk</title>

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- ANIMATE -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/heavenly-store/css/dasboard.css">
    <link rel="shortcut icon" href="/heavenly-store/img/logo.png" type="image/x-icon">

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>

<style>
    .sold-out-overlay {
        position: relative;
        display: inline-block;
    }

    .sold-out-badge {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 100%;
        max-height: 100%;
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

    <!-- PRODUK DETAIL -->
    <div class="section">
        <div class="container">
            <a href="produk.php"><i data-feather="arrow-left"></i></a>
            <p></p>
            <div class="row mt-3">
                <div class="col-md-6">
                    <?php if ($produk->stok_produk >= 1) { ?>
                        <img src="./produk/<?php echo $produk->gambar_produk ?>" class="img-fluid" alt="<?php echo $produk->nama_produk; ?>">
                    <?php } else { ?>
                        <div class="sold-out-overlay">
                            <img src="./produk/<?php echo $produk->gambar_produk ?>" class="img-fluid" style="opacity: 60%;" alt="<?php echo $produk->nama_produk; ?>">
                            <img src="./img/soldout.png" class="sold-out-badge" alt="Sold Out">
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-6">
                    <h2><?php echo $produk->nama_produk; ?></h2>
                    <hr>
                    <?php if ($produk->stok_produk >= 1) { ?>
                        <h3 class="harga text-danger">Rp. <?php echo number_format($produk->harga_produk); ?></h3>
                    <?php } else { ?>
                        <h3 class="harga text-danger"><strike>Rp. <?php echo number_format($produk->harga_produk); ?></strike></h3>
                    <?php } ?>
                    <hr>
                    <h6>
                        <?php echo $produk->stok_produk ?> Pcs
                    </h6>
                    <hr>
                    <p><strong>Deskripsi:</strong>
                        <?php echo $produk->deskripsi_produk; ?>
                    </p>
                    <hr>
                    <!-- Add a dropdown menu for size selection -->
                    <select id="size" name="size" class="form-select mb-3">
                        <option value="">Size</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                        <!-- Add more options as needed -->
                        <!-- xnd_development_xsVJY1qePyq77PNJXIIo0Qr4zgR9FpjJFQCZneCZsAE05bA5Kch77eAKTDSBaHIY -->
                        <!-- Runr4uSimVfMjlnINrcfgMQ3m2xVla6CrBAXOjO0RiIKukoJ -->
                    </select>
                    <hr>
                    <?php if ($produk->stok_produk >= 1) { ?>
                        <div class="d-flex align-items-center mb-3">
                            <button id="decrement" class="btn btn-primary px-2">&minus;</button>
                            <p id="counter" class="mx-3">1</p>
                            <button id="increment" class="btn btn-primary px-2">&plus;</button>
                        </div>
                    <?php } else { ?>
                        <h3>Habisss...</h3>
                    <?php } ?>

                    <p class="btn-beli mt-2">
                        <?php if ($produk->stok_produk >= 1) { ?>
                            <a id="beliekarang" href="beli.php" class="btn btn-primary">Beli Sekarang...</a>
                        <?php } else { ?>
                            <a class="btn btn-primary" style="cursor: not-allowed; background-color: #ccc;" disabled>Beli Sekarang...</a>
                        <?php } ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- PRODUK DETAIL -->

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

    <!-- ICON -->
    <script>
        feather.replace();
    </script>

    <!-- ANIMATE -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy6pW9R+8WQTnD36dce726+Y4nE4fsyPsU" crossorigin="anonymous"></script>
    <script src="/heavenly-store/js/script.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-J6qa4849blE2+poUqDKLAgqBly1+98YDpZ6eEeXp6mR3Z/CfGFRb+UHg1QqzW1ck" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen tombol dan elemen angka
        var decrementButton = document.getElementById('decrement');
        var incrementButton = document.getElementById('increment');
        var counterElement = document.getElementById('counter');

        // Tambahkan event listener untuk tombol decrement
        decrementButton.addEventListener('click', function() {
            // Ambil nilai saat ini
            var currentValue = parseInt(counterElement.innerText);

            // Kurangi nilai jika lebih dari 0
            if (currentValue > 1) {
                counterElement.innerText = currentValue - 1;
            }
        });

        // Tambahkan event listener untuk tombol increment
        incrementButton.addEventListener('click', function() {
            // Ambil nilai saat ini
            var currentValue = parseInt(counterElement.innerText);

            // Tambahkan nilai
            counterElement.innerText = currentValue + 1;
        });
        });
    </script>

</body>

</html>