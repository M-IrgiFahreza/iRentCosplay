<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'koneksi.php';

// Ambil data keranjang untuk pengguna
if (isset($_SESSION['keranjang'])) {
    $keranjang = $_SESSION['keranjang'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body>
    <?php require 'navbar.php'; ?>
    <div class="container my-5">
        <h1>Keranjang Belanja</h1>
        <?php if (!empty($keranjang)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalHarga = 0;
                foreach ($keranjang as $row): 
                    $totalHarga += $row['harga'] * $row['jumlah'];
                ?>
                <tr>
                    <td><img src="image/<?php echo $row['foto']; ?>" width="50"></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td><?php echo $row['jumlah']; ?></td>
                    <td>Rp <?php echo number_format($row['jumlah'] * $row['harga'], 0, ',', '.'); ?></td>
                    <td>
                        <a href="keranjang-hapus.php?id=<?php echo $row['produk_id']; ?>"
                            class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><strong>Total Harga: </strong>Rp <?php echo number_format($totalHarga, 0, ',', '.'); ?></p>
        <a href="checkout.php" class="btn btn-primary">Lanjut ke Checkout</a>
        <?php else: ?>
        <p>Keranjang belanja Anda kosong.</p>
        <?php endif; ?>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>