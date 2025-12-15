<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                    <h3 class="card-title">
                        <i class="fas fa-recycle mr-2"></i>
                        Waste Management (WS)
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="alert alert-info">
                                <h5><i class="fas fa-info-circle"></i> Tentang Waste Management</h5>
                                <p class="mb-0">Pengelolaan limbah berkelanjutan melalui program reduce, reuse, recycle, pengolahan limbah organik dan anorganik, serta penerapan zero waste campus.</p>
                            </div>

                            <!-- Statistik Terkait -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-chart-bar mr-2"></i>
                                        Statistik Terkait Waste Management
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-danger">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Total Limbah</span>
                                                    <span class="info-box-number">2,850 kg</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-danger" style="width: 45%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Target: Reduksi 40% pada 2028
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success">
                                                    <i class="fas fa-recycle"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Limbah Daur Ulang</span>
                                                    <span class="info-box-number">65%</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success" style="width: 65%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Target: 85% pada 2028
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-warning">
                                                    <i class="fas fa-leaf"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Kompos Organik</span>
                                                    <span class="info-box-number">1,250 kg</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" style="width: 70%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Target: 2,000 kg pada 2028
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info">
                                                    <i class="fas fa-dumpster"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Tempat Sampah Terpilah</span>
                                                    <span class="info-box-number">85 Unit</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info" style="width: 80%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Target: 120 unit pada 2028
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Quick Actions -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-tools mr-2"></i>
                                        Aksi Cepat
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="<?= base_url('waste-management') ?>" class="btn btn-danger">
                                            <i class="fas fa-list"></i> Kelola Data Waste Management
                                        </a>
                                        <a href="<?= base_url('statistics/landing') ?>" class="btn btn-primary">
                                            <i class="fas fa-chart-bar"></i> Kelola Statistik Landing
                                        </a>
                                        <a href="<?= base_url('statistics') ?>" class="btn btn-success">
                                            <i class="fas fa-chart-line"></i> Manajemen Statistik & Chart
                                        </a>
                                        <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">
                                            <i class="fas fa-tachometer-alt"></i> Lihat Dashboard
                                        </a>
                                        <button class="btn btn-warning" onclick="updateLandingStats()">
                                            <i class="fas fa-sync"></i> Sync Data
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Kriteria -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-info mr-2"></i>
                                        Informasi Kriteria
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success"></i> Program 3R (Reduce, Reuse, Recycle)</li>
                                        <li><i class="fas fa-check text-success"></i> Pengolahan limbah organik</li>
                                        <li><i class="fas fa-check text-success"></i> Pemilahan sampah</li>
                                        <li><i class="fas fa-check text-success"></i> Zero waste campus</li>
                                        <li><i class="fas fa-check text-success"></i> Bank sampah</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateLandingStats() {
        // Show loading
        Swal.fire({
            title: 'Memperbarui Data...',
            text: 'Sedang melakukan sinkronisasi data statistik',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });

        // Simulate API call
        fetch('<?= base_url("statistics/sync-all") ?>', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat memperbarui data'
                });
            });
    }
</script>

<?= $this->endSection() ?>