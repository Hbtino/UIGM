<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4">Edit Statistik: <?= esc($statistic['label']) ?></h1>

    <div class="card shadow">
        <div class="card-body">
            <form action="<?= base_url('dashboard-statistics/update/' . $statistic['id']) ?>" method="post">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="label">Label <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="label" name="label"
                                value="<?= esc($statistic['label']) ?>" required>
                            <small class="form-text text-muted">Nama/label statistik yang ditampilkan</small>
                        </div>

                        <div class="form-group">
                            <label for="value">Value <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" id="value" name="value"
                                value="<?= esc($statistic['value']) ?>" required
                                style="font-size: 24px; font-weight: bold; color: #2c3e50;">
                            <small class="form-text text-muted">
                                Nilai statistik (contoh: 80, 176, 6605, dll)
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3"><?= esc($statistic['description'] ?? '') ?></textarea>
                            <small class="form-text text-muted">Penjelasan tentang statistik ini</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="static" <?= $statistic['type'] == 'static' ? 'selected' : '' ?>>Static</option>
                                        <option value="calculated" <?= $statistic['type'] == 'calculated' ? 'selected' : '' ?>>Calculated</option>
                                        <option value="target" <?= $statistic['type'] == 'target' ? 'selected' : '' ?>>Target</option>
                                    </select>
                                    <small class="form-text text-muted">
                                        <strong>Static:</strong> Nilai tetap<br>
                                        <strong>Calculated:</strong> Dihitung otomatis<br>
                                        <strong>Target:</strong> Nilai target
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control" id="category" name="category">
                                        <option value="target" <?= $statistic['category'] == 'target' ? 'selected' : '' ?>>Target</option>
                                        <option value="current" <?= $statistic['category'] == 'current' ? 'selected' : '' ?>>Current</option>
                                        <option value="campus_info" <?= $statistic['category'] == 'campus_info' ? 'selected' : '' ?>>Campus Info</option>
                                        <option value="user_stats" <?= $statistic['category'] == 'user_stats' ? 'selected' : '' ?>>User Stats</option>
                                    </select>
                                    <small class="form-text text-muted">Kategori statistik</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title">Pengaturan</h6>

                                <div class="form-group">
                                    <label for="order">Urutan</label>
                                    <input type="number" class="form-control" id="order" name="order"
                                        value="<?= esc($statistic['order']) ?>" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select class="form-control" id="is_active" name="is_active">
                                        <option value="1" <?= $statistic['is_active'] == 1 ? 'selected' : '' ?>>Aktif</option>
                                        <option value="0" <?= $statistic['is_active'] == 0 ? 'selected' : '' ?>>Nonaktif</option>
                                    </select>
                                </div>

                                <hr>

                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-save"></i> Simpan Perubahan
                                    </button>
                                    <a href="<?= base_url('dashboard-statistics') ?>" class="btn btn-secondary btn-block">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-info text-white mt-3">
                            <div class="card-body">
                                <h6 class="card-title"><i class="fas fa-info-circle"></i> Info</h6>
                                <small>
                                    <strong>Key:</strong> <?= esc($statistic['key']) ?><br><br>

                                    <strong>Contoh Penggunaan:</strong><br>
                                    <?php if ($statistic['category'] == 'target'): ?>
                                        Nilai ini digunakan untuk menampilkan target di stat card dashboard.
                                    <?php elseif ($statistic['category'] == 'current'): ?>
                                        Nilai ini menunjukkan posisi/ranking saat ini.
                                    <?php elseif ($statistic['category'] == 'campus_info'): ?>
                                        Informasi umum tentang kampus yang ditampilkan di dashboard.
                                    <?php else: ?>
                                        Statistik umum dashboard.
                                    <?php endif; ?>
                                </small>
                            </div>
                        </div>

                        <div class="alert alert-warning mt-3">
                            <small>
                                <i class="fas fa-exclamation-triangle"></i>
                                <strong>Perhatian:</strong> Perubahan akan langsung terlihat di dashboard setelah refresh.
                            </small>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>