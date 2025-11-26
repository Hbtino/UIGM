<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Capaian Kinerja POLBAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #4ac00bff, #097b27ff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
            color: #fff;
            position: relative;
        }
        
        .login-box {
            background: white;
            color: #333;
            border-radius: 10px;
            box-shadow: 0px 8px 20px rgba(255, 255, 255, 0.3);
            width: 380px;
            padding: 25px;
            text-align: center;
            position: relative;
        }
        
        .back-button {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #f0f0f0;
            color: #003C8F;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            z-index: 10;
        }
        
        .back-button:hover {
            background: #003C8F;
            color: white;
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        
        .back-button i {
            font-size: 16px;
        }

        .login-box h2 {
            color: #003C8F;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .btn-login {
            background-color: #2bc121ff;
            color: white;
            border: none;
        }

        .btn-login:hover {
            background-color: #228d11ff;
        }

        .logo {
            width: 80px;
            margin-bottom: 10px;
        }

        small {
            color: grey;
        }
        
        .welcome-text {
            color: #003C8F;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .description {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 20px;
            line-height: 1.4;
        }
        
        .form-control {
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
        }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
        }
        
        .remember-me input {
            margin-right: 5px;
        }
        
        .forgot-password {
            color: #003C8F;
            text-decoration: none;
        }
        
        .forgot-password:hover {
            text-decoration: underline;
        }
        
        .signup-link {
            margin-top: 15px;
            color: #666;
            font-size: 0.9rem;
        }
        
        .signup-link a {
            color: #12e03fff;
            text-decoration: none;
            font-weight: bold;
        }
        
        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <!-- Back Button -->
        <a href="<?= base_url('/') ?>" class="back-button" title="Kembali ke Beranda">
            <i class="fas fa-arrow-left"></i>
        </a>
        
        <img src="https://e7.pngegg.com/pngimages/2/27/png-clipart-bandung-state-polytechnic-symbol-technical-school-pendhidhikan-dhuwur-symbol-miscellaneous-angle.png" class="logo" alt="POLBAN Logo">
        
        <div class="welcome-text">UI Green Metric Polban!</div>
        <div class="description">
           <br> Polban berpartisipasi aktif dalam UI GreenMetric sebagai bentuk dukungan terhadap pembangunan berkelanjutan di lingkungan kampus.<br>
        </div>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        
        <?php if(session()->getFlashdata('warning')): ?>
            <div class="alert alert-warning">
                <i class="fas fa-clock"></i> <?= session()->getFlashdata('warning') ?>
            </div>
        <?php endif; ?>
        
        <?php if(session()->getFlashdata('info')): ?>
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> <?= session()->getFlashdata('info') ?>
            </div>
        <?php endif; ?>
        
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="/login/process" method="post">
            <div class="mb-2">
                <input type="email" name="email" class="form-control" placeholder="name@gmail.com" required>
            </div>
            <div class="mb-2">
                <input type="password" name="password" class="form-control" placeholder="***********" required>
            </div>
            
            <div class="form-options">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>

            </div>
            
            <button type="submit" class="btn btn-login w-100">Login</button>
        </form>
        
        <div class="signup-link">
            Not a member yet? <a href="/register">Sign up</a>
        </div>
    </div>

</body>
</html>
