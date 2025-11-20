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
            overflow: hidden;

        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .logo-circle:hover {
            animation-play-state: paused;
        }

        .logo-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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

        .footer h4 {
            color: #149823ff;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .footer p {
            color: #bdc3c7;
            line-height: 1.8;
        }

        .contact-info {
            list-style: none;
            padding: 0;
        }

        .contact-info li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #bdc3c7;
            transition: all 0.3s;
        }

        .contact-info li:hover {
            color: #149823ff;
            padding-left: 5px;
        }

        .contact-info i {
            color: #149823ff;
            font-size: 18px;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            margin-top: 40px;
            border-top: 1px solid #34495e;
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

        /* Mobile Responsive */
        @media (max-width: 992px) {
            .nav-menu {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
                background: white;
                color: #03c914ff;
                border: none;
                padding: 8px 15px;
                border-radius: 5px;
                cursor: pointer;
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
                font-size: 22px;
            }

            .section-title {
                font-size: 28px;
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
                        <img src="https://e7.pngegg.com/pngimages/2/27/png-clipart-bandung-state-polytechnic-symbol-technical-school-pendhidhikan-dhuwur-symbol-miscellaneous-angle.png" alt="POLBAN Logo">
                    </div>
                    <span>POLBAN</span>
                </a>

                <!-- Desktop Menu -->
                <ul class="nav-menu">
                    <li><a href="#deskripsi">Deskripsi</a></li>
                    <li><a href="#program">Program</a></li>
                    <li><a href="#berita">Berita</a></li>
                    <li><a href="#kontak">Kontak</a></li>
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
            <h2 class="section-title">Deskripsi</h2>
            <div class="section-content">
                <p>Bagian ini berisi deskripsi lengkap tentang program GreenMetric Polban.</p>

                <!-- Placeholder untuk konten deskripsi -->
                <div class="row g-4 align-items-center">
                    <div class="col-md-6">
                        <img src="gambar-kampus.jpg" class="img-fluid rounded shadow" alt="Kampus Polban">
                    </div>
                    <div class="col-md-6">
                        <h3>Tentang GreenMetric Polban</h3>
                        <p>GreenMetric adalah program pemeringkatan universitas yang fokus pada pengelolaan kampus hijau dan berkelanjutan.</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check-circle text-success me-2"></i> Kampus Hijau</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i> Energi Terbarukan</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i> Pengelolaan Limbah</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Program -->
    <section id="program" class="content-section">
        <div class="container">
            <h2 class="section-title">Program</h2>
            <div class="section-content">
                <p>Bagian ini berisi informasi tentang program-program GreenMetric.</p>

                <!-- Placeholder untuk konten program -->
                <div class="content-placeholder">
                    <i class="fas fa-tasks"></i>
                    <p>Konten Program akan ditambahkan di sini</p>
                    <small class="text-muted">Anda dapat menambahkan daftar program, card, atau grid</small>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Berita -->
    <section id="berita" class="content-section">
        <div class="container">
            <h2 class="section-title">Berita</h2>
            <div class="section-content">
                <p>Bagian ini berisi berita-berita terbaru tentang GreenMetric Polban.</p>

                <!-- Placeholder untuk konten berita -->
                <div class="content-placeholder">
                    <i class="fas fa-newspaper"></i>
                    <p>Konten Berita akan ditambahkan di sini</p>
                    <small class="text-muted">Anda dapat menambahkan artikel, card berita, atau carousel</small>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Kontak -->
    <section id="kontak" class="content-section">
        <div class="container">
            <h2 class="section-title">Kontak</h2>
            <div class="section-content">
                <p>Hubungi kami untuk informasi lebih lanjut tentang GreenMetric Polban.</p>

                <!-- Placeholder untuk konten kontak -->
                <div class="content-placeholder">
                    <i class="fas fa-envelope"></i>
                    <p>Konten Kontak akan ditambahkan di sini</p>
                    <small class="text-muted">Anda dapat menambahkan form kontak, peta, atau informasi kontak</small>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- About -->
                <div class="col-md-6 mb-4">
                    <h4>UI GreenMetric Polban</h4>
                    <p>
                        Program pemeringkatan universitas berbasis kampus hijau dan berkelanjutan.
                    </p>
                </div>

                <!-- Kontak -->
                <div class="col-md-6 mb-4">
                    <h4>Kontak</h4>
                    <ul class="contact-info">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Jl. Gegerkalong Hilir, Bandung</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>greenmetric@polban.ac.id</span>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <span>+62 22 1234567</span>
                        </li>
                    </ul>
                </div>
            </div>

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

        // Smooth scroll untuk menu navigasi
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const headerOffset = 80;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Active menu highlight saat scroll
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('.content-section');
            const navLinks = document.querySelectorAll('.nav-menu a[href^="#"]');

            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (window.pageYOffset >= (sectionTop - 100)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.style.background = '';
                if (link.getAttribute('href') === '#' + current) {
                    link.style.background = 'rgba(255, 255, 255, 0.2)';
                }
            });
        });
    </script>
</body>

</html>