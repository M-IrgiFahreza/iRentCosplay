<?php
session_start();
require 'koneksi.php';

// Cek apakah produk_id dan jumlah ada di POST
if (isset($_POST['produk_id']) && isset($_POST['jumlah'])) {
    $produk_id = $_POST['produk_id'];
    $jumlah = $_POST['jumlah'];

    // Ambil data produk dari database
    $query = "SELECT * FROM produk WHERE produk_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $produk_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $produk = mysqli_fetch_assoc($result);

    if ($produk) {
        // Menambahkan produk ke dalam keranjang sesi
        if (!isset($_SESSION['keranjang'])) {
            $_SESSION['keranjang'] = [];
        }

        $keranjang = $_SESSION['keranjang'];
        // Cek apakah produk sudah ada di keranjang
        $produk_exists = false;
        foreach ($keranjang as &$item) {
            if ($item['produk_id'] == $produk_id) {
                $item['jumlah'] += $jumlah;
                $produk_exists = true;
                break;
            }
        }

        if (!$produk_exists) {
            $produk['jumlah'] = $jumlah;
            $_SESSION['keranjang'][] = $produk;
        }
    }
}

header("Location: keranjang.php");
exit;