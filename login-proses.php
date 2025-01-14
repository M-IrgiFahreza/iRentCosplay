<?php
session_start();
require "koneksi.php";

// Ambil data dari form login
$email = $_POST['email'];
$password = $_POST['password'];

// Cek apakah email dan password ada di database
$query = mysqli_query($con, "SELECT * FROM pelanggan WHERE email = '$email' AND password = '$password'");
$user = mysqli_fetch_array($query);

if ($user) {
    // Set session jika login berhasil
    $_SESSION['user_id'] = $user['user_id'];  // Pastikan user_id diset
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    
    // Redirect ke halaman produk atau halaman lain setelah login berhasil
    header('Location: index.php');
    exit();
} else {
    // Jika login gagal
    echo "Email atau password salah.";
}
?>