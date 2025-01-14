<?php
require "session.php";
require "../koneksi.php";

$querykategori = mysqli_query($con, "SELECT * FROM kategori");
$jumlahkategori = mysqli_num_rows($querykategori);

$queryproduk = mysqli_query($con, "SELECT * FROM produk");
$jumlahproduk = mysqli_num_rows($queryproduk);

$querypelanggan = mysqli_query($con, "SELECT * FROM pelanggan");
$jumlahpelanggan = mysqli_num_rows($querypelanggan);

$querytransaksi = mysqli_query($con, "SELECT * FROM transaksi");
$jumlahtransaksi = mysqli_num_rows($querytransaksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">

    <style>
    body {
        background-color: #f5f5f5;
        font-family: 'Arial', sans-serif;
    }

    .navbar {
        padding: 10px;
        background-color: #007bff;
        color: white;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .no-decoration {
        text-decoration: none;
    }

    .breadcrumb-item {
        display: flex;
        align-items: center;
    }

    .breadcrumb-item i {
        margin-right: 5px;
        font-size: 1rem;
    }

    .summary-box {
        background: linear-gradient(135deg, #72c2e8, #c2e7f3);
        color: #000;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        padding: 20px;
    }

    .summary-box .icon {
        font-size: 6rem;
        margin-bottom: 10px;
        color: #ffffff90;
    }

    .summary-box h3 {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
    }

    .summary-box p {
        font-size: 1.5rem;
    }

    .container {
        max-width: 1200px;
    }

    .col-lg-4,
    .col-md-6 {
        transition: transform 0.3s;
        border-radius: 10px;
    }

    .col-lg-4:hover,
    .col-md-6:hover {
        transform: scale(1.05);
    }
    </style>
</head>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fa-solid fa-house"></i>&nbsp;Home
                </li>
            </ol>
        </nav>

        <h2>Hallo <?php echo $_SESSION['username']; ?></h2>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-box">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa-solid fa-layer-group icon"></i>
                            </div>
                            <div class="col-6">
                                <h3>Kategori</h3>
                                <p><?php echo $jumlahkategori; ?> Kategori</p>
                                <p><a href="kategori.php" class="text-white no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-box">
                        <div class="row">
                            <div class="col-6">
                                <i class="fas fa-box icon"></i>
                            </div>
                            <div class="col-6">
                                <h3>Produk</h3>
                                <p><?php echo $jumlahproduk; ?> Produk</p>
                                <p><a href="produk.php" class="text-white no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-box">
                        <div class="row">
                            <div class="col-6">
                                <i class="fas fa-users icon"></i>
                            </div>
                            <div class="col-6">
                                <h3>Pelanggan</h3>
                                <p><?php echo $jumlahpelanggan; ?> Pelanggan</p>
                                <p><a href="pelanggan.php" class="text-white no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-box">
                        <div class="row">
                            <div class="col-6">
                                <i class="fas fa-exchange-alt icon"></i>
                            </div>
                            <div class="col-6">
                                <h3>Transaksi</h3>
                                <p><?php echo $jumlahtransaksi; ?> Transaksi</p>
                                <p><a href="transaksi.php" class="text-white no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>