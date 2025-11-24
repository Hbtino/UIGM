<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Berita</h1>
        <a href="<?= base_url('news-admin') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= base_url('news-admin/update/' . $news['id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="title">Judul Berita *</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="<?= old('title', $news['title']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="slug">Slug (URL) *</label>
                    <input type="text" class="form-control" id="slug" name="slug"
                        value="<?= old('slug', $news['slug']) ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category">Kategori *</label>
                            <input type="text" class="form-control" id="category" name="category"
                                value="<?= old('category', $news['category']) ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="is_published">Status *</label>
                            <select class="form-control" id="is_published" name="is_published" required>
                                <option value="0" <?= old('is_published', $news['is_published']) == 0 ? 'selected' : '' ?>>Draft</option>
                                <option value="1" <?= old('is_published', $news['is_published']) == 1 ? 'selected' : '' ?>>Published</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="excerpt">Ringkasan</label>
                    <textarea class="form-control" id="excerpt" name="excerpt" rows="3"><?= old('excerpt', $news['excerpt']) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="content">Konten *</label>
                    <textarea class="form-control" id="content" name="content" rows="10" required><?= old('content', $news['content']) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Gambar</label>
                    <?php if (!empty($news['image'])): ?>
                        <div class="mb-2">
                            <img src="<?= base_url('uploads/news/' . $news['image']) ?>"
                                alt="Current" class="img-thumbnail" style="max-width: 200px;">
                            <p class="text-muted small">Gambar saat ini</p>
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                    <small class="text-muted">Upload gambar baru untuk mengganti</small>
                </div>

                <div class="form-group">
                    <label for="published_at">Tanggal Publikasi</label>
                    <?php
                    $pubDate = $news['published_at'] ?? $news['created_at'];
                    $formattedDate = $pubDate ? date('Y-m-d\TH:i', strtotime($pubDate)) : date('Y-m-d\TH:i');
                    ?>
                    <input type="datetime-local" class="form-control" id="published_at" name="published_at"
                        value="<?= old('published_at', $formattedDate) ?>">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="<?= base_url('news-admin') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>