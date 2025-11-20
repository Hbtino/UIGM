<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header  text-white" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%) !important;">
                <h4 class="mb-0">Tambah Data Transportasi & Mobilitas Berkelanjutan</h4>
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

                <form action="/transportation/store" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tahun Periode <span class="text-danger">*</span></label>
                                <input type="number" name="tahun" class="form-control" value="<?= old('tahun') ?>" required>
                            </div>
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">Data Perjalanan Ramah Lingkungan</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Total Perjalanan/Responden <span class="text-danger">*</span></label>
                                <input type="number" name="total_perjalanan" id="total_perjalanan" class="form-control" value="<?= old('total_perjalanan') ?>" required>
                                <small class="text-muted">Jumlah total perjalanan atau responden survei</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Perjalanan Ramah Lingkungan <span class="text-danger">*</span></label>
                                <input type="number" name="perjalanan_ramah_lingkungan" id="perjalanan_ramah_lingkungan" class="form-control" value="<?= old('perjalanan_ramah_lingkungan') ?>" required>
                                <small class="text-muted">Jumlah perjalanan menggunakan transportasi berkelanjutan</small>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <strong>Persentase Otomatis:</strong> <span id="preview_persen">0%</span>
                        <br><small>Persentase akan dihitung otomatis berdasarkan data di atas</small>
                    </div>

                    <h5 class="mt-4 mb-3">Data Pendukung Lainnya</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jumlah Kendaraan</label>
                                <input type="number" name="jumlah_kendaraan" class="form-control" value="<?= old('jumlah_kendaraan', 0) ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jumlah Populasi</label>
                                <input type="number" name="jumlah_populasi" class="form-control" value="<?= old('jumlah_populasi', 0) ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Rasio Kendaraan</label>
                                <input type="text" name="rasio_kendaraan" class="form-control" value="<?= old('rasio_kendaraan') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Layanan Antar Jemput</label>
                                <input type="text" name="layanan_antar_jemput" class="form-control" value="<?= old('layanan_antar_jemput') ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kebijakan ZEV</label>
                                <input type="text" name="kebijakan_zev" class="form-control" value="<?= old('kebijakan_zev') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Luas Parkir (m²)</label>
                                <input type="text" name="luas_parkir" class="form-control" value="<?= old('luas_parkir') ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Program Pembatasan Parkir</label>
                                <input type="text" name="program_pembatasan_parkir" class="form-control" value="<?= old('program_pembatasan_parkir') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Inisiatif Pengurangan Kendaraan</label>
                                <input type="number" name="inisiatif_pengurangan_kendaraan" class="form-control" value="<?= old('inisiatif_pengurangan_kendaraan', 0) ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jalur Pejalan Kaki</label>
                                <input type="text" name="jalur_pejalan_kaki" class="form-control" value="<?= old('jalur_pejalan_kaki') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jumlah Sepeda Kampus</label>
                                <input type="number" name="sepeda_kampus" class="form-control" value="<?= old('sepeda_kampus', 0) ?>">
                            </div>
                        </div>
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
                        <a href="/transportation" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-calculate percentage
document.addEventListener('DOMContentLoaded', function() {
    const totalInput = document.getElementById('total_perjalanan');
    const ramahInput = document.getElementById('perjalanan_ramah_lingkungan');
    const previewPersen = document.getElementById('preview_persen');
    
    function calculatePercentage() {
        const total = parseFloat(totalInput.value) || 0;
        const ramah = parseFloat(ramahInput.value) || 0;
        
        if (total > 0) {
            const persen = ((ramah / total) * 100).toFixed(2);
            previewPersen.textContent = persen + '%';
        } else {
            previewPersen.textContent = '0%';
        }
    }
    
    totalInput.addEventListener('input', calculatePercentage);
    ramahInput.addEventListener('input', calculatePercentage);
});
</script>

<?= $this->endSection() ?>

