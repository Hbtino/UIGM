<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('waste-management') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 text-white" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);">
            <h6 class="m-0 font-weight-bold">Request Revisi - Tahun <?= $WasteManagement['tahun'] ?></h6>
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
                            <td><?= $WasteManagement['tahun'] ?></td>
                        </tr>
                        <tr>
                            <th>Total Konsumsi Listrik</th>
                            <td><?= number_format($WasteManagement['total_konsumsi_listrik'], 2) ?> kWh</td>
                        </tr>
                        <tr>
                            <th>Energi Terbarukan</th>
                            <td><?= number_format($WasteManagement['konsumsi_energi_terbarukan'], 2) ?> kWh</td>
                        </tr>
                        <tr>
                            <th>Persentase Terbarukan</th>
                            <td><strong class="text-success"><?= number_format($WasteManagement['persentase_energi_terbarukan'], 2) ?>%</strong></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-bordered">
                        <tr>
                            <th width="50%">Status</th>
                            <td><span class="badge badge-success">Approved</span></td>
                        </tr>
                        <tr>
                            <th>Capaian Persen</th>
                            <td><strong class="text-primary"><?= number_format($WasteManagement['capaian_persen'], 2) ?>%</strong></td>
                        </tr>
                        <tr>
                            <th>Jejak Karbon per Orang</th>
                            <td><?= number_format($WasteManagement['jejak_karbon_per_orang'], 2) ?> ton CO2</td>
                        </tr>
                    </table>
                </div>
            </div>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <hr>

            <h5 class="mb-3">Form Permintaan Revisi</h5>
            <form action="<?= base_url('waste-management/submit-revision-request/' . $WasteManagement['id']) ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label>Alasan Revisi <span class="text-danger">*</span></label>
                    <textarea name="alasan_revisi" class="form-control" rows="5" required 
                              placeholder="Jelaskan alasan mengapa data ini perlu direvisi (minimal 10 karakter)..."><?= old('alasan_revisi') ?></textarea>
                    <small class="text-muted">Contoh: Data konsumsi energi perlu diperbarui karena ada instalasi panel surya baru yang meningkatkan persentase energi terbarukan.</small>
                </div>

                <div class="alert alert-warning">
                    <strong>Catatan:</strong>
                    <ul class="mb-0">
                        <li>Permintaan revisi akan dikirim ke admin/reviewer untuk ditinjau</li>
                        <li>Jika disetujui, status data akan berubah menjadi "Pending" dan Anda dapat mengedit data</li>
                        <li>Jika ditolak, data tetap berstatus "Approved" dan tidak dapat diedit</li>
                    </ul>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-paper-plane"></i> Ajukan Permintaan Revisi
                    </button>
                    <a href="<?= base_url('waste-management') ?>" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

