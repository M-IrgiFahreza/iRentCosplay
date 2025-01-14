<?php
session_start();
require 'koneksi.php';

// Pastikan keranjang belanja tidak kosong
if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) {
    header("Location: keranjang.php");
    exit;
}

$keranjang = $_SESSION['keranjang'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <h1>Checkout</h1>
        <h3>Rincian Pembelian</h3>
        <ul class="list-group">
            <?php
            $totalHarga = 0;
            foreach ($keranjang as $produk) {
                $totalHarga += $produk['harga'] * $produk['jumlah'];
                echo "<li class='list-group-item'>
                        <strong>{$produk['nama']}</strong><br>
                        Jumlah: {$produk['jumlah']}<br>
                        Harga: Rp " . number_format($produk['harga'], 0, ',', '.') . "<br>
                        Subtotal: Rp " . number_format($produk['harga'] * $produk['jumlah'], 0, ',', '.') . "
                    </li>";
            }
            ?>
        </ul>
        <hr>
        <p>Total Harga: Rp <?php echo number_format($totalHarga, 0, ',', '.'); ?></p>

        <h3>Informasi Pengiriman</h3>
        <form action="checkout-proses.php" method="POST">
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat Pengiriman</label>
                <textarea name="alamat" id="alamat" class="form-control" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="kota" class="form-label">Kota</label>
                <input type="text" name="kota" id="kota" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="kode_pos" class="form-label">Kode Pos</label>
                <input type="text" name="kode_pos" id="kode_pos" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="no_telepon" class="form-label">Nomor Telepon</label>
                <input type="text" name="no_telepon" id="no_telepon" class="form-control" required>
            </div>

            <h3>Metode Pembayaran</h3>
            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
                    <option value="cod">Cash on Delivery (COD)</option>
                </select>
            </div>
            <button onclick="initiatePayment()" class="btn btn-success w-100">Bayar dengan Midtrans</button>
            <button type="submit" class="btn btn-primary">Proses Pembayaran</button>
        </form>
    </div>
    <script src="js/payment.js"></script>

</body>

</html>