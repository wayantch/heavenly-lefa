<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="container mt-5">
    <h1>Silahkan Konfirmasi pesanan</h1>
    <p>Anda membeli produk <?php echo $produk->nama_produk ?> dengan harga <?php echo $produk->harga_produk ?></p>
    <img src="./img/Qr.jpg" class="img-fluid" alt="QR Code" width="200px">

    <form action="" method="POST" class="mt-4">
        <div class="form-group">
            <label for="nama">Masukkan Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama Anda">
        </div>

        <div class="form-group">
            <label for="email">Masukkan Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email Anda">
        </div>

        <div class="form-group">
            <label for="gambar">Bukti Transfer</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Beli Sekarang</button>
    </form>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
