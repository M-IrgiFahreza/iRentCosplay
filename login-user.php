<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #2b5876, #4e4376);
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
            border-radius: 8px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 30px;
            font-size: 26px;
            font-weight: 500;
            color: #333;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 8px;
            padding: 15px 15px 15px 45px;
            font-size: 16px;
            border: 1px solid #ddd;
            width: 100%;
            transition: border 0.3s;
            box-sizing: border-box;
        }

        .form-control:focus {
            border: 1px solid #2a5298;
            box-shadow: 0 0 10px rgba(42, 82, 152, 0.3);
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #aaa;
        }

        .password-container .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #aaa;
        }

        .btn {
            background-color: #4e4376;
            border: none;
            color: #fff;
            font-size: 18px;
            padding: 15px;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #4e4376;
        }

        .register-link {
            display: block;
            margin-top: 20px;
            color: #2a5298;
            text-decoration: none;
            font-size: 14px;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        .password-hint {
            text-align: left;
            font-size: 14px;
            margin-top: 5px;
            color: #555;
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
    <div class="login-box">
        <h2>Login</h2>
        <form action="login-proses.php" method="POST">
            <div class="form-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group password-container">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                <span class="toggle-password">
                </span>
            </div>
            <p class="password-hint" onclick="togglePasswordVisibility()">
                <i id="password-icon" class="fas fa-eye"></i> Lihat Password
            </p>
            <button type="submit" class="btn">Login</button>
            <a href="register-user.php" class="register-link">Belum punya akun? Daftar di sini</a>
        </form>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');

            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            passwordIcon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
        }
    </script>
</body>

</html>
