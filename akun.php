<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login-user.php"); // Arahkan ke halaman login jika belum login
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Akun</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
    /* Styling untuk Navbar */
    .navbar {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background-color: #354649;
    }



    /* Styling untuk Sidebar */
    .list-group-item {
        font-size: 18px;
        font-weight: 500;
        color: #495057;
        border-radius: 0.5rem;
    }

    .list-group-item.active {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
    }

    .list-group-item a {
        color: #495057;
        text-decoration: none;
    }

    .list-group-item a:hover {
        color: #0d6efd;
        text-decoration: underline;
    }

    /* Styling untuk Judul Utama */
    h1 {
        font-size: 2.5rem;
        color: #333;
    }

    /* Styling untuk Konten */
    .container {
        margin-top: 50px;
    }

    /* Styling untuk Box Konten */
    .content-box {
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 30px;
        background-color: #f8f9fa;
    }

    /* Hover Effect untuk Sidebar Item */
    .list-group-item:hover {
        background-color: #f0f8ff;
    }

    /* Styling untuk Link */
    .nav-link {
        font-weight: 600;
    }

    .nav-link:hover {
        color: #f39c12 !important;
    }

    .list-group-item.active {
        font-weight: 700;
    }
    </style>
</head>

<body>

    <div class="container my-5">
        <div class="content-box">
            <h1 class="mb-4">Halo, <?php echo $_SESSION['username']; ?>!</h1>
            <div class="row">
                <!-- Sidebar Menu -->
                <div class="col-md-3">
                    <ul class="list-group">
                        <li class="list-group-item active">Menu Akun</li>
                        <li class="list-group-item"><a href="?page=histori-pembayaran">Histori Pembayaran</a></li>
                        <li class="list-group-item"><a href="?page=keranjang">Barang di Keranjang</a></li>
                    </ul>
                </div>

                <!-- Konten -->
                <div class="col-md-9">
                    <?php
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        switch ($page) {
                            case 'histori-pembayaran':
                                include 'histori-pembayaran.php';
                                break;
                            case 'keranjang':
                                include 'keranjang.php';
                                break;
                            default:
                                echo "<h3>Halaman tidak ditemukan!</h3>";
                                break;
                        }
                    } else {
                        echo "<h3>Selamat datang di halaman akun Anda.</h3>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>