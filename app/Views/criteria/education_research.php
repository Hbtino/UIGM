<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%); color: white;">
                    <h3 class="card-title">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        Education & Research (ED)
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
                                <h5><i class="fas fa-info-circle"></i> Tentang Education & Research</h5>
                                <p class="mb-0">Program pendidikan dan penelitian berkelanjutan melalui kurikulum sustainability, penelitian lingkungan, publikasi ilmiah, dan kegiatan akademik yang mendukung kampus berkelanjutan.</p>
                            </div>

                            <!-- Statistik Terkait -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-chart-bar mr-2"></i>
                                        Statistik Terkait Education & Research
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="info-box">
                                                <span class="info-box-icon" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%); color: white;">
                                                    <i class="fas fa-book"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Mata Kuliah Sustainability</span>
                                                    <span class="info-box-number">45 MK</span>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%); width: 75%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Target: 60 MK pada 2028
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="info-box">
                                                <span class="info-box-icon" style="background: linear-gradient(135deg, #4CAF50 0%, #2E7D32 100%); color: white;">
                                                    <i class="fas fa-flask"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Penelitian Lingkungan</span>
                                                    <span class="info-box-number">28 Penelitian</span>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="background: linear-gradient(135deg, #4CAF50 0%, #2E7D32 100%); width: 60%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Target: 50 penelitian pada 2028
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="info-box">
                                                <span class="info-box-icon" style="background: linear-gradient(135deg, #66BB6A 0%, #43A047 100%); color: white;">
                                                    <i class="fas fa-newspaper"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Publikasi Ilmiah</span>
                                                    <span class="info-box-number">125 Paper</span>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="background: linear-gradient(135deg, #66BB6A 0%, #43A047 100%); width: 65%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Target: 200 paper pada 2028
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="info-box">
                                                <span class="info-box-icon" style="background: linear-gradient(135deg, #81C784 0%, #4CAF50 100%); color: white;">
                                                    <i class="fas fa-users"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Mahasiswa Terlibat</span>
                                                    <span class="info-box-number">2,450 Mahasiswa</span>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="background: linear-gradient(135deg, #81C784 0%, #4CAF50 100%); width: 80%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Target: 3,000 mahasiswa pada 2028
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
                                        <a href="<?= base_url('education-research/data') ?>" class="btn" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%); border: none; color: white;">
                                            <i class="fas fa-list"></i> Kelola Data Education & Research
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
                                        <li><i class="fas fa-check text-success"></i> Kurikulum sustainability</li>
                                        <li><i class="fas fa-check text-success"></i> Penelitian lingkungan</li>
                                        <li><i class="fas fa-check text-success"></i> Publikasi ilmiah</li>
                                        <li><i class="fas fa-check text-success"></i> Program community service</li>
                                        <li><i class="fas fa-check text-success"></i> Kegiatan akademik berkelanjutan</li>
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