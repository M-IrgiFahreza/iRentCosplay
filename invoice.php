<?php
session_start();
require 'koneksi.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login-user.php");
    exit;
}

// Mengambil transaksi berdasarkan ID yang dikirimkan di URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $transaksi_id = $_GET['id'];

    // Ambil data transaksi dari database berdasarkan transaksi_id
    $query = "SELECT * FROM transaksi WHERE transaksi_id = ? AND user_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ii", $transaksi_id, $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $transaksi = mysqli_fetch_assoc($result);

        // Ambil detail transaksi dengan nama produk dari tabel produk
        $queryDetail = "SELECT dt.*, p.nama AS produk_nama
                        FROM detail_transaksi dt
                        JOIN produk p ON dt.produk_id = p.produk_id
                        WHERE dt.transaksi_id = ?";
        $stmtDetail = mysqli_prepare($con, $queryDetail);
        mysqli_stmt_bind_param($stmtDetail, "i", $transaksi_id);
        mysqli_stmt_execute($stmtDetail);
        $resultDetail = mysqli_stmt_get_result($stmtDetail);
    } else {
        echo "Transaksi tidak ditemukan.";
        exit;
    }
} else {
    echo "ID transaksi tidak valid.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Transaksi <?php echo $transaksi['transaksi_id']; ?></title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body>
    <?php require 'navbar.php'; ?>
    <div class="container my-5">
        <h1>Invoice - Transaksi #<?php echo $transaksi['transaksi_id']; ?></h1>

        <h3>Informasi Transaksi</h3>
        <p><strong>Tanggal:</strong> <?php echo $transaksi['tanggal']; ?></p>
        <p><strong>Alamat:</strong> <?php echo $transaksi['alamat']; ?></p>
        <p><strong>Kota:</strong> <?php echo $transaksi['kota']; ?></p>
        <p><strong>Kode Pos:</strong> <?php echo $transaksi['kode_pos']; ?></p>
        <p><strong>Nomor Telepon:</strong> <?php echo $transaksi['no_telepon']; ?></p>
        <p><strong>Metode Pembayaran:</strong> <?php echo $transaksi['metode_pembayaran']; ?></p>
        <p><strong>Status:</strong> <?php echo ucfirst($transaksi['status']); ?></p>

        <h3>Detail Pembelian</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultDetail)): ?>
                <tr>
                    <td><?php echo $row['produk_nama']; ?></td>
                    <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td><?php echo $row['jumlah']; ?></td>
                    <td>Rp <?php echo number_format($row['harga'] * $row['jumlah'], 0, ',', '.'); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <p><strong>Total Pembayaran:</strong> Rp <?php echo number_format($transaksi['total_harga'], 0, ',', '.'); ?>
        </p>

        <a href="akun.php" class="btn btn-secondary">Kembali ke Riwayat Pembayaran</a>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>