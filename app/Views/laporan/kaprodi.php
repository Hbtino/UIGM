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
        .header p {
            color: #666;
            font-size: 16px;
        }
        .section-title {
            background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            margin: 30px 0 20px;
            font-weight: 700;
            font-size: 18px;
        }
        .section-subtitle {
            background: #f8f9fa;
            padding: 10px 15px;
            border-left: 4px solid #149823ff;
            margin: 20px 0 15px;
            font-weight: 600;
            color: #333;
        }
        .table {
            margin-bottom: 30px;
        }
        .table thead {
            background: #149823ff;
            color: white;
        }
        .table thead th {
            padding: 15px;
            font-weight: 600;
            border: none;
            vertical-align: middle;
        }
        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
        }
        .table tbody tr:hover {
            background: #f8f9fa;
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
        .note-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .note-box strong {
            color: #856404;
        }
        .note-box p {
            margin: 5px 0 0;
            color: #856404;
        }
        .intro-box {
            background: #e7f3ff;
            border-left: 4px solid #0d6efd;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .intro-box p {
            margin: 8px 0;
            color: #084298;
            line-height: 1.6;
        }
        .form-input {
            background: #f8f9fa;
            border: 1px solid #ddd;
            padding: 8px 12px;
            border-radius: 5px;
            width: 100%;
        }
        .form-textarea {
            background: #f8f9fa;
            border: 1px solid #ddd;
            padding: 8px 12px;
            border-radius: 5px;
            width: 100%;
            min-height: 80px;
            resize: vertical;
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
            <h1><i class="fas fa-file-alt"></i> Laporan Program Studi - UI GreenMetric</h1>
            <p>Form Pelaporan Kontribusi Program Studi untuk UI GreenMetric World University Ranking</p>
            <p><strong>Periode: <?= $laporan_data['periode'] ?></strong></p>
            <?php if (isset($last_saved) && $last_saved): ?>
                <div class="alert alert-info mt-3" style="font-size: 14px;">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Laporan terakhir disimpan:</strong> 
                    <?php
                        $date = new DateTime($last_saved);
                        echo $date->format('d F Y, H:i:s');
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Section 0: Pendahuluan -->
        <div class="intro-box">
            <h5 style="color: #084298; font-weight: 700; margin-bottom: 15px;">1.0 Pendahuluan</h5>
            <p>Laporan ini merinci kontribusi Program Studi terhadap inisiatif UI GreenMetric. Ini adalah komitmen kami untuk mengintegrasikan prinsip-prinsip pembangunan berkelanjutan dalam pendidikan, penelitian, dan operasional harian, sejalan dengan visi universitas.</p>
        </div>

        <!-- Section 1: Info Program Studi -->
        <div class="section-title">
            Informasi Program Studi
        </div>
        <table class="table table-bordered">
            <tr>
                <td width="30%"><strong>Nama Program Studi</strong></td>
                <td>
                    <?php if ($user_role === 'admin'): ?>
                        <select class="form-input" name="prodi_id">
                            <option value="">-- Pilih Program Studi --</option>
                            <?php if (isset($prodi_list) && is_array($prodi_list)): ?>
                                <?php foreach ($prodi_list as $prodi): ?>
                                    <option value="<?= esc($prodi['id']) ?>" <?= ($prodi['id'] == $user_prodi_id) ? 'selected' : '' ?>>
                                        <?= esc($prodi['nama']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    <?php else: ?>
                        <input type="text" class="form-input" value="<?= esc($prodi_name) ?>" readonly style="background: #e9ecef; cursor: not-allowed;">
                        <input type="hidden" name="prodi_id" value="<?= esc($user_prodi_id) ?>">
                    <?php endif; ?>
                </td>
            </tr>
            <?php if ($user_role === 'admin'): ?>
            <tr>
                <td><strong>Pilih Kaprodi (Admin)</strong></td>
                <td>
                    <select class="form-input" name="kaprodi_id" id="kaprodi_select">
                        <option value="">-- Pilih Kaprodi --</option>
                        <?php if (isset($prodi_list) && is_array($prodi_list)): ?>
                            <?php 
                            // Get list of kaprodi users
                            $userModel = new \App\Models\UserModel();
                            $kaprodiUsers = $userModel->where('role', 'kaprodi')->findAll();
                            foreach ($kaprodiUsers as $kaprodi): 
                            ?>
                                <option value="<?= esc($kaprodi['id']) ?>" <?= (isset($user_id) && $kaprodi['id'] == $user_id) ? 'selected' : '' ?>>
                                    <?= esc($kaprodi['name']) ?> (<?= esc($kaprodi['email']) ?>)
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <small style="color: #666; display: block; margin-top: 5px;">
                        <i class="fas fa-info-circle"></i> Admin dapat membuat laporan atas nama kaprodi yang dipilih
                    </small>
                </td>
            </tr>
            <?php endif; ?>
            <tr>
                <td><strong>Nama Lengkap Kaprodi dan Gelar</strong></td>
                <td><input type="text" id="kaprodi_name" class="form-input" placeholder="Contoh: Dr. Ahmad Budiman, S.T., M.T." value="<?= isset($saved_data['kaprodi_name']) ? esc($saved_data['kaprodi_name']) : '' ?>"></td>
            </tr>
            <tr>
                <td><strong>Jurusan</strong></td>
                <td><input type="text" id="jurusan" class="form-input" placeholder="Masukkan jurusan" value="<?= isset($saved_data['jurusan']) ? esc($saved_data['jurusan']) : '' ?>"></td>
            </tr>
            <tr>
                <td><strong>Tanggal Laporan</strong></td>
                <td><input type="date" id="tanggal_laporan" class="form-input" value="<?= isset($saved_data['tanggal_laporan']) ? esc($saved_data['tanggal_laporan']) : date('Y-m-d') ?>"></td>
            </tr>
        </table>

        <!-- Section 2: Kontribusi Berdasarkan Kriteria -->
        <div class="section-title">
            2.0 Kontribusi Berdasarkan Kriteria UI GreenMetric
        </div>

        <div class="note-box">
            <strong>Panduan Pengisian:</strong>
            <p>• Kolom "Kegiatan/Inisiatif" diisi dengan deskripsi singkat tentang apa yang telah Anda lakukan.</p>
            <p>• Kolom "Data Kuantitatif/Kualitatif (Bukti)" adalah bagian terpenting. Tim penilai UI GreenMetric sangat membutuhkan bukti konkret (data, foto, dokumen) untuk memvalidasi klaim Anda. Pastikan setiap klaim didukung oleh lampiran yang jelas.</p>
        </div>

        <!-- SI: Setting and Infrastructure -->
        <div class="section-subtitle">
            <i class="fas fa-building"></i> SI (Setting and Infrastructure)
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Kegiatan/Inisiatif Program Studi</th>
                    <th width="40%">Data Kuantitatif/Kualitatif (Bukti)</th>
                    <th width="20%">Lampiran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <strong>Penggunaan ruang efisien:</strong><br>
                        <small>Memaksimalkan penggunaan ruang kelas dan laboratorium bersama.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Jadwal penggunaan ruang kelas yang terkoordinasi.&#10;- Denah tata ruang prodi."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <strong>Area hijau:</strong><br>
                        <small>Menata taman atau area hijau di sekitar gedung prodi.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Foto-foto area hijau.&#10;- Deskripsi jenis tanaman/penghijauan yang dilakukan."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>
                        <strong>Fasilitas bagi pejalan kaki/difabel:</strong><br>
                        <small>Memastikan akses yang mudah dan aman di lingkungan prodi.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Foto jalur pejalan kaki/rambu-rambu/jalur difabel."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- EC: Energy and Climate Change -->
        <div class="section-subtitle">
            <i class="fas fa-bolt"></i> EC (Energy and Climate Change)
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Kegiatan/Inisiatif Program Studi</th>
                    <th width="40%">Data Kuantitatif/Kualitatif (Bukti)</th>
                    <th width="20%">Lampiran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <strong>Kebijakan penghematan energi:</strong><br>
                        <small>Menerapkan SOP pemadaman listrik/AC saat tidak digunakan.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Salinan SOP atau pengumuman tertulis.&#10;- Foto stiker/tanda pengingat penghematan energi."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <strong>Peralatan hemat energi:</strong><br>
                        <small>Menggunakan lampu LED, komputer bersertifikasi energy star, dll.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Data inventarisasi peralatan (jumlah unit lampu LED, AC inverter, dll).&#10;- Foto peralatan (lampu LED, komputer/monitor, dll)."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>
                        <strong>Pengukuran emisi karbon:</strong><br>
                        <small>Jika ada inisiatif penghitungan emisi dari kegiatan prodi.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Hasil perhitungan emisi (jika tersedia) atau deskripsi singkat kebijakan pengurangan perjalanan dinas."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- WS: Waste -->
        <div class="section-subtitle">
            <i class="fas fa-recycle"></i> WS (Waste)
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Kegiatan/Inisiatif Program Studi</th>
                    <th width="40%">Data Kuantitatif/Kualitatif (Bukti)</th>
                    <th width="20%">Lampiran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <strong>Pemilahan sampah:</strong><br>
                        <small>Menyediakan tempat sampah terpisah (organik, anorganik, B3).</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Foto tempat sampah terpisah.&#10;- Jumlah titik tempat pemilahan sampah di area prodi."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <strong>Pengurangan penggunaan kertas & plastik:</strong><br>
                        <small>Menerapkan sistem administrasi digital, mengurangi print out.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Kebijakan administrasi digital.&#10;- Foto dispenser air minum untuk mengurangi botol plastik."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>
                        <strong>Pengelolaan limbah B3 (jika ada lab):</strong><br>
                        <small>Pengelolaan limbah bahan berbahaya dan beracun sesuai standar.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Dokumen MOU dengan pengelola limbah B3 tersertifikasi (misal: untuk limbah lab kimia)."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- WR: Water -->
        <div class="section-subtitle">
            <i class="fas fa-tint"></i> WR (Water)
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Kegiatan/Inisiatif Program Studi</th>
                    <th width="40%">Data Kuantitatif/Kualitatif (Bukti)</th>
                    <th width="20%">Lampiran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <strong>Konservasi air:</strong><br>
                        <small>Pemasangan poster edukasi, perbaikan kebocoran.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Foto poster edukasi hemat air.&#10;- Laporan perbaikan sistem perairan (misal: perbaikan keran bocor)."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <strong>Penggunaan kembali air:</strong><br>
                        <small>Jika prodi memiliki sistem daur ulang air (misal: untuk siram tanaman).</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Deskripsi sistem daur ulang air (jika ada)."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- TR: Transportation -->
        <div class="section-subtitle">
            <i class="fas fa-bus"></i> TR (Transportation)
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Kegiatan/Inisiatif Program Studi</th>
                    <th width="40%">Data Kuantitatif/Kualitatif (Bukti)</th>
                    <th width="20%">Lampiran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <strong>Sosialisasi transportasi hijau:</strong><br>
                        <small>Mendorong penggunaan transportasi umum atau sepeda.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Salinan email/pengumuman/poster sosialisasi."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <strong>Aksesibilitas:</strong><br>
                        <small>Memastikan kemudahan akses dari halte bus atau stasiun terdekat.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Deskripsi jarak prodi ke halte terdekat."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- ER: Education and Research -->
        <div class="section-subtitle">
            <i class="fas fa-graduation-cap"></i> ER (Education and Research)
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Kegiatan/Inisiatif Program Studi</th>
                    <th width="40%">Data Kuantitatif/Kualitatif (Bukti)</th>
                    <th width="20%">Lampiran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <strong>Integrasi kurikulum:</strong><br>
                        <small>Memasukkan aspek keberlanjutan dalam mata kuliah.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Daftar mata kuliah yang mencakup topik keberlanjutan (beserta credit point dan deskripsi singkat topik yang diajarkan).&#10;- Salinan silabus/RPS (Rencana Pembelajaran Semester)."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <strong>Penelitian/Publikasi:</strong><br>
                        <small>Penelitian dosen dan mahasiswa tentang isu lingkungan/keberlanjutan.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Daftar judul skripsi/tesis/penelitian dosen (minimal 5-10 judul) dalam 3 tahun terakhir yang relevan.&#10;- Daftar publikasi ilmiah (jurnal/prosiding) terkait."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>
                        <strong>Kegiatan/Seminar:</strong><br>
                        <small>Menyelenggarakan kegiatan ilmiah bertema keberlanjutan.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Foto kegiatan (seminar/webinar/lokakarya).&#10;- Pamflet atau rundown acara."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- Note Box -->
        <div class="note-box">
            <strong>Catatan Penting:</strong>
            <p>*Bukti Dukung sangat krusial. UI GreenMetric membutuhkan bukti fisik (foto geotagged, dokumen PDF yang ditandatangani, tautan web resmi) untuk memvalidasi setiap klaim data. Pastikan semua lampiran jelas dan terorganisir dengan baik.</p>
        </div>

        <!-- Action Buttons -->
        <div class="text-center mt-4">
            <a href="<?= base_url('laporan/riwayat-kaprodi') ?>" class="btn btn-info btn-lg" style="padding: 12px 40px;">
                <i class="fas fa-history"></i> Lihat Riwayat
            </a>
            <button id="btnSave" class="btn btn-success btn-lg" style="padding: 12px 40px;">
                <i class="fas fa-save"></i> Simpan Laporan
            </button>
            <a href="<?= base_url('laporan/export-kaprodi-pdf') ?>" class="btn btn-primary btn-lg ms-2" style="padding: 12px 40px;">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Load saved data when page loads
        window.addEventListener('DOMContentLoaded', function() {
            <?php if (isset($saved_data) && $saved_data): ?>
                const savedData = <?= json_encode($saved_data) ?>;
                
                // Load SI data
                if (savedData.si) {
                    const siData = JSON.parse(savedData.si);
                    let siIndex = 0;
                    document.querySelectorAll('table').forEach(table => {
                        const subtitle = table.previousElementSibling;
                        if (subtitle && subtitle.textContent.includes('SI (Setting')) {
                            table.querySelectorAll('tbody tr').forEach(row => {
                                if (siData[siIndex]) {
                                    const textareas = row.querySelectorAll('textarea');
                                    if (textareas.length >= 2) {
                                        textareas[0].value = siData[siIndex].kegiatan || '';
                                        textareas[1].value = siData[siIndex].bukti || '';
                                    }
                                    siIndex++;
                                }
                            });
                        }
                    });
                }
                
                // Load EC data
                if (savedData.ec) {
                    const ecData = JSON.parse(savedData.ec);
                    let ecIndex = 0;
                    document.querySelectorAll('table').forEach(table => {
                        const subtitle = table.previousElementSibling;
                        if (subtitle && subtitle.textContent.includes('EC (Energy')) {
                            table.querySelectorAll('tbody tr').forEach(row => {
                                if (ecData[ecIndex]) {
                                    const textareas = row.querySelectorAll('textarea');
                                    if (textareas.length >= 2) {
                                        textareas[0].value = ecData[ecIndex].kegiatan || '';
                                        textareas[1].value = ecData[ecIndex].bukti || '';
                                    }
                                    ecIndex++;
                                }
                            });
                        }
                    });
                }
                
                // Load WS data
                if (savedData.ws) {
                    const wsData = JSON.parse(savedData.ws);
                    let wsIndex = 0;
                    document.querySelectorAll('table').forEach(table => {
                        const subtitle = table.previousElementSibling;
                        if (subtitle && subtitle.textContent.includes('WS (Waste')) {
                            table.querySelectorAll('tbody tr').forEach(row => {
                                if (wsData[wsIndex]) {
                                    const textareas = row.querySelectorAll('textarea');
                                    if (textareas.length >= 2) {
                                        textareas[0].value = wsData[wsIndex].kegiatan || '';
                                        textareas[1].value = wsData[wsIndex].bukti || '';
                                    }
                                    wsIndex++;
                                }
                            });
                        }
                    });
                }
            <?php endif; ?>
        });
        
        document.getElementById('btnSave').addEventListener('click', function() {
            const formData = new FormData();
            
            // Info Prodi
            formData.append('user_id', <?= $user_id ?>);
            formData.append('user_name', '<?= esc($user_name) ?>');
            
            // Check if admin selected different kaprodi
            const kaprodiSelect = document.getElementById('kaprodi_select');
            if (kaprodiSelect && kaprodiSelect.value) {
                formData.append('selected_kaprodi_id', kaprodiSelect.value);
                // Get selected kaprodi name
                const selectedOption = kaprodiSelect.options[kaprodiSelect.selectedIndex];
                formData.append('user_name', selectedOption.text.split(' (')[0]); // Get name without email
            }
            
            formData.append('prodi_id', <?= $user_prodi_id ?>);
            // Get prodi_name from select or readonly input
            const prodiSelect = document.querySelector('select[name="prodi_id"]');
            const prodiInput = document.querySelector('input[name="prodi_id"]');
            let prodiName = '<?= esc($prodi_name) ?>';
            if (prodiSelect && prodiSelect.value) {
                const selectedProdi = prodiSelect.options[prodiSelect.selectedIndex];
                prodiName = selectedProdi.text;
            }
            formData.append('prodi_name', prodiName);
            formData.append('kaprodi_name', document.getElementById('kaprodi_name').value || '<?= esc(session()->get('user_name')) ?>');
            formData.append('jurusan', document.getElementById('jurusan').value);
            formData.append('tanggal_laporan', document.getElementById('tanggal_laporan').value);
            
            // SI Data
            const siData = [];
            document.querySelectorAll('table').forEach(table => {
                const subtitle = table.previousElementSibling;
                if (subtitle && subtitle.textContent.includes('SI (Setting')) {
                    table.querySelectorAll('tbody tr').forEach(row => {
                        const textareas = row.querySelectorAll('textarea');
                        if (textareas.length >= 2) {
                            siData.push({
                                kegiatan: textareas[0].value,
                                bukti: textareas[1].value
                            });
                        }
                    });
                }
            });
            formData.append('si', JSON.stringify(siData));
            
            // EC Data
            const ecData = [];
            document.querySelectorAll('table').forEach(table => {
                const subtitle = table.previousElementSibling;
                if (subtitle && subtitle.textContent.includes('EC (Energy')) {
                    table.querySelectorAll('tbody tr').forEach(row => {
                        const textareas = row.querySelectorAll('textarea');
                        if (textareas.length >= 2) {
                            ecData.push({
                                kegiatan: textareas[0].value,
                                bukti: textareas[1].value
                            });
                        }
                    });
                }
            });
            formData.append('ec', JSON.stringify(ecData));
            
            // WS Data
            const wsData = [];
            document.querySelectorAll('table').forEach(table => {
                const subtitle = table.previousElementSibling;
                if (subtitle && subtitle.textContent.includes('WS (Waste')) {
                    table.querySelectorAll('tbody tr').forEach(row => {
                        const textareas = row.querySelectorAll('textarea');
                        if (textareas.length >= 2) {
                            wsData.push({
                                kegiatan: textareas[0].value,
                                bukti: textareas[1].value
                            });
                        }
                    });
                }
            });
            formData.append('ws', JSON.stringify(wsData));
            
            // Send data
            fetch('<?= base_url('laporan/save-kaprodi') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Laporan berhasil disimpan!');
                    // Reload page to show updated timestamp
                    window.location.reload();
                } else {
                    alert('Gagal menyimpan laporan: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan laporan');
            });
        });
    </script>
    </div>
    </div>
</body>
</html>
