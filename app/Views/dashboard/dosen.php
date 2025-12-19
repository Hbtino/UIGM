<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

<!-- Dosen Dashboard -->
<div class="dosen-header">
    <div class="dosen-info">
        <h2 class="dosen-title">
            <i class="fas fa-user-graduate"></i>
            Dashboard Dosen
        </h2>
        <p class="dosen-subtitle">Selamat datang, <?= $user_name ?? 'Dr. Ahmad Hidayat, M.T.' ?></p>
    </div>
    <div class="dosen-status">
        <div class="status-badge <?= $submission_status ?? 'draft' ?>">
            <i class="fas <?= $submission_status == 'submitted' ? 'fa-check-circle' : ($submission_status == 'review' ? 'fa-eye' : 'fa-edit') ?>"></i>
            <span><?= ucfirst($submission_status ?? 'Draft') ?></span>
        </div>
    </div>
</div>

<!-- Status Data Pribadi -->
<div class="personal-status">
    <div class="status-card profile">
        <div class="status-header">
            <h4><i class="fas fa-user"></i> Status Data Pribadi</h4>
            <span class="completion-rate"><?= $profile_completion ?? 85 ?>%</span>
        </div>
        <div class="progress-bar">
            <div class="progress-fill" style="width: <?= $profile_completion ?? 85 ?>%"></div>
        </div>
        <div class="status-details">
            <div class="detail-item">
                <i class="fas fa-id-card text-success"></i>
                <span>Data Identitas: Lengkap</span>
            </div>
            <div class="detail-item">
                <i class="fas fa-graduation-cap text-success"></i>
                <span>Riwayat Pendidikan: Lengkap</span>
            </div>
            <div class="detail-item">
                <i class="fas fa-briefcase text-warning"></i>
                <span>Pengalaman Kerja: Perlu Update</span>
            </div>
        </div>
        <a href="<?= base_url('dosen/profile') ?>" class="btn btn-outline-primary btn-sm">
            <i class="fas fa-edit"></i> Update Profile
        </a>
    </div>

    <div class="status-card deadline">
        <div class="status-header">
            <h4><i class="fas fa-clock"></i> Deadline & Reminder</h4>
        </div>
        <div class="deadline-list">
            <div class="deadline-item urgent">
                <div class="deadline-info">
                    <strong>Deadline Semester 1</strong>
                    <span>31 Januari 2025</span>
                </div>
                <div class="deadline-countdown">
                    <span class="days"><?= $days_left ?? 15 ?></span>
                    <span class="label">hari lagi</span>
                </div>
            </div>
            <div class="deadline-item normal">
                <div class="deadline-info">
                    <strong>Update Bulanan</strong>
                    <span>Setiap tanggal 25</span>
                </div>
                <div class="deadline-status">
                    <i class="fas fa-check-circle text-success"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Checklist Data Education & Research -->
<div class="ed-checklist-section">
    <div class="section-header">
        <h3><i class="fas fa-clipboard-check"></i> Checklist Data Education & Research</h3>
        <div class="overall-progress">
            <span>Progress: <?= $ed_progress ?? 68 ?>%</span>
            <div class="mini-progress">
                <div class="mini-fill" style="width: <?= $ed_progress ?? 68 ?>%"></div>
            </div>
        </div>
    </div>

    <div class="checklist-grid">
        <div class="checklist-card publikasi">
            <div class="card-header">
                <h4><i class="fas fa-book"></i> Publikasi</h4>
                <span class="item-count"><?= $ed_data['publikasi']['count'] ?? 8 ?>/10</span>
            </div>
            <div class="checklist-items">
                <div class="checklist-item <?= ($ed_data['publikasi']['jurnal'] ?? 0) > 0 ? 'completed' : 'pending' ?>">
                    <i class="fas <?= ($ed_data['publikasi']['jurnal'] ?? 0) > 0 ? 'fa-check-circle' : 'fa-circle' ?>"></i>
                    <span>Jurnal Internasional (<?= $ed_data['publikasi']['jurnal'] ?? 0 ?>)</span>
                </div>
                <div class="checklist-item <?= ($ed_data['publikasi']['konferensi'] ?? 0) > 0 ? 'completed' : 'pending' ?>">
                    <i class="fas <?= ($ed_data['publikasi']['konferensi'] ?? 0) > 0 ? 'fa-check-circle' : 'fa-circle' ?>"></i>
                    <span>Konferensi (<?= $ed_data['publikasi']['konferensi'] ?? 0 ?>)</span>
                </div>
                <div class="checklist-item <?= ($ed_data['publikasi']['buku'] ?? 0) > 0 ? 'completed' : 'pending' ?>">
                    <i class="fas <?= ($ed_data['publikasi']['buku'] ?? 0) > 0 ? 'fa-check-circle' : 'fa-circle' ?>"></i>
                    <span>Buku/Chapter (<?= $ed_data['publikasi']['buku'] ?? 0 ?>)</span>
                </div>
            </div>
            <button class="btn btn-success btn-sm" onclick="addData('publikasi')">
                <i class="fas fa-plus"></i> Tambah Publikasi
            </button>
        </div>

        <div class="checklist-card penelitian">
            <div class="card-header">
                <h4><i class="fas fa-flask"></i> Penelitian</h4>
                <span class="item-count"><?= $ed_data['penelitian']['count'] ?? 5 ?>/8</span>
            </div>
            <div class="checklist-items">
                <div class="checklist-item <?= ($ed_data['penelitian']['internal'] ?? 0) > 0 ? 'completed' : 'pending' ?>">
                    <i class="fas <?= ($ed_data['penelitian']['internal'] ?? 0) > 0 ? 'fa-check-circle' : 'fa-circle' ?>"></i>
                    <span>Penelitian Internal (<?= $ed_data['penelitian']['internal'] ?? 0 ?>)</span>
                </div>
                <div class="checklist-item <?= ($ed_data['penelitian']['eksternal'] ?? 0) > 0 ? 'completed' : 'pending' ?>">
                    <i class="fas <?= ($ed_data['penelitian']['eksternal'] ?? 0) > 0 ? 'fa-check-circle' : 'fa-circle' ?>"></i>
                    <span>Penelitian Eksternal (<?= $ed_data['penelitian']['eksternal'] ?? 0 ?>)</span>
                </div>
                <div class="checklist-item <?= ($ed_data['penelitian']['kolaborasi'] ?? 0) > 0 ? 'completed' : 'pending' ?>">
                    <i class="fas <?= ($ed_data['penelitian']['kolaborasi'] ?? 0) > 0 ? 'fa-check-circle' : 'fa-circle' ?>"></i>
                    <span>Kolaborasi Internasional (<?= $ed_data['penelitian']['kolaborasi'] ?? 0 ?>)</span>
                </div>
            </div>
            <button class="btn btn-success btn-sm" onclick="addData('penelitian')">
                <i class="fas fa-plus"></i> Tambah Penelitian
            </button>
        </div>

        <div class="checklist-card pengabdian">
            <div class="card-header">
                <h4><i class="fas fa-hands-helping"></i> Pengabdian</h4>
                <span class="item-count"><?= $ed_data['pengabdian']['count'] ?? 3 ?>/5</span>
            </div>
            <div class="checklist-items">
                <div class="checklist-item <?= ($ed_data['pengabdian']['masyarakat'] ?? 0) > 0 ? 'completed' : 'pending' ?>">
                    <i class="fas <?= ($ed_data['pengabdian']['masyarakat'] ?? 0) > 0 ? 'fa-check-circle' : 'fa-circle' ?>"></i>
                    <span>Pengabdian Masyarakat (<?= $ed_data['pengabdian']['masyarakat'] ?? 0 ?>)</span>
                </div>
                <div class="checklist-item <?= ($ed_data['pengabdian']['industri'] ?? 0) > 0 ? 'completed' : 'pending' ?>">
                    <i class="fas <?= ($ed_data['pengabdian']['industri'] ?? 0) > 0 ? 'fa-check-circle' : 'fa-circle' ?>"></i>
                    <span>Kerjasama Industri (<?= $ed_data['pengabdian']['industri'] ?? 0 ?>)</span>
                </div>
            </div>
            <button class="btn btn-success btn-sm" onclick="addData('pengabdian')">
                <i class="fas fa-plus"></i> Tambah Pengabdian
            </button>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <div class="action-card submit">
        <h4><i class="fas fa-paper-plane"></i> Submit Data</h4>
        <p>Submit semua data Anda untuk direview oleh Kaprodi</p>
        <div class="submit-requirements">
            <div class="requirement <?= ($profile_completion ?? 85) >= 90 ? 'met' : 'unmet' ?>">
                <i class="fas <?= ($profile_completion ?? 85) >= 90 ? 'fa-check' : 'fa-times' ?>"></i>
                <span>Profile lengkap (min 90%)</span>
            </div>
            <div class="requirement <?= ($ed_progress ?? 68) >= 70 ? 'met' : 'unmet' ?>">
                <i class="fas <?= ($ed_progress ?? 68) >= 70 ? 'fa-check' : 'fa-times' ?>"></i>
                <span>Data ED lengkap (min 70%)</span>
            </div>
        </div>
        <button class="btn btn-primary" onclick="submitData()"
            <?= (($profile_completion ?? 85) >= 90 && ($ed_progress ?? 68) >= 70) ? '' : 'disabled' ?>>
            <i class="fas fa-check"></i> Submit untuk Review
        </button>
    </div>

    <div class="action-card draft">
        <h4><i class="fas fa-save"></i> Simpan Draft</h4>
        <p>Simpan progress Anda sebagai draft untuk dilanjutkan nanti</p>
        <div class="draft-info">
            <span>Terakhir disimpan: <?= $last_saved ?? '2 jam lalu' ?></span>
        </div>
        <button class="btn btn-outline-secondary" onclick="saveDraft()">
            <i class="fas fa-save"></i> Simpan Draft
        </button>
    </div>

    <div class="action-card help">
        <h4><i class="fas fa-question-circle"></i> Bantuan</h4>
        <p>Butuh bantuan dalam mengisi data? Lihat panduan atau hubungi admin</p>
        <div class="help-buttons">
            <a href="<?= base_url('dosen/panduan') ?>" class="btn btn-info btn-sm">
                <i class="fas fa-book"></i> Panduan
            </a>
            <a href="<?= base_url('dosen/contact-admin') ?>" class="btn btn-warning btn-sm">
                <i class="fas fa-envelope"></i> Hubungi Admin
            </a>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="recent-activity-section">
    <h3><i class="fas fa-history"></i> Aktivitas Terbaru</h3>
    <div class="activity-timeline">
        <?php
        $recent_activities = $recent_activities ?? [
            ['action' => 'Menambahkan publikasi jurnal internasional', 'time' => '2 jam lalu', 'type' => 'publikasi'],
            ['action' => 'Update data penelitian internal', 'time' => '1 hari lalu', 'type' => 'penelitian'],
            ['action' => 'Menyimpan draft pengabdian masyarakat', 'time' => '2 hari lalu', 'type' => 'pengabdian'],
            ['action' => 'Update profile pendidikan', 'time' => '3 hari lalu', 'type' => 'profile']
        ];
        ?>
        <?php foreach ($recent_activities as $activity): ?>
            <div class="activity-item">
                <div class="activity-icon <?= $activity['type'] ?>">
                    <i class="fas <?= $activity['type'] == 'publikasi' ? 'fa-book' : ($activity['type'] == 'penelitian' ? 'fa-flask' : ($activity['type'] == 'pengabdian' ? 'fa-hands-helping' : 'fa-user')) ?>"></i>
                </div>
                <div class="activity-content">
                    <span class="activity-text"><?= $activity['action'] ?></span>
                    <span class="activity-time"><?= $activity['time'] ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .dosen-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .dosen-title {
        font-size: 28px;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .dosen-subtitle {
        margin: 5px 0 0;
        opacity: 0.9;
        font-size: 14px;
    }

    .status-badge {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 14px;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .status-badge.draft {
        background: rgba(255, 193, 7, 0.2);
        border-color: rgba(255, 193, 7, 0.3);
    }

    .status-badge.review {
        background: rgba(33, 150, 243, 0.2);
        border-color: rgba(33, 150, 243, 0.3);
    }

    .status-badge.submitted {
        background: rgba(76, 175, 80, 0.2);
        border-color: rgba(76, 175, 80, 0.3);
    }

    .personal-status {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
        margin-bottom: 25px;
    }

    .status-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .status-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .status-header h4 {
        margin: 0;
        color: #1e3c72;
        font-size: 18px;
    }

    .completion-rate {
        font-size: 24px;
        font-weight: 700;
        color: #4CAF50;
    }

    .progress-bar {
        height: 8px;
        background: #f0f0f0;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #4CAF50, #2196F3);
        border-radius: 4px;
        transition: width 0.3s ease;
    }

    .status-details {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 20px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
    }

    .deadline-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .deadline-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border-radius: 10px;
        background: #f8f9fa;
    }

    .deadline-item.urgent {
        background: rgba(244, 67, 54, 0.1);
        border-left: 4px solid #f44336;
    }

    .deadline-item.normal {
        background: rgba(76, 175, 80, 0.1);
        border-left: 4px solid #4CAF50;
    }

    .deadline-info strong {
        display: block;
        color: #333;
        font-weight: 600;
    }

    .deadline-info span {
        font-size: 12px;
        color: #666;
    }

    .deadline-countdown {
        text-align: center;
    }

    .deadline-countdown .days {
        display: block;
        font-size: 24px;
        font-weight: 700;
        color: #f44336;
    }

    .deadline-countdown .label {
        font-size: 10px;
        color: #666;
    }

    .ed-checklist-section {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .section-header h3 {
        margin: 0;
        color: #1e3c72;
    }

    .overall-progress {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        color: #666;
    }

    .mini-progress {
        width: 100px;
        height: 4px;
        background: #f0f0f0;
        border-radius: 2px;
        overflow: hidden;
    }

    .mini-fill {
        height: 100%;
        background: #4CAF50;
        border-radius: 2px;
        transition: width 0.3s ease;
    }

    .checklist-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .checklist-card {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        border-left: 4px solid;
    }

    .checklist-card.publikasi {
        border-left-color: #2196F3;
    }

    .checklist-card.penelitian {
        border-left-color: #4CAF50;
    }

    .checklist-card.pengabdian {
        border-left-color: #FF9800;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .card-header h4 {
        margin: 0;
        color: #333;
        font-size: 16px;
    }

    .item-count {
        font-size: 14px;
        font-weight: 600;
        color: #1e3c72;
    }

    .checklist-items {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 15px;
    }

    .checklist-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
    }

    .checklist-item.completed {
        color: #4CAF50;
    }

    .checklist-item.pending {
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
        margin: 0 0 15px;
        color: #666;
        font-size: 14px;
    }

    .submit-requirements {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 15px;
    }

    .requirement {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
    }

    .requirement.met {
        color: #4CAF50;
    }

    .requirement.unmet {
        color: #f44336;
    }

    .draft-info {
        font-size: 12px;
        color: #666;
        margin-bottom: 15px;
    }

    .help-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .recent-activity-section {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .recent-activity-section h3 {
        margin: 0 0 20px;
        color: #1e3c72;
    }

    .activity-timeline {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
    }

    .activity-icon.publikasi {
        background: #2196F3;
    }

    .activity-icon.penelitian {
        background: #4CAF50;
    }

    .activity-icon.pengabdian {
        background: #FF9800;
    }

    .activity-icon.profile {
        background: #9C27B0;
    }

    .activity-content {
        flex: 1;
    }

    .activity-text {
        display: block;
        color: #333;
        font-weight: 500;
    }

    .activity-time {
        font-size: 12px;
        color: #666;
    }

    @media (max-width: 768px) {
        .dosen-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .personal-status {
            grid-template-columns: 1fr;
        }

        .checklist-grid {
            grid-template-columns: 1fr;
        }

        .quick-actions {
            grid-template-columns: 1fr;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Dosen Dashboard Functions
    function addData(type) {
        window.location.href = `<?= base_url('dosen/add-data') ?>/${type}`;
    }

    function submitData() {
        if (confirm('Yakin ingin submit semua data untuk direview? Data yang sudah disubmit tidak dapat diubah.')) {
            fetch('<?= base_url('dosen/submit-data') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Data berhasil disubmit untuk review', 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        showNotification('Gagal submit data: ' + data.message, 'error');
                    }
                });
        }
    }

    function saveDraft() {
        fetch('<?= base_url('dosen/save-draft') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Draft berhasil disimpan', 'success');
                    updateLastSaved();
                } else {
                    showNotification('Gagal menyimpan draft: ' + data.message, 'error');
                }
            });
    }

    function updateLastSaved() {
        const now = new Date();
        const timeString = 'Baru saja';
        document.querySelector('.draft-info span').textContent = `Terakhir disimpan: ${timeString}`;
    }

    function showNotification(message, type) {
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

    // Auto-save functionality
    let autoSaveTimer;

    function enableAutoSave() {
        clearTimeout(autoSaveTimer);
        autoSaveTimer = setTimeout(() => {
            saveDraft();
        }, 300000); // Auto save every 5 minutes
    }

    // Check deadline and show warning
    function checkDeadline() {
        const daysLeft = <?= $days_left ?? 15 ?>;
        if (daysLeft <= 7) {
            showNotification(`Perhatian: Deadline dalam ${daysLeft} hari!`, 'warning');
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        enableAutoSave();
        checkDeadline();
    });

    // Enable auto-save on any form input
    document.addEventListener('input', function() {
        enableAutoSave();
    });
</script>
<?= $this->endSection() ?>