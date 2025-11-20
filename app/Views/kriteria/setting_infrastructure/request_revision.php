<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header text-white" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);">
                <h4 class="mb-0">Request Revisi Data Setting & Infrastructure - Tahun <?= $data_item['tahun'] ?></h4>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <strong>Informasi:</strong> Data ini sudah disetujui. Untuk melakukan perubahan, Anda perlu mengajukan permintaan revisi kepada admin/reviewer.
                </div>

                <h5 class="mb-3">Data Saat Ini</h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <table class="table table-sm table-bordered">
                            <tr>
                                <th width="50%">Tahun</th>
                                <td><?= $data_item['tahun'] ?></td>
                            </tr>
                            <tr>
                                <th>Luas Total</th>
                                <td><?= number_format($data_item['luas_total'], 2) ?> m²</td>
                            </tr>
                            <tr>
                                <th>Luas Ruang Terbuka</th>
                                <td><?= number_format($data_item['luas_ruang_terbuka'], 2) ?> m²</td>
                            </tr>
                            <tr>
                                <th>Persentase Area Hijau</th>
                                <td><strong class="text-success"><?= $data_item['persentase_area_hijau'] ?>%</strong></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm table-bordered">
                            <tr>
                                <th width="50%">Status</th>
                                <td><span class="badge bg-success">Approved</span></td>
                            </tr>
                            <tr>
                                <th>Persentase Anggaran</th>
                                <td><?= $data_item['persentase_anggaran'] ?>%</td>
                            </tr>
                            <tr>
                                <th>Persentase Pemeliharaan</th>
                                <td><?= $data_item['persentase_pemeliharaan'] ?>%</td>
                            </tr>
                            <tr>
                                <th>Capaian Persen</th>
                                <td><strong class="text-primary"><?= $data_item['capaian_persen'] ?>%</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>

                <hr>

                <h5 class="mb-3">Form Permintaan Revisi</h5>
                <form action="/setting-infrastructure/submit-revision-request/<?= $data_item['id'] ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label">Alasan Revisi <span class="text-danger">*</span></label>
                        <textarea name="alasan_revisi" class="form-control" rows="5" required placeholder="Jelaskan alasan mengapa data ini perlu direvisi (minimal 10 karakter)..."><?= old('alasan_revisi') ?></textarea>
                        <small class="text-muted">Contoh: Data luas area hijau perlu diperbarui karena ada penambahan taman baru seluas 500 m².</small>
                    </div>

                    <div class="alert alert-warning">
                        <strong>Catatan:</strong>
                        <ul class="mb-0">
                            <li>Permintaan revisi akan dikirim ke admin/reviewer untuk ditinjau</li>
                            <li>Jika disetujui, status data akan berubah menjadi "Pending" dan Anda dapat mengedit data</li>
                            <li>Jika ditolak, data tetap berstatus "Approved" dan tidak dapat diedit</li>
                        </ul>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">Ajukan Permintaan Revisi</button>
                        <a href="/setting-infrastructure" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
