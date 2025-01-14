<?php
require "koneksi.php";
session_start();

// Ambil data produk berdasarkan nama produk
$nama = htmlspecialchars($_GET['nama']);
$stmt = $con->prepare("SELECT * FROM produk WHERE nama = ?");
$stmt->bind_param("s", $nama);
$stmt->execute();
$result = $stmt->get_result();
$produk = $result->fetch_assoc();

if (!$produk) {
    die("Produk tidak ditemukan.");
}

// Ambil produk terkait berdasarkan kategori
$stmt = $con->prepare("SELECT * FROM produk WHERE kategori_id = ? AND produk_id != ? LIMIT 4");
$stmt->bind_param("ii", $produk['kategori_id'], $produk['produk_id']);
$stmt->execute();
$queryProdukTerkait = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Detail Produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<style>
.produk-terkait-image {
    height: auto;
    width: 100%;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.produk-terkait-image:hover {
    transform: scale(1.1);
    box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.3);
}

.text-center {
    font-size: 1.1rem;
    color: #ffff;
    margin-top: 10px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: color 0.3s ease;
}

.text-center:hover {
    color: #fefae0;
}

@media (max-width: 768px) {
    .produk-terkait-image {
        width: 90%;
        /* Lebar lebih kecil pada layar tablet */
    }
}
</style>

</style>

<body>
    <!-- Navbar -->
    <?php require "navbar.php"; ?>

    <!-- Detail Produk -->
    <div class="container-fluid my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="image/<?php echo $produk['foto']; ?>" class="w-100" alt="">
                </div>
                <div class="col-md-6 offset-md-1">
                    <h1><?php echo $produk['nama']; ?></h1>
                    <p class="fs-5"><?php echo $produk['detail']; ?></p>
                    <p class="text-harga">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                    <p class="fs-5">Status Ketersediaan : <strong><?php echo $produk['ketersediaan_stok']; ?></strong>
                    </p>

                    <div class="row">
                        <!-- Form Beli Sekarang -->
                        <div class="col-md-6 mb-3">
                            <form action="checkout.php" method="POST">
                                <input type="hidden" name="produk_id" value="<?php echo $produk['produk_id']; ?>">
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control" value="1"
                                        min="1" max="<?php echo $produk['ketersediaan_stok']; ?>">
                                </div>
                                <?php if (isset($_SESSION['username'])) { ?>
                                <button type="submit" name="beli" value="1" class="btn btn-success w-100">Beli
                                    Sekarang</button>
                                <?php } else { ?>
                                <a href="login-user.php?redirect=<?php echo urlencode("produk-detail.php?nama=" . $produk['nama']); ?>"
                                    class="btn btn-success w-100">Login untuk Beli Sekarang</a>
                                <?php } ?>
                            </form>
                        </div>

                        <!-- Form Tambah ke Keranjang -->
                        <div class="col-md-6 mb-3">
                            <form action="keranjang-tambah.php" method="POST">
                                <input type="hidden" name="produk_id" value="<?php echo $produk['produk_id']; ?>">
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control" value="1"
                                        min="1" max="<?php echo $produk['ketersediaan_stok']; ?>">
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Tambah ke Keranjang</button>
                            </form>
                        </div>
                    </div>


                    <!-- Produk Terkait -->
                    <div class="container-fluid py-5 warna1">
                        <div class="container">
                            <h2 class="text-center text-white mb-5">Produk Terkait</h2>
                            <div class="row">
                                <?php 
                                if ($queryProdukTerkait->num_rows > 0) {
                                    while ($data = $queryProdukTerkait->fetch_assoc()) { ?>
                                <div class="col-md-6 col-lg-3 mb-3">
                                    <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>">
                                        <img src="image/<?php echo $data['foto']; ?>"
                                            class="img-fluid img-thumbnail produk-terkait-image" alt="">
                                        <p class="text-center"><?php echo $data['nama']; ?></p>
                                    </a>
                                </div>
                                <?php } 
                                } else {
                                    echo "<div class='col-12'><p class='text-center text-white'>Produk terkait tidak tersedia.</p></div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Form Ulasan -->
                    <?php
                    $queryUlasan = mysqli_query($con, "SELECT username, rating, komentar, tanggal FROM ulasan WHERE produk_id = '" . $produk['produk_id'] . "' ORDER BY tanggal DESC");

                    if (mysqli_num_rows($queryUlasan) > 0) {
                        while ($ulasan = mysqli_fetch_array($queryUlasan)) {
                            echo "<div class='ulasan-item'>";
                            echo "<strong>" . $ulasan['username'] . "</strong><br>";
                            echo "<span class='text-warning'>";
                            for ($i = 1; $i <= 5; $i++) {
                                echo $i <= $ulasan['rating'] ? '★' : '☆';
                            }
                            echo "</span><br>";
                            echo "<p>" . nl2br($ulasan['komentar']) . "</p>";
                            echo "<small class='text-muted'>" . date('d M Y, H:i', strtotime($ulasan['tanggal'])) . "</small><br>";
                            echo "</div><hr>";
                        }
                    } else {
                        echo "<p>Belum ada ulasan untuk produk ini.</p>";
                    }
                    ?>

                    <!-- Formulir ulasan (jika user sudah membeli produk) -->
                    <?php if (isset($_SESSION['user_id'])) { 
                        $user_id = $_SESSION['user_id'];
                        $queryPembelian = mysqli_query($con, "
                            SELECT dt.produk_id 
                            FROM detail_transaksi dt
                            INNER JOIN transaksi t ON t.transaksi_id = dt.transaksi_id
                            WHERE t.user_id = '$user_id' 
                            AND t.status = 'paid' 
                            AND dt.produk_id = '" . $produk['produk_id'] . "'
                        ");

                        if (mysqli_num_rows($queryPembelian) > 0) { ?>
                    <form action="tambah-ulasan.php" method="POST">
                        <input type="hidden" name="produk_id" value="<?php echo $produk['produk_id']; ?>">
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select name="rating" id="rating" class="form-select" required>
                                <option value="1">1 - Sangat Buruk</option>
                                <option value="2">2 - Buruk</option>
                                <option value="3">3 - Cukup</option>
                                <option value="4">4 - Baik</option>
                                <option value="5">5 - Sangat Baik</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="komentar" class="form-label">Komentar</label>
                            <textarea name="komentar" id="komentar" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                    </form>
                    <?php } else { ?>
                    <p>Anda hanya dapat memberikan ulasan setelah membeli produk ini.</p>
                    <?php }
                    } else { ?>
                    <p>Silakan <a href="login-user.php">login</a> untuk memberikan ulasan.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php require "footer.php"; ?>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>