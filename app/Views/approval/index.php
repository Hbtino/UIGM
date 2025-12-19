<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-check-circle"></i> Approval Final
                    </h3>
                    <p class="text-muted mb-0">Kelola persetujuan final untuk semua kategori UIGM</p>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (empty($pendingApprovals)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                            <h4 class="mt-3">Tidak Ada Data Pending</h4>
                            <p class="text-muted">Semua data sudah disetujui atau belum ada pengajuan baru.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Kategori</th>
                                        <th>Judul/Nama</th>
                                        <th>User</th>
                                        <th>Tanggal Submit</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pendingApprovals as $approval): ?>
                                        <tr>
                                            <td><?= $approval['id'] ?></td>
                                            <td>
                                                <span class="badge bg-primary"><?= $approval['category_label'] ?></span>
                                            </td>
                                            <td>
                                                <?php
                                                // Get title based on category
                                                $title = $approval['judul'] ?? $approval['nama'] ?? $approval['title'] ?? 'Data #' . $approval['id'];
                                                echo esc($title);
                                                ?>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-secondary rounded-circle d-flex align-items-center justify-content-center me-2">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold"><?= esc($approval['user_name']) ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    <?= date('d/m/Y H:i', strtotime($approval['updated_at'])) ?>
                                                </small>
                                            </td>
                                            <td>
                                                <span class="badge bg-warning">Pending</span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?= base_url('approval-final/review/' . $approval['category'] . '/' . $approval['id']) ?>"
                                                        class="btn btn-sm btn-outline-primary" title="Review">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-outline-success"
                                                        onclick="approveData('<?= $approval['category'] ?>', <?= $approval['id'] ?>)" title="Approve">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        onclick="rejectData('<?= $approval['category'] ?>', <?= $approval['id'] ?>)" title="Reject">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Bulk Actions -->
                        <div class="mt-3">
                            <h5>Aksi Massal</h5>
                            <div class="row">
                                <?php
                                $categories = [
                                    'setting_infrastructure' => 'Setting & Infrastructure',
                                    'energy_climate' => 'Energy & Climate',
                                    'water_management' => 'Water Management',
                                    'waste_management' => 'Waste Management',
                                    'transportation' => 'Transportation',
                                    'education_research' => 'Education & Research'
                                ];
                                ?>
                                <?php foreach ($categories as $cat => $label): ?>
                                    <div class="col-md-4 mb-2">
                                        <button type="button" class="btn btn-outline-success w-100"
                                            onclick="finalizeCategory('<?= $cat ?>')">
                                            <i class="fas fa-lock"></i> Finalisasi <?= $label ?>
                                        </button>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tolak Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="rejectForm" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="reason" class="form-label">Alasan Penolakan</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required
                            placeholder="Masukkan alasan penolakan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function approveData(category, id) {
        if (confirm('Yakin ingin menyetujui data ini?')) {
            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `<?= base_url('approval-final/approve/') ?>${category}/${id}`;

            // Add CSRF token
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '<?= csrf_token() ?>';
            csrfInput.value = '<?= csrf_hash() ?>';
            form.appendChild(csrfInput);

            document.body.appendChild(form);
            form.submit();
        }
    }

    function rejectData(category, id) {
        const modal = new bootstrap.Modal(document.getElementById('rejectModal'));
        const form = document.getElementById('rejectForm');
        form.action = `<?= base_url('approval-final/reject/') ?>${category}/${id}`;

        // Add CSRF token
        let csrfInput = form.querySelector('input[name="<?= csrf_token() ?>"]');
        if (!csrfInput) {
            csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '<?= csrf_token() ?>';
            form.appendChild(csrfInput);
        }
        csrfInput.value = '<?= csrf_hash() ?>';

        modal.show();
    }

    function finalizeCategory(category) {
        if (confirm(`Yakin ingin memfinalisasi semua data yang sudah disetujui di kategori ini?\n\nData yang sudah difinalisasi tidak dapat diubah lagi.`)) {
            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `<?= base_url('approval-final/finalize/') ?>${category}`;

            // Add CSRF token
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '<?= csrf_token() ?>';
            csrfInput.value = '<?= csrf_hash() ?>';
            form.appendChild(csrfInput);

            document.body.appendChild(form);
            form.submit();
        }
    }
</script>

<style>
    .avatar-sm {
        width: 32px;
        height: 32px;
    }

    .table th {
        border-top: none;
        font-weight: 600;
    }

    .btn-group .btn {
        border-radius: 0.375rem;
        margin-right: 2px;
    }

    .btn-group .btn:last-child {
        margin-right: 0;
    }

    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }
</style>
<?= $this->endSection() ?>