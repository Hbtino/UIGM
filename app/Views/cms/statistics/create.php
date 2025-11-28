<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4">Tambah Statistik Baru</h1>

    <div class="card shadow">
        <div class="card-body">
            <form action="<?= base_url('dashboard-statistics/store') ?>" method="post">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="key">Key <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="key" name="key" required
                                placeholder="Contoh: skor_capaian_2024">
                            <small class="form-text text-muted">
                                Identifier unik untuk statistik (gunakan huruf kecil, angka, dan underscore)
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="label">Label <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="label" name="label" required
                                placeholder="Contoh: Skor Capaian 2024">
                            <small class="form-text text-muted">Nama/label statistik yang ditampilkan</small>
                        </div>

                        <div class="form-group">
                            <label for="value">Value <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" id="value" name="value" required
                                placeholder="Contoh: 75"
                                style="font-size: 24px; font-weight: bold; color: #2c3e50;">
                            <small class="form-text text-muted">
                                Nilai statistik (contoh: 80, 176, 6605, dll)
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                placeholder="Penjelasan tentang statistik ini"></textarea>
                            <small class="form-text text-muted">Penjelasan tentang statistik ini</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Type <span class="text-danger">*</span></label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="static">Static</option>
                                        <option value="calculated">Calculated</option>
                                        <option value="target">Target</option>
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
                                    <label for="category">Category <span class="text-danger">*</span></label>
                                    <select class="form-control" id="category" name="category" required>
                                        <option value="target">Target</option>
                                        <option value="current">Current</option>
                                        <option value="campus_info">Campus Info</option>
                                        <option value="user_stats">User Stats</option>
                                        <option value="other">Other</option>
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
                                        value="0" min="0">
                                    <small class="form-text text-muted">Urutan tampilan (semakin kecil semakin atas)</small>
                                </div>

                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select class="form-control" id="is_active" name="is_active">
                                        <option value="1" selected>Aktif</option>
                                        <option value="0">Nonaktif</option>
                                    </select>
                                </div>

                                <hr>

                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-success btn-block">
                                        <i class="fas fa-save"></i> Simpan Statistik
                                    </button>
                                    <a href="<?= base_url('dashboard-statistics') ?>" class="btn btn-secondary btn-block">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-info text-white mt-3">
                            <div class="card-body">
                                <h6 class="card-title"><i class="fas fa-lightbulb"></i> Tips</h6>
                                <small>
                                    <strong>Key:</strong> Harus unik dan tidak boleh sama dengan yang sudah ada<br><br>

                                    <strong>Contoh Key:</strong><br>
                                    - skor_capaian_2024<br>
                                    - total_mahasiswa_aktif<br>
                                    - ranking_nasional_2024<br><br>

                                    <strong>Value:</strong> Bisa berupa angka atau teks
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