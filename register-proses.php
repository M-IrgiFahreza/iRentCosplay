<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi dan sanitasi input
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validasi format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email tidak valid!";
        exit;
    }

    // Validasi panjang password (minimal 8 karakter)
    if (strlen($password) < 8) {
        echo "Password harus memiliki minimal 8 karakter!";
        exit;
    }

    // Menyiapkan query untuk mengecek apakah email sudah ada
    $checkEmailQuery = "SELECT * FROM pelanggan WHERE email = ?";
    $stmt = mysqli_prepare($con, $checkEmailQuery);
    if ($stmt === false) {
        die("Query gagal: " . mysqli_error($con));
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo "Email sudah terdaftar!";
    } else {
        // Jika email belum ada, lakukan proses penyimpanan data tanpa hashing password
        $insertQuery = "INSERT INTO pelanggan (username, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $insertQuery);
        if ($stmt === false) {
            die("Query gagal: " . mysqli_error($con));
        }
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: login-user.php?success=1");
            exit;
        } else {
            echo "Terjadi kesalahan saat mendaftar: " . mysqli_error($con);
        }
    }

    // Tutup prepared statement
    mysqli_stmt_close($stmt);
}

// Menutup koneksi
mysqli_close($con);
?>