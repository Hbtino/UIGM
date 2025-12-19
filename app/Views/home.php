<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenMetric Polban - Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animated Styles -->
    <link rel="stylesheet" href="<?= base_url('assets/css/home_animated.css') ?>">

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
        }

        /* Ranking Charts Styles */
        .ranking-charts-grid {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 25px !important;
            margin-bottom: 40px !important;
        }

        .ranking-chart-card {
            background: white !important;
            padding: 30px !important;
            border-radius: 12px !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
        }

        @media (max-width: 992px) {
            .ranking-charts-grid {
                grid-template-columns: 1fr !important;
            }
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, #149823ff, #0b5804ff);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
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

        .logo-circle:hover {
            transform: rotate(360deg);
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
        }

        .logo-circle:hover i {
            color: #0b5804ff;
            transform: scale(1.1);
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

        /* Navigation Menu */
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 20px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-menu li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .nav-menu li a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            color: white;
        }

        .nav-menu li a:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.3);
        }

        /* Dropdown Menu Styles */
        .dropdown-menu-item {
            position: relative;
        }

        .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .dropdown-toggle i {
            font-size: 12px;
            transition: transform 0.3s ease;
        }

        .dropdown-menu-item.active .dropdown-toggle i {
            transform: rotate(180deg);
        }

        .dropdown-submenu {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            min-width: 250px;
            border-radius: 8px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
            list-style: none;
            padding: 10px 0;
            margin: 0;
        }

        .dropdown-menu-item:hover .dropdown-submenu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu-item:hover .dropdown-toggle i {
            transform: rotate(180deg);
        }

        .dropdown-submenu li {
            margin: 0;
        }

        .dropdown-submenu li a {
            color: #2c3e50 !important;
            padding: 12px 20px;
            display: block;
            font-weight: 500;
            font-size: 14px;
            border-radius: 0;
            transition: all 0.3s ease;
        }

        .dropdown-submenu li a:hover {
            background: #f8f9fa !important;
            color: #149823ff !important;
            transform: translateX(5px);
        }

        .dropdown-submenu li a i {
            transition: transform 0.3s ease;
        }

        .dropdown-submenu li a:hover i {
            transform: scale(1.1);
        }

        .dropdown-submenu li:first-child a {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .dropdown-submenu li:last-child a {
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .btn-login {

            color: #149823ff;
            border: none;
            padding: 10px 30px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            color: #149823ff;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-login:active {
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }

        .btn-login i {
            transition: transform 0.3s ease;
        }

        .btn-login:hover i {
            transform: scale(1.1);
        }

        /* Hero Section dengan UIGreenMetric */
        .hero-section {
            background: linear-gradient(135deg, #149823ff, #0b5804ff);
            color: white;
            padding: 80px 0 100px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            top: -50%;
            left: -50%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: moveBackground 20s linear infinite;
        }

        @keyframes moveBackground {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(50px, 50px);
            }
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-section h1 {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1s ease;
        }

        .hero-section .description {
            font-size: 20px;
            max-width: 900px;
            margin: 0 auto 60px;
            line-height: 1.8;
            animation: fadeInUp 1s ease 0.3s backwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* UIGreenMetric Box */
        .ui-greenmetric-box {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 50px 40px;
            max-width: 900px;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1s ease 0.6s backwards;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .ui-greenmetric-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .ui-greenmetric-box h2 {
            color: #149823ff;
            font-size: 42px;
            font-weight: bold;
            margin-bottom: 20px;
            display: inline-flex;
            align-items: center;
            gap: 15px;
        }

        .trophy-icon {
            font-size: 50px;
            color: #f39c12;
            animation: bounce 2s ease infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .ui-greenmetric-box p {
            font-size: 18px;
            color: #7f8c8d;
            line-height: 1.8;
            margin: 0;
        }

        /* Content Sections */
        .content-section {
            padding: 80px 0;
            min-height: 500px;
            background: white;
        }

        .content-section:nth-child(even) {
            background: #f8f9fa;
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

        .section-content {
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
            color: #7f8c8d;
            font-size: 18px;
            line-height: 1.8;
        }

        /* News Card Styles */
        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .card-text {
            font-size: 14px;
            line-height: 1.6;
        }

        /* Placeholder untuk konten yang akan ditambahkan */
        .content-placeholder {
            background: white;
            border: 2px dashed #ddd;
            border-radius: 10px;
            padding: 60px 40px;
            margin-top: 40px;
            text-align: center;
        }

        .content-placeholder i {
            font-size: 60px;
            color: #bdc3c7;
            margin-bottom: 20px;
        }

        .content-placeholder p {
            color: #95a5a6;
            font-size: 18px;
            margin: 0;
        }

        /* Footer */
        .footer {
            background: #2c3e50;
            color: white;
            padding: 50px 0 20px;
        }

        .footer-bottom {
            text-align: center;
            padding: 30px 0;
            color: #95a5a6;
        }

        /* Scroll to top button */
        .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #149823ff, #0b5804ff);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .scroll-top.show {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 5px 20px rgba(12, 222, 103, 0.4);
        }

        /* Social Media Hover Effects */
        .social-media a:hover {
            transform: scale(1.1) translateY(-3px);
        }

        /* Mobile Menu */
        .mobile-menu-toggle {
            display: none;
            background: white;
            color: #03c914ff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mobile-menu-toggle:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: scale(1.05);
        }

        /* Mobile Responsive */
        @media (max-width: 992px) {
            .nav-menu {
                position: fixed;
                top: 80px;
                right: -100%;
                width: 250px;
                height: calc(100vh - 80px);
                background: linear-gradient(135deg, #149823ff, #0b5804ff);
                flex-direction: column;
                justify-content: flex-start;
                align-items: stretch;
                padding: 20px 0;
                transition: right 0.3s ease;
                box-shadow: -5px 0 15px rgba(0, 0, 0, 0.2);
                z-index: 999;
            }

            .nav-menu.active {
                right: 0;
            }

            .nav-menu li {
                margin: 0;
                width: 100%;
            }

            .nav-menu li a {
                display: block;
                padding: 15px 25px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                transition: all 0.3s ease;
            }

            .nav-menu li a:hover {
                background: rgba(255, 255, 255, 0.2);
                transform: translateX(10px);
            }

            /* Mobile Dropdown Styles */
            .dropdown-submenu {
                position: static;
                background: rgba(255, 255, 255, 0.1);
                box-shadow: none;
                border-radius: 0;
                opacity: 1;
                visibility: visible;
                transform: none;
                margin-left: 20px;
                margin-top: 5px;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease;
            }

            .dropdown-menu-item:hover .dropdown-submenu,
            .dropdown-menu-item.active .dropdown-submenu {
                max-height: 300px;
                padding-top: 5px;
                padding-bottom: 5px;
            }

            .dropdown-submenu li a {
                color: rgba(255, 255, 255, 0.9) !important;
                padding: 10px 15px;
                font-size: 13px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .dropdown-submenu li a:hover {
                background: rgba(255, 255, 255, 0.2) !important;
                color: white !important;
                transform: translateX(5px);
            }

            .mobile-menu-toggle {
                display: block;
            }
        }

        @media (min-width: 993px) {
            .mobile-menu-toggle {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 32px;
            }

            .hero-section .description {
                font-size: 16px;
            }

            .ui-greenmetric-box h2 {
                font-size: 28px;
                flex-direction: column;
            }

            .ui-greenmetric-box {
                padding: 30px 20px;
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

            .section-title {
                font-size: 28px;
            }

            /* Mobile dropdown improvements */
            .dropdown-submenu {
                min-width: 200px;
                margin-left: 15px;
            }

            .dropdown-submenu li a {
                padding: 8px 15px;
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .dropdown-submenu {
                min-width: 180px;
                margin-left: 10px;
            }

            .dropdown-submenu li a {
                padding: 6px 12px;
                font-size: 11px;
            }

            .nav-menu li a {
                padding: 12px 20px;
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

                <!-- Desktop Menu -->
                <ul class="nav-menu">
                    <li><a href="#deskripsi">Deskripsi</a></li>
                    <li><a href="#statistik">Statistik</a></li>
                    <li><a href="#program">Program</a></li>
                    <li class="dropdown-menu-item">
                        <a href="#" class="dropdown-toggle">Kriteria <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-submenu">
                            <li><a href="/kriteria/setting-infrastructure"><i class="fas fa-building" style="color: #667eea; margin-right: 8px;"></i>Setting & Infrastructure</a></li>
                            <li><a href="/kriteria/energy-climate"><i class="fas fa-bolt" style="color: #f093fb; margin-right: 8px;"></i>Energy & Climate Change</a></li>
                            <li><a href="/kriteria/waste"><i class="fas fa-recycle" style="color: #4facfe; margin-right: 8px;"></i>Waste</a></li>
                            <li><a href="/kriteria/water"><i class="fas fa-tint" style="color: #00f2fe; margin-right: 8px;"></i>Water</a></li>
                            <li><a href="/kriteria/transportation"><i class="fas fa-bus" style="color: #fa709a; margin-right: 8px;"></i>Transportation</a></li>
                            <li><a href="/kriteria/education-research"><i class="fas fa-graduation-cap" style="color: #ffecd2; margin-right: 8px;"></i>Education & Research</a></li>
                        </ul>
                    </li>
                    <li><a href="#berita">Berita</a></li>
                    <li><a href="#informasi">Informasi</a></li>
                    <li><a href="/login" class="btn-login"><i class="fas fa-user"></i> Login</a></li>
                </ul>

                <!-- Mobile Menu Toggle (Optional) -->
                <button class="mobile-menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>
            </nav>
        </div>
    </header>

    <!-- Hero Section dengan UIGreenMetric -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="container">
                <h1>Selamat Datang di GreenMetric Polban</h1>
                <p class="description">
                    Selamat datang di GreenMetric Polban 2025. Program ini bertujuan untuk mendorong universitas dalam mengimplementasikan praktik ramah lingkungan dan berkelanjutan.
                </p>

                <!-- UIGreenMetric Box -->
                <div class="ui-greenmetric-box">
                    <h2>
                        <i class="fas fa-trophy trophy-icon"></i>
                        UIGreenMetric
                    </h2>
                    <p>
                        Selamat datang di GreenMetric Polban 2025. Program ini bertujuan untuk mendorong universitas dalam mengimplementasikan praktik ramah lingkungan dan berkelanjutan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Deskripsi -->
    <section id="deskripsi" class="content-section">
        <div class="container">
            <?php if (isset($contents['deskripsi'])): ?>
                <h2 class="section-title"><?= esc($contents['deskripsi']['title'] ?? 'Deskripsi') ?></h2>
                <div class="section-content">
                    <?php if (!empty($contents['deskripsi']['subtitle'])): ?>
                        <p class="lead"><?= esc($contents['deskripsi']['subtitle']) ?></p>
                    <?php endif; ?>

                    <div class="row g-4 align-items-center mt-4">
                        <?php if (!empty($contents['deskripsi']['image'])): ?>
                            <div class="col-md-6">
                                <img src="<?= base_url('uploads/landing/' . $contents['deskripsi']['image']) ?>"
                                    class="img-fluid rounded shadow"
                                    alt="<?= esc($contents['deskripsi']['title']) ?>"
                                    style="width: 100%; height: auto; object-fit: cover;">
                            </div>
                        <?php endif; ?>

                        <div class="<?= !empty($contents['deskripsi']['image']) ? 'col-md-6' : 'col-12' ?>">
                            <?php if (!empty($contents['deskripsi']['content'])): ?>
                                <div class="content-text">
                                    <?= $contents['deskripsi']['content'] ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($contents['deskripsi']['button_text']) && !empty($contents['deskripsi']['button_url'])): ?>
                                <a href="<?= esc($contents['deskripsi']['button_url']) ?>"
                                    class="btn btn-lg mt-3"
                                    style="background: linear-gradient(135deg, #149823ff, #0b5804ff); color: white; padding: 12px 30px; border-radius: 25px; text-decoration: none;">
                                    <?= esc($contents['deskripsi']['button_text']) ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <h2 class="section-title">Deskripsi</h2>
                <div class="section-content">
                    <p>Bagian ini berisi deskripsi lengkap tentang program GreenMetric Polban.</p>
                    <div class="content-placeholder">
                        <i class="fas fa-info-circle"></i>
                        <p>Konten Deskripsi belum diatur</p>
                        <small class="text-muted">Silakan tambahkan konten melalui CMS</small>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Section Statistik Kampus -->
    <?php if (isset($landingStats) && !empty($landingStats)): ?>
        <section id="statistik" class="content-section" style="background: #f8f9fa;">
            <div class="container">
                <!-- Progress Ranking (2 Grafik) -->
                <h2 class="section-title" style="text-align: center; margin-bottom: 30px; color: #1e3a8a; font-size: 28px; font-weight: 700;">
                    <i class="fas fa-chart-line"></i> Progress Ranking Kampus
                </h2>
                <?php if (isset($landingStats) && !empty($landingStats) && (isset($landingStats['ranking_dunia']) || isset($landingStats['ranking_indonesia']))): ?>
                    <div class="ranking-charts-grid">
                        <!-- Ranking Dunia -->
                        <?php if (isset($landingStats['ranking_dunia']) && !empty($landingStats['ranking_dunia'])): ?>
                            <div class="ranking-chart-card">
                                <h3 style="color: #1e3a8a; font-size: 20px; font-weight: 700; margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
                                    <i class="fas fa-globe"></i> Progress Ranking Dunia
                                </h3>
                                <?php foreach ($landingStats['ranking_dunia'] as $index => $chart): ?>
                                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px solid #e2e8f0;">
                                        <span style="color: #64748b;"><?= esc($chart['year']) ?></span>
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <strong style="color: #1e3a8a; font-size: 20px;">#<?= is_numeric($chart['rank_value']) ? number_format($chart['rank_value']) : esc($chart['rank_value']) ?></strong>
                                            <?php if ($index > 0): ?>
                                                <?php
                                                $prevRank = $landingStats['ranking_dunia'][$index - 1]['rank_value'];
                                                $improvement = $prevRank - $chart['rank_value'];
                                                ?>
                                                <?php if ($improvement > 0): ?>
                                                    <span style="color: #10b981; font-size: 14px;">
                                                        <i class="fas fa-arrow-up"></i> <?= $improvement ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Ranking Indonesia -->
                        <?php if (isset($landingStats['ranking_indonesia']) && !empty($landingStats['ranking_indonesia'])): ?>
                            <div class="ranking-chart-card">
                                <h3 style="color: #1e3a8a; font-size: 20px; font-weight: 700; margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
                                    <i class="fas fa-map-marker-alt"></i> Progress Ranking Indonesia
                                </h3>
                                <?php foreach ($landingStats['ranking_indonesia'] as $index => $chart): ?>
                                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px solid #e2e8f0;">
                                        <span style="color: #64748b;"><?= esc($chart['year']) ?></span>
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <strong style="color: #1e3a8a; font-size: 20px;">#<?= is_numeric($chart['rank_value']) ? number_format($chart['rank_value']) : esc($chart['rank_value']) ?></strong>
                                            <?php if ($index > 0): ?>
                                                <?php
                                                $prevRank = $landingStats['ranking_indonesia'][$index - 1]['rank_value'];
                                                $improvement = $prevRank - $chart['rank_value'];
                                                ?>
                                                <?php if ($improvement > 0): ?>
                                                    <span style="color: #10b981; font-size: 14px;">
                                                        <i class="fas fa-arrow-up"></i> <?= $improvement ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Info Boxes (4 boxes) -->
                <?php if (isset($landingStats['info_box'])): ?>
                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 40px;">
                        <style>
                            @media (max-width: 1200px) {
                                #statistik .container>div:nth-child(2) {
                                    grid-template-columns: repeat(2, 1fr) !important;
                                }
                            }

                            @media (max-width: 768px) {
                                #statistik .container>div:nth-child(2) {
                                    grid-template-columns: 1fr !important;
                                }
                            }
                        </style>
                        <?php
                        $infoBoxes = [];
                        foreach ($landingStats['info_box'] as $stat) {
                            $key = $stat['key_name'];
                            if (!str_contains($key, 'subtitle') && !str_contains($key, 'progress')) {
                                $infoBoxes[$key] = [
                                    'label' => $stat['label'],
                                    'value' => $stat['value'],
                                    'icon' => $stat['icon'],
                                    'color' => $stat['color']
                                ];
                            }
                        }
                        foreach ($infoBoxes as $key => $box):
                        ?>
                            <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border-left: 4px solid <?= $box['color'] ?>;">
                                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                                    <div style="width: 50px; height: 50px; background: <?= $box['color'] ?>; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                        <i class="<?= $box['icon'] ?>" style="font-size: 24px; color: white;"></i>
                                    </div>
                                    <div>
                                        <h4 style="font-size: 32px; font-weight: 700; color: <?= $box['color'] ?>; margin: 0;">
                                            <?= esc($box['value']) ?>
                                        </h4>
                                    </div>
                                </div>
                                <p style="color: #64748b; font-size: 14px; margin: 0;"><?= esc($box['label']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Profil & Fasilitas Kampus -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 25px; margin-bottom: 40px;">
                    <!-- Profil Kampus -->
                    <?php if (isset($landingStats['profil_kampus'])): ?>
                        <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                            <h3 style="color: #1e3a8a; font-size: 20px; font-weight: 700; margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-university"></i> Profil Kampus Polban
                            </h3>
                            <?php foreach ($landingStats['profil_kampus'] as $stat): ?>
                                <div style="display: flex; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #e2e8f0;">
                                    <span style="color: #64748b;"><?= esc($stat['label']) ?></span>
                                    <strong style="color: #1e3a8a; font-size: 18px;">
                                        <?= is_numeric($stat['value']) ? number_format($stat['value']) : esc($stat['value']) ?>
                                    </strong>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Fasilitas Kampus -->
                    <?php if (isset($landingStats['fasilitas'])): ?>
                        <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                            <h3 style="color: #1e3a8a; font-size: 20px; font-weight: 700; margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-building"></i> Fasilitas Kampus
                            </h3>
                            <?php foreach ($landingStats['fasilitas'] as $stat): ?>
                                <div style="display: flex; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #e2e8f0;">
                                    <span style="color: #64748b;"><?= esc($stat['label']) ?></span>
                                    <strong style="color: #1e3a8a; font-size: 18px;">
                                        <?= is_numeric($stat['value']) ? number_format($stat['value']) : esc($stat['value']) ?>
                                    </strong>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Interactive Charts Section -->
                <!-- Dashboard Charts Section -->
                <?php if (!empty($chartData)): ?>
                    <div style="margin-top: 50px;">
                        <h2 class="section-title" style="text-align: center; margin-bottom: 30px; color: #1e3a8a; font-size: 28px; font-weight: 700;">
                            <i class="fas fa-chart-area"></i> Grafik Pencapaian Keberlanjutan
                        </h2>

                        <!-- Main Dashboard Charts -->
                        <div style="display: grid; grid-template-columns: 1fr; gap: 30px;">

                            <!-- Chart 1: Capaian Kriteria Kampus Berkelanjutan (Grouped Bar Chart) -->
                            <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                <h3 style="color: #1e3a8a; font-size: 20px; font-weight: 600; margin-bottom: 15px; text-align: center;">
                                    Capaian Kriteria Kampus Berkelanjutan (2023-2028)
                                </h3>
                                <p style="color: #64748b; font-size: 14px; text-align: center; margin-bottom: 25px;">
                                    Proyeksi pencapaian berdasarkan UI GreenMetric World University Ranking
                                </p>
                                <div style="position: relative; height: 400px;">
                                    <canvas id="sustainabilityChart" style="max-height: 400px;"></canvas>
                                </div>
                            </div>

                            <!-- Chart 2: Total Skor Capaian Per Tahun (Line Chart) -->
                            <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                <h3 style="color: #1e3a8a; font-size: 20px; font-weight: 600; margin-bottom: 15px; text-align: center;">
                                    Total Skor Capaian Per Tahun
                                </h3>
                                <p style="color: #64748b; font-size: 14px; text-align: center; margin-bottom: 25px;">
                                    Grafik peningkatan skor keseluruhan kampus berkelanjutan
                                </p>
                                <div style="position: relative; height: 400px;">
                                    <canvas id="totalScoreChart" style="max-height: 400px;"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- Section Program -->
    <section id="program" class="content-section">
        <div class="container">
            <?php if (isset($contents['program'])): ?>
                <h2 class="section-title"><?= esc($contents['program']['title'] ?? 'Program') ?></h2>
                <div class="section-content">
                    <?php if (!empty($contents['program']['subtitle'])): ?>
                        <p class="lead text-center mb-5"><?= esc($contents['program']['subtitle']) ?></p>
                    <?php endif; ?>

                    <!-- Program Preview - Show only 3 main programs -->
                    <div class="row g-4 mb-5">
                        <div class="col-md-4">
                            <div class="card h-100 shadow-sm border-0" style="transition: transform 0.3s ease;">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <i class="fas fa-building fa-3x" style="color: #149823;"></i>
                                    </div>
                                    <h5 class="card-title fw-bold">Setting & Infrastructure</h5>
                                    <p class="card-text text-muted">Pengembangan infrastruktur kampus yang ramah lingkungan dan berkelanjutan.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 shadow-sm border-0" style="transition: transform 0.3s ease;">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <i class="fas fa-bolt fa-3x" style="color: #f39c12;"></i>
                                    </div>
                                    <h5 class="card-title fw-bold">Energy & Climate</h5>
                                    <p class="card-text text-muted">Pengelolaan energi terbarukan dan mitigasi perubahan iklim.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 shadow-sm border-0" style="transition: transform 0.3s ease;">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <i class="fas fa-tint fa-3x" style="color: #3498db;"></i>
                                    </div>
                                    <h5 class="card-title fw-bold">Water Management</h5>
                                    <p class="card-text text-muted">Sistem pengelolaan air yang efisien dan berkelanjutan.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="text-center">
                        <p class="mb-4" style="color: #7f8c8d; font-size: 16px;">
                            Dan masih banyak program berkelanjutan lainnya yang kami kembangkan
                        </p>
                        <a href="/program"
                            class="btn btn-lg"
                            style="background: linear-gradient(135deg, #149823ff, #0b5804ff); color: white; padding: 12px 30px; border-radius: 25px; text-decoration: none; transition: all 0.3s ease;">
                            <i class="fas fa-eye me-2"></i>
                            Lihat Semua Program
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <h2 class="section-title">Program</h2>
                <div class="section-content">
                    <p class="text-center mb-4">Bagian ini berisi informasi tentang program-program GreenMetric.</p>

                    <!-- Placeholder untuk konten program -->
                    <div class="content-placeholder">
                        <i class="fas fa-tasks"></i>
                        <p>Konten Program belum diatur</p>
                        <small class="text-muted">Silakan tambahkan konten melalui <a href="<?= base_url('landing-contents') ?>" class="text-decoration-none">CMS Landing Contents</a></small>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <style>
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
        }
    </style>

    <!-- Section Berita -->
    <section id="berita" class="content-section">
        <div class="container">
            <h2 class="section-title">Berita</h2>
            <div class="section-content">
                <p>Bagian ini berisi berita-berita terbaru tentang GreenMetric Polban.</p>

                <?php if (!empty($news)): ?>
                    <div class="row g-4 mt-4">
                        <?php foreach ($news as $item): ?>
                            <div class="col-md-4">
                                <a href="<?= base_url('news/' . $item['slug']) ?>" class="text-decoration-none">
                                    <div class="card h-100 shadow-sm" style="transition: transform 0.3s; cursor: pointer;">
                                        <?php if (!empty($item['image'])): ?>
                                            <img src="<?= base_url('uploads/news/' . $item['image']) ?>"
                                                class="card-img-top"
                                                alt="<?= esc($item['title']) ?>"
                                                style="height: 200px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center"
                                                style="height: 200px;">
                                                <i class="fas fa-newspaper fa-3x text-white"></i>
                                            </div>
                                        <?php endif; ?>

                                        <div class="card-body">
                                            <h5 class="card-title" style="color: #2c3e50;">
                                                <?= esc($item['title']) ?>
                                            </h5>
                                            <p class="card-text text-muted">
                                                <?= esc(substr(strip_tags($item['excerpt'] ?? $item['content']), 0, 100)) ?>...
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar"></i>
                                                    <?= date('d M Y', strtotime($item['published_at'] ?? $item['created_at'])) ?>
                                                </small>
                                                <span class="badge" style="background-color: #149823ff;">
                                                    <?= esc($item['category'] ?? 'Berita') ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Tombol Lihat Semua Berita -->
                    <div class="text-center mt-5">
                        <a href="<?= base_url('news') ?>" class="btn btn-lg" style="background: linear-gradient(135deg, #149823ff, #0b5804ff); color: white; padding: 15px 40px; border-radius: 30px; font-weight: 600; box-shadow: 0 5px 15px rgba(20, 152, 35, 0.3); transition: all 0.3s;">
                            <i class="fas fa-newspaper"></i> Lihat Semua Berita
                        </a>
                    </div>
                <?php else: ?>
                    <div class="content-placeholder">
                        <i class="fas fa-newspaper"></i>
                        <p>Belum ada berita yang dipublikasikan</p>
                        <small class="text-muted">Berita akan muncul di sini setelah dipublikasikan oleh admin</small>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Section Informasi -->
    <section id="informasi" class="content-section" style="background: #1e3a5f; color: white;">
        <div class="container">
            <?php
            $informasiContent = isset($contents['informasi']) ? $contents['informasi'] : null;
            ?>
            <h2 class="section-title" style="color: white;">
                <?= $informasiContent ? esc($informasiContent['title']) : 'Informasi' ?>
            </h2>
            <div class="section-content" style="color: rgba(255,255,255,0.9);">
                <p><?= $informasiContent ? esc($informasiContent['content']) : 'Hubungi kami untuk informasi lebih lanjut tentang GreenMetric Polban.' ?></p>

                <!-- Contact Information -->
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px; margin-top: 40px; margin-bottom: 30px;">
                    <!-- Contact Details (Left Column) -->
                    <div>
                        <h4 style="color: #4CAF50; margin-bottom: 20px; font-size: 18px; font-weight: 700;">
                            <i class="fas fa-info-circle"></i>
                            <?= $informasiContent ? esc($informasiContent['subtitle']) : 'Informasi tentang Polban' ?>
                        </h4>
                        <div style="line-height: 1.8; color: rgba(255,255,255,0.9);">
                            <p style="margin-bottom: 15px;">
                                <i class="fas fa-map-marker-alt" style="color: #4CAF50; margin-right: 10px;"></i>
                                <?= $informasiContent && $informasiContent['address'] ? nl2br(esc($informasiContent['address'])) : 'Jl. Gegerkalong Hilir, Ds. Ciwaruga, Parongpong, Kabupaten Bandung Barat, Jawa Barat 40559' ?>
                            </p>
                            <p style="margin-bottom: 15px;">
                                <i class="fas fa-phone" style="color: #4CAF50; margin-right: 10px;"></i>
                                <?= $informasiContent && $informasiContent['phone'] ? esc($informasiContent['phone']) : '(022) 2013789' ?>
                            </p>
                            <p style="margin-bottom: 15px;">
                                <i class="fas fa-envelope" style="color: #4CAF50; margin-right: 10px;"></i>
                                <?= $informasiContent && $informasiContent['email'] ? esc($informasiContent['email']) : 'info@polban.ac.id' ?>
                            </p>
                            <div style="margin-top: 20px;">
                                <a href="https://www.facebook.com/polbanofficial/?locale=id_ID" target="_blank" style="display: inline-block; width: 35px; height: 35px; background: #3b5998; border-radius: 50%; text-align: center; line-height: 35px; margin-right: 10px; color: white; text-decoration: none; transition: transform 0.3s;">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://www.instagram.com/politekniknegeribandung?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" style="display: inline-block; width: 35px; height: 35px; background: #E1306C; border-radius: 50%; text-align: center; line-height: 35px; margin-right: 10px; color: white; text-decoration: none; transition: transform 0.3s;">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="https://www.youtube.com/c/POLBANOFFICIAL" target="_blank" style="display: inline-block; width: 35px; height: 35px; background: #FF0000; border-radius: 50%; text-align: center; line-height: 35px; color: white; text-decoration: none; transition: transform 0.3s;">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Logo Section (Right Column) -->
                    <div style="text-align: center;">
                        <div style="background: white; padding: 40px; border-radius: 15px; display: inline-block; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
                                <div style="width: 80px; height: 80px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(20, 152, 35, 0.3); border: 3px solid #149823ff;">
                                    <img src="<?= base_url('assets/images/logo-polban.png') ?>" alt="Logo Polban" style="width: 60px; height: 60px; object-fit: contain;">
                                </div>
                                <div style="text-align: center;">
                                    <h4 style="color: #149823ff; margin: 0; font-weight: bold;">POLBAN</h4>
                                    <p style="color: #666; margin: 5px 0 0 0; font-size: 14px;">Kampus Berkelanjutan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Location (Full Width Below) -->
                <?php if ($informasiContent && !empty($informasiContent['map_embed'])): ?>
                    <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 30px; margin-top: 30px;">
                        <h4 style="color: #4CAF50; margin-bottom: 20px; font-size: 18px; font-weight: 700; text-align: center;">
                            <i class="fas fa-map-marked-alt"></i> Lokasi Kampus
                        </h4>
                        <div class="map-container" style="border-radius: 15px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                            <?= $informasiContent['map_embed'] ?>
                        </div>
                        <style>
                            .map-container iframe {
                                width: 100% !important;
                                height: 350px !important;
                            }
                        </style>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-bottom">
                <p>Copyright © 2024 UI GreenMetric Polban. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <div class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up"></i>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js for interactive charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Animated JavaScript -->
    <script src="<?= base_url('assets/js/home_animated.js') ?>"></script>
    <script>
        // Scroll to top functionality
        const scrollTop = document.getElementById('scrollTop');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollTop.classList.add('show');
            } else {
                scrollTop.classList.remove('show');
            }
        });

        scrollTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Smooth scroll untuk menu navigasi header
        document.querySelectorAll('.nav-menu a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const target = document.querySelector(targetId);

                if (target) {
                    // Offset untuk header yang sticky (responsive)
                    const headerOffset = window.innerWidth <= 992 ? 90 : 80;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });

                    // Update active menu dengan animasi
                    document.querySelectorAll('.nav-menu a').forEach(link => {
                        link.style.background = '';
                        link.style.borderRadius = '';
                    });
                    this.style.background = 'rgba(255, 255, 255, 0.2)';
                    this.style.borderRadius = '5px';
                }
            });
        });

        // Mobile menu toggle
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const navMenu = document.querySelector('.nav-menu');

        if (mobileMenuToggle && navMenu) {
            mobileMenuToggle.addEventListener('click', function() {
                navMenu.classList.toggle('active');

                // Change icon
                const icon = this.querySelector('i');
                if (navMenu.classList.contains('active')) {
                    icon.className = 'fas fa-times';
                } else {
                    icon.className = 'fas fa-bars';
                }
            });

            // Close mobile menu when clicking on a link
            document.querySelectorAll('.nav-menu a[href^="#"]').forEach(link => {
                link.addEventListener('click', function() {
                    navMenu.classList.remove('active');
                    mobileMenuToggle.querySelector('i').className = 'fas fa-bars';
                });
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!navMenu.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                    navMenu.classList.remove('active');
                    mobileMenuToggle.querySelector('i').className = 'fas fa-bars';
                }
            });
        }

        // Active menu highlight saat scroll
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('.content-section');
            const navLinks = document.querySelectorAll('.nav-menu a[href^="#"]');
            const headerOffset = window.innerWidth <= 992 ? 90 : 80;

            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - headerOffset - 50;
                const sectionBottom = sectionTop + section.clientHeight;

                if (window.pageYOffset >= sectionTop && window.pageYOffset < sectionBottom) {
                    current = section.getAttribute('id');
                }
            });

            // Update active menu
            navLinks.forEach(link => {
                link.style.background = '';
                link.style.borderRadius = '';
                if (link.getAttribute('href') === '#' + current) {
                    link.style.background = 'rgba(255, 255, 255, 0.2)';
                    link.style.borderRadius = '5px';
                }
            });
        });

        // Enhanced Dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownItems = document.querySelectorAll('.dropdown-menu-item');
            let activeDropdown = null;
            
            dropdownItems.forEach(item => {
                const toggle = item.querySelector('.dropdown-toggle');
                const submenu = item.querySelector('.dropdown-submenu');
                
                if (toggle && submenu) {
                    // Handle click events for mobile and desktop
                    toggle.addEventListener('click', function(e) {
                        e.preventDefault();
                        
                        // Close other dropdowns
                        dropdownItems.forEach(otherItem => {
                            if (otherItem !== item) {
                                otherItem.classList.remove('active');
                            }
                        });
                        
                        // Toggle current dropdown
                        const isActive = item.classList.contains('active');
                        item.classList.toggle('active', !isActive);
                        activeDropdown = !isActive ? item : null;
                    });

                    // Handle hover for desktop (enhance CSS hover)
                    item.addEventListener('mouseenter', function() {
                        if (window.innerWidth > 992) {
                            // Close other dropdowns
                            dropdownItems.forEach(otherItem => {
                                if (otherItem !== item) {
                                    otherItem.classList.remove('active');
                                }
                            });
                            item.classList.add('active');
                            activeDropdown = item;
                        }
                    });

                    item.addEventListener('mouseleave', function() {
                        if (window.innerWidth > 992) {
                            setTimeout(() => {
                                if (!item.matches(':hover')) {
                                    item.classList.remove('active');
                                    if (activeDropdown === item) {
                                        activeDropdown = null;
                                    }
                                }
                            }, 100);
                        }
                    });

                    // Handle touch events for better mobile experience
                    toggle.addEventListener('touchstart', function(e) {
                        // Prevent double-tap zoom on mobile
                        e.preventDefault();
                    }, { passive: false });
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown-menu-item')) {
                    dropdownItems.forEach(item => {
                        item.classList.remove('active');
                    });
                    activeDropdown = null;
                }
            });

            // Close dropdown on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && activeDropdown) {
                    activeDropdown.classList.remove('active');
                    activeDropdown = null;
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 992) {
                    // Reset mobile states when switching to desktop
                    dropdownItems.forEach(item => {
                        item.classList.remove('active');
                    });
                    activeDropdown = null;
                }
            });
        });

        // Initialize Dashboard Charts on Landing Page
        document.addEventListener('DOMContentLoaded', function() {
            // Configure Chart.js defaults
            Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";
            Chart.defaults.font.size = 12;
            Chart.defaults.color = '#64748b';

            <?php if (!empty($chartData)): ?>
                // Data dari controller (sama seperti dashboard)
                const chartData = <?= json_encode($chartData) ?>;

                // Chart 1: Capaian Kriteria Kampus Berkelanjutan (Grouped Bar Chart)
                const sustainabilityCtx = document.getElementById('sustainabilityChart');
                if (sustainabilityCtx) {
                    new Chart(sustainabilityCtx, {
                        type: 'bar',
                        data: {
                            labels: chartData.labels,
                            datasets: chartData.datasets
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'bottom',
                                    labels: {
                                        padding: 15,
                                        font: {
                                            size: 11
                                        },
                                        usePointStyle: true,
                                        pointStyle: 'rect',
                                        boxWidth: 12,
                                        boxHeight: 12
                                    }
                                },
                                title: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                    padding: 12,
                                    titleFont: {
                                        size: 13,
                                        weight: 'bold'
                                    },
                                    bodyFont: {
                                        size: 12
                                    },
                                    callbacks: {
                                        label: function(context) {
                                            return context.dataset.label + ': ' + context.parsed.y + '%';
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 100,
                                    ticks: {
                                        callback: function(value) {
                                            return value + '%';
                                        },
                                        stepSize: 10,
                                        font: {
                                            size: 11
                                        }
                                    },
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.06)',
                                        drawBorder: false
                                    },
                                    title: {
                                        display: false
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        font: {
                                            size: 11,
                                            weight: '600'
                                        }
                                    }
                                }
                            },
                            interaction: {
                                intersect: false,
                                mode: 'index'
                            }
                        }
                    });
                }

                // Chart 2: Total Skor Capaian Per Tahun (Line Chart)
                const totalScoreCtx = document.getElementById('totalScoreChart');
                if (totalScoreCtx) {
                    // Create gradient
                    const gradient = totalScoreCtx.getContext('2d').createLinearGradient(0, 0, 0, 400);
                    gradient.addColorStop(0, 'rgba(45, 122, 79, 0.3)');
                    gradient.addColorStop(1, 'rgba(45, 122, 79, 0.05)');

                    new Chart(totalScoreCtx, {
                        type: 'line',
                        data: {
                            labels: chartData.labels,
                            datasets: [{
                                label: 'Total Skor (%)',
                                data: chartData.totalScore,
                                backgroundColor: gradient,
                                borderColor: '#2d7a4f',
                                borderWidth: 3,
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: '#2d7a4f',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                pointRadius: 6,
                                pointHoverRadius: 8,
                                pointHoverBackgroundColor: '#2d7a4f',
                                pointHoverBorderColor: '#fff',
                                pointHoverBorderWidth: 3
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                    labels: {
                                        usePointStyle: true,
                                        padding: 15,
                                        font: {
                                            size: 12,
                                            weight: '600'
                                        }
                                    }
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(45, 122, 79, 0.95)',
                                    padding: 12,
                                    titleFont: {
                                        size: 13,
                                        weight: 'bold'
                                    },
                                    bodyFont: {
                                        size: 12
                                    },
                                    callbacks: {
                                        label: function(context) {
                                            return 'Total Skor: ' + context.parsed.y + '%';
                                        },
                                        afterLabel: function(context) {
                                            const index = context.dataIndex;
                                            const worldRank = chartData.worldRank[index];
                                            const idRank = chartData.indonesiaRank[index];
                                            return 'World Rank: #' + worldRank + '\nID Rank: #' + idRank;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 100,
                                    ticks: {
                                        callback: function(value) {
                                            return value + '%';
                                        },
                                        stepSize: 10,
                                        font: {
                                            size: 11
                                        }
                                    },
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.06)',
                                        drawBorder: false
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        font: {
                                            size: 11,
                                            weight: '600'
                                        }
                                    }
                                }
                            }
                        }
                    });
                }

            <?php endif; ?>

            // Initialize generic landing page charts (if any)
            const chartCanvases = document.querySelectorAll('canvas[id^="landingChart"]');
            chartCanvases.forEach(function(canvas) {
                const ctx = canvas.getContext('2d');
                const chartType = canvas.dataset.chartType;
                const chartData = JSON.parse(canvas.dataset.chartData || '{}');
                const chartConfig = JSON.parse(canvas.dataset.chartConfig || '{}');

                // Default config
                const defaultConfig = {
                    type: chartType,
                    data: chartData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: false
                            }
                        }
                    }
                };

                // Merge dengan custom config
                const finalConfig = mergeDeep(defaultConfig, {
                    options: chartConfig
                });

                // Create chart
                try {
                    new Chart(ctx, finalConfig);
                } catch (error) {
                    console.error('Error creating chart:', error);
                }
            });
        });

        // Helper function untuk merge object
        function mergeDeep(target, source) {
            const output = Object.assign({}, target);
            if (isObject(target) && isObject(source)) {
                Object.keys(source).forEach(key => {
                    if (isObject(source[key])) {
                        if (!(key in target))
                            Object.assign(output, {
                                [key]: source[key]
                            });
                        else
                            output[key] = mergeDeep(target[key], source[key]);
                    } else {
                        Object.assign(output, {
                            [key]: source[key]
                        });
                    }
                });
            }
            return output;
        }

        function isObject(item) {
            return (item && typeof item === "object" && !Array.isArray(item));
        }
    </script>
</body>

</html>