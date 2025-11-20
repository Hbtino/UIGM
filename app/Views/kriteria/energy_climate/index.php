<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header  text-white d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%) !important;">
                <h4 class="mb-0"><?= $title ?></h4>
                <?php if (in_array(session()->get('role'), ['admin', 'kaprodi'])): ?>
                    <a href="<?= base_url('energy-climate/create') ?>" class="btn btn-light btn-sm">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                <?php endif; ?>
            </div>

            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Total Konsumsi (kWh)</th>
                            <th>Energi Terbarukan (%)</th>
                            <th>Capaian (%)</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($energyClimate)): ?>
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($energyClimate as $item): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $item['tahun'] ?></td>
                                    <td><?= number_format($item['total_konsumsi_listrik'], 2) ?></td>
                                    <td><?= number_format($item['persentase_energi_terbarukan'], 2) ?>%</td>
                                    <td><?= number_format($item['capaian_persen'], 2) ?>%</td>
                                    <td>
                                        <?php if ($item['status_verifikasi'] === 'pending'): ?>
                                            <span class="badge badge-warning">Pending</span>
                                        <?php elseif ($item['status_verifikasi'] === 'approved'): ?>
                                            <span class="badge badge-success">Approved</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Rejected</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <?php if ($item['bukti_pendukung']): ?>
                                                <a href="<?= base_url('energy-climate/download/' . $item['id']) ?>" 
                                                   class="btn btn-sm btn-info" title="Download">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            <?php endif; ?>

                                            <?php if (in_array(session()->get('role'), ['admin', 'reviewer']) && $item['status_verifikasi'] === 'pending'): ?>
                                                <a href="<?= base_url('energy-climate/verify/' . $item['id']) ?>" 
                                                   class="btn btn-sm btn-warning" title="Verifikasi">
                                                    <i class="fas fa-check-circle"></i>
                                                </a>
                                            <?php endif; ?>

                                            <?php 
                                            $canEdit = false;
                                            if (session()->get('role') === 'admin') {
                                                $canEdit = true;
                                            } elseif ($item['status_verifikasi'] === 'pending' && $item['created_by'] == session()->get('user_id')) {
                                                $canEdit = true;
                                            }
                                            ?>

                                            <?php if ($canEdit): ?>
                                                <a href="<?= base_url('energy-climate/edit/' . $item['id']) ?>" 
                                                   class="btn btn-sm btn-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            <?php endif; ?>

                                            <?php if (session()->get('role') === 'admin'): ?>
                                                <a href="<?= base_url('energy-climate/delete/' . $item['id']) ?>" 
                                                   class="btn btn-sm btn-danger" 
                                                   onclick="return confirm('Yakin ingin menghapus data ini?')" 
                                                   title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            <?php endif; ?>

                                            <?php if ($item['status_verifikasi'] === 'approved'): ?>
                                                <a href="<?= base_url('energy-climate/request-revision/' . $item['id']) ?>" 
                                                   class="btn btn-sm btn-secondary" title="Request Revisi">
                                                    <i class="fas fa-redo"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            <?php if (in_array(session()->get('role'), ['admin', 'reviewer'])): ?>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <a href="<?= base_url('energy-climate/revisions') ?>" class="btn btn-block text-white" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);"">
                            <i class="fas fa-list"></i> Lihat Permintaan Revisi
                        </a>
                    </div>
                    <div class="col-md-6 mb-2">
                        <a href="<?= base_url('energy-climate/my-revisions') ?>" class="btn btn-block text-white" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);"><i class="fas fa-user"></i> Revisi Saya
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <a href="<?= base_url('energy-climate/my-revisions') ?>" class="btn btn-block text-white" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);"><i class="fas fa-user"></i> Revisi Saya
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

