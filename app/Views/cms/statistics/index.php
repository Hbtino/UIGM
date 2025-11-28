<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4">Statistik Dashboard</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i>
        <strong>Informasi:</strong> Statistik ini digunakan untuk menampilkan nilai-nilai statis di dashboard seperti target skor, jumlah mahasiswa, dll.
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Statistik Dashboard</h6>
            <a href="<?= base_url('dashboard-statistics/create') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Statistik
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Label</th>
                            <th width="15%">Value</th>
                            <th width="12%">Type</th>
                            <th width="15%">Category</th>
                            <th width="10%">Status</th>
                            <th width="18%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($statistics)): ?>
                            <?php foreach ($statistics as $index => $stat): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td>
                                        <strong><?= esc($stat['label']) ?></strong>
                                        <?php if (!empty($stat['description'])): ?>
                                            <br><small class="text-muted"><?= esc($stat['description']) ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-primary" style="font-size: 14px;">
                                            <?= esc($stat['value']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                        $typeColors = [
                                            'static' => 'secondary',
                                            'calculated' => 'info',
                                            'target' => 'success'
                                        ];
                                        $color = $typeColors[$stat['type']] ?? 'secondary';
                                        ?>
                                        <span class="badge badge-<?= $color ?>">
                                            <?= esc($stat['type']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light">
                                            <?= esc($stat['category'] ?? '-') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($stat['is_active']): ?>
                                            <span class="badge badge-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary">Nonaktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('dashboard-statistics/edit/' . $stat['id']) ?>"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="<?= base_url('dashboard-statistics/delete/' . $stat['id']) ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus statistik ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Statistik
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= count($statistics) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-bar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Statistik Aktif
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= count(array_filter($statistics, function ($s) {
                                    return $s['is_active'];
                                })) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Kategori
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= count(array_unique(array_column($statistics, 'category'))) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>