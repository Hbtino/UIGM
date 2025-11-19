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
        <div class="card-header py-3 bg-info text-white">
            <h6 class="m-0 font-weight-bold">Verifikasi Data - Tahun <?= $WasteManagement['tahun'] ?></h6>
        </div>
        <div class="card-body">
            <h5 class="mb-3">Detail Data</h5>
            
            <div class="row mb-3">
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
                        <tr>
                            <th>Listrik per Orang</th>
                            <td><?= number_format($WasteManagement['total_listrik_per_orang'], 2) ?> kWh</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-bordered">
                        <tr>
                            <th width="50%">Peralatan Hemat Energi</th>
                            <td><?= $WasteManagement['peralatan_hemat_energi'] ?> unit</td>
                        </tr>
                        <tr>
                            <th>Bangunan Cerdas</th>
                            <td><?= $WasteManagement['bangunan_cerdas'] ?> unit</td>
                        </tr>
                        <tr>
                            <th>Sumber Energi Terbarukan</th>
                            <td><?= $WasteManagement['jumlah_energi_terbarukan'] ?> unit</td>
                        </tr>
                        <tr>
                            <th>Bangunan Ramah Lingkungan</th>
                            <td><?= $WasteManagement['bangunan_ramah_lingkungan'] ?> unit</td>
                        </tr>
                        <tr>
                            <th>Jejak Karbon per Orang</th>
                            <td><?= number_format($WasteManagement['jejak_karbon_per_orang'], 2) ?> ton CO2</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <h6>Program & Inisiatif:</h6>
                    <ul>
                        <li>Program Pengurangan Emisi: <strong><?= $WasteManagement['program_pengurangan_emisi'] ? 'Ada' : 'Tidak Ada' ?></strong></li>
                        <li>Program Inovatif Energi: <strong><?= $WasteManagement['program_inovatif_energi'] ? 'Ada' : 'Tidak Ada' ?></strong></li>
                        <li>Program Dampak Iklim: <strong><?= $WasteManagement['program_dampak_iklim'] ? 'Ada' : 'Tidak Ada' ?></strong></li>
                    </ul>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="alert alert-primary">
                        <strong>Capaian Persen:</strong> <?= number_format($WasteManagement['capaian_persen'], 2) ?>%
                    </div>
                </div>
            </div>

            <?php if ($WasteManagement['keterangan']): ?>
                <div class="mb-3">
                    <strong>Keterangan:</strong>
                    <p class="border p-2 bg-light"><?= nl2br(esc($WasteManagement['keterangan'])) ?></p>
                </div>
            <?php endif; ?>

            <?php if ($WasteManagement['bukti_pendukung']): ?>
                <div class="mb-3">
                    <strong>Bukti Pendukung:</strong><br>
                    <a href="<?= base_url('waste-management/download/' . $WasteManagement['id']) ?>" class="btn btn-info mt-2">
                        <i class="fas fa-download"></i> Download Bukti
                    </a>
                </div>
            <?php endif; ?>

            <hr>

            <h5 class="mb-3">Proses Verifikasi</h5>
            <form action="<?= base_url('waste-management/process-verification/' . $WasteManagement['id']) ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label>Keputusan <span class="text-danger">*</span></label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="action" id="approve" value="approve" required>
                            <label class="form-check-label" for="approve">
                                <i class="fas fa-check-circle text-success"></i> Setujui
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="action" id="reject" value="reject" required>
                            <label class="form-check-label" for="reject">
                                <i class="fas fa-times-circle text-danger"></i> Tolak
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="catatan_verifikasi">Catatan Verifikasi</label>
                    <textarea class="form-control" id="catatan_verifikasi" name="catatan_verifikasi" rows="4" 
                              placeholder="Berikan catatan atau alasan verifikasi..."></textarea>
                    <small class="text-muted">Catatan ini akan terlihat oleh penginput data</small>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Proses Verifikasi
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

