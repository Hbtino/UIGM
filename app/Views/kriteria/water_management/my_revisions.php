<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('water-management') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-info text-white">
            <h6 class="m-0 font-weight-bold">Permintaan Revisi Saya</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tahun Data</th>
                            <th>Alasan Revisi</th>
                            <th>Status</th>
                            <th>Tanggal Request</th>
                            <th>Catatan Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($revisions)): ?>
                            <tr>
                                <td colspan="6" class="text-center">Anda belum mengajukan permintaan revisi</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($revisions as $rev): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><strong><?= $rev['tahun'] ?></strong></td>
                                    <td><?= character_limiter(esc($rev['alasan_revisi']), 80) ?></td>
                                    <td>
                                        <?php if ($rev['status'] === 'pending'): ?>
                                            <span class="badge badge-warning">Menunggu Review</span>
                                        <?php elseif ($rev['status'] === 'approved'): ?>
                                            <span class="badge badge-success">Disetujui</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Ditolak</span>
                                        <?php endif; ?>
                                        <?php if ($rev['status'] != 'pending' && isset($rev['reviewed_by_name'])): ?>
                                            <br><small class="text-muted">oleh <?= esc($rev['reviewed_by_name']) ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d/m/Y H:i', strtotime($rev['created_at'])) ?></td>
                                    <td>
                                        <?php if ($rev['review_notes']): ?>
                                            <?= character_limiter(esc($rev['review_notes']), 80) ?>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <div class="alert alert-info">
                    <strong>Informasi:</strong>
                    <ul class="mb-0">
                        <li><span class="badge badge-warning">Menunggu Review</span> - Permintaan Anda sedang ditinjau oleh admin/reviewer</li>
                        <li><span class="badge badge-success">Disetujui</span> - Permintaan disetujui, Anda dapat mengedit data</li>
                        <li><span class="badge badge-danger">Ditolak</span> - Permintaan ditolak, data tetap tidak dapat diedit</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

