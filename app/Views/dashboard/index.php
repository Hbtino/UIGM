<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
        
        /* Sidebar Styles */
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
            transition: all 0.3s ease;
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
        
        .sidebar-header {
            padding: 25px 20px;
            background: rgba(0,0,0,0.2);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 10px;
        }
        
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
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
            letter-spacing: 0.5px;
        }
        
        .sidebar-header p {
            color: rgba(255,255,255,0.7);
            font-size: 13px;
            margin: 5px 0 0;
        }
        
        .nav-section {
            margin-bottom: 5px;
        }
        
        .nav-section-title {
            padding: 15px 20px 8px;
            color: rgba(255,255,255,0.5);
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .nav-item {
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
            position: relative;
        }
        
        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
            border-left-color: #4CAF50;
            padding-left: 25px;
        }
        
        .nav-link.active {
            background-color: rgba(76, 175, 80, 0.2);
            color: white;
            border-left-color: #4CAF50;
            font-weight: 600;
        }
        
        .nav-link.active::before {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #4CAF50;
        }
        
        .nav-link i {
            width: 24px;
            margin-right: 12px;
            font-size: 18px;
            text-align: center;
        }
        
        .nav-link span {
            font-size: 14px;
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
        
        /* Main Content Styles */
        .main-content {
            margin-left: 280px;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }
        
        /* Top Bar */
        .top-bar {
            background: white;
            padding: 20px 30px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .top-bar-left h2 {
            margin: 0;
            color: #1e3c72;
            font-size: 26px;
            font-weight: 700;
        }
        
        .top-bar-left p {
            margin: 5px 0 0;
            color: #666;
            font-size: 14px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-details {
            text-align: right;
        }
        
        .user-details .name {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }
        
        .user-details .role {
            font-size: 12px;
            color: #999;
            text-transform: capitalize;
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
            box-shadow: 0 2px 10px rgba(102, 126, 234, 0.4);
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--card-color-start), var(--card-color-end));
        }
        
        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .stat-card.blue { --card-color-start: #667eea; --card-color-end: #764ba2; }
        .stat-card.green { --card-color-start: #11998e; --card-color-end: #38ef7d; }
        .stat-card.orange { --card-color-start: #f093fb; --card-color-end: #f5576c; }
        .stat-card.purple { --card-color-start: #4facfe; --card-color-end: #00f2fe; }
        
        .stat-icon {
            width: 65px;
            height: 65px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .stat-icon.blue { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .stat-icon.green { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
        .stat-icon.orange { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .stat-icon.purple { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        
        .stat-info {
            flex: 1;
        }
        
        .stat-info h3 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            color: #333;
            line-height: 1;
        }
        
        .stat-info p {
            margin: 8px 0 0;
            color: #666;
            font-size: 14px;
            font-weight: 500;
        }
        
        .stat-info .trend {
            display: inline-block;
            margin-top: 5px;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }
        
        .stat-info .trend.up {
            background: rgba(76, 175, 80, 0.1);
            color: #4CAF50;
        }
        
        .stat-info .trend.target {
            background: rgba(33, 150, 243, 0.1);
            color: #2196F3;
        }
        
        /* Chart Container */
        .chart-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            margin-bottom: 25px;
        }
        
        .chart-header {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .chart-header-left h3 {
            margin: 0;
            color: #1e3c72;
            font-size: 22px;
            font-weight: 700;
        }
        
        .chart-header-left p {
            margin: 8px 0 0;
            color: #666;
            font-size: 14px;
        }
        
        canvas {
            max-height: 420px;
        }
        
        /* Info Box */
        .info-box {
            background: linear-gradient(135deg, #1ac247ff 0%, #0b671bff 100%);
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        
        .info-box h4 {
            margin: 0 0 10px;
            font-size: 18px;
            font-weight: 700;
        }
        
        .info-box p {
            margin: 0;
            opacity: 0.95;
            line-height: 1.6;
        }
        
        /* Ranking Grid */
        .ranking-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }
        
        .ranking-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        
        .ranking-card h4 {
            margin: 0 0 20px;
            color: #1e3c72;
            font-size: 18px;
            font-weight: 700;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .ranking-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f5f5f5;
        }
        
        .ranking-item:last-child {
            border-bottom: none;
        }
        
        .ranking-year {
            font-weight: 600;
            color: #666;
        }
        
        .ranking-value {
            font-size: 20px;
            font-weight: 700;
            color: #1e3c72;
        }
        
        .ranking-change {
            font-size: 12px;
            color: #4CAF50;
            margin-left: 8px;
        }
        
        /* Responsive */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            
            .sidebar-header h4,
            .sidebar-header p,
            .nav-link span,
            .nav-section-title {
                display: none;
            }
            
            .sidebar-logo {
                justify-content: center;
            }
            
            .sidebar-header {
                padding: 20px 10px;
            }
            
            .nav-link {
                justify-content: center;
                padding: 14px 10px;
            }
            
            .nav-link i {
                margin-right: 0;
            }
            
            .main-content {
                margin-left: 70px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .top-bar {
                flex-direction: column;
                gap: 15px;
            }
            
            .user-details {
                text-align: center;
            }
        }
        
        /* Print Styles */
        @media print {
            .sidebar,
            .top-bar .user-info {
                display: none;
            }
            
            .main-content {
                margin-left: 0;
            }
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
            <div class="nav-section">
                <div class="nav-section-title">Menu Utama</div>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard') ?>" class="nav-link <?= $page === 'dashboard' ? 'active' : '' ?>">
                            <i class="fas fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="nav-section">
                <div class="nav-section-title">Kriteria SDGs</div>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard/pengaturan-infrastruktur') ?>" class="nav-link <?= $page === 'pengaturan-infrastruktur' ? 'active' : '' ?>">
                            <i class="fas fa-building"></i>
                            <span>Pengaturan & Infrastruktur</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard/energi-iklim') ?>" class="nav-link <?= $page === 'energi-iklim' ? 'active' : '' ?>">
                            <i class="fas fa-bolt"></i>
                            <span>Energi & Perubahan Iklim</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard/limbah') ?>" class="nav-link <?= $page === 'limbah' ? 'active' : '' ?>">
                            <i class="fas fa-recycle"></i>
                            <span>Pengelolaan Limbah</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard/air') ?>" class="nav-link <?= $page === 'air' ? 'active' : '' ?>">
                            <i class="fas fa-tint"></i>
                            <span>Pengelolaan Air</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard/transportasi') ?>" class="nav-link <?= $page === 'transportasi' ? 'active' : '' ?>">
                            <i class="fas fa-bus"></i>
                            <span>Transportasi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard/pendidikan-penelitian') ?>" class="nav-link <?= $page === 'pendidikan-penelitian' ? 'active' : '' ?>">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Pendidikan & Penelitian</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="nav-section">
                <div class="nav-section-title">Sistem</div>
                <ul class="nav-menu">
                    <?php if(isset($user_role) && $user_role == 'admin'): ?>
                    <li class="nav-item">
                        <a href="<?= base_url('users') ?>" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Manajemen User</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard/laporan') ?>" class="nav-link <?= $page === 'laporan' ? 'active' : '' ?>">
                            <i class="fas fa-file-alt"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard/pengaturan') ?>" class="nav-link <?= $page === 'pengaturan' ? 'active' : '' ?>">
                            <i class="fas fa-cog"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('logout') ?>" class="nav-link">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Keluar</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <div class="sidebar-footer">
            <p>&copy; 2024 Politeknik Negeri Bandung<br>Renstra TMKB 2024-2028</p>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="top-bar-left">
                <h2>Dashboard Kampus Berkelanjutan</h2>
                <p>Renstra TMKB Polban 2024-2028 | UI GreenMetric</p>
            </div>
            <div class="user-info">
                <div class="user-details">
                    <div class="name"><?= isset($user_name) ? esc($user_name) : 'Admin' ?></div>
                    <div class="role"><?= isset($user_role) ? esc($user_role) : 'User' ?></div>
                </div>
                <div class="user-avatar">
                    <?= isset($user_name) ? strtoupper(substr($user_name, 0, 1)) : 'A' ?>
                </div>
            </div>
        </div>
        
        <!-- Info Box -->
        <div class="info-box">
            <h4><i class="fas fa-info-circle"></i> Tentang Renstra TMKB Polban</h4>
            <p>
                Rencana Strategis Transformasi Menuju Kampus Berkelanjutan (TMKB) Politeknik Negeri Bandung 
                periode 2024-2028 disusun untuk mendukung pencapaian Sustainable Development Goals (SDGs) 
                yang ditetapkan oleh PBB. Dashboard ini menampilkan capaian 6 kriteria utama kampus berkelanjutan 
                berdasarkan UI GreenMetric World University Ranking.
            </p>
        </div>
        
        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card blue">
                <div class="stat-icon blue">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $stats['targetSkor2028'] ?>%</h3>
                    <p>Target Skor 2028</p>
                    <span class="trend target">Target: 80%</span>
                </div>
            </div>
            
            <div class="stat-card green">
                <div class="stat-icon green">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="stat-info">
                    <h3>#<?= $stats['targetRankingDunia'] ?></h3>
                    <p>Target Ranking Dunia</p>
                    <span class="trend up"><i class="fas fa-arrow-up"></i> dari #896</span>
                </div>
            </div>
            
            <div class="stat-card orange">
                <div class="stat-icon orange">
                    <i class="fas fa-flag"></i>
                </div>
                <div class="stat-info">
                    <h3>#<?= $stats['targetRankingIndonesia'] ?></h3>
                    <p>Target Ranking Indonesia</p>
                    <span class="trend up"><i class="fas fa-arrow-up"></i> dari #87</span>
                </div>
            </div>
            
            <div class="stat-card purple">
                <div class="stat-icon purple">
                    <i class="fas fa-leaf"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $stats['jumlahKriteria'] ?></h3>
                    <p>Kriteria Keberlanjutan</p>
                    <span class="trend target">6 Kriteria SDGs</span>
                </div>
            </div>
        </div>
        
        <!-- Main Chart -->
        <div class="chart-container">
            <div class="chart-header">
                <div class="chart-header-left">
                    <h3>Capaian Kriteria Kampus Berkelanjutan (2023-2028)</h3>
                    <p>Proyeksi pencapaian berdasarkan UI GreenMetric World University Ranking</p>
                </div>
            </div>
            <canvas id="sustainabilityChart"></canvas>
        </div>
        
        <!-- Ranking Progress -->
        <div class="ranking-grid">
            <div class="ranking-card">
                <h4><i class="fas fa-globe"></i> Progress Ranking Dunia</h4>
                <?php foreach($chartData['labels'] as $index => $year): ?>
                <div class="ranking-item">
                    <span class="ranking-year"><?= $year ?></span>
                    <div>
                        <span class="ranking-value">#<?= $chartData['worldRank'][$index] ?></span>
                        <?php if($index > 0): ?>
                            <span class="ranking-change">
                                <i class="fas fa-arrow-up"></i> <?= $chartData['worldRank'][$index-1] - $chartData['worldRank'][$index] ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="ranking-card">
                <h4><i class="fas fa-map-marker-alt"></i> Progress Ranking Indonesia</h4>
                <?php foreach($chartData['labels'] as $index => $year): ?>
                <div class="ranking-item">
                    <span class="ranking-year"><?= $year ?></span>
                    <div>
                        <span class="ranking-value">#<?= $chartData['indonesiaRank'][$index] ?></span>
                        <?php if($index > 0): ?>
                            <span class="ranking-change">
                                <i class="fas fa-arrow-up"></i> <?= $chartData['indonesiaRank'][$index-1] - $chartData['indonesiaRank'][$index] ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Total Score Chart -->
        <div class="chart-container">
            <div class="chart-header">
                <div class="chart-header-left">
                    <h3>Total Skor Capaian Per Tahun</h3>
                    <p>Grafik peningkatan skor keseluruhan kampus berkelanjutan</p>
                </div>
            </div>
            <canvas id="totalScoreChart"></canvas>
        </div>
        
        <!-- Campus Info Grid -->
        <div class="ranking-grid">
            <div class="ranking-card">
                <h4><i class="fas fa-university"></i> Profil Kampus Polban</h4>
                <div class="ranking-item">
                    <span class="ranking-year">Mahasiswa</span>
                    <span class="ranking-value"><?= number_format($stats['jumlahMahasiswa']) ?></span>
                </div>
                <div class="ranking-item">
                    <span class="ranking-year">Dosen</span>
                    <span class="ranking-value"><?= number_format($stats['jumlahDosen']) ?></span>
                </div>
                <div class="ranking-item">
                    <span class="ranking-year">Jurusan</span>
                    <span class="ranking-value"><?= $stats['jumlahJurusan'] ?></span>
                </div>
                <div class="ranking-item">
                    <span class="ranking-year">Program Studi</span>
                    <span class="ranking-value"><?= $stats['jumlahProdi'] ?></span>
                </div>
            </div>
            
            <div class="ranking-card">
                <h4><i class="fas fa-building"></i> Fasilitas Kampus</h4>
                <div class="ranking-item">
                    <span class="ranking-year">Luas Kampus</span>
                    <span class="ranking-value"><?= number_format($stats['luasKampus']) ?> m²</span>
                </div>
                <div class="ranking-item">
                    <span class="ranking-year">Luas Bangunan</span>
                    <span class="ranking-value"><?= number_format($stats['luasBangunan']) ?> m²</span>
                </div>
                <div class="ranking-item">
                    <span class="ranking-year">Jumlah Bangunan</span>
                    <span class="ranking-value"><?= $stats['jumlahBangunan'] ?></span>
                </div>
                <div class="ranking-item">
                    <span class="ranking-year">Laboratorium</span>
                    <span class="ranking-value"><?= $stats['jumlahLaboratorium'] ?></span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart Configuration -->
   // BAGIAN JAVASCRIPT UNTUK CHART -

<script>
    // Data dari controller
    const chartData = <?= json_encode($chartData) ?>;
    
    // Configure Chart.js defaults
    Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";
    Chart.defaults.font.size = 12;
    Chart.defaults.color = '#666';
    
    // Main Sustainability Chart - GROUPED BAR CHART SEPERTI SCREENSHOT
    const ctx = document.getElementById('sustainabilityChart').getContext('2d');
    const sustainabilityChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: chartData.datasets
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
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
    
    // Total Score Chart - LINE CHART WITH GRADIENT
    const ctx2 = document.getElementById('totalScoreChart').getContext('2d');
    
    // Create gradient
    const gradient = ctx2.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(45, 122, 79, 0.3)');
    gradient.addColorStop(1, 'rgba(45, 122, 79, 0.05)');
    
    const totalScoreChart = new Chart(ctx2, {
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
            maintainAspectRatio: true,
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
    
    // Auto refresh chart on window resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            sustainabilityChart.resize();
            totalScoreChart.resize();
        }, 250);
    });
    
    // Print functionality
    function printDashboard() {
        window.print();
    }
    
    // Export data to CSV
    function exportToCSV() {
        let csv = 'Tahun,SI,EC,WS,WR,TR,ED,Total Score,World Rank,ID Rank\n';
        
        for(let i = 0; i < chartData.labels.length; i++) {
            csv += chartData.labels[i] + ',';
            csv += chartData.datasets[0].data[i] + ',';
            csv += chartData.datasets[1].data[i] + ',';
            csv += chartData.datasets[2].data[i] + ',';
            csv += chartData.datasets[3].data[i] + ',';
            csv += chartData.datasets[4].data[i] + ',';
            csv += chartData.datasets[5].data[i] + ',';
            csv += chartData.totalScore[i] + ',';
            csv += chartData.worldRank[i] + ',';
            csv += chartData.indonesiaRank[i] + '\n';
        }
        
        const blob = new Blob([csv], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.setAttribute('hidden', '');
        a.setAttribute('href', url);
        a.setAttribute('download', 'data_kampus_berkelanjutan.csv');
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }
</script>