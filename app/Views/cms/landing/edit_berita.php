<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h2><i class="fas fa-newspaper"></i> Kelola Berita di Landing Page</h2>
    <a href="<?= base_url('landing-contents') ?>" class="btn btn-secondary mb-3">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i> 
        <strong>Info:</strong> 3 berita terbaru yang berstatus <strong>Published</strong> akan otomatis ditampilkan di landing page.
    </div>

    <?php if (!empty($publishedNews)): ?>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Berita</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($publishedNews as $i => $news): ?>
                            <tr class="<?= $i < 3 ? 'table-success' : '' ?>">
                                <td><?= $i + 1 ?></td>
                                <td><?= esc($news['title']) ?></td>
                                <td><?= date('d M Y', strtotime($news['published_at'] ?? $news['created_at'])) ?></td>
                                <td>
                                    <?php if ($i < 3): ?>
                                        <span class="badge" style="background-color: #28a745; color: white;">Ditampilkan</span>
                                    <?php else: ?>
                                        <span class="badge" style="background-color: #dc3545; color: white;">Tidak Ditampilkan</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('news-admin/edit/' . $news['id']) ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i> 
            Belum ada berita yang dipublikasikan. 
            <a href="<?= base_url('news-admin/create') ?>" class="alert-link">Tambah berita baru</a>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>