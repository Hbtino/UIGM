<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
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
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        
        /* Sidebar Styles - Same as user.php */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);
            padding: 0;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 4px 0 15px rgba(0,0,0,0.2);
            display: flex;
            flex-direction: column;
        }
        
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }
        
        .sidebar nav {
            flex: 1;
        }
        
        .sidebar-header {
            padding: 25px 20px;
            background: rgba(0,0,0,0.2);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .sidebar-logo i {
            font-size: 32px;
            color: #4CAF50;
        }
        
        .sidebar-header h4 {
            color: white;
            font-size: 20px;
            font-weight: 700;
            margin: 0;
        }
        
        .sidebar-header p {
            color: rgba(255,255,255,0.7);
            font-size: 13px;
            margin: 5px 0 0;
        }
        
        .nav-section-title {
            padding: 15px 20px 8px;
            color: rgba(255,255,255,0.5);
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
            border-left-color: #4CAF50;
        }
        
        .nav-link.active {
            background-color: rgba(76, 175, 80, 0.2);
            color: white;
            border-left-color: #4CAF50;
            font-weight: 600;
        }
        
        .nav-link i {
            width: 24px;
            margin-right: 12px;
            font-size: 18px;
        }
        
        .sidebar-footer {
            padding: 20px;
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,0.1);
            background: rgba(0,0,0,0.2);
        }
        
        .sidebar-footer p {
            color: rgba(255,255,255,0.5);
            font-size: 11px;
            margin: 0;
            text-align: center;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 30px;
            min-height: 100vh;
        }
        
        .content-section {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .content-section h2 {
            color: #149823ff;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #149823ff;
        }
        
        .kriteria-card {
            padding: 25px;
            margin-bottom: 20px;
            border-radius: 10px;
            border-left: 5px solid;
            background: #f8f9fa;
        }
        
        .kriteria-card h3 {
            margin-bottom: 15px;
        }
        
        .kriteria-card ul {
            margin: 15px 0;
            padding-left: 20px;
        }
        
        .kriteria-card li {
            margin-bottom: 8px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-leaf"></i>
                <div>
                    <h4>POLBAN</h4>
                    <p>Kampus Berkelanjutan</p>
                </div>
            </div>
        </div>
        
        <nav>
            <div class="nav-section-title">Menu Utama</div>
            <ul class="nav-menu">
                <li><a href="<?= base_url('dashboard') ?>" class="nav-link"><i class="fas fa-home"></i> Dashboard</a></li>
            </ul>
            
            <div class="nav-section-title">Informasi</div>
            <ul class="nav-menu">
                <li><a href="<?= base_url('dashboard/user/info-sdgs') ?>" class="nav-link"><i class="fas fa-info-circle"></i> Tentang SDGs</a></li>
                <li><a href="<?= base_url('dashboard/user/kriteria') ?>" class="nav-link active"><i class="fas fa-list-check"></i> Kriteria UI GreenMetric</a></li>
            </ul>
            
            <div class="nav-section-title">Akun</div>
            <ul class="nav-menu">
                <li><a href="<?= base_url('settings') ?>" class="nav-link"><i class="fas fa-user-edit"></i> Edit Profil</a></li>
                <li><a href="<?= base_url('logout') ?>" class="nav-link"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </nav>
        
        <div class="sidebar-footer">
            <p>&copy; 2024 Politeknik Negeri Bandung<br>Kampus Berkelanjutan</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-section">
            <h2><i class="fas fa-list-check"></i> 6 Kriteria UI GreenMetric World University Ranking</h2>
            
            <p style="line-height: 1.8; color: #666; margin-bottom: 30px;">
                UI GreenMetric World University Ranking menilai komitmen universitas terhadap keberlanjutan lingkungan melalui 6 kriteria utama. Setiap kriteria memiliki bobot penilaian yang berbeda dan mencakup berbagai indikator spesifik.
            </p>

            <!-- SI -->
            <div class="kriteria-card" style="border-left-color: #2196F3;">
                <h3><i class="fas fa-building" style="color: #2196F3;"></i> 1. Setting & Infrastructure (SI) - 15%</h3>
                <p style="color: #666; margin-bottom: 15px;">
                    Kriteria ini menilai pengaturan dasar kampus dan infrastruktur yang mendukung keberlanjutan lingkungan.
                </p>
                <strong>Indikator Penilaian:</strong>
                <ul style="color: #666;">
                    <li>Rasio luas area terbuka terhadap total luas kampus</li>
                    <li>Rasio luas area yang ditanami vegetasi terhadap total luas kampus</li>
                    <li>Rasio luas area yang menyerap air terhadap total luas kampus</li>
                    <li>Anggaran universitas untuk upaya keberlanjutan</li>
                </ul>
            </div>

            <!-- EC -->
            <div class="kriteria-card" style="border-left-color: #FF9800;">
                <h3><i class="fas fa-bolt" style="color: #FF9800;"></i> 2. Energy & Climate Change (EC) - 21%</h3>
                <p style="color: #666; margin-bottom: 15px;">
                    Kriteria ini menilai penggunaan energi, program efisiensi energi, dan upaya mitigasi perubahan iklim.
                </p>
                <strong>Indikator Penilaian:</strong>
                <ul style="color: #666;">
                    <li>Penggunaan peralatan hemat energi</li>
                    <li>Implementasi smart building</li>
                    <li>Penggunaan energi terbarukan</li>
                    <li>Total konsumsi listrik per tahun</li>
                    <li>Rasio produksi energi terbarukan terhadap konsumsi energi</li>
                    <li>Program pengurangan emisi gas rumah kaca</li>
                </ul>
            </div>

            <!-- WS -->
            <div class="kriteria-card" style="border-left-color: #4CAF50;">
                <h3><i class="fas fa-recycle" style="color: #4CAF50;"></i> 3. Waste (WS) - 18%</h3>
                <p style="color: #666; margin-bottom: 15px;">
                    Kriteria ini menilai pengelolaan limbah dan program daur ulang di kampus.
                </p>
                <strong>Indikator Penilaian:</strong>
                <ul style="color: #666;">
                    <li>Program daur ulang limbah</li>
                    <li>Program pengolahan limbah organik</li>
                    <li>Program pengolahan limbah anorganik</li>
                    <li>Program pengolahan limbah beracun</li>
                    <li>Pembuangan limbah ke tempat pembuangan akhir</li>
                </ul>
            </div>

            <!-- WR -->
            <div class="kriteria-card" style="border-left-color: #00BCD4;">
                <h3><i class="fas fa-tint" style="color: #00BCD4;"></i> 4. Water (WR) - 10%</h3>
                <p style="color: #666; margin-bottom: 15px;">
                    Kriteria ini menilai program konservasi air dan penggunaan air di kampus.
                </p>
                <strong>Indikator Penilaian:</strong>
                <ul style="color: #666;">
                    <li>Program konservasi air</li>
                    <li>Program daur ulang air</li>
                    <li>Penggunaan peralatan hemat air</li>
                    <li>Konsumsi air yang berasal dari air tanah</li>
                </ul>
            </div>

            <!-- TR -->
            <div class="kriteria-card" style="border-left-color: #9C27B0;">
                <h3><i class="fas fa-bus" style="color: #9C27B0;"></i> 5. Transportation (TR) - 18%</h3>
                <p style="color: #666; margin-bottom: 15px;">
                    Kriteria ini menilai kebijakan transportasi dan upaya mengurangi emisi kendaraan.
                </p>
                <strong>Indikator Penilaian:</strong>
                <ul style="color: #666;">
                    <li>Jumlah kendaraan (mobil dan motor) di kampus</li>
                    <li>Rasio kendaraan terhadap populasi kampus</li>
                    <li>Layanan shuttle bus kampus</li>
                    <li>Kebijakan zero emission atau low emission vehicle</li>
                    <li>Rasio area parkir terhadap total luas kampus</li>
                    <li>Program transportasi ramah lingkungan</li>
                </ul>
            </div>

            <!-- ED -->
            <div class="kriteria-card" style="border-left-color: #F44336;">
                <h3><i class="fas fa-graduation-cap" style="color: #F44336;"></i> 6. Education & Research (ED) - 18%</h3>
                <p style="color: #666; margin-bottom: 15px;">
                    Kriteria ini menilai integrasi keberlanjutan dalam pendidikan dan penelitian.
                </p>
                <strong>Indikator Penilaian:</strong>
                <ul style="color: #666;">
                    <li>Rasio mata kuliah keberlanjutan terhadap total mata kuliah</li>
                    <li>Rasio dana penelitian keberlanjutan terhadap total dana penelitian</li>
                    <li>Jumlah publikasi ilmiah tentang keberlanjutan</li>
                    <li>Jumlah kegiatan ilmiah tentang keberlanjutan</li>
                    <li>Jumlah organisasi mahasiswa terkait keberlanjutan</li>
                    <li>Website keberlanjutan universitas</li>
                    <li>Laporan keberlanjutan yang dipublikasikan</li>
                </ul>
            </div>

            <div style="background: #e3f2fd; padding: 20px; border-radius: 10px; border-left: 4px solid #2196F3; margin-top: 30px;">
                <h4 style="color: #1976D2; margin-bottom: 10px;"><i class="fas fa-info-circle"></i> Informasi Penting</h4>
                <p style="margin: 0; color: #666; line-height: 1.8;">
                    POLBAN berkomitmen untuk terus meningkatkan performa di semua kriteria UI GreenMetric. Setiap civitas akademika dapat berkontribusi dalam pencapaian target melalui praktik-praktik berkelanjutan dalam kegiatan sehari-hari di kampus.
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
