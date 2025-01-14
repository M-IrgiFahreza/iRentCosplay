<?php
session_start();
require 'koneksi.php';

// Cek jika ada produk yang ingin dihapus
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Cek apakah produk ada di keranjang
    if (isset($_SESSION['keranjang'])) {
        foreach ($_SESSION['keranjang'] as $key => $produk) {
            if ($produk['produk_id'] == $id) {
                // Hapus produk dari session
                unset($_SESSION['keranjang'][$key]);
                // Re-index array session
                $_SESSION['keranjang'] = array_values($_SESSION['keranjang']);
                break;
            }
        }
    }
}

// Redirect kembali ke halaman keranjang setelah penghapusan
header("Location: keranjang.php");
exit();
?>