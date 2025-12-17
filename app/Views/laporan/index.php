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
        .form-input {
            background: #f8f9fa;
            border: 1px solid #ddd;
            padding: 8px 12px;
            border-radius: 5px;
            width: 100%;
        }
        .file-upload {
            position: relative;
        }
        .file-upload input[type="file"] {
            font-size: 13px;
            padding: 6px;
        }
        .file-upload .file-name {
            font-size: 11px;
            color: #666;
            margin-top: 3px;
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
                                    <a href="<?= base_url('dashboard/laporan') ?>" class="nav-link active">
                                        <i class="fas fa-user-tie"></i>
                                        <span>Laporan Dosen</span>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if (in_array($user_role, ['admin', 'kaprodi'])): ?>
                                <li class="nav-item">
                                    <a href="<?= base_url('laporan/kaprodi') ?>" class="nav-link">
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
            <h1><i class="fas fa-file-alt"></i> Laporan UI GreenMetric</h1>
            <p>Form Pelaporan Kontribusi Dosen untuk UI GreenMetric World University Ranking</p>
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

        <!-- Section 1: Info Dosen -->
        <div class="section-title">
            1. Informasi Dosen
        </div>
        <table class="table table-bordered">
            <tr>
                <td width="30%"><strong>Nama Dosen</strong></td>
                <td>
                    <?php if ($user_role === 'admin'): ?>
                        <!-- Admin bisa mengganti nama dosen -->
                        <select class="form-input" name="dosen_id">
                            <option value="">-- Pilih Dosen --</option>
                            <?php if (isset($dosen_list) && is_array($dosen_list)): ?>
                                <?php foreach ($dosen_list as $dosen): ?>
                                    <option value="<?= esc($dosen['id']) ?>" <?= ($dosen['id'] == $user_id) ? 'selected' : '' ?>>
                                        <?= esc($dosen['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    <?php else: ?>
                        <!-- Dosen tidak bisa mengganti (readonly) -->
                        <input type="text" class="form-input" value="<?= esc($user_name) ?>" readonly style="background: #e9ecef; cursor: not-allowed;">
                        <input type="hidden" name="dosen_id" value="<?= esc($user_id) ?>">
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td><strong>Jurusan</strong></td>
                <td><input type="text" id="jurusan" class="form-input" placeholder="Masukkan jurusan" value="<?= isset($saved_data['jurusan']) ? esc($saved_data['jurusan']) : '' ?>"></td>
            </tr>
            <tr>
                <td><strong>Program Studi</strong></td>
                <td><input type="text" id="program_studi" class="form-input" placeholder="Masukkan program studi" value="<?= isset($saved_data['program_studi']) ? esc($saved_data['program_studi']) : '' ?>"></td>
            </tr>
        </table>

        <!-- Section 2: Kursus/Mata Kuliah -->
        <div class="section-title">
            2. Kursus/Mata Kuliah tentang Keberlanjutan (Sustainability Courses)
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">Kode MK</th>
                    <th width="20%">Nama Mata Kuliah</th>
                    <th width="35%">Deskripsi Relevansi dengan Isu Lingkungan/SDGs</th>
                    <th width="10%">Jumlah SKS</th>
                    <th width="20%">Bukti Dukung (Lampiran)*</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td><input type="text" class="form-input" placeholder="[Kode]"></td>
                    <td><input type="text" class="form-input" placeholder="[Nama MK]"></td>
                    <td><input type="text" class="form-input" placeholder="Contoh: Mencakup 30% materi tentang energi terbarukan"></td>
                    <td><input type="text" class="form-input" placeholder="[SKS]"></td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td><input type="text" class="form-input" placeholder="[Kode]"></td>
                    <td><input type="text" class="form-input" placeholder="[Nama MK]"></td>
                    <td><input type="text" class="form-input" placeholder="Contoh: Fokus utama pada ekologi perkotaan"></td>
                    <td><input type="text" class="form-input" placeholder="[SKS]"></td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- Section 3: Acara Ilmiah -->
        <div class="section-title">
            3. Acara Ilmiah (Seminar/Workshop/Pengabdian Masyarakat)
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Nama Acara</th>
                    <th width="15%">Tanggal Pelaksanaan</th>
                    <th width="15%">Peran (Narasumber/Peserta/Panitia)</th>
                    <th width="25%">Topik</th>
                    <th width="20%">Bukti Dukung (Lampiran)*</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td><input type="text" class="form-input" placeholder="[Nama Acara]"></td>
                    <td><input type="date" class="form-input"></td>
                    <td>
                        <select class="form-input">
                            <option>Narasumber</option>
                            <option>Peserta</option>
                            <option>Panitia</option>
                        </select>
                    </td>
                    <td><input type="text" class="form-input" placeholder="Contoh: Pengelolaan Air Bersih"></td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td><input type="text" class="form-input" placeholder="[Nama Acara]"></td>
                    <td><input type="date" class="form-input"></td>
                    <td>
                        <select class="form-input">
                            <option>Narasumber</option>
                            <option>Peserta</option>
                            <option>Panitia</option>
                        </select>
                    </td>
                    <td><input type="text" class="form-input" placeholder="Contoh: Hari Lingkungan Hidup"></td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- Section 4: Praktik Ramah Lingkungan -->
        <div class="section-title">
            4. Praktik Ramah Lingkungan di Area Kerja/Lab
        </div>
        <p><strong>Kategori WS: Waste (Limbah) & EC: Energy & Climate Change (Energi & Perubahan Iklim)</strong></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Inisiatif/Program</th>
                    <th width="40%">Deskripsi Pelaksanaan</th>
                    <th width="10%">Kategori (WS/EC)</th>
                    <th width="20%">Bukti Dukung (Lampiran)*</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td><input type="text" class="form-input" placeholder="Contoh: Gerakan Paperless"></td>
                    <td><input type="text" class="form-input" placeholder="Mengurangi penggunaan kertas di departemen"></td>
                    <td>
                        <select class="form-input">
                            <option>WS</option>
                            <option>EC</option>
                        </select>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td><input type="text" class="form-input" placeholder="Contoh: Manajemen Limbah B3 Lab"></td>
                    <td><input type="text" class="form-input" placeholder="Implementasi SOP pemilahan limbah kimia"></td>
                    <td>
                        <select class="form-input">
                            <option>WS</option>
                            <option>EC</option>
                        </select>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td><input type="text" class="form-input" placeholder="Contoh: Efisiensi Energi Lab"></td>
                    <td><input type="text" class="form-input" placeholder="Penggunaan peralatan lab berlabel hemat energi"></td>
                    <td>
                        <select class="form-input">
                            <option>WS</option>
                            <option>EC</option>
                        </select>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- Section 5: Kontribusi Kebijakan -->
        <div class="section-title">
            5. Kontribusi Kebijakan atau Infrastruktur (Opsional)
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Bentuk Kontribusi</th>
                    <th width="40%">Deskripsi Detail</th>
                    <th width="10%">Kategori (WR/TR/SI)</th>
                    <th width="20%">Bukti Dukung (Lampiran)*</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td><input type="text" class="form-input" placeholder="Contoh: Penggunaan Transportasi Publik"></td>
                    <td><input type="text" class="form-input" placeholder="Komitmen pribadi penggunaan transportasi publik ke kampus"></td>
                    <td>
                        <select class="form-input">
                            <option>TR</option>
                            <option>WR</option>
                            <option>SI</option>
                        </select>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td><input type="text" class="form-input" placeholder="Contoh: Penghematan Air"></td>
                    <td><input type="text" class="form-input" placeholder="Pemasangan poster edukasi penghematan air di toilet fakultas"></td>
                    <td>
                        <select class="form-input">
                            <option>TR</option>
                            <option>WR</option>
                            <option>SI</option>
                        </select>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- Note Box -->
        <div class="note-box">
            <strong>Keterangan:</strong>
            <p>*Bukti Dukung sangat krusial. UI GreenMetric membutuhkan bukti fisik (foto <em>geotagged</em>, dokumen PDF yang ditandatangani, tautan web resmi) untuk memvalidasi setiap klaim data.</p>
        </div>

        <!-- Action Buttons -->
        <div class="text-center mt-4">
            <a href="<?= base_url('laporan/riwayat-dosen') ?>" class="btn btn-info btn-lg" style="padding: 12px 40px;">
                <i class="fas fa-history"></i> Lihat Riwayat
            </a>
            <button id="btnSave" class="btn btn-success btn-lg" style="padding: 12px 40px;">
                <i class="fas fa-save"></i> Simpan Laporan
            </button>
            <a href="<?= base_url('laporan/export-dosen-pdf') ?>" class="btn btn-primary btn-lg ms-2" style="padding: 12px 40px;">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Load saved data when page loads
        window.addEventListener('DOMContentLoaded', function() {
            <?php if (isset($saved_data) && $saved_data): ?>
                const savedData = <?= json_encode($saved_data) ?>;
                
                // Load mata kuliah data
                if (savedData.mata_kuliah) {
                    const mataKuliahData = JSON.parse(savedData.mata_kuliah);
                    const mkRows = document.querySelectorAll('table tbody tr');
                    let mkIndex = 0;
                    
                    mkRows.forEach((row, index) => {
                        if (index < 2 && row.closest('table').querySelector('thead th:nth-child(2)')?.textContent.includes('Kode MK')) {
                            const inputs = row.querySelectorAll('input[type="text"]');
                            if (mataKuliahData[mkIndex] && inputs.length >= 4) {
                                inputs[0].value = mataKuliahData[mkIndex].kode || '';
                                inputs[1].value = mataKuliahData[mkIndex].nama || '';
                                inputs[2].value = mataKuliahData[mkIndex].deskripsi || '';
                                inputs[3].value = mataKuliahData[mkIndex].sks || '';
                            }
                            mkIndex++;
                        }
                    });
                }
                
                // Load acara data
                if (savedData.acara) {
                    const acaraData = JSON.parse(savedData.acara);
                    const acaraTable = document.querySelectorAll('table')[2];
                    if (acaraTable) {
                        const acaraRows = acaraTable.querySelectorAll('tbody tr');
                        acaraRows.forEach((row, index) => {
                            if (acaraData[index]) {
                                const inputs = row.querySelectorAll('input');
                                const selects = row.querySelectorAll('select');
                                if (inputs.length >= 3 && selects.length >= 1) {
                                    inputs[0].value = acaraData[index].nama || '';
                                    inputs[1].value = acaraData[index].tanggal || '';
                                    selects[0].value = acaraData[index].peran || '';
                                    inputs[2].value = acaraData[index].topik || '';
                                }
                            }
                        });
                    }
                }
                
                // Load praktik data
                if (savedData.praktik) {
                    const praktikData = JSON.parse(savedData.praktik);
                    const praktikTable = document.querySelectorAll('table')[3];
                    if (praktikTable) {
                        const praktikRows = praktikTable.querySelectorAll('tbody tr');
                        praktikRows.forEach((row, index) => {
                            if (praktikData[index]) {
                                const inputs = row.querySelectorAll('input[type="text"]');
                                const selects = row.querySelectorAll('select');
                                if (inputs.length >= 2 && selects.length >= 1) {
                                    inputs[0].value = praktikData[index].inisiatif || '';
                                    inputs[1].value = praktikData[index].deskripsi || '';
                                    selects[0].value = praktikData[index].kategori || '';
                                }
                            }
                        });
                    }
                }
                
                // Load kontribusi data
                if (savedData.kontribusi) {
                    const kontribusiData = JSON.parse(savedData.kontribusi);
                    const kontribusiTable = document.querySelectorAll('table')[4];
                    if (kontribusiTable) {
                        const kontribusiRows = kontribusiTable.querySelectorAll('tbody tr');
                        kontribusiRows.forEach((row, index) => {
                            if (kontribusiData[index]) {
                                const inputs = row.querySelectorAll('input[type="text"]');
                                const selects = row.querySelectorAll('select');
                                if (inputs.length >= 2 && selects.length >= 1) {
                                    inputs[0].value = kontribusiData[index].bentuk || '';
                                    inputs[1].value = kontribusiData[index].deskripsi || '';
                                    selects[0].value = kontribusiData[index].kategori || '';
                                }
                            }
                        });
                    }
                }
            <?php endif; ?>
        });
        
        document.getElementById('btnSave').addEventListener('click', function() {
            const formData = new FormData();
            
            // Info Dosen
            formData.append('user_id', <?= $user_id ?>);
            formData.append('user_name', '<?= esc($user_name) ?>');
            
            // Check if admin selected different dosen
            const dosenSelect = document.querySelector('select[name="dosen_id"]');
            if (dosenSelect && dosenSelect.value) {
                formData.append('selected_dosen_id', dosenSelect.value);
                // Get selected dosen name
                const selectedOption = dosenSelect.options[dosenSelect.selectedIndex];
                formData.append('user_name', selectedOption.text);
            }
            
            formData.append('jurusan', document.getElementById('jurusan').value);
            formData.append('program_studi', document.getElementById('program_studi').value);
            
            // Mata Kuliah - Get from section 2
            const mataKuliah = [];
            const mkTable = document.querySelectorAll('table')[1]; // Second table
            if (mkTable) {
                mkTable.querySelectorAll('tbody tr').forEach(row => {
                    const inputs = row.querySelectorAll('input[type="text"]');
                    if (inputs.length >= 4) {
                        mataKuliah.push({
                            kode: inputs[0].value,
                            nama: inputs[1].value,
                            deskripsi: inputs[2].value,
                            sks: inputs[3].value
                        });
                    }
                });
            }
            formData.append('mata_kuliah', JSON.stringify(mataKuliah));
            
            // Acara Ilmiah - Get from section 3
            const acara = [];
            const acaraTable = document.querySelectorAll('table')[2]; // Third table
            if (acaraTable) {
                acaraTable.querySelectorAll('tbody tr').forEach(row => {
                    const inputs = row.querySelectorAll('input');
                    const selects = row.querySelectorAll('select');
                    if (inputs.length >= 3 && selects.length >= 1) {
                        acara.push({
                            nama: inputs[0].value,
                            tanggal: inputs[1].value,
                            peran: selects[0].value,
                            topik: inputs[2].value
                        });
                    }
                });
            }
            formData.append('acara', JSON.stringify(acara));
            
            // Praktik Ramah Lingkungan - Get from section 4
            const praktik = [];
            const praktikTable = document.querySelectorAll('table')[3]; // Fourth table
            if (praktikTable) {
                praktikTable.querySelectorAll('tbody tr').forEach(row => {
                    const inputs = row.querySelectorAll('input[type="text"]');
                    const selects = row.querySelectorAll('select');
                    if (inputs.length >= 2 && selects.length >= 1) {
                        praktik.push({
                            inisiatif: inputs[0].value,
                            deskripsi: inputs[1].value,
                            kategori: selects[0].value
                        });
                    }
                });
            }
            formData.append('praktik', JSON.stringify(praktik));
            
            // Kontribusi Kebijakan - Get from section 5
            const kontribusi = [];
            const kontribusiTable = document.querySelectorAll('table')[4]; // Fifth table
            if (kontribusiTable) {
                kontribusiTable.querySelectorAll('tbody tr').forEach(row => {
                    const inputs = row.querySelectorAll('input[type="text"]');
                    const selects = row.querySelectorAll('select');
                    if (inputs.length >= 2 && selects.length >= 1) {
                        kontribusi.push({
                            bentuk: inputs[0].value,
                            deskripsi: inputs[1].value,
                            kategori: selects[0].value
                        });
                    }
                });
            }
            formData.append('kontribusi', JSON.stringify(kontribusi));
            
            // Send data
            fetch('<?= base_url('laporan/save-dosen') ?>', {
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
</body>
</html>
