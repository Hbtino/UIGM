<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

<!-- Super Admin / Admin Pusat Dashboard -->
<div class="admin-pusat-header">
    <div class="admin-status">
        <div class="admin-info">
            <h2 class="admin-title">
                <i class="fas fa-crown"></i>
                Dashboard Admin Pusat
            </h2>
            <p class="admin-subtitle">Kontrol & Monitoring UIGM 2025</p>
        </div>
        <div class="year-controls">
            <div class="year-status">
                <span class="status-label">Status Tahun UIGM:</span>
                <div class="status-badge <?= $year_status ?? 'open' ?>">
                    <i class="fas <?= $year_status == 'open' ? 'fa-unlock' : ($year_status == 'review' ? 'fa-eye' : 'fa-lock') ?>"></i>
                    <span><?= ucfirst($year_status ?? 'Open') ?></span>
                </div>
            </div>
            <div class="year-actions">
                <button class="btn btn-warning btn-sm" onclick="changeYearStatus('review')">
                    <i class="fas fa-eye"></i> Set Review
                </button>
                <button class="btn btn-danger btn-sm" onclick="changeYearStatus('locked')">
                    <i class="fas fa-lock"></i> Lock Tahun
                </button>
                <button class="btn btn-success btn-sm" onclick="finalizeYear()">
                    <i class="fas fa-check-circle"></i> Finalisasi
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Progress Overview Cards -->
<div class="progress-overview">
    <div class="progress-card si">
        <div class="progress-header">
            <h4><i class="fas fa-building"></i> Setting & Infrastructure</h4>
            <span class="progress-percentage"><?= $progress['si'] ?? 75 ?>%</span>
        </div>
        <div class="progress-bar">
            <div class="progress-fill" style="width: <?= $progress['si'] ?? 75 ?>%"></div>
        </div>
        <div class="progress-details">
            <span>Data: <?= $data_count['si'] ?? 45 ?>/60</span>
            <span>Belum Validasi: <?= $pending_count['si'] ?? 8 ?></span>
        </div>
    </div>

    <div class="progress-card ec">
        <div class="progress-header">
            <h4><i class="fas fa-leaf"></i> Energy & Climate</h4>
            <span class="progress-percentage"><?= $progress['ec'] ?? 82 ?>%</span>
        </div>
        <div class="progress-bar">
            <div class="progress-fill" style="width: <?= $progress['ec'] ?? 82 ?>%"></div>
        </div>
        <div class="progress-details">
            <span>Data: <?= $data_count['ec'] ?? 49 ?>/60</span>
            <span>Belum Validasi: <?= $pending_count['ec'] ?? 3 ?></span>
        </div>
    </div>

    <div class="progress-card ws">
        <div class="progress-header">
            <h4><i class="fas fa-recycle"></i> Waste Management</h4>
            <span class="progress-percentage"><?= $progress['ws'] ?? 68 ?>%</span>
        </div>
        <div class="progress-bar">
            <div class="progress-fill" style="width: <?= $progress['ws'] ?? 68 ?>%"></div>
        </div>
        <div class="progress-details">
            <span>Data: <?= $data_count['ws'] ?? 41 ?>/60</span>
            <span>Belum Validasi: <?= $pending_count['ws'] ?? 12 ?></span>
        </div>
    </div>

    <div class="progress-card wr">
        <div class="progress-header">
            <h4><i class="fas fa-tint"></i> Water Management</h4>
            <span class="progress-percentage"><?= $progress['wr'] ?? 71 ?>%</span>
        </div>
        <div class="progress-bar">
            <div class="progress-fill" style="width: <?= $progress['wr'] ?? 71 ?>%"></div>
        </div>
        <div class="progress-details">
            <span>Data: <?= $data_count['wr'] ?? 43 ?>/60</span>
            <span>Belum Validasi: <?= $pending_count['wr'] ?? 9 ?></span>
        </div>
    </div>

    <div class="progress-card tr">
        <div class="progress-header">
            <h4><i class="fas fa-car"></i> Transportation</h4>
            <span class="progress-percentage"><?= $progress['tr'] ?? 85 ?>%</span>
        </div>
        <div class="progress-bar">
            <div class="progress-fill" style="width: <?= $progress['tr'] ?? 85 ?>%"></div>
        </div>
        <div class="progress-details">
            <span>Data: <?= $data_count['tr'] ?? 51 ?>/60</span>
            <span>Belum Validasi: <?= $pending_count['tr'] ?? 2 ?></span>
        </div>
    </div>

    <div class="progress-card ed">
        <div class="progress-header">
            <h4><i class="fas fa-graduation-cap"></i> Education & Research</h4>
            <span class="progress-percentage"><?= $progress['ed'] ?? 92 ?>%</span>
        </div>
        <div class="progress-bar">
            <div class="progress-fill" style="width: <?= $progress['ed'] ?? 92 ?>%"></div>
        </div>
        <div class="progress-details">
            <span>Data: <?= $data_count['ed'] ?? 55 ?>/60</span>
            <span>Belum Validasi: <?= $pending_count['ed'] ?? 1 ?></span>
        </div>
    </div>
</div>

<!-- Action Center -->
<div class="action-center">
    <div class="action-card validation">
        <h4><i class="fas fa-clipboard-check"></i> Validasi Data</h4>
        <div class="validation-summary">
            <div class="validation-item">
                <span class="count"><?= $validation_summary['pending'] ?? 35 ?></span>
                <span class="label">Menunggu Validasi</span>
            </div>
            <div class="validation-item">
                <span class="count"><?= $validation_summary['today'] ?? 12 ?></span>
                <span class="label">Validasi Hari Ini</span>
            </div>
        </div>
        <div class="action-buttons">
            <a href="<?= base_url('admin/validation-queue') ?>" class="btn btn-primary">
                <i class="fas fa-list"></i> Lihat Antrian
            </a>
            <a href="<?= base_url('admin/bulk-validation') ?>" class="btn btn-success">
                <i class="fas fa-check-double"></i> Validasi Massal
            </a>
        </div>
    </div>

    <div class="action-card reports">
        <h4><i class="fas fa-chart-bar"></i> Laporan & Export</h4>
        <div class="report-options">
            <button class="btn btn-outline-primary" onclick="exportReport('summary')">
                <i class="fas fa-file-pdf"></i> Laporan Ringkasan
            </button>
            <button class="btn btn-outline-success" onclick="exportReport('detailed')">
                <i class="fas fa-file-excel"></i> Data Lengkap
            </button>
            <button class="btn btn-outline-info" onclick="exportReport('progress')">
                <i class="fas fa-chart-line"></i> Progress Report
            </button>
        </div>
        <div class="quick-stats">
            <span>Total Data: <?= $total_data ?? 284 ?></span>
            <span>Completion: <?= $completion_rate ?? 78 ?>%</span>
        </div>
    </div>

    <div class="action-card monitoring">
        <h4><i class="fas fa-monitor-waveform"></i> Monitoring Real-time</h4>
        <div class="monitoring-stats">
            <div class="stat-item">
                <i class="fas fa-users text-primary"></i>
                <span><?= $active_users ?? 23 ?> User Aktif</span>
            </div>
            <div class="stat-item">
                <i class="fas fa-upload text-success"></i>
                <span><?= $uploads_today ?? 8 ?> Upload Hari Ini</span>
            </div>
            <div class="stat-item">
                <i class="fas fa-exclamation-triangle text-warning"></i>
                <span><?= $issues_count ?? 3 ?> Issue Terbuka</span>
            </div>
        </div>
        <a href="<?= base_url('admin/monitoring') ?>" class="btn btn-info btn-sm">
            <i class="fas fa-eye"></i> Detail Monitoring
        </a>
    </div>
</div>

<!-- Score Progress Chart -->
<div class="chart-container">
    <div class="chart-header">
        <h3><i class="fas fa-chart-area"></i> Progress Skor per Kategori UIGM</h3>
        <div class="chart-controls">
            <select id="yearFilter" class="form-select">
                <option value="2025">2025</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
            </select>
            <button class="btn btn-sm btn-outline-primary" onclick="refreshChart()">
                <i class="fas fa-sync"></i>
            </button>
        </div>
    </div>
    <canvas id="adminProgressChart"></canvas>
</div>

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .admin-pusat-header {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        color: white;
    }

    .admin-status {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .admin-title {
        font-size: 28px;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .admin-title i {
        color: #ffd700;
    }

    .year-controls {
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: flex-end;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-badge.open {
        background: rgba(76, 175, 80, 0.2);
        border: 1px solid rgba(76, 175, 80, 0.3);
    }

    .status-badge.review {
        background: rgba(255, 193, 7, 0.2);
        border: 1px solid rgba(255, 193, 7, 0.3);
    }

    .status-badge.locked {
        background: rgba(244, 67, 54, 0.2);
        border: 1px solid rgba(244, 67, 54, 0.3);
    }

    .progress-overview {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }

    .progress-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border-left: 4px solid;
    }

    .progress-card.si {
        border-left-color: #2196F3;
    }

    .progress-card.ec {
        border-left-color: #4CAF50;
    }

    .progress-card.ws {
        border-left-color: #FF9800;
    }

    .progress-card.wr {
        border-left-color: #00BCD4;
    }

    .progress-card.tr {
        border-left-color: #E91E63;
    }

    .progress-card.ed {
        border-left-color: #9C27B0;
    }

    .progress-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .progress-header h4 {
        margin: 0;
        font-size: 16px;
        color: #333;
    }

    .progress-percentage {
        font-size: 24px;
        font-weight: 700;
        color: #1e3c72;
    }

    .progress-bar {
        height: 8px;
        background: #f0f0f0;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 10px;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #4CAF50, #2196F3);
        border-radius: 4px;
        transition: width 0.3s ease;
    }

    .progress-details {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: #666;
    }

    .action-center {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }

    .action-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .action-card h4 {
        margin: 0 0 20px;
        color: #1e3c72;
        font-size: 18px;
    }

    .validation-summary {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .validation-item {
        text-align: center;
    }

    .validation-item .count {
        display: block;
        font-size: 28px;
        font-weight: 700;
        color: #1e3c72;
    }

    .validation-item .label {
        font-size: 12px;
        color: #666;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .report-options {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 15px;
    }

    .quick-stats {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: #666;
        padding-top: 15px;
        border-top: 1px solid #f0f0f0;
    }

    .monitoring-stats {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 15px;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
    }

    .chart-container {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
    }

    .chart-controls {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    @media (max-width: 768px) {
        .admin-status {
            flex-direction: column;
            align-items: flex-start;
        }

        .year-controls {
            align-items: flex-start;
            width: 100%;
        }

        .year-actions {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Admin Pusat Dashboard Functions
    function changeYearStatus(status) {
        if (confirm(`Yakin ingin mengubah status tahun menjadi ${status}?`)) {
            fetch('<?= base_url('admin/change-year-status') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Gagal mengubah status: ' + data.message);
                    }
                });
        }
    }

    function finalizeYear() {
        if (confirm('Yakin ingin finalisasi tahun UIGM 2025? Tindakan ini tidak dapat dibatalkan.')) {
            fetch('<?= base_url('admin/finalize-year') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Tahun UIGM 2025 berhasil difinalisasi');
                        location.reload();
                    } else {
                        alert('Gagal finalisasi: ' + data.message);
                    }
                });
        }
    }

    function exportReport(type) {
        window.open(`<?= base_url('admin/export-report') ?>/${type}`, '_blank');
    }

    function refreshChart() {
        // Refresh chart data
        location.reload();
    }

    // Progress Chart
    const ctx = document.getElementById('adminProgressChart').getContext('2d');
    const adminChart = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ['SI', 'EC', 'WS', 'WR', 'TR', 'ED'],
            datasets: [{
                label: 'Progress (%)',
                data: [<?= $progress['si'] ?? 75 ?>, <?= $progress['ec'] ?? 82 ?>, <?= $progress['ws'] ?? 68 ?>, <?= $progress['wr'] ?? 71 ?>, <?= $progress['tr'] ?? 85 ?>, <?= $progress['ed'] ?? 92 ?>],
                backgroundColor: 'rgba(30, 60, 114, 0.2)',
                borderColor: '#1e3c72',
                borderWidth: 2,
                pointBackgroundColor: '#1e3c72',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                r: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        stepSize: 20
                    }
                }
            }
        }
    });
</script>
<?= $this->endSection() ?>