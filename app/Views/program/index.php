<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Program Kampus Berkelanjutan - POLBAN' ?></title>
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
            overflow-x: hidden;
            scroll-behavior: smooth;
            background: #f8f9fa;
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
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            color: white;
            transform: scale(1.05);
        }

        .logo-circle {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .logo-circle i {
            font-size: 24px;
            color: #149823ff;
            transition: all 0.3s ease;
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

        .btn-back {
            background: rgba(255, 255, 255, 0.2);
            color: white;
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

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #149823ff, #0b5804ff);
            color: white;
            padding: 60px 0;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 42px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 18px;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Content Section */
        .content-section {
            padding: 80px 0;
            background: white;
        }

        .section-title {
            font-size: 36px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, #149823ff, #0b5804ff);
            border-radius: 2px;
        }

        /* Program Cards */
        .program-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #e9ecef;
        }

        .program-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .program-icon {
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

        .program-card h3 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .program-card p {
            color: #7f8c8d;
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* Breadcrumb */
        .breadcrumb-section {
            background: #f8f9fa;
            padding: 20px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item a {
            color: #149823ff;
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: #6c757d;
        }

        /* Footer */
        .footer {
            background: #2c3e50;
            color: white;
            padding: 50px 0 20px;
            margin-top: 80px;
        }

        .footer-bottom {
            text-align: center;
            padding: 30px 0;
            color: #95a5a6;
            border-top: 1px solid #34495e;
            margin-top: 30px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 32px;
            }

            .hero-section p {
                font-size: 16px;
            }

            .section-title {
                font-size: 28px;
            }

            .program-card {
                padding: 20px;
                margin-bottom: 20px;
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

                <a href="/" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </nav>
        </div>
    </header>

    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Program</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <?php if ($programContent): ?>
                <h1><?= esc($programContent['title'] ?? 'Program Kampus Berkelanjutan') ?></h1>
                <?php if (!empty($programContent['subtitle'])): ?>
                    <p><?= esc($programContent['subtitle']) ?></p>
                <?php endif; ?>
            <?php else: ?>
                <h1>Program Kampus Berkelanjutan</h1>
                <p>Inisiatif keberlanjutan POLBAN untuk menciptakan kampus yang ramah lingkungan</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        <div class="container">
            <h2 class="section-title">Program Keberlanjutan POLBAN</h2>

            <?php if ($programContent && !empty($programContent['content'])): ?>
                <!-- Display dynamic content from CMS -->
                <div class="program-content">
                    <?= $programContent['content'] ?>
                </div>
            <?php else: ?>
                <!-- Default static content if no CMS content -->
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="program-card text-center">
                            <div class="program-icon" style="background: #149823;">
                                <i class="fas fa-building"></i>
                            </div>
                            <h3>Setting & Infrastructure</h3>
                            <p>Pengembangan infrastruktur kampus yang ramah lingkungan dan berkelanjutan dengan teknologi hijau terdepan untuk mendukung aktivitas akademik yang optimal.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="program-card text-center">
                            <div class="program-icon" style="background: #f39c12;">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <h3>Energy & Climate</h3>
                            <p>Pengelolaan energi terbarukan dan program mitigasi perubahan iklim untuk masa depan yang berkelanjutan melalui inovasi teknologi energi bersih.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="program-card text-center">
                            <div class="program-icon" style="background: #3498db;">
                                <i class="fas fa-tint"></i>
                            </div>
                            <h3>Water Management</h3>
                            <p>Sistem pengelolaan air yang efisien dengan teknologi konservasi dan daur ulang air untuk memastikan ketersediaan air bersih yang berkelanjutan.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="program-card text-center">
                            <div class="program-icon" style="background: #27ae60;">
                                <i class="fas fa-recycle"></i>
                            </div>
                            <h3>Waste Management</h3>
                            <p>Program pengelolaan limbah komprehensif dengan sistem reduce, reuse, dan recycle untuk menciptakan kampus zero waste yang berkelanjutan.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="program-card text-center">
                            <div class="program-icon" style="background: #9b59b6;">
                                <i class="fas fa-bus"></i>
                            </div>
                            <h3>Transportation</h3>
                            <p>Sistem transportasi kampus yang ramah lingkungan dengan kendaraan listrik dan jalur sepeda untuk mengurangi emisi karbon dan polusi udara.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="program-card text-center">
                            <div class="program-icon" style="background: #e74c3c;">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <h3>Education & Research</h3>
                            <p>Program pendidikan dan penelitian berkelanjutan untuk menciptakan generasi yang peduli lingkungan dan mengembangkan solusi inovatif.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Additional Information -->
            <div class="row mt-5">
                <div class="col-lg-8 mx-auto">
                    <div class="text-center">
                        <h3 class="mb-4" style="color: #2c3e50;">Komitmen Kami</h3>
                        <p class="lead" style="color: #7f8c8d;">
                            POLBAN berkomitmen untuk menjadi kampus berkelanjutan yang berkontribusi pada pencapaian
                            Sustainable Development Goals (SDGs) melalui implementasi program-program inovatif dan
                            berkelanjutan di semua aspek kehidupan kampus.
                        </p>
                        <div class="mt-4">
                            <a href="/" class="btn btn-lg" style="background: linear-gradient(135deg, #149823ff, #0b5804ff); color: white; padding: 12px 30px; border-radius: 25px; text-decoration: none;">
                                <i class="fas fa-home me-2"></i>
                                Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>POLBAN - Kampus Berkelanjutan</h5>
                    <p>Politeknik Negeri Bandung berkomitmen untuk menciptakan lingkungan kampus yang berkelanjutan dan ramah lingkungan.</p>
                </div>
                <div class="col-md-6">
                    <h5>Kontak</h5>
                    <p>
                        <i class="fas fa-map-marker-alt me-2"></i>
                        Jl. Gegerkalong Hilir, Ds. Ciwaruga, Bandung 40012<br>
                        <i class="fas fa-phone me-2"></i>
                        (022) 2013789<br>
                        <i class="fas fa-envelope me-2"></i>
                        info@polban.ac.id
                    </p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Politeknik Negeri Bandung. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>