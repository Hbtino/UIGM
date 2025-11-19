<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Tambah Data Setting & Infrastructure</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>

                <form action="/setting-infrastructure/store" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tahun Periode <span class="text-danger">*</span></label>
                                <input type="number" name="tahun" class="form-control" value="<?= old('tahun') ?>" required>
                            </div>
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">Data Luas Area</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Luas Total Kampus (m²) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="luas_total" id="luas_total" class="form-control" value="<?= old('luas_total') ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Luas Ruang Terbuka (m²) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="luas_ruang_terbuka" id="luas_ruang_terbuka" class="form-control" value="<?= old('luas_ruang_terbuka') ?>" required>
                                <small class="text-muted">Tidak boleh melebihi luas total</small>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <strong>Persentase Area Hijau:</strong> <span id="preview_area_hijau">0%</span>
                        <br><small>Dihitung otomatis: (Ruang Terbuka / Luas Total) × 100</small>
                    </div>

                    <h5 class="mt-4 mb-3">Detail Area Hijau</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Vegetasi Hutan (m²)</label>
                                <input type="number" step="0.01" name="vegetasi_hutan" class="form-control" value="<?= old('vegetasi_hutan', 0) ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Area Tanaman (m²)</label>
                                <input type="number" step="0.01" name="area_tanaman" class="form-control" value="<?= old('area_tanaman', 0) ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Area Resapan Air (m²)</label>
                                <input type="number" step="0.01" name="area_resapan" class="form-control" value="<?= old('area_resapan', 0) ?>">
                            </div>
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">Anggaran & Pemeliharaan</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Persentase Anggaran (%)</label>
                                <input type="number" step="0.01" name="persentase_anggaran" id="persentase_anggaran" class="form-control" value="<?= old('persentase_anggaran', 0) ?>" min="0" max="100">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Persentase Pemeliharaan (%)</label>
                                <input type="number" step="0.01" name="persentase_pemeliharaan" id="persentase_pemeliharaan" class="form-control" value="<?= old('persentase_pemeliharaan', 0) ?>" min="0" max="100">
                            </div>
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">Fasilitas</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Fasilitas Disabilitas</label>
                                <textarea name="fasilitas_disabilitas" class="form-control" rows="3"><?= old('fasilitas_disabilitas') ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Fasilitas Energi Terbarukan</label>
                                <textarea name="fasilitas_energi_terbarukan" class="form-control" rows="3"><?= old('fasilitas_energi_terbarukan') ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-success">
                        <strong>Capaian Persen (Otomatis):</strong> <span id="preview_capaian">0%</span>
                        <br><small>Formula: (Area Hijau × 40%) + (Anggaran × 30%) + (Pemeliharaan × 30%)</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3"><?= old('keterangan') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bukti Pendukung <span class="text-danger">*</span></label>
                        <input type="file" name="bukti_pendukung" class="form-control" required>
                        <small class="text-muted">Format: PDF, JPG, PNG, XLSX (Max: 2MB)</small>
                    </div>

                    <div class="alert alert-warning">
                        <strong>Catatan:</strong> Data yang Anda input akan berstatus <strong>Pending</strong> dan menunggu verifikasi dari admin/reviewer.
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                        <a href="/setting-infrastructure" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const luasTotal = document.getElementById('luas_total');
    const luasRuangTerbuka = document.getElementById('luas_ruang_terbuka');
    const persentaseAnggaran = document.getElementById('persentase_anggaran');
    const persentasePemeliharaan = document.getElementById('persentase_pemeliharaan');
    const previewAreaHijau = document.getElementById('preview_area_hijau');
    const previewCapaian = document.getElementById('preview_capaian');
    
    function calculate() {
        const total = parseFloat(luasTotal.value) || 0;
        const terbuka = parseFloat(luasRuangTerbuka.value) || 0;
        const anggaran = parseFloat(persentaseAnggaran.value) || 0;
        const pemeliharaan = parseFloat(persentasePemeliharaan.value) || 0;
        
        // Calculate area hijau percentage
        let areaHijau = 0;
        if (total > 0) {
            areaHijau = ((terbuka / total) * 100).toFixed(2);
            previewAreaHijau.textContent = areaHijau + '%';
        } else {
            previewAreaHijau.textContent = '0%';
        }
        
        // Calculate capaian persen
        const capaian = (
            (parseFloat(areaHijau) * 0.4) +
            (anggaran * 0.3) +
            (pemeliharaan * 0.3)
        ).toFixed(2);
        
        previewCapaian.textContent = capaian + '%';
    }
    
    luasTotal.addEventListener('input', calculate);
    luasRuangTerbuka.addEventListener('input', calculate);
    persentaseAnggaran.addEventListener('input', calculate);
    persentasePemeliharaan.addEventListener('input', calculate);
});
</script>

<?= $this->endSection() ?>
