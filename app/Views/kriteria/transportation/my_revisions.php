<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-white d-flex" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);" justify-content-between align-items-center">
                <h4 class="mb-0">Permintaan Revisi Saya</h4>
                <a href="/transportation" class="btn btn-light btn-sm">Kembali ke Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
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
                                    <?php
                                    $statusBadge = [
                                        'pending' => 'bg-warning',
                                        'approved' => 'bg-success',
                                        'rejected' => 'bg-danger'
                                    ];
                                    $statusText = [
                                        'pending' => 'Menunggu Review',
                                        'approved' => 'Disetujui',
                                        'rejected' => 'Ditolak'
                                    ];
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><strong><?= $rev['tahun'] ?></strong></td>
                                        <td><?= character_limiter(esc($rev['alasan_revisi']), 80) ?></td>
                                        <td>
                                            <span class="badge <?= $statusBadge[$rev['status']] ?>">
                                                <?= $statusText[$rev['status']] ?>
                                            </span>
                                            <?php if ($rev['status'] != 'pending' && $rev['reviewer_name']): ?>
                                                <br><small class="text-muted">oleh <?= esc($rev['reviewer_name']) ?></small>
                                            <?php endif ?>
                                        </td>
                                        <td><?= date('d/m/Y H:i', strtotime($rev['created_at'])) ?></td>
                                        <td>
                                            <?php if ($rev['review_notes']): ?>
                                                <?= character_limiter(esc($rev['review_notes']), 80) ?>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <div class="alert alert-info">
                        <strong>Informasi:</strong>
                        <ul class="mb-0">
                            <li><span class="badge bg-warning">Menunggu Review</span> - Permintaan Anda sedang ditinjau oleh admin/reviewer</li>
                            <li><span class="badge bg-success">Disetujui</span> - Permintaan disetujui, Anda dapat mengedit data</li>
                            <li><span class="badge bg-danger">Ditolak</span> - Permintaan ditolak, data tetap tidak dapat diedit</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
