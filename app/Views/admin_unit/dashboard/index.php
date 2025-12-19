<?= $this->extend('layouts/user_sidebar_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <!-- Welcome Card -->
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%); color: white;">
                    <h3 class="card-title">
                        <i class="fas fa-home mr-2"></i>
                        Selamat Datang di Dashboard Admin Unit
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Halo, <?= $user_name ?>!</h4>
                            <p class="lead">Selamat datang di sistem dashboard UIGM (UI Green Metric) khusus Admin Unit <strong><?= $user_unit ?></strong>. Melalui dashboard ini, Anda dapat menginput dan mengelola data untuk berbagai kriteria keberlanjutan kampus di unit Anda.</p>

                            <div class="alert alert-info">
                                <h5><i class="fas fa-info-circle"></i> Informasi Penting untuk Admin Unit</h5>
                                <ul class="mb-0">
                                    <li>Saat ini hanya fitur <strong>Pengelolaan Limbah</strong> yang tersedia</li>
                                    <li>5 kategori lainnya akan segera hadir</li>
                                    <li>Data yang Anda input akan diverifikasi oleh admin pusat</li>
                                    <li>Pastikan data yang diinput akurat dan sesuai dengan kondisi unit <strong><?= $user_unit ?></strong></li>
                                    <li>Anda bertanggung jawab atas data dari unit Anda</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <img src="<?= base_url('assets/dist/img/uigm-illustration.png') ?>" alt="UIGM" class="img-fluid" style="max-height: 200px;">
                                <div class="mt-3">
                                    <div class="badge badge-primary badge-lg">
                                        <i class="fas fa-building mr-1"></i>
                                        Unit: <?= $user_unit ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Kriteria UIGM Cards -->
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-recycle fa-3x text-success"></i>
                    </div>
                    <h5 class="card-title">Pengelolaan Limbah</h5>
                    <p class="card-text">Input data sampah anorganik, organik, limbah air, dan limbah berbahaya (B3) untuk unit <?= $user_unit ?></p>
                    <a href="<?= base_url('admin-unit-dashboard/waste-management') ?>" class="btn btn-success">
                        <i class="fas fa-plus"></i> Input Data
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-bolt fa-3x text-muted"></i>
                    </div>
                    <h5 class="card-title text-muted">Energi & Perubahan Iklim</h5>
                    <p class="card-text text-muted">Fitur akan segera tersedia untuk unit Anda</p>
                    <button class="btn btn-secondary" disabled>
                        <i class="fas fa-clock"></i> Segera Hadir
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-car fa-3x text-muted"></i>
                    </div>
                    <h5 class="card-title text-muted">Transportasi</h5>
                    <p class="card-text text-muted">Fitur akan segera tersedia untuk unit Anda</p>
                    <button class="btn btn-secondary" disabled>
                        <i class="fas fa-clock"></i> Segera Hadir
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-tint fa-3x text-muted"></i>
                    </div>
                    <h5 class="card-title text-muted">Pengelolaan Air</h5>
                    <p class="card-text text-muted">Fitur akan segera tersedia untuk unit Anda</p>
                    <button class="btn btn-secondary" disabled>
                        <i class="fas fa-clock"></i> Segera Hadir
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-building fa-3x text-muted"></i>
                    </div>
                    <h5 class="card-title text-muted">Infrastruktur</h5>
                    <p class="card-text text-muted">Fitur akan segera tersedia untuk unit Anda</p>
                    <button class="btn btn-secondary" disabled>
                        <i class="fas fa-clock"></i> Segera Hadir
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-graduation-cap fa-3x text-muted"></i>
                    </div>
                    <h5 class="card-title text-muted">Pendidikan</h5>
                    <p class="card-text text-muted">Fitur akan segera tersedia untuk unit Anda</p>
                    <button class="btn btn-secondary" disabled>
                        <i class="fas fa-clock"></i> Segera Hadir
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats untuk Admin Unit -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar mr-2"></i>
                        Statistik Unit <?= $user_unit ?>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-success">
                                    <i class="fas fa-recycle"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Data Terkirim</span>
                                    <span class="info-box-number"><?= $statistics['total_input'] ?? 0 ?></span>
                                    <span class="progress-description">
                                        Total dari <?= $user_unit ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning">
                                    <i class="fas fa-clock"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Menunggu Verifikasi</span>
                                    <span class="info-box-number"><?= $statistics['pending'] ?? 0 ?></span>
                                    <span class="progress-description">
                                        Data pending
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary">
                                    <i class="fas fa-check"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Terverifikasi</span>
                                    <span class="info-box-number"><?= $statistics['approved'] ?? 0 ?></span>
                                    <span class="progress-description">
                                        Data approved
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger">
                                    <i class="fas fa-times"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Ditolak</span>
                                    <span class="info-box-number"><?= $statistics['rejected'] ?? 0 ?></span>
                                    <span class="progress-description">
                                        Data rejected
                                    </span>
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