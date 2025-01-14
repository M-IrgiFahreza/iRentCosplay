<?php
// koneksi.php
$host = 'localhost'; // Atau alamat server database
$user = 'root'; // Username MySQL
$pass = ''; // Password MySQL
$db   = 'toko_online'; // Nama database

// Membuat koneksi
$con = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>