<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4">Konten Dashboard</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Konten Dashboard</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Section</th>
                            <th width="25%">Title</th>
                            <th width="15%">Value</th>
                            <th width="10%">Icon</th>
                            <th width="10%">Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($contents)): ?>
                            <?php foreach ($contents as $index => $content): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td>
                                        <span class="badge badge-secondary"><?= esc($content['section']) ?></span>
                                    </td>
                                    <td><?= esc($content['title']) ?></td>
                                    <td>
                                        <?php if (!empty($content['value'])): ?>
                                            <strong><?= esc($content['value']) ?></strong>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($content['icon'])): ?>
                                            <i class="fas <?= esc($content['icon']) ?>"></i>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($content['is_active']): ?>
                                            <span class="badge badge-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary">Nonaktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('dashboard-contents/edit/' . $content['section']) ?>"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i>
        <strong>Informasi:</strong> Konten dashboard digunakan untuk menampilkan informasi di halaman dashboard utama.
    </div>
</div>

<?= $this->endSection() ?>