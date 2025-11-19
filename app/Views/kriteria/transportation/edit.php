<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header bg-warning">
                <h4 class="mb-0">Edit Data Transportasi</h4>
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

                <form action="/transportation/update/<?= $data_item['id'] ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tahun Periode <span class="text-danger">*</span></label>
                                <input type="number" name="tahun" class="form-control" value="<?= old('tahun', $data_item['tahun']) ?>" required>
                            </div>
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">Data Perjalanan Ramah Lingkungan</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Total Perjalanan/Responden <span class="text-danger">*</span></label>
                                <input type="number" name="total_perjalanan" id="total_perjalanan" class="form-control" value="<?= old('total_perjalanan', $data_item['total_perjalanan']) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Perjalanan Ramah Lingkungan <span class="text-danger">*</span></label>
                                <input type="number" name="perjalanan_ramah_lingkungan" id="perjalanan_ramah_lingkungan" class="form-control" value="<?= old('perjalanan_ramah_lingkungan', $data_item['perjalanan_ramah_lingkungan']) ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <strong>Persentase Saat Ini:</strong> <?= $data_item['capaian_persen'] ?>%
                        <br><strong>Persentase Baru:</strong> <span id="preview_persen"><?= $data_item['capaian_persen'] ?>%</span>
                    </div>

                    <h5 class="mt-4 mb-3">Data Pendukung Lainnya</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jumlah Kendaraan</label>
                                <input type="number" name="jumlah_kendaraan" class="form-control" value="<?= old('jumlah_kendaraan', $data_item['jumlah_kendaraan']) ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jumlah Populasi</label>
                                <input type="number" name="jumlah_populasi" class="form-control" value="<?= old('jumlah_populasi', $data_item['jumlah_populasi']) ?>">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3"><?= old('keterangan', $data_item['keterangan']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bukti Pendukung</label>
                        <?php if ($data_item['bukti_pendukung']): ?>
                            <div class="mb-2">
                                <a href="/transportation/download/<?= $data_item['id'] ?>" class="btn btn-sm btn-info">
                                    Download File Saat Ini
                                </a>
                            </div>
                        <?php endif ?>
                        <input type="file" name="bukti_pendukung" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah file. Format: PDF, JPG, PNG, XLSX (Max: 2MB)</small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">Update Data</button>
                        <a href="/transportation" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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
