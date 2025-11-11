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
            z-index: 1000;
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
        .table thead {
            background: #2d7a4f;
            color: white;
        }
        .badge-capaian {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
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
        <a href="<?= base_url('energy-climate') ?>" class="nav-link">
            <i class="fas fa-bolt"></i> Energy & Climate
        </a>
        <a href="<?= base_url('waste-management') ?>" class="nav-link">
            <i class="fas fa-recycle"></i> Waste Management
        </a>
        <a href="<?= base_url('water-management') ?>" class="nav-link">
            <i class="fas fa-tint"></i> Water Management
        </a>
        <a href="<?= base_url('transportation') ?>" class="nav-link">
            <i class="fas fa-bus"></i> Transportation
        </a>
        <a href="<?= base_url('education-research') ?>" class="nav-link">
            <i class="fas fa-graduation-cap"></i> Education & Research
        </a>
        <hr style="border-color: rgba(255,255,255,0.2)">
        <a href="<?= base_url('logout') ?>" class="nav-link">
            <i class="fas fa-sign-out-alt"></i> Keluar
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3><i class="fas fa-building text-success"></i> Data Setting & Infrastructure</h3>
                <p class="text-muted mb-0">Manajemen data capaian pengaturan dan infrastruktur kampus</p>
            </div>
            <?php if(in_array($user_role, ['admin', 'kaprodi'])): ?>
            <a href="<?= base_url('setting-infrastructure/create') ?>" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
            <?php endif; ?>
        </div>

        <!-- Alert Messages -->
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Data Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Tahun</th>
                                <th>Luas Ruang Terbuka</th>
                                <th>Luas Total</th>
                                <th>Capaian (%)</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($data_si)): ?>
                                <?php $no = 1; foreach($data_si as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><strong><?= $row['tahun'] ?></strong></td>
                                    <td><?= number_format($row['luas_ruang_terbuka'], 2) ?> m²</td>
                                    <td><?= number_format($row['luas_total'], 2) ?> m²</td>
                                    <td>
                                        <span class="badge badge-capaian <?= $row['capaian_persen'] >= 70 ? 'bg-success' : ($row['capaian_persen'] >= 50 ? 'bg-warning' : 'bg-danger') ?>">
                                            <?= $row['capaian_persen'] ?>%
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?= base_url('setting-infrastructure/edit/'.$row['id']) ?>" 
                                               class="btn btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <?php if($user_role == 'admin'): ?>
                                            <a href="<?= base_url('setting-infrastructure/delete/'.$row['id']) ?>" 
                                               class="btn btn-danger" 
                                               onclick="return confirm('Yakin ingin menghapus data tahun <?= $row['tahun'] ?>?')"
                                               title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada data. Silakan tambah data baru.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>