<?= $this->extend('layouts/user_sidebar_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <!-- Welcome Card -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%); color: white;">
                    <h3 class="card-title">
                        <i class="fas fa-home mr-2"></i>
                        Selamat Datang di Dashboard UIGM Green Campus
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Halo, <?= $user_name ?>! 👋</h4>
                            <p class="text-muted">
                                Selamat datang di sistem input data Green Campus UIGM.
                                Gunakan menu di sebelah kiri untuk mengakses berbagai kategori input data lingkungan.
                            </p>

                            <div class="alert alert-info">
                                <h5><i class="fas fa-info-circle"></i> Informasi</h5>
                                <p class="mb-0">
                                    Saat ini hanya <strong>Pengelolaan Limbah</strong> yang tersedia untuk input data.
                                    Kategori lainnya akan segera hadir.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <i class="fas fa-leaf" style="font-size: 80px; color: #149823ff; opacity: 0.3;"></i>
                                <h5 class="mt-3 text-muted">Green Campus Initiative</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= count($userWasteData) ?></h3>
                    <p>Data Input Limbah</p>
                </div>
                <div class="icon">
                    <i class="fas fa-recycle"></i>
                </div>
                <a href="<?= base_url('user/waste-management') ?>" class="small-box-footer">
                    Input Data <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>5</h3>
                    <p>Kategori Limbah</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list"></i>
                </div>
                <a href="<?= base_url('user/waste-management') ?>" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>6</h3>
                    <p>Total Kategori UIGM</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Coming Soon <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?= date('Y') ?></h3>
                    <p>Tahun Aktif</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Data Tahun Ini <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Data -->
    <?php if (!empty($userWasteData)): ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-history mr-2"></i>
                            Data Input Terbaru
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tahun</th>
                                        <th>Jenis Sampah</th>
                                        <th>Total Keseluruhan</th>
                                        <th>Status</th>
                                        <th>Tanggal Input</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($userWasteData as $data): ?>
                                        <tr>
                                            <td><?= $data['tahun'] ?></td>
                                            <td>
                                                <span class="badge badge-info">
                                                    <?= ucwords(str_replace('_', ' ', $data['jenis_sampah'])) ?>
                                                </span>
                                            </td>
                                            <td><?= number_format($data['total_sampah_keseluruhan'], 2) ?> kg</td>
                                            <td>
                                                <?php if ($data['status_verifikasi'] == 'pending'): ?>
                                                    <span class="badge badge-warning">Pending</span>
                                                <?php elseif ($data['status_verifikasi'] == 'approved'): ?>
                                                    <span class="badge badge-success">Disetujui</span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger">Ditolak</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= date('d/m/Y H:i', strtotime($data['created_at'])) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Categories Overview -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-th-large mr-2"></i>
                        Kategori UIGM Green Campus
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Active Category -->
                        <div class="col-md-4 mb-3">
                            <div class="card border-success">
                                <div class="card-body text-center">
                                    <i class="fas fa-recycle fa-3x text-success mb-3"></i>
                                    <h5>Pengelolaan Limbah</h5>
                                    <p class="text-muted">Input data sampah dan limbah</p>
                                    <a href="<?= base_url('user/waste-management') ?>" class="btn btn-success">
                                        <i class="fas fa-plus"></i> Input Data
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Coming Soon Categories -->
                        <div class="col-md-4 mb-3">
                            <div class="card border-secondary">
                                <div class="card-body text-center">
                                    <i class="fas fa-bolt fa-3x text-secondary mb-3"></i>
                                    <h5>Energi & Perubahan Iklim</h5>
                                    <p class="text-muted">Segera hadir</p>
                                    <button class="btn btn-secondary" disabled>
                                        <i class="fas fa-clock"></i> Coming Soon
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card border-secondary">
                                <div class="card-body text-center">
                                    <i class="fas fa-tint fa-3x text-secondary mb-3"></i>
                                    <h5>Pengelolaan Air</h5>
                                    <p class="text-muted">Segera hadir</p>
                                    <button class="btn btn-secondary" disabled>
                                        <i class="fas fa-clock"></i> Coming Soon
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card border-secondary">
                                <div class="card-body text-center">
                                    <i class="fas fa-car fa-3x text-secondary mb-3"></i>
                                    <h5>Transportasi</h5>
                                    <p class="text-muted">Segera hadir</p>
                                    <button class="btn btn-secondary" disabled>
                                        <i class="fas fa-clock"></i> Coming Soon
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card border-secondary">
                                <div class="card-body text-center">
                                    <i class="fas fa-building fa-3x text-secondary mb-3"></i>
                                    <h5>Infrastruktur</h5>
                                    <p class="text-muted">Segera hadir</p>
                                    <button class="btn btn-secondary" disabled>
                                        <i class="fas fa-clock"></i> Coming Soon
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card border-secondary">
                                <div class="card-body text-center">
                                    <i class="fas fa-graduation-cap fa-3x text-secondary mb-3"></i>
                                    <h5>Pendidikan</h5>
                                    <p class="text-muted">Segera hadir</p>
                                    <button class="btn btn-secondary" disabled>
                                        <i class="fas fa-clock"></i> Coming Soon
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>