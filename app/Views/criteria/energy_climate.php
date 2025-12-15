<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white;">
                    <h3 class="card-title">
                        <i class="fas fa-bolt mr-2"></i>
                        Energy & Climate Change (EC)
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
                                <h5><i class="fas fa-info-circle"></i> Tentang Energy & Climate Change</h5>
                                <p class="mb-0">Pengelolaan energi berkelanjutan dan mitigasi perubahan iklim melalui penggunaan energi terbarukan, efisiensi energi, dan pengurangan emisi karbon di lingkungan kampus.</p>
                            </div>

                            <!-- Statistik Terkait -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-chart-bar mr-2"></i>
                                        Statistik Terkait Energy & Climate Change
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success">
                                                    <i class="fas fa-bolt"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Total Konsumsi Listrik</span>
                                                    <span class="info-box-number">2,450 kWh</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success" style="width: 65%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Target: Efisiensi 30% pada 2028
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
                                                    <span class="info-box-text">Energi Terbarukan</span>
                                                    <span class="info-box-number">35%</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" style="width: 35%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Target: 60% pada 2028
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info">
                                                    <i class="fas fa-cloud"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Emisi Karbon</span>
                                                    <span class="info-box-number">1,250 ton CO2</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info" style="width: 45%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Target: Reduksi 50% pada 2028
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-primary">
                                                    <i class="fas fa-solar-panel"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Panel Surya</span>
                                                    <span class="info-box-number">125 Unit</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-primary" style="width: 55%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Target: 250 unit pada 2028
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
                                        <a href="<?= base_url('energy-climate') ?>" class="btn btn-success">
                                            <i class="fas fa-list"></i> Kelola Data Energy & Climate
                                        </a>
                                        <a href="<?= base_url('statistics/landing') ?>" class="btn btn-primary">
                                            <i class="fas fa-chart-bar"></i> Kelola Statistik Landing
                                        </a>
                                        <a href="<?= base_url('statistics') ?>" class="btn btn-info">
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
                                        <li><i class="fas fa-check text-success"></i> Penggunaan energi terbarukan</li>
                                        <li><i class="fas fa-check text-success"></i> Efisiensi energi bangunan</li>
                                        <li><i class="fas fa-check text-success"></i> Sistem monitoring konsumsi</li>
                                        <li><i class="fas fa-check text-success"></i> Pengurangan emisi karbon</li>
                                        <li><i class="fas fa-check text-success"></i> Teknologi hemat energi</li>
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