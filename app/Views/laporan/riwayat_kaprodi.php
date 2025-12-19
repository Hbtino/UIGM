<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>
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
        
        /* Submenu Collapse Styling */
        .collapse .nav-link {
            padding: 12px 20px 12px 15px;
            font-size: 13px;
            color: rgba(255,255,255,0.7);
        }
        
        .collapse .nav-link:hover {
            color: white;
            background-color: rgba(255,255,255,0.08);
            padding-left: 20px;
        }
        
        .collapse .nav-link.active {
            color: white;
            background-color: rgba(76, 175, 80, 0.15);
        }
        
        .collapse .nav-link i {
            font-size: 14px;
            width: 20px;
        }
        
        /* Chevron icon animation */
        .nav-link[data-bs-toggle="collapse"] .fa-chevron-down {
            transition: transform 0.3s ease;
        }
        
        .nav-link[data-bs-toggle="collapse"][aria-expanded="true"] .fa-chevron-down {
            transform: rotate(180deg);
        }
        
        /* Force white color for collapse toggle links */
        .nav-link[data-bs-toggle="collapse"],
        .nav-link[data-bs-toggle="collapse"]:focus,
        .nav-link[data-bs-toggle="collapse"]:active,
        .nav-link[data-bs-toggle="collapse"][aria-expanded="true"],
        .nav-link[data-bs-toggle="collapse"][aria-expanded="false"] {
            color: rgba(255,255,255,0.8) !important;
        }
        
        .nav-link[data-bs-toggle="collapse"]:hover {
            color: white !important;
        }
        
        .nav-link[data-bs-toggle="collapse"] span,
        .nav-link[data-bs-toggle="collapse"] i {
            color: inherit;
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
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 3px solid #149823ff;
        }
        .header h1 {
            color: #149823ff;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .btn-back {
            background: #6c757d;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        .btn-back:hover {
            background: #5a6268;
            color: white;
        }
        .laporan-card {
            border: 2px solid #149823ff;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            background: #f8f9fa;
        }
        .laporan-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #149823ff;
        }
        .laporan-title {
            font-size: 20px;
            font-weight: 700;
            color: #149823ff;
        }
        .laporan-date {
            font-size: 14px;
            color: #666;
        }
        .info-row {
            display: flex;
            margin-bottom: 10px;
        }
        .info-label {
            font-weight: 600;
            width: 200px;
            color: #333;
        }
        .info-value {
            color: #666;
        }
        .section-title {
            background: #149823ff;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            margin: 20px 0 10px;
            font-weight: 600;
        }
        .section-subtitle {
            background: #e9ecef;
            padding: 8px 12px;
            border-left: 4px solid #149823ff;
            margin: 15px 0 10px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .data-table th {
            background: #149823ff;
            color: white;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        .data-table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            font-size: 12px;
        }
        .no-data {
            text-align: center;
            padding: 30px;
            color: #999;
            font-style: italic;
        }
        .action-buttons {
            margin-top: 20px;
            text-align: center;
        }
        .btn-edit {
            background: #ffc107;
            color: #000;
            padding: 10px 30px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            margin: 0 5px;
        }
        .btn-edit:hover {
            background: #e0a800;
            color: #000;
        }
        .btn-pdf {
            background: #dc3545;
            color: white;
            padding: 10px 30px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            margin: 0 5px;
        }
        .btn-pdf:hover {
            background: #c82333;
            color: white;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
            padding: 10px 30px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: inline-block;
            margin: 0 5px;
            font-size: 16px;
        }
        .btn-delete:hover {
            background: #c82333;
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
                        <a href="<?= base_url('dashboard') ?>" class="nav-link">
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
                        <a href="<?= base_url('setting-infrastructure') ?>" class="nav-link">
                            <i class="fas fa-building"></i>
                            <span>Pengaturan & Infrastruktur</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('energy-climate') ?>" class="nav-link">
                            <i class="fas fa-bolt"></i>
                            <span>Energi & Perubahan Iklim</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('water-management') ?>" class="nav-link">
                            <i class="fas fa-tint"></i>
                            <span>Pengelolaan Air</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('waste-management') ?>" class="nav-link">
                            <i class="fas fa-recycle"></i>
                            <span>Pengelolaan Limbah</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard/transportasi') ?>" class="nav-link">
                            <i class="fas fa-bus"></i>
                            <span>Transportasi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('education-research') ?>" class="nav-link">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Pendidikan & Penelitian</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="nav-section">
                <div class="nav-section-title">Sistem</div>
                <ul class="nav-menu">
                    <?php 
                    $user_role = isset($user_role) ? $user_role : session()->get('role');
                    if($user_role == 'admin'): 
                    ?>
                    <li class="nav-item">
                        <a href="<?= base_url('users') ?>" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Manajemen User</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('menus') ?>" class="nav-link">
                            <i class="fas fa-bars"></i>
                            <span>Manajemen Menu</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('news-admin') ?>" class="nav-link">
                            <i class="fas fa-newspaper"></i>
                            <span>Manajemen Berita</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('landing-contents') ?>" class="nav-link">
                            <i class="fas fa-file-alt"></i>
                            <span>Konten Landing Page</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <!-- Laporan Menu with Submenu -->
                    <?php if (in_array($user_role, ['admin', 'dosen', 'kaprodi'])): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link active" data-bs-toggle="collapse" data-bs-target="#laporanSubmenu" aria-expanded="true">
                            <i class="fas fa-file-alt"></i>
                            <span>Laporan</span>
                            <i class="fas fa-chevron-down ms-auto" style="font-size: 12px;"></i>
                        </a>
                        <div class="collapse show" id="laporanSubmenu">
                            <ul class="nav flex-column ms-3">
                                <?php if (in_array($user_role, ['admin', 'dosen'])): ?>
                                <li class="nav-item">
                                    <a href="<?= base_url('dashboard/laporan') ?>" class="nav-link">
                                        <i class="fas fa-user-tie"></i>
                                        <span>Laporan Dosen</span>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if (in_array($user_role, ['admin', 'kaprodi'])): ?>
                                <li class="nav-item">
                                    <a href="<?= base_url('laporan/kaprodi') ?>" class="nav-link active">
                                        <i class="fas fa-graduation-cap"></i>
                                        <span>Laporan Kaprodi</span>
                                    </a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                    <?php endif; ?>
                    
                    <li class="nav-item">
                        <a href="<?= base_url('settings') ?>" class="nav-link">
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
            <p>&copy; 2024 Politeknik Negeri Bandung<br>Kampus Berkelanjutan</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
    <div class="container">
        
        <div class="header">
            <h1><i class="fas fa-history"></i> Riwayat Laporan Program Studi</h1>
            <p>Lihat laporan yang sudah Anda simpan</p>
        </div>

        <?php if (!empty($laporan) && is_array($laporan)): ?>
            <?php foreach ($laporan as $item): ?>
            <?php 
                $data = json_decode($item['data_laporan'] ?? '{}', true);
                if (!is_array($data)) {
                    $data = [];
                }
                
                // Get prodi info from database columns or fallback to JSON data
                $prodiName = !empty($item['prodi_name']) && $item['prodi_name'] !== 'Program Studi' 
                    ? $item['prodi_name'] 
                    : ($data['prodi_name'] ?? 'Program Studi');
                    
                $kaprodiName = !empty($item['kaprodi_name']) && $item['kaprodi_name'] !== 'Kaprodi'
                    ? $item['kaprodi_name'] 
                    : ($data['kaprodi_name'] ?? 'Kaprodi');
                    
                $jurusan = !empty($item['jurusan']) ? $item['jurusan'] : ($data['jurusan'] ?? '');
                $tanggalLaporan = !empty($item['tanggal_laporan']) ? $item['tanggal_laporan'] : ($data['tanggal_laporan'] ?? '');
                
                $lastSaved = $item['updated_at'] ?? $item['created_at'] ?? date('Y-m-d H:i:s');
                try {
                    $date = new DateTime($lastSaved);
                } catch (Exception $e) {
                    $date = new DateTime();
                }
            ?>
            
            <div class="laporan-card">
                <div class="laporan-header">
                    <div class="laporan-title">
                        <i class="fas fa-file-alt"></i> Laporan Program Studi - UI GreenMetric
                        <?php if (ENVIRONMENT === 'development'): ?>
                            <span style="font-size: 12px; color: #666;">
                                (ID: <?= isset($item['id']) ? $item['id'] : 'NOT SET' ?>)
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="laporan-date">
                        <i class="fas fa-clock"></i> Disimpan: <?= $date->format('d F Y, H:i:s') ?>
                    </div>
                </div>

                <div class="section-title">
                    <i class="fas fa-university"></i> Informasi Program Studi
                </div>
                <div class="info-row">
                    <div class="info-label">Program Studi:</div>
                    <div class="info-value"><?= esc($prodiName) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Nama Kaprodi:</div>
                    <div class="info-value"><?= esc($kaprodiName) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Jurusan:</div>
                    <div class="info-value"><?= esc($jurusan ?: '-') ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Laporan:</div>
                    <div class="info-value"><?= esc($tanggalLaporan ?: '-') ?></div>
                </div>

                <div class="section-title">
                    <i class="fas fa-tasks"></i> Kontribusi Berdasarkan Kriteria UI GreenMetric
                </div>

                <?php if (isset($data['si'])): ?>
                    <?php $siData = json_decode($data['si'], true); ?>
                    <?php if (!empty($siData)): ?>
                        <div class="section-subtitle">
                            <i class="fas fa-building"></i> SI (Setting and Infrastructure)
                        </div>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="45%">Kegiatan/Inisiatif</th>
                                    <th width="50%">Data/Bukti</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($siData as $index => $siItem): ?>
                                    <?php if (!empty($siItem['kegiatan'])): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= esc($siItem['kegiatan'] ?? '-') ?></td>
                                            <td><?= esc($siItem['bukti'] ?? '-') ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (isset($data['ec'])): ?>
                    <?php $ecData = json_decode($data['ec'], true); ?>
                    <?php if (!empty($ecData)): ?>
                        <div class="section-subtitle">
                            <i class="fas fa-bolt"></i> EC (Energy and Climate Change)
                        </div>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="45%">Kegiatan/Inisiatif</th>
                                    <th width="50%">Data/Bukti</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ecData as $index => $ecItem): ?>
                                    <?php if (!empty($ecItem['kegiatan'])): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= esc($ecItem['kegiatan'] ?? '-') ?></td>
                                            <td><?= esc($ecItem['bukti'] ?? '-') ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (isset($data['ws'])): ?>
                    <?php $wsData = json_decode($data['ws'], true); ?>
                    <?php if (!empty($wsData)): ?>
                        <div class="section-subtitle">
                            <i class="fas fa-recycle"></i> WS (Waste)
                        </div>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="45%">Kegiatan/Inisiatif</th>
                                    <th width="50%">Data/Bukti</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($wsData as $index => $wsItem): ?>
                                    <?php if (!empty($wsItem['kegiatan'])): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= esc($wsItem['kegiatan'] ?? '-') ?></td>
                                            <td><?= esc($wsItem['bukti'] ?? '-') ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="action-buttons">
                    <?php if (isset($item['id']) && !empty($item['id'])): ?>
                        <a href="<?= base_url('laporan/edit-kaprodi/' . $item['id']) ?>" class="btn-edit">
                            <i class="fas fa-edit"></i> Edit Laporan
                        </a>
                        <a href="<?= base_url('laporan/export-kaprodi-pdf/' . $item['id']) ?>" class="btn-pdf">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                        <form method="POST" action="<?= base_url('laporan/delete-kaprodi/' . $item['id']) ?>" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.');">
                            <button type="submit" class="btn-delete">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    <?php else: ?>
                        <p class="text-danger">Error: ID laporan tidak ditemukan</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>

        <?php else: ?>
            <div class="no-data">
                <i class="fas fa-inbox" style="font-size: 64px; color: #ccc; margin-bottom: 20px;"></i>
                <h4>Belum Ada Laporan</h4>
                <p>Anda belum menyimpan laporan. Silakan buat laporan baru.</p>
                <a href="<?= base_url('laporan/kaprodi') ?>" class="btn btn-success btn-lg mt-3">
                    <i class="fas fa-plus"></i> Buat Laporan Baru
                </a>
            </div>
        <?php endif; ?>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDeleteKaprodi(id) {
            if (confirm('Apakah Anda yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.')) {
                // Send delete request
                fetch('<?= base_url('laporan/delete-kaprodi/') ?>' + id, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Laporan berhasil dihapus');
                        location.reload();
                    } else {
                        alert('Gagal menghapus laporan: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus laporan');
                });
            }
        }
    </script>
<?= $this->endSection() ?>
