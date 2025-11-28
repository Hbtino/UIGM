<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4">Edit Konten: <?= esc($content['title'] ?? ucfirst(str_replace('_', ' ', $section))) ?></h1>

    <div class="card shadow">
        <div class="card-body">
            <form action="<?= base_url('dashboard-contents/update/' . $section) ?>" method="post">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="<?= esc($content['title'] ?? '') ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="subtitle">Subtitle <small class="text-muted">(opsional)</small></label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle"
                                value="<?= esc($content['subtitle'] ?? '') ?>">
                        </div>

                        <div class="form-group">
                            <label for="content">Content <small class="text-muted">(untuk info box)</small></label>
                            <textarea class="form-control" id="content" name="content" rows="5"><?= esc($content['content'] ?? '') ?></textarea>
                            <small class="form-text text-muted">Konten lengkap untuk section info box</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="value">Value <small class="text-muted">(untuk stat card)</small></label>
                                    <input type="text" class="form-control" id="value" name="value"
                                        value="<?= esc($content['value'] ?? '') ?>"
                                        placeholder="Contoh: 80, 500, #50">
                                    <small class="form-text text-muted">Nilai numerik atau teks untuk stat card</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="icon">Icon <small class="text-muted">(Font Awesome)</small></label>
                                    <input type="text" class="form-control" id="icon" name="icon"
                                        value="<?= esc($content['icon'] ?? '') ?>"
                                        placeholder="Contoh: fa-chart-line">
                                    <small class="form-text text-muted">
                                        <a href="https://fontawesome.com/icons" target="_blank">Lihat icon</a>
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="color">Color <small class="text-muted">(untuk stat card)</small></label>
                                    <select class="form-control" id="color" name="color">
                                        <option value="">-- Pilih Warna --</option>
                                        <option value="blue" <?= ($content['color'] ?? '') == 'blue' ? 'selected' : '' ?>>Blue</option>
                                        <option value="green" <?= ($content['color'] ?? '') == 'green' ? 'selected' : '' ?>>Green</option>
                                        <option value="orange" <?= ($content['color'] ?? '') == 'orange' ? 'selected' : '' ?>>Orange</option>
                                        <option value="purple" <?= ($content['color'] ?? '') == 'purple' ? 'selected' : '' ?>>Purple</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="trend_type">Trend Type</label>
                                    <select class="form-control" id="trend_type" name="trend_type">
                                        <option value="">-- Pilih Trend --</option>
                                        <option value="up" <?= ($content['trend_type'] ?? '') == 'up' ? 'selected' : '' ?>>Up (Naik)</option>
                                        <option value="down" <?= ($content['trend_type'] ?? '') == 'down' ? 'selected' : '' ?>>Down (Turun)</option>
                                        <option value="target" <?= ($content['trend_type'] ?? '') == 'target' ? 'selected' : '' ?>>Target</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="trend_text">Trend Text</label>
                            <input type="text" class="form-control" id="trend_text" name="trend_text"
                                value="<?= esc($content['trend_text'] ?? '') ?>"
                                placeholder="Contoh: Target: 80%, dari #896">
                            <small class="form-text text-muted">Teks yang ditampilkan di bawah stat card</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title">Pengaturan</h6>

                                <div class="form-group">
                                    <label for="order">Urutan</label>
                                    <input type="number" class="form-control" id="order" name="order"
                                        value="<?= esc($content['order'] ?? 0) ?>" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select class="form-control" id="is_active" name="is_active">
                                        <option value="1" <?= ($content['is_active'] ?? 1) == 1 ? 'selected' : '' ?>>Aktif</option>
                                        <option value="0" <?= ($content['is_active'] ?? 1) == 0 ? 'selected' : '' ?>>Nonaktif</option>
                                    </select>
                                </div>

                                <hr>

                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-save"></i> Simpan Perubahan
                                    </button>
                                    <a href="<?= base_url('dashboard-contents') ?>" class="btn btn-secondary btn-block">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-info text-white mt-3">
                            <div class="card-body">
                                <h6 class="card-title"><i class="fas fa-info-circle"></i> Panduan</h6>
                                <small>
                                    <strong>Section:</strong> <?= esc($section) ?><br><br>

                                    <?php if (strpos($section, 'stat_card') !== false): ?>
                                        <strong>Stat Card:</strong><br>
                                        - Isi <strong>Value</strong> dengan angka<br>
                                        - Pilih <strong>Icon</strong> dan <strong>Color</strong><br>
                                        - Atur <strong>Trend</strong> jika perlu
                                    <?php elseif ($section == 'info_box'): ?>
                                        <strong>Info Box:</strong><br>
                                        - Isi <strong>Title</strong> dan <strong>Content</strong><br>
                                        - Icon akan otomatis muncul
                                    <?php else: ?>
                                        <strong>Text Content:</strong><br>
                                        - Isi <strong>Title</strong> atau <strong>Subtitle</strong><br>
                                        - Sesuaikan dengan kebutuhan
                                    <?php endif; ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>