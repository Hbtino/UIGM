<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Capaian Kinerja POLBAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #003C8F, #01579B);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
            color: #fff;
        }

        .login-box {
            background: white;
            color: #333;
            border-radius: 10px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
            width: 380px;
            padding: 25px;
            text-align: center;
        }

        .login-box h2 {
            color: #003C8F;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .btn-login {
            background-color: #003C8F;
            color: white;
            border: none;
        }

        .btn-login:hover {
            background-color: #01579B;
        }

        .btn-register {
            background-color: #007E33;
            color: #fff;
            border: none;
            margin-top: 8px;
        }

        .btn-register:hover {
            background-color: #006622;
        }

        .logo {
            width: 80px;
            margin-bottom: 10px;
        }

        small {
            color: grey;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <img src="https://e7.pngegg.com/pngimages/2/27/png-clipart-bandung-state-polytechnic-symbol-technical-school-pendhidhikan-dhuwur-symbol-miscellaneous-angle.png" class="logo" alt="POLBAN Logo">
        <h2>Login Akun</h2>
        <p><small>Aplikasi Capaian Kinerja - POLBAN</small></p>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="/login/process" method="post">
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
            </div>
            <button type="submit" class="btn btn-login w-100">Login</button>
            <a href="/register" class="btn btn-register w-100">Register</a>
        </form>
    </div>

</body>
</html>
