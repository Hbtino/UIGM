<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">Verifikasi Data Transportasi - Tahun <?= $data_item['tahun'] ?></h4>
            </div>
            <div class="card-body">
                <h5 class="mb-3">Detail Data</h5>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <th width="50%">Tahun Periode</th>
                                <td><?= $data_item['tahun'] ?></td>
                            </tr>
                            <tr>
                                <th>Total Perjalanan</th>
                                <td><?= number_format($data_item['total_perjalanan']) ?></td>
                            </tr>
                            <tr>
                                <th>Perjalanan Ramah Lingkungan</th>
                                <td><?= number_format($data_item['perjalanan_ramah_lingkungan']) ?></td>
                            </tr>
                            <tr>
                                <th>Persentase</th>
                                <td><strong class="text-primary"><?= $data_item['capaian_persen'] ?>%</strong></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <th width="50%">Jumlah Kendaraan</th>
                                <td><?= number_format($data_item['jumlah_kendaraan']) ?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Populasi</th>
                                <td><?= number_format($data_item['jumlah_populasi']) ?></td>
                            </tr>
                            <tr>
                                <th>Sepeda Kampus</th>
                                <td><?= number_format($data_item['sepeda_kampus']) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <?php if ($data_item['keterangan']): ?>
                    <div class="mb-3">
                        <strong>Keterangan:</strong>
                        <p class="border p-2 bg-light"><?= nl2br(esc($data_item['keterangan'])) ?></p>
                    </div>
                <?php endif ?>

                <?php if ($data_item['bukti_pendukung']): ?>
                    <div class="mb-3">
                        <strong>Bukti Pendukung:</strong><br>
                        <a href="/transportation/download/<?= $data_item['id'] ?>" class="btn btn-info mt-2">
                            Download Bukti Pendukung
                        </a>
                    </div>
                <?php endif ?>

                <hr>

                <h5 class="mb-3">Proses Verifikasi</h5>
                <form action="/transportation/process-verification/<?= $data_item['id'] ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label">Status Verifikasi <span class="text-danger">*</span></label>
                        <select name="status_verifikasi" class="form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="approved">Setujui</option>
                            <option value="rejected">Tolak</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan Verifikasi</label>
                        <textarea name="catatan_verifikasi" class="form-control" rows="4" placeholder="Berikan catatan atau alasan verifikasi..."></textarea>
                        <small class="text-muted">Catatan ini akan terlihat oleh penginput data</small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Proses Verifikasi</button>
                        <a href="/transportation" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
