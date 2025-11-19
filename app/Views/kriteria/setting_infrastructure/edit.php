<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header bg-warning">
                <h4 class="mb-0">Edit Data Setting & Infrastructure</h4>
            </div>
            <div class="card-body">
                <?php if ($data_item['status_verifikasi'] == 'approved'): ?>
                    <div class="alert alert-warning">
                        <strong>Perhatian:</strong> Data ini sudah disetujui. Perubahan akan mengubah status menjadi "Pending" dan memerlukan verifikasi ulang.
                    </div>
                <?php endif ?>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>

                <form action="/setting-infrastructure/update/<?= $data_item['id'] ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tahun Periode <span class="text-danger">*</span></label>
                                <input type="number" name="tahun" class="form-control" value="<?= old('tahun', $data_item['tahun']) ?>" required>
                            </div>
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">Data Luas Area</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Luas Total Kampus (m²) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="luas_total" id="luas_total" class="form-control" value="<?= old('luas_total', $data_item['luas_total']) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Luas Ruang Terbuka (m²) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="luas_ruang_terbuka" id="luas_ruang_terbuka" class="form-control" value="<?= old('luas_ruang_terbuka', $data_item['luas_ruang_terbuka']) ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <strong>Persentase Saat Ini:</strong> <?= $data_item['persentase_area_hijau'] ?>%
                        <br><strong>Persentase Baru:</strong> <span id="preview_area_hijau"><?= $data_item['persentase_area_hijau'] ?>%</span>
                    </div>

                    <h5 class="mt-4 mb-3">Detail Area Hijau</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Vegetasi Hutan (m²)</label>
                                <input type="number" step="0.01" name="vegetasi_hutan" class="form-control" value="<?= old('vegetasi_hutan', $data_item['vegetasi_hutan']) ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Area Tanaman (m²)</label>
                                <input type="number" step="0.01" name="area_tanaman" class="form-control" value="<?= old('area_tanaman', $data_item['area_tanaman']) ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Area Resapan Air (m²)</label>
                                <input type="number" step="0.01" name="area_resapan" class="form-control" value="<?= old('area_resapan', $data_item['area_resapan']) ?>">
                            </div>
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">Anggaran & Pemeliharaan</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Persentase Anggaran (%)</label>
                                <input type="number" step="0.01" name="persentase_anggaran" id="persentase_anggaran" class="form-control" value="<?= old('persentase_anggaran', $data_item['persentase_anggaran']) ?>" min="0" max="100">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Persentase Pemeliharaan (%)</label>
                                <input type="number" step="0.01" name="persentase_pemeliharaan" id="persentase_pemeliharaan" class="form-control" value="<?= old('persentase_pemeliharaan', $data_item['persentase_pemeliharaan']) ?>" min="0" max="100">
                            </div>
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">Fasilitas</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Fasilitas Disabilitas</label>
                                <textarea name="fasilitas_disabilitas" class="form-control" rows="3"><?= old('fasilitas_disabilitas', $data_item['fasilitas_disabilitas']) ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Fasilitas Energi Terbarukan</label>
                                <textarea name="fasilitas_energi_terbarukan" class="form-control" rows="3"><?= old('fasilitas_energi_terbarukan', $data_item['fasilitas_energi_terbarukan']) ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-success">
                        <strong>Capaian Saat Ini:</strong> <?= $data_item['capaian_persen'] ?>%
                        <br><strong>Capaian Baru:</strong> <span id="preview_capaian"><?= $data_item['capaian_persen'] ?>%</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3"><?= old('keterangan', $data_item['keterangan']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bukti Pendukung</label>
                        <?php if ($data_item['bukti_pendukung']): ?>
                            <div class="mb-2">
                                <a href="/setting-infrastructure/download/<?= $data_item['id'] ?>" class="btn btn-sm btn-info">
                                    Download File Saat Ini
                                </a>
                            </div>
                        <?php endif ?>
                        <input type="file" name="bukti_pendukung" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah file. Format: PDF, JPG, PNG, XLSX (Max: 2MB)</small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">Update Data</button>
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
        
        let areaHijau = 0;
        if (total > 0) {
            areaHijau = ((terbuka / total) * 100).toFixed(2);
            previewAreaHijau.textContent = areaHijau + '%';
        } else {
            previewAreaHijau.textContent = '0%';
        }
        
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
