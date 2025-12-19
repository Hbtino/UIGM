<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

<!-- Admin Unit Dashboard -->
<div class="unit-header">
    <div class="unit-info">
        <h2 class="unit-title">
            <i class="fas fa-building"></i>
            Dashboard Admin Unit
        </h2>
        <p class="unit-subtitle">Unit: <?= $user_unit ?? 'Sarpras/Umum/LPPM' ?></p>
    </div>
    <div class="unit-status">
        <div class="status-badge active">
            <i class="fas fa-check-circle"></i>
            <span>Status: Aktif Input</span>
        </div>
    </div>
</div>

<!-- Unit Progress Overview -->
<div class="unit-progress">
    <div class="progress-summary">
        <h3>Progress Data Unit Anda</h3>
        <div class="progress-circle">
            <svg viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="45" fill="none" stroke="#f0f0f0" stroke-width="8" />
                <circle cx="50" cy="50" r="45" fill="none" stroke="#4CAF50" stroke-width="8"
                    stroke-dasharray="<?= ($unit_progress ?? 68) * 2.83 ?> 283"
                    stroke-dashoffset="0" transform="rotate(-90 50 50)" />
            </svg>
            <div class="progress-text">
                <span class="percentage"><?= $unit_progress ?? 68 ?>%</span>
                <span class="label">Selesai</span>
            </div>
        </div>
    </div>

    <div class="progress-details">
        <div class="detail-item">
            <i class="fas fa-clipboard-list text-primary"></i>
            <div>
                <span class="count"><?= $unit_data['total'] ?? 45 ?></span>
                <span class="label">Total Indikator</span>
            </div>
        </div>
        <div class="detail-item">
            <i class="fas fa-check text-success"></i>
            <div>
                <span class="count"><?= $unit_data['completed'] ?? 31 ?></span>
                <span class="label">Sudah Diisi</span>
            </div>
        </div>
        <div class="detail-item">
            <i class="fas fa-clock text-warning"></i>
            <div>
                <span class="count"><?= $unit_data['draft'] ?? 8 ?></span>
                <span class="label">Draft</span>
            </div>
        </div>
        <div class="detail-item">
            <i class="fas fa-eye text-info"></i>
            <div>
                <span class="count"><?= $unit_data['review'] ?? 6 ?></span>
                <span class="label">Review</span>
            </div>
        </div>
    </div>
</div>

<!-- Kategori yang Menjadi Tanggung Jawab -->
<div class="responsibility-section">
    <h3><i class="fas fa-tasks"></i> Kategori Tanggung Jawab Unit</h3>

    <?php
    $unit_categories = $unit_categories ?? [
        'si' => ['name' => 'Setting & Infrastructure', 'progress' => 75, 'total' => 20, 'completed' => 15],
        'ws' => ['name' => 'Waste Management', 'progress' => 60, 'total' => 15, 'completed' => 9],
        'wr' => ['name' => 'Water Management', 'progress' => 80, 'total' => 10, 'completed' => 8]
    ];
    ?>

    <div class="category-grid">
        <?php foreach ($unit_categories as $key => $category): ?>
            <div class="category-card <?= $key ?>">
                <div class="category-header">
                    <h4><?= $category['name'] ?></h4>
                    <span class="category-progress"><?= $category['progress'] ?>%</span>
                </div>
                <div class="category-bar">
                    <div class="category-fill" style="width: <?= $category['progress'] ?>%"></div>
                </div>
                <div class="category-stats">
                    <span>Selesai: <?= $category['completed'] ?>/<?= $category['total'] ?></span>
                    <a href="<?= base_url('unit/category/' . $key) ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Kelola
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <div class="action-card input">
        <h4><i class="fas fa-plus-circle"></i> Input Data Baru</h4>
        <p>Tambahkan data indikator untuk kategori yang menjadi tanggung jawab unit Anda</p>
        <div class="action-buttons">
            <a href="<?= base_url('unit/add-data') ?>" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
            <a href="<?= base_url('unit/bulk-upload') ?>" class="btn btn-info">
                <i class="fas fa-upload"></i> Upload Massal
            </a>
        </div>
    </div>

    <div class="action-card upload">
        <h4><i class="fas fa-file-upload"></i> Upload Bukti</h4>
        <p>Upload dokumen pendukung untuk data yang sudah diinput</p>
        <div class="upload-stats">
            <span>Butuh Bukti: <?= $evidence_needed ?? 12 ?></span>
            <span>Terupload: <?= $evidence_uploaded ?? 8 ?></span>
        </div>
        <a href="<?= base_url('unit/evidence-upload') ?>" class="btn btn-warning">
            <i class="fas fa-paperclip"></i> Upload Bukti
        </a>
    </div>

    <div class="action-card submit">
        <h4><i class="fas fa-paper-plane"></i> Submit Review</h4>
        <p>Submit data yang sudah lengkap untuk direview oleh admin</p>
        <div class="submit-stats">
            <span>Siap Submit: <?= $ready_submit ?? 5 ?></span>
            <span>Menunggu Review: <?= $pending_review ?? 3 ?></span>
        </div>
        <a href="<?= base_url('unit/submit-review') ?>" class="btn btn-primary">
            <i class="fas fa-check"></i> Submit Review
        </a>
    </div>
</div>

<!-- Reminder & Deadline -->
<div class="reminder-section">
    <div class="reminder-card">
        <h4><i class="fas fa-bell"></i> Reminder & Deadline</h4>
        <div class="reminder-list">
            <div class="reminder-item urgent">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <strong>Deadline Semester 1</strong>
                    <span>15 hari lagi - 31 Januari 2025</span>
                </div>
            </div>
            <div class="reminder-item normal">
                <i class="fas fa-calendar"></i>
                <div>
                    <strong>Update Bulanan</strong>
                    <span>Setiap tanggal 25 - Update progress data</span>
                </div>
            </div>
            <div class="reminder-item info">
                <i class="fas fa-info-circle"></i>
                <div>
                    <strong>Pelatihan Data Entry</strong>
                    <span>20 Januari 2025 - Wajib hadir</span>
                </div>
            </div>
        </div>
    </div>

    <div class="recent-activity">
        <h4><i class="fas fa-history"></i> Aktivitas Terbaru</h4>
        <div class="activity-list">
            <?php
            $recent_activities = $recent_activities ?? [
                ['action' => 'Data SI-001 diupdate', 'time' => '2 jam lalu', 'status' => 'success'],
                ['action' => 'Upload bukti WS-005', 'time' => '1 hari lalu', 'status' => 'info'],
                ['action' => 'Submit review WR-003', 'time' => '2 hari lalu', 'status' => 'warning'],
                ['action' => 'Data SI-002 disetujui', 'time' => '3 hari lalu', 'status' => 'success']
            ];
            ?>
            <?php foreach ($recent_activities as $activity): ?>
                <div class="activity-item">
                    <i class="fas fa-circle text-<?= $activity['status'] ?>"></i>
                    <div>
                        <span class="activity-text"><?= $activity['action'] ?></span>
                        <span class="activity-time"><?= $activity['time'] ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .unit-header {
        background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .unit-title {
        font-size: 28px;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .unit-subtitle {
        margin: 5px 0 0;
        opacity: 0.9;
        font-size: 14px;
    }

    .unit-progress {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 30px;
        margin-bottom: 25px;
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .progress-summary {
        text-align: center;
    }

    .progress-circle {
        position: relative;
        width: 200px;
        height: 200px;
        margin: 20px auto;
    }

    .progress-circle svg {
        width: 100%;
        height: 100%;
    }

    .progress-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .progress-text .percentage {
        display: block;
        font-size: 36px;
        font-weight: 700;
        color: #4CAF50;
    }

    .progress-text .label {
        font-size: 14px;
        color: #666;
    }

    .progress-details {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        align-content: center;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .detail-item i {
        font-size: 24px;
    }

    .detail-item .count {
        display: block;
        font-size: 24px;
        font-weight: 700;
        color: #333;
    }

    .detail-item .label {
        font-size: 12px;
        color: #666;
    }

    .responsibility-section {
        margin-bottom: 25px;
    }

    .responsibility-section h3 {
        color: #1e3c72;
        margin-bottom: 20px;
    }

    .category-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .category-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border-left: 4px solid;
    }

    .category-card.si {
        border-left-color: #2196F3;
    }

    .category-card.ws {
        border-left-color: #FF9800;
    }

    .category-card.wr {
        border-left-color: #00BCD4;
    }

    .category-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .category-header h4 {
        margin: 0;
        font-size: 16px;
        color: #333;
    }

    .category-progress {
        font-size: 20px;
        font-weight: 700;
        color: #1e3c72;
    }

    .category-bar {
        height: 8px;
        background: #f0f0f0;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 15px;
    }

    .category-fill {
        height: 100%;
        background: linear-gradient(90deg, #4CAF50, #2196F3);
        border-radius: 4px;
        transition: width 0.3s ease;
    }

    .category-stats {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
        color: #666;
    }

    .quick-actions {
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
        margin: 0 0 10px;
        color: #1e3c72;
        font-size: 18px;
    }

    .action-card p {
        margin: 0 0 20px;
        color: #666;
        font-size: 14px;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .upload-stats,
    .submit-stats {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 14px;
        color: #666;
    }

    .reminder-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 20px;
    }

    .reminder-card,
    .recent-activity {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .reminder-card h4,
    .recent-activity h4 {
        margin: 0 0 20px;
        color: #1e3c72;
        font-size: 18px;
    }

    .reminder-list,
    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .reminder-item,
    .activity-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        border-radius: 10px;
    }

    .reminder-item.urgent {
        background: rgba(244, 67, 54, 0.1);
        border-left: 4px solid #f44336;
    }

    .reminder-item.normal {
        background: rgba(33, 150, 243, 0.1);
        border-left: 4px solid #2196F3;
    }

    .reminder-item.info {
        background: rgba(76, 175, 80, 0.1);
        border-left: 4px solid #4CAF50;
    }

    .activity-item {
        background: #f8f9fa;
    }

    .reminder-item i,
    .activity-item i {
        font-size: 16px;
    }

    .reminder-item div,
    .activity-item div {
        flex: 1;
    }

    .reminder-item strong,
    .activity-text {
        display: block;
        font-weight: 600;
        color: #333;
    }

    .reminder-item span,
    .activity-time {
        font-size: 12px;
        color: #666;
    }

    @media (max-width: 768px) {
        .unit-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .unit-progress {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .progress-details {
            grid-template-columns: 1fr;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Unit Dashboard Functions
    function refreshProgress() {
        location.reload();
    }

    // Auto-save draft functionality
    let autoSaveTimer;

    function enableAutoSave() {
        clearTimeout(autoSaveTimer);
        autoSaveTimer = setTimeout(() => {
            // Auto save draft logic here
            console.log('Auto-saving draft...');
        }, 30000); // Save every 30 seconds
    }

    // Notification for deadlines
    function checkDeadlines() {
        const deadlineDate = new Date('2025-01-31');
        const today = new Date();
        const daysLeft = Math.ceil((deadlineDate - today) / (1000 * 60 * 60 * 24));

        if (daysLeft <= 15 && daysLeft > 0) {
            showNotification(`Deadline dalam ${daysLeft} hari!`, 'warning');
        }
    }

    function showNotification(message, type) {
        // Simple notification system
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.top = '20px';
        notification.style.right = '20px';
        notification.style.zIndex = '9999';
        notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, 5000);
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        checkDeadlines();
    });
</script>
<?= $this->endSection() ?>