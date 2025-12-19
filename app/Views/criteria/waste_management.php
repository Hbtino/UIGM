<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%); color: white;">
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
                            <div class="alert" style="background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%); border-left: 4px solid #149823ff; color: #2e7d32;">
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
                                    <!-- Main Total Sampah Card with Dropdown -->
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <div class="info-box mb-0">
                                                <span class="info-box-icon" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%); color: white;">
                                                    <i class="fas fa-trash-alt"></i>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Total Sampah</span>
                                                    <span class="info-box-number"><?= $relatedStats['total_sampah'] ?? '4,425 kg' ?></span>
                                                    <div class="progress mb-2">
                                                        <div class="progress-bar" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%); width: <?= $relatedStats['total_progress'] ?? 65 ?>%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Target: Reduksi 40% pada 2028
                                                    </span>

                                                    <!-- Dropdown Toggle Button -->
                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-outline-success" type="button" data-bs-toggle="collapse" data-bs-target="#wasteDetails" aria-expanded="false" aria-controls="wasteDetails">
                                                            <i class="fas fa-chevron-down mr-1"></i>
                                                            Lihat Detail Kategori
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Collapsible Details -->
                                            <div class="collapse mt-3" id="wasteDetails">
                                                <div class="card card-body border-0" style="background-color: #f8f9fa;">
                                                    <h6 class="text-muted mb-3">
                                                        <i class="fas fa-list mr-2"></i>
                                                        Detail Kategori Sampah
                                                    </h6>
                                                    <div class="row">
                                                        <?php if (isset($relatedStats['categories']) && is_array($relatedStats['categories'])): ?>
                                                            <?php foreach ($relatedStats['categories'] as $category): ?>
                                                                <div class="col-md-6 mb-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0">
                                                                            <div class="bg-<?= $category['color'] ?> rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                                                <i class="<?= $category['icon'] ?> text-white"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-3">
                                                                            <h6 class="mb-1"><?= $category['label'] ?></h6>
                                                                            <p class="mb-0 text-muted"><?= $category['value'] ?></p>
                                                                            <div class="progress" style="height: 4px;">
                                                                                <div class="progress-bar bg-<?= $category['color'] ?>" style="width: <?= $category['progress'] ?>%"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <!-- Fallback: Sampah Anorganik Bersih -->
                                                            <div class="col-md-6 mb-3">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-shrink-0">
                                                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                                            <i class="fas fa-recycle text-white"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <h6 class="mb-1">Sampah Anorganik Bersih</h6>
                                                                        <p class="mb-0 text-muted">1,200 kg</p>
                                                                        <div class="progress" style="height: 4px;">
                                                                            <div class="progress-bar bg-primary" style="width: 75%"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <?php endif; ?>
                                                    </div>
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
                                        <a href="<?= base_url('waste-management/data') ?>" class="btn" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%); border: none; color: white;">
                                            <i class="fas fa-list"></i> Kelola Data Waste Management
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

    // Handle dropdown toggle button text and icon
    document.addEventListener('DOMContentLoaded', function() {
        const collapseElement = document.getElementById('wasteDetails');
        const toggleButton = document.querySelector('[data-bs-target="#wasteDetails"]');

        if (collapseElement && toggleButton) {
            collapseElement.addEventListener('show.bs.collapse', function() {
                toggleButton.innerHTML = '<i class="fas fa-chevron-up mr-1"></i> Sembunyikan Detail';
            });

            collapseElement.addEventListener('hide.bs.collapse', function() {
                toggleButton.innerHTML = '<i class="fas fa-chevron-down mr-1"></i> Lihat Detail Kategori';
            });
        }
    });
</script>

<?= $this->endSection() ?>