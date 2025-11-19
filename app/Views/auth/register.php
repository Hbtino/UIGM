<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Green Metric Polban</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #4ac00bff, #097b27ff);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .register-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 480px;
            padding: 50px 45px;
        }
        
        .title {
            color: #1a5c3e;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            text-align: center;
        }
        
        .subtitle {
            color: #6b7280;
            font-size: 15px;
            margin-bottom: 35px;
            text-align: center;
            font-weight: 400;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .input-label {
            display: block;
            color: #374151;
            font-size: 14px;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .input-field {
            width: 100%;
            padding: 15px 18px;
            border: none;
            background: #e8f5f0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s;
            color: #1f2937;
        }
        
        .input-field::placeholder {
            color: #9ca3af;
        }
        
        .input-field:focus {
            outline: none;
            background: #d1ebe3;
            box-shadow: 0 0 0 3px rgba(45, 134, 89, 0.1);
        }
        
        .register-button {
            background: #27cd11ff;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 16px;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .register-button:hover {
            background: #13ad08ab;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(17, 220, 34, 0.6);
        }
        
        .register-button:active {
            transform: translateY(0);
        }
        
        .login-link {
            text-align: center;
            margin-top: 25px;
            color: #6b7280;
            font-size: 14px;
        }
        
        .login-link a {
            color: #4adf29ff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }
        
        .login-link a:hover {
            color: #25d385ff;
            text-decoration: underline;
        }
        
        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-left: 4px solid #dc2626;
            font-size: 14px;
        }
        
        select.input-field {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 20px;
            padding-right: 45px;
            cursor: pointer;
        }
        
        select.input-field option {
            background: white;
            color: #1f2937;
            padding: 10px;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #0cde67ff, #03c914ff);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(45, 134, 89, 0.3);
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo-container">
            <div class="logo">G</div>
        </div>
        
        <h1 class="title">Ui Green Metric Polban</h1>
        <p class="subtitle">Sign up to GreenApp</p>
        
        <?php if(isset($validation)) : ?>
            <div class="alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        
        <form action="/register/process" method="POST">
            <div class="form-group">
                <input type="text" name="name" class="input-field" required placeholder="Nama Lengkap">
            </div>
            
            <div class="form-group">
                <input type="email" name="email" class="input-field" required placeholder="Email">
            </div>
            
            <div class="form-group">
                <input type="password" name="password" class="input-field" required placeholder="Password">
            </div>
            
            <div class="form-group">
                <input type="password" name="password_confirm" class="input-field" required placeholder="Konfirmasi Password">
            </div>
            
            <button type="submit" class="register-button">SIGN UP</button>
        </form>
        
        <div class="login-link">
            Sudah punya akun? <a href="/login">Login disini!</a>
        </div>
    </div>
</body>
</html>