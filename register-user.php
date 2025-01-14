<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #2b5876, #4e4376);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .form-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .form-box {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: #333;
        }

        .form-box .icon-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-box .icon-container i {
            font-size: 50px;
            color: #4e4376;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
            position: relative;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            height: 40px;
        }

        .input-group i {
            position: absolute;
            top: 70%;
            right: 15px;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 18px;
        }

        .password-helper {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            margin-top: 5px;
            color: #333;
            cursor: pointer;
        }

        .password-helper i {
            font-size: 18px;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #4e4376;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #2b5876;
        }

        .register-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #4e4376;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        .success-message {
            text-align: center;
            font-size: 18px;
            color: #4e4376;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <div class="form-box">
            <div class="icon-container">
                <i class="fas fa-user-circle"></i>
            </div>
            <h2>Register</h2>

            <!-- Display success message if available -->
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'success') {
                echo '<div class="success-message">Akun Anda telah berhasil dibuat! Anda akan diarahkan ke halaman login dalam 3 detik.</div>';
            }
            ?>

            <form action="register-proses.php" method="POST">
                <div class="input-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Masukkan username" required>
                    <i class="fas fa-user"></i>
                </div>
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Masukkan email" required>
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan password" required>
                    <i class="fas fa-lock"></i>
                </div>
                <div class="password-helper" onclick="togglePassword()">
                    <i id="password-icon" class="fas fa-eye"></i>
                    <span>Lihat Password</span>
                </div>
                <button type="submit" class="submit-btn">Register</button>
                <a href="login-user.php" class="register-link">Sudah punya akun? Login di sini</a>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                passwordIcon.className = 'fas fa-eye';
            }
        }

        // Redirect to login page after 3 seconds if registration is successful
        <?php
        if (isset($_GET['status']) && $_GET['status'] == 'success') {
            echo 'setTimeout(function() { window.location.href = "login-user.php"; }, 3000);';
        }
        ?>
    </script>
</body>

</html>
