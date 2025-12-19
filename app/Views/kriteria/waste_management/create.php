<?= $this->extend('layouts/sidebar_layout') ?>
<?= $this->section('content') ?>

<div class="content-area">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('waste-management') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 text-white" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);">
            <h6 class="m-0 font-weight-bold">
                <i class="fas fa-recycle me-2"></i>Form Tambah Data Waste Management
            </h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('waste-management/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="tahun" class="form-label">Tahun <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="tahun" name="tahun"
                                value="<?= old('tahun', date('Y')) ?>" required min="2000" max="2100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="jenis_sampah" class="form-label">Jenis Sampah <span class="text-danger">*</span></label>
                            <select class="form-select" id="jenis_sampah" name="jenis_sampah" required>
                                <option value="">-- Pilih Jenis Sampah --</option>
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
                        </div>
                    </div>
                </div>

                <h5 class="mt-4 mb-3">
                    <i class="fas fa-trash-alt me-2"></i>Data Sampah Berdasarkan Kategori
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="total_sampah_anorganik_bersih" class="form-label">
                                Sampah Anorganik Bersih (kg) <span class="text-danger">*</span>
                            </label>
                            <input type="number" step="0.01" class="form-control" id="total_sampah_anorganik_bersih"
                                name="total_sampah_anorganik_bersih" value="<?= old('total_sampah_anorganik_bersih') ?>" required>
                            <div class="form-text">Contoh: botol plastik, kaleng, kertas bersih</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="total_sampah_anorganik_kotor" class="form-label">
                                Sampah Anorganik Kotor (kg) <span class="text-danger">*</span>
                            </label>
                            <input type="number" step="0.01" class="form-control" id="total_sampah_anorganik_kotor"
                                name="total_sampah_anorganik_kotor" value="<?= old('total_sampah_anorganik_kotor') ?>" required>
                            <div class="form-text">Contoh: plastik kotor, kemasan makanan bekas</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="total_sampah_organik" class="form-label">
                                Sampah Organik (kg) <span class="text-danger">*</span>
                            </label>
                            <input type="number" step="0.01" class="form-control" id="total_sampah_organik"
                                name="total_sampah_organik" value="<?= old('total_sampah_organik') ?>" required>
                            <div class="form-text">Contoh: sisa makanan, daun, ranting</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="total_limbah_air" class="form-label">
                                Limbah Air (liter) <span class="text-danger">*</span>
                            </label>
                            <input type="number" step="0.01" class="form-control" id="total_limbah_air"
                                name="total_limbah_air" value="<?= old('total_limbah_air') ?>" required>
                            <div class="form-text">Air limbah dari laboratorium, kantin, dll</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="total_limbah_b3" class="form-label">
                                Limbah Berbahaya B3 (kg) <span class="text-danger">*</span>
                            </label>
                            <input type="number" step="0.01" class="form-control" id="total_limbah_b3"
                                name="total_limbah_b3" value="<?= old('total_limbah_b3') ?>" required>
                            <div class="form-text">Contoh: baterai, lampu, chemical lab</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Total Sampah Keseluruhan (Auto-calculated)</label>
                            <input type="text" class="form-control bg-light" id="preview_total" readonly>
                            <div class="form-text">Otomatis dihitung dari semua kategori di atas</div>
                        </div>
                    </div>
                </div>

                <h5 class="mt-4 mb-3">
                    <i class="fas fa-recycle me-2"></i>Program 3R (Reduce, Reuse, Recycle)
                </h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="program_reduce" class="form-label">Program Reduce <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="program_reduce"
                                name="program_reduce" value="<?= old('program_reduce') ?>" required>
                            <div class="form-text">Jumlah program pengurangan sampah</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="program_reuse" class="form-label">Program Reuse <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="program_reuse"
                                name="program_reuse" value="<?= old('program_reuse') ?>" required>
                            <div class="form-text">Jumlah program penggunaan ulang</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="program_recycle" class="form-label">Program Recycle <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="program_recycle"
                                name="program_recycle" value="<?= old('program_recycle') ?>" required>
                            <div class="form-text">Jumlah program daur ulang</div>
                        </div>
                    </div>
                </div>

                <h5 class="mt-4 mb-3">
                    <i class="fas fa-leaf me-2"></i>Fasilitas & Program Pengelolaan
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="tempat_sampah_terpilah" class="form-label">
                                Tempat Sampah Terpilah (unit) <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control" id="tempat_sampah_terpilah"
                                name="tempat_sampah_terpilah" value="<?= old('tempat_sampah_terpilah') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="kompos_organik" class="form-label">
                                Kompos Organik (kg) <span class="text-danger">*</span>
                            </label>
                            <input type="number" step="0.01" class="form-control" id="kompos_organik"
                                name="kompos_organik" value="<?= old('kompos_organik') ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="daur_ulang_persentase" class="form-label">
                                Persentase Daur Ulang (%) <span class="text-danger">*</span>
                            </label>
                            <input type="number" step="0.01" class="form-control" id="daur_ulang_persentase"
                                name="daur_ulang_persentase" value="<?= old('daur_ulang_persentase') ?>" required min="0" max="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="zero_waste_program" class="form-label">
                                Program Zero Waste <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="zero_waste_program" name="zero_waste_program" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="1" <?= old('zero_waste_program') == '1' ? 'selected' : '' ?>>Ada</option>
                                <option value="0" <?= old('zero_waste_program') == '0' ? 'selected' : '' ?>>Tidak Ada</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="bank_sampah" class="form-label">
                                Bank Sampah <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="bank_sampah" name="bank_sampah" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="1" <?= old('bank_sampah') == '1' ? 'selected' : '' ?>>Ada</option>
                                <option value="0" <?= old('bank_sampah') == '0' ? 'selected' : '' ?>>Tidak Ada</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="capaian_persen" class="form-label">
                                Capaian Persentase (%) <span class="text-danger">*</span>
                            </label>
                            <input type="number" step="0.01" class="form-control" id="capaian_persen"
                                name="capaian_persen" value="<?= old('capaian_persen') ?>" required min="0" max="100">
                        </div>
                    </div>
                </div>
                <h5 class="mt-4 mb-3">
                    <i class="fas fa-file-alt me-2"></i>Keterangan & Bukti Pendukung
                </h5>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"
                                placeholder="Tambahkan keterangan atau catatan tambahan..."><?= old('keterangan') ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label for="bukti_pendukung" class="form-label">Bukti Pendukung <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="bukti_pendukung" name="bukti_pendukung" required>
                            <div class="form-text">Format: PDF, JPG, PNG, XLSX, XLS. Maksimal: 2MB</div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('waste-management') ?>" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-2"></i>Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Auto-calculate total sampah
    function calculateTotal() {
        const anorganikBersih = parseFloat(document.getElementById('total_sampah_anorganik_bersih').value) || 0;
        const anorganikKotor = parseFloat(document.getElementById('total_sampah_anorganik_kotor').value) || 0;
        const organik = parseFloat(document.getElementById('total_sampah_organik').value) || 0;
        const limbahAir = parseFloat(document.getElementById('total_limbah_air').value) || 0;
        const limbahB3 = parseFloat(document.getElementById('total_limbah_b3').value) || 0;

        const total = anorganikBersih + anorganikKotor + organik + (limbahAir * 0.001) + limbahB3; // Convert liter to kg
        document.getElementById('preview_total').value = total.toFixed(2) + ' kg';

        // Store total for backend
        if (!document.getElementById('total_sampah_keseluruhan')) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.id = 'total_sampah_keseluruhan';
            hiddenInput.name = 'total_sampah_keseluruhan';
            document.querySelector('form').appendChild(hiddenInput);
        }
        document.getElementById('total_sampah_keseluruhan').value = total.toFixed(2);
    }

    // Add event listeners for auto-calculation
    document.getElementById('total_sampah_anorganik_bersih').addEventListener('input', calculateTotal);
    document.getElementById('total_sampah_anorganik_kotor').addEventListener('input', calculateTotal);
    document.getElementById('total_sampah_organik').addEventListener('input', calculateTotal);
    document.getElementById('total_limbah_air').addEventListener('input', calculateTotal);
    document.getElementById('total_limbah_b3').addEventListener('input', calculateTotal);

    // Initial calculation
    calculateTotal();

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const jenissampah = document.getElementById('jenis_sampah').value;
        if (!jenisampah) {
            e.preventDefault();
            alert('Silakan pilih jenis sampah terlebih dahulu!');
            return false;
        }

        const total = parseFloat(document.getElementById('total_sampah_keseluruhan').value) || 0;
        if (total <= 0) {
            e.preventDefault();
            alert('Total sampah harus lebih dari 0!');
            return false;
        }
    });
</script>
<?= $this->endSection() ?>