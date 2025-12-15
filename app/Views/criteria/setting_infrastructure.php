<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #54a0ff 0%, #2f3542 100%); color: white;">
                    <h3 class="card-title">
                        <i class="fas fa-building mr-2"></i>
                        <?= $criteriaInfo['name'] ?? 'Setting & Infrastructure' ?>
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
                                <h5><i class="fas fa-info-circle"></i> Tentang Setting & Infrastructure</h5>
                                <p class="mb-0"><?= $criteriaInfo['description'] ?? 'Kelola pengaturan dan infrastruktur kampus berkelanjutan' ?></p>
                            </div>

                            <!-- Statistik Terkait -->
                            <?php if (!empty($relatedStats)): ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <i class="fas fa-chart-bar mr-2"></i>
                                            Statistik Terkait Setting & Infrastructure
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <?php foreach ($relatedStats as $stat): ?>
                                                <div class="col-md-6 mb-3">
                                                    <div class="info-box">
                                                        <span class="info-box-icon bg-info">
                                                            <i class="<?= $stat['icon'] ?? 'fas fa-chart-line' ?>"></i>
                                                        </span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text"><?= esc($stat['label']) ?></span>
                                                            <span class="info-box-number"><?= esc($stat['value']) ?></span>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-info" style="width: 70%"></div>
                                                            </div>
                                                            <span class="progress-description">
                                                                Target: 80% pada 2028
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-warning">
                                    <h6><i class="fas fa-exclamation-triangle"></i> Belum Ada Data</h6>
                                    <p class="mb-0">Belum ada statistik yang terkait dengan Setting & Infrastructure. Silakan tambahkan melalui halaman manajemen statistik.</p>
                                    <a href="<?= base_url('statistics/landing') ?>" class="btn btn-primary btn-sm mt-2">
                                        <i class="fas fa-plus"></i> Kelola Statistik
                                    </a>
                                </div>
                            <?php endif; ?>
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
                                        <a href="<?= base_url('statistics/landing') ?>" class="btn btn-primary">
                                            <i class="fas fa-chart-bar"></i> Kelola Statistik Landing
                                        </a>
                                        <a href="<?= base_url('statistics') ?>" class="btn btn-info">
                                            <i class="fas fa-chart-line"></i> Manajemen Statistik & Chart
                                        </a>
                                        <a href="<?= base_url('dashboard') ?>" class="btn btn-success">
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
                                        <li><i class="fas fa-check text-success"></i> Infrastruktur hijau</li>
                                        <li><i class="fas fa-check text-success"></i> Bangunan berkelanjutan</li>
                                        <li><i class="fas fa-check text-success"></i> Pengelolaan lahan</li>
                                        <li><i class="fas fa-check text-success"></i> Teknologi ramah lingkungan</li>
                                        <li><i class="fas fa-check text-success"></i> Sistem monitoring</li>
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