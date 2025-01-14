<?php
session_start();
require "../koneksi.php"; // Pastikan file koneksi sudah benar

// Place the login logic at the top, before any HTML output starts
if (isset($_POST['loginbtn'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Cek user di database
    $query = mysqli_query($con, "SELECT * FROM pengguna WHERE username='$username'");
    $countdata = mysqli_num_rows($query);
    $data = mysqli_fetch_array($query);

    if ($countdata > 0) {
        // Verifikasi password menggunakan MD5
        if (md5($password) == $data['password']) {
            $_SESSION['username'] = $data['username'];
            $_SESSION['login'] = true;
            header('location: ../adminpanel'); // Arahkan ke halaman admin
            exit;
        } else {
            // Password salah
            $error_message = "Password yang Anda masukkan salah.";
        }
    } else {
        // Username tidak ada
        $error_message = "Data tidak ada. Pastikan username dan password Anda benar.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #2b5876, #4e4376, #836D8A);

            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background-color: #fff;
            width: 100%;
            max-width: 450px;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 30px;
            font-size: 26px;
            font-weight: 500;
            color: #333;
        }

        .form-control {
            border-radius: 25px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 16px;
            border: 1px solid #ddd;
            transition: border 0.3s;
            padding-left: 40px;
        }

        .form-control:focus {
            border: 1px solid #2575fc;
            box-shadow: 0 0 10px rgba(37, 117, 252, 0.3);
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #aaa;
        }

        .form-group {
            position: relative;
        }

        .btn {
            background-color: #2575fc;
            border: none;
            color: #fff;
            font-size: 18px;
            padding: 15px;
            border-radius: 25px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #6a11cb;
        }

        .alert {
            margin-top: 20px;
            padding: 15px;
            background-color: #ffcd56;
            border-radius: 5px;
            color: #333;
            font-weight: bold;
        }

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box img {
            width: 60px;
            height: 60px;
            margin-bottom: 20px;
        }

        .login-box .form-group {
            margin-bottom: 20px;
        }

        .login-box .icon-group {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .login-box .icon-group a {
            font-size: 20px;
            color: #333;
            transition: color 0.3s;
        }

        .login-box .icon-group a:hover {
            color: #2575fc;
        }

        @media (max-width: 600px) {
            .login-box {
                padding: 20px;
                width: 90%;
            }
        }
    
    </style>
</head>

<body>
    <div class="main">
        <div class="login-box">
            <i class="fas fa-user-circle" style="font-size: 60px; color: #2575fc;"></i>
            <h2>Login</h2>
            <form action="" method="post">
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                </div>
                <button class="btn mt-4" type="submit" name="loginbtn">Login</button>
            </form>

            <!-- Added Social Media Icons -->
            <div class="icon-group">
                <a href="#" title="Login with Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" title="Login with Google"><i class="fab fa-google"></i></a>
                <a href="#" title="Login with Twitter"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>

    <?php if (isset($error_message)): ?>
        <div class="mt-2" style="width: 500px">
            <div class="alert alert-warning" role="alert">
                <?php echo $error_message; ?>
            </div>
        </div>
    <?php endif; ?>

    <script>
        // JavaScript for form validation
    </script>
</body>
</html>
