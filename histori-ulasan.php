<?php
session_start();
require 'koneksi.php';

$user_id = $_SESSION['user_id']; // Ambil ID pengguna dari session

// Query untuk mengambil histori ulasan berdasarkan user_id
$query = "SELECT p.nama AS produk, u.ulasan, u.rating FROM ulasan u 
          JOIN produk p ON u.produk_id = p.produk_id
          WHERE u.user_id = ?";
$stmt = mysqli_prepare($con, $query);

if ($stmt === false) {
    die("Query gagal dijalankan: " . mysqli_error($con));
}

mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

echo "<h3>Histori Ulasan</h3>";
echo "<ul class='list-group'>";
while ($ulasan = mysqli_fetch_assoc($result)) {
    echo "<li class='list-group-item'>
            <strong>{$ulasan['produk']}</strong><br>
            Ulasan: {$ulasan['ulasan']}<br>
            Rating: {$ulasan['rating']} / 5
          </li>";
}
echo "</ul>";

mysqli_stmt_close($stmt);
mysqli_close($con);
?>