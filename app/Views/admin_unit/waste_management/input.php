<?= $this->extend('layouts/user_sidebar_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%); color: white;">
                    <h3 class="card-title">
                        <i class="fas fa-recycle mr-2"></i>
                        Input Data Pengelolaan Limbah - Unit <?= $user_unit ?? 'Admin Unit' ?>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Form Input -->
                            <form action="<?= base_url('admin-unit-dashboard/store-waste-data') ?>" method="post" id="wasteForm">
                                <?= csrf_field() ?>

                                <div class="row">
                                    <!-- Tanggal -->
                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control <?= isset($validation) && $validation->hasError('tanggal') ? 'is-invalid' : '' ?>"
                                            id="tanggal" name="tanggal" value="<?= old('tanggal', date('Y-m-d')) ?>" required>
                                        <?php if (isset($validation) && $validation->hasError('tanggal')): ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('tanggal') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Gedung -->
                                    <div class="col-md-6 mb-3">
                                        <label for="gedung" class="form-label">Gedung/Lokasi di Unit <?= $user_unit ?? 'Anda' ?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control <?= isset($validation) && $validation->hasError('gedung') ? 'is-invalid' : '' ?>"
                                            id="gedung" name="gedung" value="<?= old('gedung') ?>"
                                            placeholder="Contoh: Gedung A, Lab Kimia, Kantin Unit <?= $user_unit ?? 'Anda' ?>" required>
                                        <?php if (isset($validation) && $validation->hasError('gedung')): ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('gedung') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Jenis Sampah -->
                                <div class="mb-3">
                                    <label for="jenis_sampah" class="form-label">Jenis Sampah <span class="text-danger">*</span></label>
                                    <select class="form-select <?= isset($validation) && $validation->hasError('jenis_sampah') ? 'is-invalid' : '' ?>"
                                        id="jenis_sampah" name="jenis_sampah" required onchange="updateSatuanOptions()">
                                        <option value="">Pilih Jenis Sampah</option>
                                        <option value="sampah_anorganik_bersih" <?= old('jenis_sampah') == 'sampah_anorganik_bersih' ? 'selected' : '' ?>>
                                            Sampah Anorganik Bersih
                                        </option>
                                        <option value="sampah_anorganik_kotor" <?= old('jenis_sampah') == 'sampah_anorganik_kotor' ? 'selected' : '' ?>>
                                            Sampah Anorganik Kotor
                                        </option>
                                        <option value="sampah_organik" <?= old('jenis_sampah') == 'sampah_organik' ? 'selected' : '' ?>>
                                            Sampah Organik
                                        </option>
                                        <option value="limbah_air" <?= old('jenis_sampah') == 'limbah_air' ? 'selected' : '' ?>>
                                            Limbah Air
                                        </option>
                                        <option value="limbah_b3" <?= old('jenis_sampah') == 'limbah_b3' ? 'selected' : '' ?>>
                                            Limbah Berbahaya (B3)
                                        </option>
                                    </select>
                                    <?php if (isset($validation) && $validation->hasError('jenis_sampah')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('jenis_sampah') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="row">
                                    <!-- Jumlah -->
                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah" class="form-label">Jumlah <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" min="0.01"
                                            class="form-control <?= isset($validation) && $validation->hasError('jumlah') ? 'is-invalid' : '' ?>"
                                            id="jumlah" name="jumlah" value="<?= old('jumlah') ?>"
                                            placeholder="Masukkan jumlah" required>
                                        <?php if (isset($validation) && $validation->hasError('jumlah')): ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('jumlah') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Satuan -->
                                    <div class="col-md-6 mb-3">
                                        <label for="satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
                                        <select class="form-select <?= isset($validation) && $validation->hasError('satuan') ? 'is-invalid' : '' ?>"
                                            id="satuan" name="satuan" required>
                                            <option value="">Pilih Satuan</option>
                                            <option value="kg" <?= old('satuan') == 'kg' ? 'selected' : '' ?>>Kilogram (kg)</option>
                                            <option value="liter" <?= old('satuan') == 'liter' ? 'selected' : '' ?>>Liter (L)</option>
                                        </select>
                                        <?php if (isset($validation) && $validation->hasError('satuan')): ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('satuan') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Info Satuan -->
                                <div class="alert alert-info" id="satuanInfo" style="display: none;">
                                    <h6><i class="fas fa-info-circle"></i> Informasi Satuan</h6>
                                    <p class="mb-0" id="satuanText"></p>
                                </div>

                                <!-- Tombol Submit -->
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="reset" class="btn btn-secondary me-md-2">
                                        <i class="fas fa-undo"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Simpan Data
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-4">
                            <!-- Panduan Input -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-question-circle mr-2"></i>
                                        Panduan Input Data Unit <?= $user_unit ?? 'Admin Unit' ?>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <h6>Jenis Sampah & Satuan:</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-recycle text-primary"></i>
                                            <strong>Sampah Anorganik Bersih:</strong><br>
                                            <small class="text-muted">Satuan: Kilogram (kg)<br>
                                                Contoh: Botol plastik, kaleng, kertas</small>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-trash text-warning"></i>
                                            <strong>Sampah Anorganik Kotor:</strong><br>
                                            <small class="text-muted">Satuan: Kilogram (kg)<br>
                                                Contoh: Plastik bekas makanan</small>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-leaf text-success"></i>
                                            <strong>Sampah Organik:</strong><br>
                                            <small class="text-muted">Satuan: Kilogram (kg)<br>
                                                Contoh: Sisa makanan, daun</small>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-tint text-info"></i>
                                            <strong>Limbah Air:</strong><br>
                                            <small class="text-muted">Satuan: Liter (L)<br>
                                                Contoh: Air bekas lab, air kotor</small>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-exclamation-triangle text-danger"></i>
                                            <strong>Limbah Berbahaya (B3):</strong><br>
                                            <small class="text-muted">Satuan: kg atau L<br>
                                                Contoh: Bahan kimia, baterai</small>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Tips -->
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-lightbulb mr-2"></i>
                                        Tips Input Data untuk Admin Unit
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success"></i> Pastikan data akurat dari unit <?= $user_unit ?? 'Anda' ?></li>
                                        <li><i class="fas fa-check text-success"></i> Isi tanggal sesuai waktu pengumpulan</li>
                                        <li><i class="fas fa-check text-success"></i> Sebutkan lokasi dengan jelas</li>
                                        <li><i class="fas fa-check text-success"></i> Pilih satuan yang tepat</li>
                                        <li><i class="fas fa-check text-success"></i> Data akan diverifikasi admin pusat</li>
                                        <li><i class="fas fa-check text-success"></i> Anda bertanggung jawab atas data unit</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateSatuanOptions() {
        const jenisSampah = document.getElementById('jenis_sampah').value;
        const satuanSelect = document.getElementById('satuan');
        const satuanInfo = document.getElementById('satuanInfo');
        const satuanText = document.getElementById('satuanText');

        // Reset options
        satuanSelect.innerHTML = '<option value="">Pilih Satuan</option>';

        if (jenisSampah === 'sampah_anorganik_bersih' || jenisSampah === 'sampah_anorganik_kotor' || jenisSampah === 'sampah_organik') {
            // Sampah padat - hanya kg
            satuanSelect.innerHTML += '<option value="kg">Kilogram (kg)</option>';
            satuanSelect.value = 'kg';
            satuanInfo.style.display = 'block';
            satuanText.textContent = 'Sampah anorganik dan organik menggunakan satuan berat (kilogram).';
        } else if (jenisSampah === 'limbah_air') {
            // Limbah air - hanya liter
            satuanSelect.innerHTML += '<option value="liter">Liter (L)</option>';
            satuanSelect.value = 'liter';
            satuanInfo.style.display = 'block';
            satuanText.textContent = 'Limbah air menggunakan satuan volume (liter).';
        } else if (jenisSampah === 'limbah_b3') {
            // Limbah B3 - bisa kg atau liter
            satuanSelect.innerHTML += '<option value="kg">Kilogram (kg)</option>';
            satuanSelect.innerHTML += '<option value="liter">Liter (L)</option>';
            satuanInfo.style.display = 'block';
            satuanText.textContent = 'Limbah berbahaya (B3) dapat menggunakan satuan berat (kg) atau volume (liter) tergantung jenis limbahnya.';
        } else {
            satuanInfo.style.display = 'none';
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateSatuanOptions();
    });
</script>

<?= $this->endSection() ?>