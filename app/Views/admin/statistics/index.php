<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar mr-2"></i>
                        Manajemen Statistik & Chart
                    </h3>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success" onclick="bulkSync()">
                            <i class="fas fa-sync"></i> Sync Semua Data
                        </button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addChartModal">
                            <i class="fas fa-plus"></i> Tambah Chart
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Navigation Tabs -->
                    <ul class="nav nav-tabs" id="statisticsTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="landing-tab" data-toggle="tab" href="#landing" role="tab">
                                <i class="fas fa-home"></i> Landing Page
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="charts-tab" data-toggle="tab" href="#charts" role="tab">
                                <i class="fas fa-chart-line"></i> Charts & Indikator
                            </a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content mt-3" id="statisticsTabContent">
                        <!-- Landing Page Statistics -->
                        <div class="tab-pane fade show active" id="landing" role="tabpanel">
                            <h5>Statistik Landing Page</h5>
                            <p class="text-muted">Kelola statistik yang ditampilkan di halaman utama website</p>

                            <?php if (!empty($landingStats)): ?>
                                <?php foreach ($landingStats as $section => $stats): ?>
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h6 class="mb-0">
                                                <i class="fas fa-folder"></i>
                                                <?= ucwords(str_replace('_', ' ', $section)) ?>
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <?php foreach ($stats as $stat): ?>
                                                    <div class="col-md-6 col-lg-4 mb-3">
                                                        <div class="form-group">
                                                            <label for="landing_<?= $stat['id'] ?>">
                                                                <?= $stat['label'] ?>
                                                                <?php if ($stat['icon']): ?>
                                                                    <i class="<?= $stat['icon'] ?> ml-1"></i>
                                                                <?php endif; ?>
                                                            </label>
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    class="form-control"
                                                                    id="landing_<?= $stat['id'] ?>"
                                                                    value="<?= htmlspecialchars($stat['value']) ?>"
                                                                    data-section="<?= $stat['section'] ?>"
                                                                    data-key="<?= $stat['key_name'] ?>"
                                                                    onchange="updateLandingStat(this)">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-edit"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    Belum ada data statistik landing page. Silakan import database terlebih dahulu.
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Dashboard Statistics -->
                        <div class="tab-pane fade" id="dashboard" role="tabpanel">
                            <h5>Statistik Dashboard</h5>
                            <p class="text-muted">Kelola statistik yang ditampilkan di dashboard admin</p>

                            <?php if (!empty($dashboardStats)): ?>
                                <?php foreach ($dashboardStats as $category => $stats): ?>
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h6 class="mb-0">
                                                <i class="fas fa-cog"></i>
                                                <?= ucwords(str_replace('_', ' ', $category)) ?>
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <?php foreach ($stats as $stat): ?>
                                                    <div class="col-md-6 col-lg-4 mb-3">
                                                        <div class="form-group">
                                                            <label for="dashboard_<?= $stat['id'] ?>">
                                                                <?= $stat['label'] ?>
                                                                <small class="text-muted">(<?= $stat['type'] ?>)</small>
                                                            </label>
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    class="form-control"
                                                                    id="dashboard_<?= $stat['id'] ?>"
                                                                    value="<?= htmlspecialchars($stat['value']) ?>"
                                                                    data-key="<?= $stat['key'] ?>"
                                                                    onchange="updateDashboardStat(this)">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-edit"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <?php if ($stat['description']): ?>
                                                                <small class="form-text text-muted">
                                                                    <?= $stat['description'] ?>
                                                                </small>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    Belum ada data statistik dashboard. Silakan import database terlebih dahulu.
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Charts & Indicators -->
                        <div class="tab-pane fade" id="charts" role="tabpanel">
                            <h5>Charts & Indikator</h5>
                            <p class="text-muted">Kelola chart dan indikator yang ditampilkan di dashboard dan landing page</p>

                            <?php if (!empty($charts)): ?>
                                <?php foreach ($charts as $location => $sections): ?>
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h6 class="mb-0">
                                                <i class="fas fa-chart-area"></i>
                                                <?= ucwords($location) ?> Charts
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <?php foreach ($sections as $section => $chartList): ?>
                                                <h6 class="text-primary"><?= ucwords(str_replace('_', ' ', $section)) ?></h6>
                                                <div class="row mb-3">
                                                    <?php foreach ($chartList as $chart): ?>
                                                        <div class="col-md-6 col-lg-4 mb-3">
                                                            <div class="card border">
                                                                <div class="card-body p-3">
                                                                    <h6 class="card-title">
                                                                        <?= $chart['title'] ?>
                                                                        <span class="badge badge-<?= $chart['chart_type'] === 'line' ? 'primary' : ($chart['chart_type'] === 'bar' ? 'success' : 'info') ?> ml-2">
                                                                            <?= $chart['chart_type'] ?>
                                                                        </span>
                                                                    </h6>
                                                                    <p class="card-text small text-muted">
                                                                        <?= $chart['description'] ?>
                                                                    </p>
                                                                    <div class="btn-group btn-group-sm">
                                                                        <button class="btn btn-outline-primary" onclick="editChart(<?= $chart['id'] ?>)">
                                                                            <i class="fas fa-edit"></i>
                                                                        </button>
                                                                        <button class="btn btn-outline-danger" onclick="deleteChart(<?= $chart['id'] ?>)">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                        <?php if ($chart['sync_with_statistics']): ?>
                                                                            <button class="btn btn-outline-success" onclick="syncChart(<?= $chart['id'] ?>)">
                                                                                <i class="fas fa-sync"></i>
                                                                            </button>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    Belum ada chart. Silakan tambah chart baru atau import database.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal untuk Add Chart -->
<div class="modal fade" id="addChartModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Chart Baru</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="addChartForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Judul Chart</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipe Chart</label>
                                <select class="form-control" name="chart_type" required>
                                    <option value="line">Line Chart</option>
                                    <option value="bar">Bar Chart</option>
                                    <option value="pie">Pie Chart</option>
                                    <option value="donut">Donut Chart</option>
                                    <option value="area">Area Chart</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="description" rows="2"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lokasi Tampil</label>
                                <select class="form-control" name="display_location" required>
                                    <option value="dashboard">Dashboard Only</option>
                                    <option value="landing">Landing Page Only</option>
                                    <option value="both">Dashboard & Landing</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Section</label>
                                <input type="text" class="form-control" name="section" placeholder="main_charts, statistics_section, etc">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data Source</label>
                                <select class="form-control" name="data_source" required>
                                    <option value="manual">Manual Input</option>
                                    <option value="database_table">Database Table</option>
                                    <option value="api">API Endpoint</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Order Position</label>
                                <input type="number" class="form-control" name="order_position" value="1" min="1">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="sync_with_statistics" name="sync_with_statistics" value="1">
                            <label class="custom-control-label" for="sync_with_statistics">
                                Sinkronisasi dengan Database Statistics
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Chart Data (JSON)</label>
                        <textarea class="form-control" name="chart_data" rows="4" placeholder='{"labels":["A","B"],"datasets":[{"data":[1,2]}]}'></textarea>
                        <small class="form-text text-muted">Format JSON untuk data chart</small>
                    </div>

                    <div class="form-group">
                        <label>Chart Config (JSON)</label>
                        <textarea class="form-control" name="chart_config" rows="3" placeholder='{"responsive":true,"plugins":{"legend":{"position":"top"}}}'></textarea>
                        <small class="form-text text-muted">Konfigurasi Chart.js (opsional)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Chart</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Update Landing Statistic
    function updateLandingStat(element) {
        const section = element.dataset.section;
        const key = element.dataset.key;
        const value = element.value;

        $.ajax({
            url: '<?= base_url('statistics/update-landing-stat') ?>',
            method: 'POST',
            data: {
                section: section,
                key: key,
                value: value
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    element.style.borderColor = '#28a745';
                    setTimeout(() => {
                        element.style.borderColor = '';
                    }, 2000);
                } else {
                    toastr.error(response.message);
                    element.style.borderColor = '#dc3545';
                }
            },
            error: function() {
                toastr.error('Gagal mengupdate statistik');
                element.style.borderColor = '#dc3545';
            }
        });
    }

    // Update Dashboard Statistic
    function updateDashboardStat(element) {
        const key = element.dataset.key;
        const value = element.value;

        $.ajax({
            url: '<?= base_url('statistics/update-dashboard-stat') ?>',
            method: 'POST',
            data: {
                key: key,
                value: value
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    element.style.borderColor = '#28a745';
                    setTimeout(() => {
                        element.style.borderColor = '';
                    }, 2000);
                } else {
                    toastr.error(response.message);
                    element.style.borderColor = '#dc3545';
                }
            },
            error: function() {
                toastr.error('Gagal mengupdate statistik dashboard');
                element.style.borderColor = '#dc3545';
            }
        });
    }

    // Add Chart
    $('#addChartForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '<?= base_url('statistics/create-chart') ?>',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('#addChartModal').modal('hide');
                    location.reload();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function() {
                toastr.error('Gagal membuat chart');
            }
        });
    });

    // Delete Chart
    function deleteChart(id) {
        if (confirm('Yakin ingin menghapus chart ini?')) {
            $.ajax({
                url: '<?= base_url('statistics/delete-chart/') ?>' + id,
                method: 'DELETE',
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        location.reload();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error('Gagal menghapus chart');
                }
            });
        }
    }

    // Bulk Sync
    function bulkSync() {
        const btn = event.target;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Syncing...';
        btn.disabled = true;

        $.ajax({
            url: '<?= base_url('statistics/bulk-sync') ?>',
            method: 'POST',
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    location.reload();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function() {
                toastr.error('Gagal melakukan sinkronisasi');
            },
            complete: function() {
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        });
    }

    // Edit Chart (placeholder - bisa dikembangkan lebih lanjut)
    function editChart(id) {
        // TODO: Implement edit chart functionality
        toastr.info('Fitur edit chart akan segera tersedia');
    }

    // Sync Chart
    function syncChart(id) {
        $.ajax({
            url: '<?= base_url('statistics/sync-statistics-to-charts') ?>',
            method: 'POST',
            success: function(response) {
                if (response.success) {
                    toastr.success('Chart berhasil disinkronkan');
                } else {
                    toastr.error(response.message);
                }
            },
            error: function() {
                toastr.error('Gagal sinkronisasi chart');
            }
        });
    }
</script>

<?= $this->endSection() ?>