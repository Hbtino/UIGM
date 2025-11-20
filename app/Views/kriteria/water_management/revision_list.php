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
        <div class="card-header py-3 text-white" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);">
            <h6 class="m-0 font-weight-bold">Daftar Permintaan Revisi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable">
                    <thead class="thead-light">
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
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><strong><?= $rev['tahun'] ?></strong></td>
                                    <td><?= esc($rev['requested_by_name']) ?></td>
                                    <td><?= character_limiter(esc($rev['alasan_revisi']), 100) ?></td>
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
                                        <?php if ($rev['status'] == 'pending'): ?>
                                            <a href="<?= base_url('water-management/review-revision/' . $rev['id']) ?>" 
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> Review
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= base_url('water-management/review-revision/' . $rev['id']) ?>" 
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-info-circle"></i> Detail
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
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
<?= $this->endSection() ?>

