<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Berita</h1>
        <a href="<?= base_url('news-admin') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= base_url('news-admin/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="title">Judul Berita *</label>
                    <input type="text" class="form-control <?= session('errors.title') ? 'is-invalid' : '' ?>"
                        id="title" name="title" value="<?= old('title') ?>" required>
                    <?php if (session('errors.title')): ?>
                        <div class="invalid-feedback"><?= session('errors.title') ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="slug">Slug (URL)</label>
                    <input type="text" class="form-control <?= session('errors.slug') ? 'is-invalid' : '' ?>"
                        id="slug" name="slug" value="<?= old('slug') ?>">
                    <small class="form-text text-muted">Kosongkan untuk generate otomatis dari judul</small>
                    <?php if (session('errors.slug')): ?>
                        <div class="invalid-feedback"><?= session('errors.slug') ?></div>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category">Kategori *</label>
                            <input type="text" class="form-control <?= session('errors.category') ? 'is-invalid' : '' ?>"
                                id="category" name="category" value="<?= old('category') ?>" required>
                            <?php if (session('errors.category')): ?>
                                <div class="invalid-feedback"><?= session('errors.category') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="is_published">Status *</label>
                            <select class="form-control" id="is_published" name="is_published" required>
                                <option value="0" <?= old('is_published') === '0' ? 'selected' : '' ?>>Draft</option>
                                <option value="1" <?= old('is_published') === '1' ? 'selected' : '' ?>>Published</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="excerpt">Ringkasan</label>
                    <textarea class="form-control" id="excerpt" name="excerpt" rows="3"><?= old('excerpt') ?></textarea>
                </div>

                <div class="form-group">
                    <label for="content">Konten *</label>
                    <textarea class="form-control <?= session('errors.content') ? 'is-invalid' : '' ?>"
                        id="content" name="content" rows="10" required><?= old('content') ?></textarea>
                    <?php if (session('errors.content')): ?>
                        <div class="invalid-feedback"><?= session('errors.content') ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="image">Gambar</label>
                    <input type="file" class="form-control-file <?= session('errors.image') ? 'is-invalid' : '' ?>"
                        id="image" name="image" accept="image/*">
                    <small class="form-text text-muted">Format: JPG, PNG, GIF. Max: 2MB</small>
                    <?php if (session('errors.image')): ?>
                        <div class="invalid-feedback"><?= session('errors.image') ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="published_at">Tanggal Publikasi</label>
                    <input type="datetime-local" class="form-control" id="published_at" name="published_at"
                        value="<?= old('published_at', date('Y-m-d\TH:i')) ?>">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="<?= base_url('news-admin') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Auto-generate slug from title
    document.getElementById('title').addEventListener('blur', function() {
        const slugInput = document.getElementById('slug');
        if (!slugInput.value) {
            const slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
            slugInput.value = slug;
        }
    });
</script>
<?= $this->endSection() ?>