<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Konten: <?= ucfirst($section) ?></h1>
        <a href="<?= base_url('landing-contents') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="<?= base_url('landing-contents/update/' . $section) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label for="title">Judul *</label>
                    <input type="text" class="form-control" id="title" name="title" 
                           value="<?= old('title', $content['title'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label for="subtitle">Subtitle</label>
                    <input type="text" class="form-control" id="subtitle" name="subtitle" 
                           value="<?= old('subtitle', $content['subtitle'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="content">Konten *</label>
                    <textarea class="form-control" id="content" name="content" rows="10" required><?= old('content', $content['content'] ?? '') ?></textarea>
                    <small class="text-muted">Gunakan HTML untuk formatting</small>
                </div>

                <div class="form-group">
                    <label for="image">Gambar</label>
                    <?php if (!empty($content['image'])): ?>
                        <div class="mb-2">
                            <img src="<?= base_url('uploads/landing/' . $content['image']) ?>" 
                                 class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="button_text">Text Tombol</label>
                            <input type="text" class="form-control" id="button_text" name="button_text" 
                                   value="<?= old('button_text', $content['button_text'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="button_url">URL Tombol</label>
                            <input type="text" class="form-control" id="button_url" name="button_url" 
                                   value="<?= old('button_url', $content['button_url'] ?? '') ?>">
                        </div>
                    </div>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" 
                           <?= (old('is_active', $content['is_active'] ?? 1) == 1) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="is_active">Aktif</label>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="<?= base_url('landing-contents') ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>