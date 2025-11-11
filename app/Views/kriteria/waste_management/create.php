<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(180deg, #2d7a4f 0%, #1d5a3a 100%);
            padding: 20px;
            overflow-y: auto;
        }
        .sidebar h4 {
            color: white;
            margin-bottom: 30px;
            font-weight: 700;
        }
        .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: white;
        }
        .main-content {
            margin-left: 280px;
            padding: 30px;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 10px 15px;
        }
        .form-control:focus, .form-select:focus {
            border-color: #2d7a4f;
            box-shadow: 0 0 0 0.2rem rgba(45, 122, 79, 0.15);
        }
        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #2d7a4f;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #2d7a4f;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4><i class="fas fa-leaf"></i> POLBAN</h4>
        <a href="<?= base_url('dashboard') ?>" class="nav-link">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <hr style="border-color: rgba(255,255,255,0.2)">
        <small style="color: rgba(255,255,255,0.5); padding-left: 15px;">KRITERIA SDGs</small>
        <a href="<?= base_url('setting-infrastructure') ?>" class="nav-link active">
            <i class="fas fa-building"></i> Setting & Infrastructure
        </a>
        <a href="<?= base_url('logout') ?>" class="nav-link" style="margin-top: 20px;">
            <i class="fas fa-sign-out-alt"></i> Keluar
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="mb-4">
            <h3><i class="fas fa-plus-circle text-success"></i> Tambah Data Setting & Infrastructure</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('setting-infrastructure') ?>">Setting & Infrastructure</a></li>
                    <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
            </nav>
        </div>

        <?php if(session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <strong><i class="fas fa-exclamation-triangle"></i> Kesalahan Input!</strong>
                <ul class="mb-0 mt-2">
                    <?php foreach(session()->getFlashdata('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('setting-infrastructure/store') ?>" method="POST">
            <?= csrf_field() ?>
            
            <div class="card mb-4">
                <div class="card-body">
                    <div class="section-title">
                        <i class="fas fa-calendar"></i> Informasi Dasar
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tahun <span class="text-danger">*</span></label>
                            <input type="number" name="tahun" class="form-control" 
                                   value="<?= old('tahun') ?>" 
                                   placeholder="Contoh: 2024" required min="2020" max="2030">
                            <small class="text-muted">Masukkan tahun capaian (4 digit)</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Capaian (%) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="capaian_persen" class="form-control" 
                                   value="<?= old('capaian_persen') ?>" 
                                   placeholder="Contoh: 75.50" required min="0" max="100">
                            <small class="text-muted">Persentase capaian keseluruhan</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="section-title">
                        <i class="fas fa-map"></i> Data Lahan & Area
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Luas Ruang Terbuka (m²) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="luas_ruang_terbuka" class="form-control" 
                                   value="<?= old('luas_ruang_terbuka') ?>" 
                                   placeholder="Contoh: 50000.00" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Luas Total Kampus (m²) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="luas_total" class="form-control" 
                                   value="<?= old('luas_total') ?>" 
                                   placeholder="Contoh: 246269.00" required>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Vegetasi Hutan (m²)</label>
                            <input type="number" step="0.01" name="vegetasi_hutan" class="form-control" 
                                   value="<?= old('vegetasi_hutan') ?>" 
                                   placeholder="Contoh: 10000.00">
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Area Tanaman (m²)</label>
                            <input type="number" step="0.01" name="area_tanaman" class="form-control" 
                                   value="<?= old('area_tanaman') ?>" 
                                   placeholder="Contoh: 20000.00">
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Area Resapan Air (m²)</label>
                            <input type="number" step="0.01" name="area_resapan" class="form-control" 
                                   value="<?= old('area_resapan') ?>" 
                                   placeholder="Contoh: 15000.00">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="section-title">
                        <i class="fas fa-money-bill"></i> Anggaran & Pemeliharaan
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Persentase Anggaran Keberlanjutan (%)</label>
                            <input type="number" step="0.01" name="persentase_anggaran" class="form-control" 
                                   value="<?= old('persentase_anggaran') ?>" 
                                   placeholder="Contoh: 15.50">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Persentase Pemeliharaan Gedung (%)</label>
                            <input type="number" step="0.01" name="persentase_pemeliharaan" class="form-control" 
                                   value="<?= old('persentase_pemeliharaan') ?>" 
                                   placeholder="Contoh: 85.00">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="section-title">
                        <i class="fas fa-hospital"></i> Fasilitas Kampus
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Fasilitas Disabilitas</label>
                            <select name="fasilitas_disabilitas" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="Ada" <?= old('fasilitas_disabilitas') == 'Ada' ? 'selected' : '' ?>>Ada</option>
                                <option value="Sebagian" <?= old('fasilitas_disabilitas') == 'Sebagian' ? 'selected' : '' ?>>Sebagian</option>
                                <option value="Tidak Ada" <?= old('fasilitas_disabilitas') == 'Tidak Ada' ? 'selected' : '' ?>>Tidak Ada</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Fasilitas Keamanan</label>
                            <select name="fasilitas_keamanan" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="Ada" <?= old('fasilitas_keamanan') == 'Ada' ? 'selected' : '' ?>>Ada</option>
                                <option value="Sebagian" <?= old('fasilitas_keamanan') == 'Sebagian' ? 'selected' : '' ?>>Sebagian</option>
                                <option value="Tidak Ada" <?= old('fasilitas_keamanan') == 'Tidak Ada' ? 'selected' : '' ?>>Tidak Ada</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Asuransi Kesehatan</label>
                            <select name="asuransi_kesehatan" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="Ada" <?= old('asuransi_kesehatan') == 'Ada' ? 'selected' : '' ?>>Ada</option>
                                <option value="Tidak Ada" <?= old('asuransi_kesehatan') == 'Tidak Ada' ? 'selected' : '' ?>>Tidak Ada</option>
                            </select>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label">Konservasi Flora & Fauna</label>
                            <textarea name="konservasi_flora_fauna" class="form-control" rows="3" 
                                      placeholder="Jelaskan program konservasi flora dan fauna yang ada..."><?= old('konservasi_flora_fauna') ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="section-title">
                        <i class="fas fa-sticky-note"></i> Keterangan
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Keterangan Tambahan</label>
                        <textarea name="keterangan" class="form-control" rows="4" 
                                  placeholder="Tambahkan catatan atau keterangan tambahan..."><?= old('keterangan') ?></textarea>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success px-4">
                    <i class="fas fa-save"></i> Simpan Data
                </button>
                <a href="<?= base_url('setting-infrastructure') ?>" class="btn btn-secondary px-4">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>