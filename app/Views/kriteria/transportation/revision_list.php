<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Daftar Permintaan Revisi Transportation</h4>
                <a href="/transportation" class="btn btn-light btn-sm">Kembali ke Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tahun Data</th>
                                <th>Diminta Oleh</th>
                                <th>Alasan Revisi</th>
                                <th>Status</th>
                                <th>Tanggal Request</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($revisions)): ?>
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada permintaan revisi</td>
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
                                    
                                    // Get transportation data
                                    $transportData = json_decode($rev['data_revisi'], true);
                                    $tahun = $transportData['tahun'] ?? '-';
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><strong><?= $tahun ?></strong></td>
                                        <td><?= esc($rev['requester_name']) ?></td>
                                        <td>
                                            <?= character_limiter(esc($rev['alasan_revisi']), 100) ?>
                                        </td>
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
                                            <?php if ($rev['status'] == 'pending'): ?>
                                                <a href="/transportation/review-revision/<?= $rev['id'] ?>" class="btn btn-sm btn-primary">
                                                    Review
                                                </a>
                                            <?php else: ?>
                                                <a href="/transportation/review-revision/<?= $rev['id'] ?>" class="btn btn-sm btn-info">
                                                    Lihat Detail
                                                </a>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <h5>Statistik Permintaan Revisi:</h5>
                    <?php
                    $pending = count(array_filter($revisions, fn($r) => $r['status'] == 'pending'));
                    $approved = count(array_filter($revisions, fn($r) => $r['status'] == 'approved'));
                    $rejected = count(array_filter($revisions, fn($r) => $r['status'] == 'rejected'));
                    ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-warning text-dark">
                                <div class="card-body text-center">
                                    <h3><?= $pending ?></h3>
                                    <p class="mb-0">Menunggu Review</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h3><?= $approved ?></h3>
                                    <p class="mb-0">Disetujui</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-danger text-white">
                                <div class="card-body text-center">
                                    <h3><?= $rejected ?></h3>
                                    <p class="mb-0">Ditolak</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
