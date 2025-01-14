<?php
require "koneksi.php";

// Query kategori untuk sidebar
$queryKategori = mysqli_query($con, "SELECT * FROM kategori");

// Menangani pencarian berdasarkan keyword
if (isset($_GET['keyword'])) {
    // Sanitasi input untuk mencegah SQL injection
    $keyword = mysqli_real_escape_string($con, $_GET['keyword']);
    
    // Menyesuaikan query untuk pencarian lebih spesifik
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama LIKE '%$keyword%'");
}
// Menangani pencarian berdasarkan kategori
else if (isset($_GET['kategori'])) {
    // Sanitasi input untuk mencegah SQL injection
    $kategori = mysqli_real_escape_string($con, $_GET['kategori']);
    $queryGetKategoriId = mysqli_query($con, "SELECT id FROM kategori WHERE nama='$kategori'");
    $kategoriId = mysqli_fetch_array($queryGetKategoriId);
    
    // Memastikan kategori ditemukan sebelum mencari produk
    if ($kategoriId) {
        $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
    } else {
        $queryProduk = mysqli_query($con, "SELECT * FROM produk"); // Default jika kategori tidak ditemukan
    }
}
// Jika tidak ada pencarian, tampilkan semua produk
else {
    $queryProduk = mysqli_query($con, "SELECT * FROM produk");
}

$countData = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iRent Cosplay | Produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require "navbar.php"; ?>
    <div class="container-fluid banner-produk d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-center">Produk</h1>
        </div>
    </div>

    <!-- body-->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <h3>Kategori</h3>
                <ul class="list-group">
                    <?php while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
                    <a href="produk.php?kategori=<?php echo urlencode($kategori['nama']); ?>">
                        <li class="list-group-item"><?php echo $kategori['nama']; ?></li>
                    </a>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Produk</h3>
                <div class="row">
                    <?php
                    // Menangani jika tidak ada produk yang ditemukan
                    if ($countData < 1) {
                        echo '<h4 class="text-center my-5">Produk yang Anda cari tidak tersedia.</h4>';
                    }

                    // Menampilkan produk
                    while ($produk = mysqli_fetch_array($queryProduk)) {
                    ?>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src="image/<?php echo $produk['foto']; ?>" class="card-img-top" alt="">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $produk['nama']; ?></h5>
                                <p class="card-text text-truncate"><?php echo $produk['detail']; ?></p>
                                <p class="card-text text-harga">Rp
                                    <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                                <a href="produk-detail.php?nama=<?php echo urlencode($produk['nama']); ?>"
                                    class="btn warna2">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <?php require"footer.php"; ?>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>