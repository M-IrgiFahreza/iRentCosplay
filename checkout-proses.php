<?php
session_start();
require 'koneksi.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login-user.php");
    exit;
}

// Mengambil data dari form dan validasi input
$user_id = $_SESSION['user_id'];
$alamat = isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : '';
$kota = isset($_POST['kota']) ? htmlspecialchars($_POST['kota']) : '';
$kode_pos = isset($_POST['kode_pos']) ? htmlspecialchars($_POST['kode_pos']) : '';
$no_telepon = isset($_POST['no_telepon']) ? htmlspecialchars($_POST['no_telepon']) : '';
$metode_pembayaran = isset($_POST['metode_pembayaran']) ? htmlspecialchars($_POST['metode_pembayaran']) : '';

// Validasi input
if (empty($alamat) || empty($kota) || empty($kode_pos) || empty($no_telepon) || empty($metode_pembayaran)) {
    header("Location: checkout.php?error=1");
    exit;
}

// Validasi nomor telepon
if (!preg_match("/^[0-9]{10,15}$/", $no_telepon)) {
    echo "Nomor telepon tidak valid.";
    exit;
}

// Cek apakah keranjang ada dan tidak kosong
if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) {
    echo "Keranjang Anda kosong. Silakan tambahkan produk sebelum checkout.";
    exit;
}

// Mengambil data keranjang
$keranjang = $_SESSION['keranjang'];
$totalHarga = 0;
foreach ($keranjang as $produk) {
    $totalHarga += $produk['harga'] * $produk['jumlah'];
}

// Menyimpan data transaksi ke database
$query = "INSERT INTO transaksi (user_id, alamat, kota, kode_pos, no_telepon, metode_pembayaran, total_harga, status)
          VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')";
$stmt = mysqli_prepare($con, $query);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sssssss", $user_id, $alamat, $kota, $kode_pos, $no_telepon, $metode_pembayaran, $totalHarga);
    if (mysqli_stmt_execute($stmt)) {
        $transaksi_id = mysqli_insert_id($con);  // Mendapatkan ID transaksi yang baru saja dimasukkan

        // Menyimpan rincian produk yang dibeli
        foreach ($keranjang as $produk) {
            $queryDetail = "INSERT INTO detail_transaksi (transaksi_id, produk_id, jumlah, harga)
                            VALUES (?, ?, ?, ?)";
            $stmtDetail = mysqli_prepare($con, $queryDetail);
            if ($stmtDetail) {
                mysqli_stmt_bind_param($stmtDetail, "iiis", $transaksi_id, $produk['produk_id'], $produk['jumlah'], $produk['harga']);
                if (!mysqli_stmt_execute($stmtDetail)) {
                    echo "Error executing detail transaksi query: " . mysqli_stmt_error($stmtDetail);
                    exit;
                }
                mysqli_stmt_close($stmtDetail);
            } else {
                echo "Terjadi kesalahan saat menyimpan detail transaksi.";
                exit;
            }
        }

        // Mengosongkan keranjang setelah transaksi berhasil
        unset($_SESSION['keranjang']);

        // Redirect ke halaman konfirmasi pembayaran atau detail transaksi
        header("Location: invoice.php?transaksi_id=" . $transaksi_id);
        exit;
    } else {
        echo "Terjadi kesalahan saat menyimpan transaksi: " . mysqli_stmt_error($stmt);
        exit;
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Terjadi kesalahan saat mempersiapkan query transaksi.";
    exit;
}
?>