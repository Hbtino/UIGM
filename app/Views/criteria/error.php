<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kriteria Tidak Ditemukan - GreenMetric Polban</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            line-height: 1.6;
        }

        .header {
            background: linear-gradient(135deg, #149823ff, #0b5804ff);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 15px;
            color: white;
            font-size: 28px;
            font-weight: bold;
            text-decoration: none;
        }

        .navbar-brand:hover {
            color: white;
        }

        .logo-circle {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-circle i {
            font-size: 24px;
            color: #149823ff;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .brand-title {
            font-size: 28px;
            font-weight: bold;
            line-height: 1;
        }

        .brand-subtitle {
            font-size: 12px;
            font-weight: 400;
            opacity: 0.9;
            line-height: 1;
        }

        .back-button {
            background: white;
            color: #149823ff;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-button:hover {
            background: rgba(255, 255, 255, 0.9);
            color: #0b5804ff;
            transform: translateY(-2px);
        }

        .error-container {
            min-height: calc(100vh - 200px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 0;
        }

        .error-card {
            background: white;
            border-radius: 15px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        .error-icon {
            width: 100px;
            height: 100px;
            background: #e74c3c;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 48px;
            color: white;
        }

        .error-title {
            font-size: 32px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .error-message {
            font-size: 18px;
            color: #7f8c8d;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .action-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: linear-gradient(135deg, #149823ff, #0b5804ff);
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(20, 152, 35, 0.3);
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
            color: white;
        }

        .footer {
            background: #2c3e50;
            color: white;
            padding: 30px 0;
            text-align: center;
        }

        @media (max-width: 768px) {
            .error-card {
                padding: 40px 20px;
                margin: 0 20px;
            }

            .error-title {
                font-size: 24px;
            }

            .error-message {
                font-size: 16px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .navbar-brand {
                gap: 10px;
            }

            .brand-title {
                font-size: 22px;
            }

            .brand-subtitle {
                font-size: 10px;
            }

            .logo-circle {
                width: 40px;
                height: 40px;
            }

            .logo-circle i {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="d-flex justify-content-between align-items-center">
                <a href="/" class="navbar-brand">
                    <div class="logo-circle">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <div class="brand-text">
                        <span class="brand-title">POLBAN</span>
                        <span class="brand-subtitle">Kampus Berkelanjutan</span>
                    </div>
                </a>

                <a href="/" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </nav>
        </div>
    </header>

    <!-- Error Content -->
    <div class="error-container">
        <div class="container">
            <div class="error-card">
                <div class="error-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h1 class="error-title">Kriteria Tidak Ditemukan</h1>
                <p class="error-message">
                    Maaf, kriteria yang Anda cari tidak dapat ditemukan atau sedang tidak tersedia. 
                    Silakan kembali ke beranda atau coba kriteria lainnya.
                </p>
                <div class="action-buttons">
                    <a href="/" class="btn-primary">
                        <i class="fas fa-home"></i> Kembali ke Beranda
                    </a>
                    <a href="javascript:history.back()" class="btn-secondary">
                        <i class="fas fa-arrow-left"></i> Halaman Sebelumnya
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>Copyright © 2024 UI GreenMetric Polban. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>