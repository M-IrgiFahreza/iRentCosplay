<?php
require 'koneksi.php';
session_start();

if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: login-user.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produk_id = $_POST['produk_id'];
    $username = $_SESSION['username'];
    $rating = $_POST['rating'];
    $komentar = mysqli_real_escape_string($con, $_POST['komentar']);

    // Simpan ulasan ke dalam tabel ulasan
    $query = "INSERT INTO ulasan (produk_id, username, rating, komentar) VALUES ('$produk_id', '$username', '$rating', '$komentar')";
    
    if (mysqli_query($con, $query)) {
        // Redirect kembali ke halaman produk detail
        header("Location: produk-detail.php?nama=" . urlencode($produk['nama']));
        exit();
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($con);
    }
}
?>