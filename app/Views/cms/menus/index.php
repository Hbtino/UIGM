<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between mb-4">
        <h2><i class="fas fa-bars"></i> Manajemen Menu</h2>
        <a href="<?= base_url('menus/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Menu
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>URL</th>
                        <th>Icon</th>
                        <th>Tipe</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($menus)): ?>
                        <tr><td colspan="8" class="text-center">Belum ada menu</td></tr>
                    <?php else: ?>
                        <?php foreach ($menus as $i => $m): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= esc($m['title']) ?></td>
                                <td><code><?= esc($m['url']) ?></code></td>
                                <td><?= $m['icon'] ? '<i class="'.$m['icon'].'"></i>' : '-' ?></td>
                                <td><span class="badge bg-<?= ($m['menu_type']??'dashboard')=='dashboard'?'primary':'info' ?>"><?= ucfirst($m['menu_type']??'dashboard') ?></span></td>
                                <td><?= $m['order'] ?></td>
                                <td><span class="badge bg-<?= $m['is_active']?'success':'secondary' ?>"><?= $m['is_active']?'Aktif':'Nonaktif' ?></span></td>
                                <td>
                                    <a href="<?= base_url('menus/edit/'.$m['id']) ?>" class="btn btn-sm btn-warning" title="Edit Menu">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('menus/delete/'.$m['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus menu <?= esc($m['title']) ?>?')" title="Hapus Menu">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
