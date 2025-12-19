<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - GreenMetric Polban</title>
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

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, #149823ff, #0b5804ff);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
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

        /* Back Button */
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

        /* Main Content */
        .main-content {
            padding: 60px 0;
            min-height: calc(100vh - 200px);
        }

        .criteria-header {
            background: white;
            border-radius: 15px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .criteria-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px;
            color: white;
        }

        .criteria-title {
            font-size: 36px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .criteria-code {
            font-size: 18px;
            color: #7f8c8d;
            margin-bottom: 20px;
        }

        .criteria-description {
            font-size: 18px;
            color: #5a6c7d;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Statistics Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-value {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 16px;
            color: #7f8c8d;
            margin-bottom: 15px;
        }

        .progress-bar-container {
            background: #ecf0f1;
            border-radius: 10px;
            height: 8px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            border-radius: 10px;
            transition: width 0.8s ease;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-top: 10px;
        }

        .status-on-track {
            background: #d4edda;
            color: #155724;
        }

        .status-needs-improvement {
            background: #fff3cd;
            color: #856404;
        }

        /* Footer */
        .footer {
            background: #2c3e50;
            color: white;
            padding: 30px 0;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .criteria-title {
                font-size: 28px;
            }

            .criteria-header {
                padding: 30px 20px;
            }

            .stat-value {
                font-size: 36px;
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

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .stat-card {
                padding: 20px;
            }

            .main-content {
                padding: 40px 0;
            }
        }

        @media (max-width: 480px) {
            .criteria-title {
                font-size: 24px;
            }

            .criteria-icon {
                width: 60px;
                height: 60px;
                font-size: 28px;
            }

            .criteria-description {
                font-size: 16px;
            }

            .stat-value {
                font-size: 28px;
            }

            .stat-label {
                font-size: 14px;
            }

            .back-button {
                padding: 8px 16px;
                font-size: 14px;
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

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Criteria Header -->
            <div class="criteria-header">
                <div class="criteria-icon" style="background: <?= esc($color) ?>;">
                    <i class="<?= esc($icon) ?>"></i>
                </div>
                <h1 class="criteria-title"><?= esc($title) ?></h1>
                <p class="criteria-code">Kode: <?= esc($code) ?> | Bobot: <?= esc($weight) ?></p>
                <p class="criteria-description"><?= esc($description) ?></p>
            </div>

            <!-- Statistics Grid -->
            <div class="stats-grid">
                <!-- Current Score -->
                <div class="stat-card">
                    <div class="stat-value" style="color: <?= esc($color) ?>;">
                        <?= esc($current_score) ?>%
                    </div>
                    <div class="stat-label">Skor Saat Ini</div>
                    <div class="progress-bar-container">
                        <div class="progress-bar" style="background: <?= esc($color) ?>; width: <?= esc($current_score) ?>%;"></div>
                    </div>
                </div>

                <!-- Target 2028 -->
                <div class="stat-card">
                    <div class="stat-value" style="color: #27ae60;">
                        <?= esc($target_2028) ?>%
                    </div>
                    <div class="stat-label">Target 2028</div>
                    <div class="progress-bar-container">
                        <div class="progress-bar" style="background: #27ae60; width: <?= esc($target_2028) ?>%;"></div>
                    </div>
                </div>

                <!-- Progress -->
                <div class="stat-card">
                    <div class="stat-value" style="color: #3498db;">
                        <?= esc($progress_percentage) ?>%
                    </div>
                    <div class="stat-label">Progress Pencapaian</div>
                    <div class="progress-bar-container">
                        <div class="progress-bar" style="background: #3498db; width: <?= esc($progress_percentage) ?>%;"></div>
                    </div>
                    <div class="status-badge <?= $status == 'On Track' ? 'status-on-track' : 'status-needs-improvement' ?>">
                        <?= esc($status) ?>
                    </div>
                </div>
            </div>

            <!-- Additional Content Section -->
            <div class="row">
                <div class="col-12">
                    <div class="stat-card">
                        <h3 style="color: #2c3e50; margin-bottom: 20px;">
                            <i class="fas fa-info-circle" style="color: <?= esc($color) ?>;"></i>
                            Informasi Kriteria
                        </h3>
                        <p style="color: #5a6c7d; font-size: 16px; line-height: 1.8;">
                            Kriteria <?= esc($title) ?> merupakan salah satu dari 6 kriteria utama dalam penilaian UI GreenMetric World University Ranking. 
                            Setiap kriteria memiliki bobot yang berbeda dalam perhitungan skor keseluruhan kampus berkelanjutan.
                        </p>
                        <div class="text-center mt-4">
                            <a href="/" class="btn btn-lg" style="background: <?= esc($color) ?>; color: white; padding: 12px 30px; border-radius: 25px; text-decoration: none;">
                                <i class="fas fa-home"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>Copyright © 2024 UI GreenMetric Polban. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animate progress bars on page load
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.progress-bar');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 500);
            });
        });
    </script>
</body>

</html>