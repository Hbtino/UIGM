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
        
        .content-section h3 {
            color: #149823ff;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        
        .sdg-goal {
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 10px;
            border-left: 5px solid;
        }
        
        .sdg-goal h4 {
            margin-bottom: 10px;
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
                <li><a href="<?= base_url('dashboard/user/info-sdgs') ?>" class="nav-link active"><i class="fas fa-info-circle"></i> Tentang SDGs</a></li>
                <li><a href="<?= base_url('dashboard/user/kriteria') ?>" class="nav-link"><i class="fas fa-list-check"></i> Kriteria UI GreenMetric</a></li>
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
            <h2><i class="fas fa-globe"></i> Tentang Sustainable Development Goals (SDGs)</h2>
            
            <p style="line-height: 1.8; color: #666; margin-bottom: 20px;">
                Sustainable Development Goals (SDGs) atau Tujuan Pembangunan Berkelanjutan adalah 17 tujuan global yang ditetapkan oleh Perserikatan Bangsa-Bangsa (PBB) pada tahun 2015 sebagai bagian dari Agenda 2030. SDGs dirancang untuk mengakhiri kemiskinan, melindungi planet, dan memastikan bahwa semua orang menikmati perdamaian dan kemakmuran pada tahun 2030.
            </p>

            <h3><i class="fas fa-university"></i> SDGs dan Perguruan Tinggi</h3>
            <p style="line-height: 1.8; color: #666; margin-bottom: 20px;">
                Perguruan tinggi memiliki peran penting dalam mencapai SDGs melalui:
            </p>
            <ul style="line-height: 2; color: #666; margin-bottom: 30px;">
                <li><strong>Pendidikan:</strong> Mengintegrasikan SDGs dalam kurikulum dan pembelajaran</li>
                <li><strong>Penelitian:</strong> Melakukan riset yang mendukung pencapaian SDGs</li>
                <li><strong>Operasional:</strong> Menerapkan praktik berkelanjutan dalam operasional kampus</li>
                <li><strong>Pengabdian Masyarakat:</strong> Berkontribusi langsung kepada masyarakat</li>
            </ul>

            <h3><i class="fas fa-leaf"></i> UI GreenMetric dan SDGs</h3>
            <p style="line-height: 1.8; color: #666; margin-bottom: 20px;">
                UI GreenMetric World University Ranking adalah sistem pemeringkatan universitas berkelanjutan yang menilai komitmen institusi pendidikan tinggi terhadap keberlanjutan lingkungan. Pemeringkatan ini sejalan dengan beberapa SDGs, terutama:
            </p>

            <div class="sdg-goal" style="background: #e5f5e0; border-left-color: #4CAF50;">
                <h4><i class="fas fa-graduation-cap"></i> SDG 4: Pendidikan Berkualitas</h4>
                <p style="margin: 0; color: #666;">Memastikan pendidikan berkualitas yang inklusif dan merata serta mempromosikan kesempatan belajar seumur hidup bagi semua.</p>
            </div>

            <div class="sdg-goal" style="background: #fff3e0; border-left-color: #FF9800;">
                <h4><i class="fas fa-bolt"></i> SDG 7: Energi Bersih dan Terjangkau</h4>
                <p style="margin: 0; color: #666;">Memastikan akses terhadap energi yang terjangkau, andal, berkelanjutan, dan modern untuk semua.</p>
            </div>

            <div class="sdg-goal" style="background: #e3f2fd; border-left-color: #2196F3;">
                <h4><i class="fas fa-tint"></i> SDG 6: Air Bersih dan Sanitasi</h4>
                <p style="margin: 0; color: #666;">Memastikan ketersediaan dan pengelolaan air bersih dan sanitasi yang berkelanjutan untuk semua.</p>
            </div>

            <div class="sdg-goal" style="background: #f3e5f5; border-left-color: #9C27B0;">
                <h4><i class="fas fa-city"></i> SDG 11: Kota dan Komunitas Berkelanjutan</h4>
                <p style="margin: 0; color: #666;">Menjadikan kota dan pemukiman manusia inklusif, aman, tangguh, dan berkelanjutan.</p>
            </div>

            <div class="sdg-goal" style="background: #e8f5e9; border-left-color: #4CAF50;">
                <h4><i class="fas fa-recycle"></i> SDG 12: Konsumsi dan Produksi Bertanggung Jawab</h4>
                <p style="margin: 0; color: #666;">Memastikan pola konsumsi dan produksi yang berkelanjutan.</p>
            </div>

            <div class="sdg-goal" style="background: #e0f2f1; border-left-color: #009688;">
                <h4><i class="fas fa-cloud"></i> SDG 13: Aksi Terhadap Iklim</h4>
                <p style="margin: 0; color: #666;">Mengambil tindakan cepat untuk memerangi perubahan iklim dan dampaknya.</p>
            </div>

            <h3><i class="fas fa-hands-helping"></i> Peran POLBAN</h3>
            <p style="line-height: 1.8; color: #666; margin-bottom: 20px;">
                Politeknik Negeri Bandung berkomitmen untuk berkontribusi dalam pencapaian SDGs melalui program Kampus Berkelanjutan. Dengan mengintegrasikan prinsip-prinsip keberlanjutan dalam pendidikan, penelitian, dan operasional kampus, POLBAN berupaya menjadi role model bagi institusi pendidikan tinggi lainnya dalam mendukung Agenda 2030.
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
