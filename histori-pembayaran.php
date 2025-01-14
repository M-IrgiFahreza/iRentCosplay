<?php
// Pastikan session_start() hanya dipanggil sekali
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Menghubungkan ke database
require 'koneksi.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login-user.php");
    exit;
}

// Ambil data riwayat transaksi pengguna
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM transaksi WHERE user_id = ? ORDER BY tanggal DESC";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pembayaran</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body>
    <?php require 'navbar.php'; ?>
    <div class="container my-5">
        <h1>History Pembayaran</h1>
        <?php if (mysqli_num_rows($result) > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['transaksi_id']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td>Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                    <td><?php echo ucfirst($row['status']); ?></td>
                    <td>
                        <a href="invoice.php?id=<?php echo $row['transaksi_id']; ?>" class="btn btn-info">Lihat
                            Invoice</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>Anda belum memiliki riwayat transaksi.</p>
        <?php endif; ?>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>