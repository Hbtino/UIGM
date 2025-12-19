<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-calendar-alt"></i> Manajemen Tahun UIGM
                    </h3>
                    <p class="text-muted mb-0">Kelola periode dan status tahun UIGM</p>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Tahun</th>
                                    <th>Periode</th>
                                    <th>Status</th>
                                    <th>Aktif</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($periods)): ?>
                                    <?php foreach ($periods as $period): ?>
                                        <tr>
                                            <td>
                                                <strong><?= esc($period['year']) ?></strong>
                                            </td>
                                            <td>
                                                <?= date('d/m/Y', strtotime($period['start_date'])) ?> -
                                                <?= date('d/m/Y', strtotime($period['end_date'])) ?>
                                            </td>
                                            <td>
                                                <?php
                                                $statusClass = [
                                                    'OPEN' => 'success',
                                                    'REVIEW' => 'warning',
                                                    'LOCKED' => 'danger'
                                                ];
                                                $class = $statusClass[$period['status']] ?? 'secondary';
                                                ?>
                                                <span class="badge bg-<?= $class ?>"><?= $period['status'] ?></span>
                                            </td>
                                            <td>
                                                <?php if ($period['is_active']): ?>
                                                    <span class="badge bg-primary">Aktif</span>
                                                <?php else: ?>
                                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                                        onclick="activatePeriod(<?= $period['id'] ?>)">
                                                        Aktifkan
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?= esc($period['description']) ?>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada data periode UIGM</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function activatePeriod(id) {
        if (confirm('Yakin ingin mengaktifkan periode ini? Periode lain akan dinonaktifkan.')) {
            window.location.href = `<?= base_url('uigm-periods/activate/') ?>${id}`;
        }
    }
</script>
<?= $this->endSection() ?>