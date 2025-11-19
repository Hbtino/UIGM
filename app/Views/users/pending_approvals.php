<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-user-clock"></i> Pending User Approvals
                    <span class="badge bg-danger"><?= $pending_count ?></span>
                </h4>
                <a href="/users" class="btn btn-sm btn-dark">Kembali ke Daftar User</a>
            </div>
            <div class="card-body">
                <?php if (empty($users)): ?>
                    <div class="alert alert-info text-center">
                        <i class="fas fa-check-circle"></i> Tidak ada user yang menunggu persetujuan
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($user['name']) ?></td>
                                        <td><?= esc($user['email']) ?></td>
                                        <td>
                                            <span class="badge bg-secondary"><?= ucfirst($user['role']) ?></span>
                                        </td>
                                        <td><?= date('d/m/Y H:i', strtotime($user['created_at'])) ?></td>
                                        <td>
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-clock"></i> Pending
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="/users/approve/<?= $user['id'] ?>" 
                                                   class="btn btn-sm btn-success" 
                                                   onclick="return confirm('Setujui user <?= esc($user['name']) ?>?')">
                                                    <i class="fas fa-check"></i> Setujui
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-sm btn-danger" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#rejectModal<?= $user['id'] ?>">
                                                    <i class="fas fa-times"></i> Tolak
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Reject Modal -->
                                    <div class="modal fade" id="rejectModal<?= $user['id'] ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title">Tolak User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="/users/reject/<?= $user['id'] ?>" method="post">
                                                    <div class="modal-body">
                                                        <p>Anda yakin ingin menolak user <strong><?= esc($user['name']) ?></strong>?</p>
                                                        <div class="mb-3">
                                                            <label class="form-label">Alasan Penolakan (Opsional)</label>
                                                            <textarea name="rejection_reason" class="form-control" rows="3" placeholder="Masukkan alasan penolakan..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Tolak User</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
