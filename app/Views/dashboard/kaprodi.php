<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

<!-- Kaprodi Dashboard -->
<div class="kaprodi-header">
    <div class="kaprodi-info">
        <h2 class="kaprodi-title">
            <i class="fas fa-user-tie"></i>
            Dashboard Kaprodi
        </h2>
        <p class="kaprodi-subtitle">Program Studi: <?= $user_prodi ?? 'Teknik Informatika' ?></p>
    </div>
    <div class="kaprodi-stats">
        <div class="stat-item">
            <span class="count"><?= $total_dosen ?? 25 ?></span>
            <span class="label">Total Dosen</span>
        </div>
        <div class="stat-item">
            <span class="count"><?= $active_dosen ?? 23 ?></span>
            <span class="label">Dosen Aktif</span>
        </div>
    </div>
</div>

<!-- Data Dosen Overview -->
<div class="dosen-overview">
    <div class="overview-card total">
        <div class="card-header">
            <h4><i class="fas fa-users"></i> Status Data Dosen</h4>
        </div>
        <div class="status-grid">
            <div class="status-item belum">
                <div class="status-count"><?= $dosen_status['belum_submit'] ?? 8 ?></div>
                <div class="status-label">Belum Submit</div>
                <div class="status-bar">
                    <div class="status-fill" style="width: <?= ($dosen_status['belum_submit'] ?? 8) / ($total_dosen ?? 25) * 100 ?>%"></div>
                </div>
            </div>
            <div class="status-item review">
                <div class="status-count"><?= $dosen_status['menunggu_review'] ?? 12 ?></div>
                <div class="status-label">Menunggu Review</div>
                <div class="status-bar">
                    <div class="status-fill" style="width: <?= ($dosen_status['menunggu_review'] ?? 12) / ($total_dosen ?? 25) * 100 ?>%"></div>
                </div>
            </div>
            <div class="status-item revisi">
                <div class="status-count"><?= $dosen_status['perlu_revisi'] ?? 3 ?></div>
                <div class="status-label">Perlu Revisi</div>
                <div class="status-bar">
                    <div class="status-fill" style="width: <?= ($dosen_status['perlu_revisi'] ?? 3) / ($total_dosen ?? 25) * 100 ?>%"></div>
                </div>
            </div>
            <div class="status-item selesai">
                <div class="status-count"><?= $dosen_status['selesai'] ?? 2 ?></div>
                <div class="status-label">Selesai</div>
                <div class="status-bar">
                    <div class="status-fill" style="width: <?= ($dosen_status['selesai'] ?? 2) / ($total_dosen ?? 25) * 100 ?>%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="overview-card progress">
        <div class="card-header">
            <h4><i class="fas fa-chart-pie"></i> Progress Keseluruhan</h4>
        </div>
        <div class="progress-circle-container">
            <div class="progress-circle">
                <svg viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#f0f0f0" stroke-width="8" />
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#4CAF50" stroke-width="8"
                        stroke-dasharray="<?= ($prodi_progress ?? 68) * 2.83 ?> 283"
                        stroke-dashoffset="0" transform="rotate(-90 50 50)" />
                </svg>
                <div class="progress-text">
                    <span class="percentage"><?= $prodi_progress ?? 68 ?>%</span>
                    <span class="label">Complete</span>
                </div>
            </div>
            <div class="progress-details">
                <div class="detail">
                    <span class="value"><?= $ed_data['total'] ?? 156 ?></span>
                    <span class="label">Total Data ED</span>
                </div>
                <div class="detail">
                    <span class="value"><?= $ed_data['approved'] ?? 89 ?></span>
                    <span class="label">Disetujui</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Daftar Dosen -->
<div class="dosen-list-section">
    <div class="section-header">
        <h3><i class="fas fa-list"></i> Daftar Dosen & Status Input</h3>
        <div class="filter-controls">
            <select id="statusFilter" class="form-select">
                <option value="">Semua Status</option>
                <option value="belum_submit">Belum Submit</option>
                <option value="menunggu_review">Menunggu Review</option>
                <option value="perlu_revisi">Perlu Revisi</option>
                <option value="selesai">Selesai</option>
            </select>
            <button class="btn btn-outline-primary" onclick="refreshDosenList()">
                <i class="fas fa-sync"></i>
            </button>
        </div>
    </div>

    <div class="dosen-table-container">
        <table class="table dosen-table">
            <thead>
                <tr>
                    <th>Nama Dosen</th>
                    <th>NIDN</th>
                    <th>Status Input</th>
                    <th>Data ED</th>
                    <th>Last Update</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dosen_list = $dosen_list ?? [
                    ['nama' => 'Dr. Ahmad Hidayat, M.T.', 'nidn' => '0123456789', 'status' => 'menunggu_review', 'data_count' => 8, 'last_update' => '2 hari lalu'],
                    ['nama' => 'Prof. Siti Nurhaliza, Ph.D.', 'nidn' => '0987654321', 'status' => 'selesai', 'data_count' => 12, 'last_update' => '1 minggu lalu'],
                    ['nama' => 'Dr. Budi Santoso, M.Kom.', 'nidn' => '0456789123', 'status' => 'perlu_revisi', 'data_count' => 5, 'last_update' => '3 hari lalu'],
                    ['nama' => 'Ir. Dewi Sartika, M.T.', 'nidn' => '0789123456', 'status' => 'belum_submit', 'data_count' => 0, 'last_update' => '-'],
                    ['nama' => 'Dr. Eko Prasetyo, M.Sc.', 'nidn' => '0321654987', 'status' => 'menunggu_review', 'data_count' => 6, 'last_update' => '1 hari lalu']
                ];
                ?>
                <?php foreach ($dosen_list as $index => $dosen): ?>
                    <tr>
                        <td>
                            <div class="dosen-info">
                                <strong><?= $dosen['nama'] ?></strong>
                            </div>
                        </td>
                        <td><?= $dosen['nidn'] ?></td>
                        <td>
                            <span class="status-badge <?= $dosen['status'] ?>">
                                <?php
                                $status_labels = [
                                    'belum_submit' => 'Belum Submit',
                                    'menunggu_review' => 'Menunggu Review',
                                    'perlu_revisi' => 'Perlu Revisi',
                                    'selesai' => 'Selesai'
                                ];
                                echo $status_labels[$dosen['status']];
                                ?>
                            </span>
                        </td>
                        <td>
                            <span class="data-count"><?= $dosen['data_count'] ?> data</span>
                        </td>
                        <td><?= $dosen['last_update'] ?></td>
                        <td>
                            <div class="action-buttons">
                                <?php if ($dosen['status'] == 'menunggu_review'): ?>
                                    <button class="btn btn-sm btn-success" onclick="approveData(<?= $index ?>)">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                    <button class="btn btn-sm btn-warning" onclick="requestRevision(<?= $index ?>)">
                                        <i class="fas fa-undo"></i> Revisi
                                    </button>
                                <?php elseif ($dosen['status'] == 'perlu_revisi'): ?>
                                    <button class="btn btn-sm btn-info" onclick="viewRevision(<?= $index ?>)">
                                        <i class="fas fa-eye"></i> Lihat
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewDetail(<?= $index ?>)">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Rekap Education & Research -->
<div class="ed-recap-section">
    <div class="recap-header">
        <h3><i class="fas fa-chart-bar"></i> Rekap Education & Research per Prodi</h3>
        <button class="btn btn-primary" onclick="exportRecap()">
            <i class="fas fa-download"></i> Export Rekap
        </button>
    </div>

    <div class="recap-grid">
        <div class="recap-card publikasi">
            <h4><i class="fas fa-book"></i> Publikasi</h4>
            <div class="recap-stats">
                <div class="stat">
                    <span class="count"><?= $ed_recap['publikasi']['jurnal'] ?? 45 ?></span>
                    <span class="label">Jurnal</span>
                </div>
                <div class="stat">
                    <span class="count"><?= $ed_recap['publikasi']['konferensi'] ?? 23 ?></span>
                    <span class="label">Konferensi</span>
                </div>
                <div class="stat">
                    <span class="count"><?= $ed_recap['publikasi']['buku'] ?? 8 ?></span>
                    <span class="label">Buku</span>
                </div>
            </div>
        </div>

        <div class="recap-card penelitian">
            <h4><i class="fas fa-flask"></i> Penelitian</h4>
            <div class="recap-stats">
                <div class="stat">
                    <span class="count"><?= $ed_recap['penelitian']['internal'] ?? 12 ?></span>
                    <span class="label">Internal</span>
                </div>
                <div class="stat">
                    <span class="count"><?= $ed_recap['penelitian']['eksternal'] ?? 8 ?></span>
                    <span class="label">Eksternal</span>
                </div>
                <div class="stat">
                    <span class="count"><?= $ed_recap['penelitian']['kolaborasi'] ?? 5 ?></span>
                    <span class="label">Kolaborasi</span>
                </div>
            </div>
        </div>

        <div class="recap-card pengabdian">
            <h4><i class="fas fa-hands-helping"></i> Pengabdian</h4>
            <div class="recap-stats">
                <div class="stat">
                    <span class="count"><?= $ed_recap['pengabdian']['masyarakat'] ?? 15 ?></span>
                    <span class="label">Masyarakat</span>
                </div>
                <div class="stat">
                    <span class="count"><?= $ed_recap['pengabdian']['industri'] ?? 7 ?></span>
                    <span class="label">Industri</span>
                </div>
                <div class="stat">
                    <span class="count"><?= $ed_recap['pengabdian']['pemerintah'] ?? 3 ?></span>
                    <span class="label">Pemerintah</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .kaprodi-header {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .kaprodi-title {
        font-size: 28px;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .kaprodi-subtitle {
        margin: 5px 0 0;
        opacity: 0.9;
        font-size: 14px;
    }

    .kaprodi-stats {
        display: flex;
        gap: 30px;
    }

    .kaprodi-stats .stat-item {
        text-align: center;
    }

    .kaprodi-stats .count {
        display: block;
        font-size: 32px;
        font-weight: 700;
    }

    .kaprodi-stats .label {
        font-size: 12px;
        opacity: 0.9;
    }

    .dosen-overview {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
        margin-bottom: 25px;
    }

    .overview-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .card-header h4 {
        margin: 0 0 20px;
        color: #1e3c72;
        font-size: 18px;
    }

    .status-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .status-item {
        text-align: center;
        padding: 15px;
        border-radius: 10px;
        background: #f8f9fa;
    }

    .status-count {
        font-size: 32px;
        font-weight: 700;
        color: #1e3c72;
        display: block;
    }

    .status-label {
        font-size: 12px;
        color: #666;
        margin: 5px 0 10px;
    }

    .status-bar {
        height: 4px;
        background: #e0e0e0;
        border-radius: 2px;
        overflow: hidden;
    }

    .status-fill {
        height: 100%;
        border-radius: 2px;
        transition: width 0.3s ease;
    }

    .status-item.belum .status-fill {
        background: #f44336;
    }

    .status-item.review .status-fill {
        background: #ff9800;
    }

    .status-item.revisi .status-fill {
        background: #2196f3;
    }

    .status-item.selesai .status-fill {
        background: #4caf50;
    }

    .progress-circle-container {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .progress-circle {
        position: relative;
        width: 120px;
        height: 120px;
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
        font-size: 24px;
        font-weight: 700;
        color: #4CAF50;
    }

    .progress-text .label {
        font-size: 10px;
        color: #666;
    }

    .progress-details {
        flex: 1;
    }

    .progress-details .detail {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }

    .progress-details .value {
        font-size: 24px;
        font-weight: 700;
        color: #1e3c72;
    }

    .progress-details .label {
        font-size: 12px;
        color: #666;
    }

    .dosen-list-section {
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

    .filter-controls {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .dosen-table-container {
        overflow-x: auto;
    }

    .dosen-table {
        width: 100%;
        margin: 0;
    }

    .dosen-table th {
        background: #f8f9fa;
        border: none;
        font-weight: 600;
        color: #333;
        padding: 15px 10px;
    }

    .dosen-table td {
        padding: 15px 10px;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }

    .dosen-info strong {
        color: #333;
        font-size: 14px;
    }

    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-badge.belum_submit {
        background: rgba(244, 67, 54, 0.1);
        color: #f44336;
    }

    .status-badge.menunggu_review {
        background: rgba(255, 152, 0, 0.1);
        color: #ff9800;
    }

    .status-badge.perlu_revisi {
        background: rgba(33, 150, 243, 0.1);
        color: #2196f3;
    }

    .status-badge.selesai {
        background: rgba(76, 175, 80, 0.1);
        color: #4caf50;
    }

    .data-count {
        font-weight: 600;
        color: #1e3c72;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }

    .ed-recap-section {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .recap-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .recap-header h3 {
        margin: 0;
        color: #1e3c72;
    }

    .recap-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .recap-card {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        border-left: 4px solid;
    }

    .recap-card.publikasi {
        border-left-color: #2196F3;
    }

    .recap-card.penelitian {
        border-left-color: #4CAF50;
    }

    .recap-card.pengabdian {
        border-left-color: #FF9800;
    }

    .recap-card h4 {
        margin: 0 0 15px;
        color: #333;
        font-size: 16px;
    }

    .recap-stats {
        display: flex;
        justify-content: space-between;
    }

    .recap-stats .stat {
        text-align: center;
    }

    .recap-stats .count {
        display: block;
        font-size: 24px;
        font-weight: 700;
        color: #1e3c72;
    }

    .recap-stats .label {
        font-size: 12px;
        color: #666;
    }

    @media (max-width: 768px) {
        .kaprodi-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .kaprodi-stats {
            width: 100%;
            justify-content: space-around;
        }

        .dosen-overview {
            grid-template-columns: 1fr;
        }

        .status-grid {
            grid-template-columns: 1fr;
        }

        .progress-circle-container {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Kaprodi Dashboard Functions
    function approveData(dosenIndex) {
        if (confirm('Yakin ingin menyetujui data dosen ini?')) {
            fetch('<?= base_url('kaprodi/approve-data') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        dosen_index: dosenIndex
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Data berhasil disetujui', 'success');
                        refreshDosenList();
                    } else {
                        showNotification('Gagal menyetujui data: ' + data.message, 'error');
                    }
                });
        }
    }

    function requestRevision(dosenIndex) {
        const reason = prompt('Alasan revisi:');
        if (reason) {
            fetch('<?= base_url('kaprodi/request-revision') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        dosen_index: dosenIndex,
                        reason: reason
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Permintaan revisi berhasil dikirim', 'success');
                        refreshDosenList();
                    } else {
                        showNotification('Gagal mengirim revisi: ' + data.message, 'error');
                    }
                });
        }
    }

    function viewDetail(dosenIndex) {
        window.open(`<?= base_url('kaprodi/dosen-detail') ?>/${dosenIndex}`, '_blank');
    }

    function viewRevision(dosenIndex) {
        window.open(`<?= base_url('kaprodi/revision-detail') ?>/${dosenIndex}`, '_blank');
    }

    function refreshDosenList() {
        location.reload();
    }

    function exportRecap() {
        window.open('<?= base_url('kaprodi/export-recap') ?>', '_blank');
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

    // Filter functionality
    document.getElementById('statusFilter').addEventListener('change', function() {
        const filterValue = this.value;
        const rows = document.querySelectorAll('.dosen-table tbody tr');

        rows.forEach(row => {
            const statusBadge = row.querySelector('.status-badge');
            if (!filterValue || statusBadge.classList.contains(filterValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
<?= $this->endSection() ?>