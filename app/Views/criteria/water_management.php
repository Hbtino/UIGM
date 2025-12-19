<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%); color: white;">
                    <h3 class="card-title">
                        <i class="fas fa-tint mr-2"></i>
                        Water Management (WR)
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
                            <div class="alert" style="background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%); border-left: 4px solid #149823ff; color: #2e7d32;">
                                <h5><i class="fas fa-info-circle"></i> Tentang Water Management</h5>
                                <p class="mb-0">Pengelolaan air berkelanjutan melalui konservasi air, pengolahan air limbah, sistem daur ulang air, dan teknologi hemat air untuk mendukung kampus berkelanjutan.</p>
                            </div>

                            <!-- Statistik Terkait -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-chart-bar mr-2"></i>
                                        Statistik Terkait Water Management
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="info-box">
                                                <span class="info-box-icon" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%); color: white;">
                                                    <i class="fas fa-tint"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Konsumsi Air</span>
                                                    <span class="info-box-number">15,250 m³</span>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%); width: 60%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Target: Efisiensi 25% pada 2028
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="info-box">
                                                <span class="info-box-icon" style="background: linear-gradient(135deg, #4CAF50 0%, #2E7D32 100%); color: white;">
                                                    <i class="fas fa-recycle"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Air Daur Ulang</span>
                                                    <span class="info-box-number">40%</span>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="background: linear-gradient(135deg, #4CAF50 0%, #2E7D32 100%); width: 40%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Target: 70% pada 2028
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="info-box">
                                                <span class="info-box-icon" style="background: linear-gradient(135deg, #66BB6A 0%, #43A047 100%); color: white;">
                                                    <i class="fas fa-filter"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Sistem Filtrasi</span>
                                                    <span class="info-box-number">12 Unit</span>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="background: linear-gradient(135deg, #66BB6A 0%, #43A047 100%); width: 75%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Target: 16 unit pada 2028
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="info-box">
                                                <span class="info-box-icon" style="background: linear-gradient(135deg, #81C784 0%, #4CAF50 100%); color: white;">
                                                    <i class="fas fa-cloud-rain"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Rainwater Harvesting</span>
                                                    <span class="info-box-number">8,500 L</span>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="background: linear-gradient(135deg, #81C784 0%, #4CAF50 100%); width: 50%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Target: 15,000 L pada 2028
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
                                        <a href="<?= base_url('water-management/data') ?>" class="btn" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%); border: none; color: white;">
                                            <i class="fas fa-list"></i> Kelola Data Water Management
                                        </a>
                                        <a href="<?= base_url('statistics/landing') ?>" class="btn" style="background: linear-gradient(135deg, #4CAF50 0%, #2E7D32 100%); border: none; color: white;">
                                            <i class="fas fa-chart-bar"></i> Kelola Statistik Landing
                                        </a>
                                        <a href="<?= base_url('statistics') ?>" class="btn" style="background: linear-gradient(135deg, #66BB6A 0%, #43A047 100%); border: none; color: white;">
                                            <i class="fas fa-chart-line"></i> Manajemen Statistik & Chart
                                        </a>
                                        <a href="<?= base_url('dashboard') ?>" class="btn" style="background: linear-gradient(135deg, #81C784 0%, #4CAF50 100%); border: none; color: white;">
                                            <i class="fas fa-tachometer-alt"></i> Lihat Dashboard
                                        </a>
                                        <button class="btn" style="background: linear-gradient(135deg, #A5D6A7 0%, #66BB6A 100%); border: none; color: white;" onclick="updateLandingStats()">
                                            <i class="fas fa-sync"></i> Sync Data
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Kategori -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-info mr-2"></i>
                                        Informasi Kategori
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success"></i> Konservasi air</li>
                                        <li><i class="fas fa-check text-success"></i> Pengolahan air limbah</li>
                                        <li><i class="fas fa-check text-success"></i> Sistem daur ulang air</li>
                                        <li><i class="fas fa-check text-success"></i> Rainwater harvesting</li>
                                        <li><i class="fas fa-check text-success"></i> Teknologi hemat air</li>
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