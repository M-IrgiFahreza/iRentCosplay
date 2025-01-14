<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg navbar-dark warna1">
    <div class="container">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link me-4" href="index.php">Home</a>
            </li>
            <li class="nav-item me-4">
                <a class="nav-link" href="tentang-kami.php">Tentang Kami</a>
            </li>
            <li class="nav-item me-4">
                <a class="nav-link" href="produk.php">Produk</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <?php if (isset($_SESSION['username'])): ?>
            <!-- Jika sudah login, tampilkan tombol Profil -->
            <li class="nav-item">
                <a class="nav-link" href="akun.php">Profil</a>
            </li>
            <!-- Tombol Logout -->
            <li class="nav-item">
                <a class="nav-link" href="logout-user.php">Logout</a>
            </li>
            <?php else: ?>
            <!-- Jika belum login, tampilkan tombol Login -->
            <li class="nav-item">
                <a class="nav-link" href="login-user.php">Login</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>