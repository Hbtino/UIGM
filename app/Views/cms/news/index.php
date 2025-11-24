<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Berita</h1>
        <a href="<?= base_url('news-admin/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Berita
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="15%">Gambar</th>
                            <th width="25%">Judul</th>
                            <th width="15%">Kategori</th>
                            <th width="10%">Status</th>
                            <th width="15%">Tanggal</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($news)): ?>
                            <?php foreach ($news as $item): ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td>
                                        <?php if (!empty($item['image'])): ?>
                                            <img src="<?= base_url('uploads/news/' . $item['image']) ?>"
                                                alt="<?= esc($item['title']) ?>"
                                                class="img-thumbnail"
                                                style="max-width: 100px;">
                                        <?php else: ?>
                                            <span class="text-muted">No image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($item['title']) ?></td>
                                    <td><?= esc($item['category'] ?? 'Umum') ?></td>
                                    <td>
                                        <?php if (isset($item['is_published']) && $item['is_published'] == 1): ?>
                                            <span class="badge badge-success">Published</span>
                                        <?php else: ?>
                                            <span class="badge badge-warning">Draft</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $date = $item['published_at'] ?? $item['created_at'];
                                        echo $date ? date('d M Y', strtotime($date)) : '-';
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('news-admin/edit/' . $item['id']) ?>"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="deleteNews(<?= $item['id'] ?>)"
                                            class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Belum ada berita</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteNews(id) {
        if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
            fetch('<?= base_url('news-admin/delete/') ?>' + id, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message || 'Gagal menghapus berita');
                    }
                })
                .catch(error => {
                    alert('Terjadi kesalahan');
                    console.error(error);
                });
        }
    }
</script>
<?= $this->endSection() ?>