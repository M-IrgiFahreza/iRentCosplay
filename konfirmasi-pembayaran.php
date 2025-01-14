<?php
session_start();
require 'koneksi.php';

if (!isset($_GET['transaksi_id'])) {
    echo "ID transaksi tidak ditemukan!";
    exit;
}

$transaksi_id = $_GET['transaksi_id'];

// Ambil data transaksi
$queryTransaksi = "SELECT * FROM transaksi WHERE transaksi_id = ?";
$stmt = mysqli_prepare($con, $queryTransaksi);
mysqli_stmt_bind_param($stmt, "i", $transaksi_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$transaksi = mysqli_fetch_assoc($result);

if (!$transaksi) {
    echo "Transaksi tidak ditemukan!";
    exit;
}

// Ambil detail transaksi
$queryDetail = "SELECT dt.*, p.nama, p.harga FROM detail_transaksi dt
                JOIN produk p ON dt.produk_id = p.produk_id
                WHERE dt.transaksi_id = ?";
$stmtDetail = mysqli_prepare($con, $queryDetail);
mysqli_stmt_bind_param($stmtDetail, "i", $transaksi_id);
mysqli_stmt_execute($stmtDetail);
$details = mysqli_stmt_get_result($stmtDetail);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h2>Konfirmasi Pembayaran</h2>
        <h4>Transaksi ID: <?php echo $transaksi['transaksi_id']; ?></h4>
        <p>Status: <?php echo $transaksi['status']; ?></p>

        <h3>Rincian Pembelian</h3>
        <ul class="list-group">
            <?php
            $totalHarga = 0;
            while ($detail = mysqli_fetch_assoc($details)) {
                $subtotal = $detail['jumlah'] * $detail['harga'];
                $totalHarga += $subtotal;
                echo "<li class='list-group-item'>
                        <strong>{$detail['nama']}</strong><br>
                        Jumlah: {$detail['jumlah']}<br>
                        Harga: Rp " . number_format($detail['harga'], 0, ',', '.') . "<br>
                        Subtotal: Rp " . number_format($subtotal, 0, ',', '.') . "
                      </li>";
            }
            ?>
        </ul>
        <hr>
        <p>Total Harga: Rp <?php echo number_format($totalHarga, 0, ',', '.'); ?></p>
        <p>Metode Pembayaran: <?php echo $transaksi['metode_pembayaran']; ?></p>
        <p>Alamat Pengiriman: <?php echo $transaksi['alamat']; ?>, <?php echo $transaksi['kota']; ?>,
            <?php echo $transaksi['kode_pos']; ?></p>
        <p>Nomor Telepon: <?php echo $transaksi['no_telepon']; ?></p>

        <p>Silakan lakukan pembayaran ke metode yang telah dipilih. Terima kasih!</p>
    </div>
</body>

</html>