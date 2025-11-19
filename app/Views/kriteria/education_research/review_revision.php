<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('education-research/revisions') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Review Permintaan Revisi</h6>
        </div>
        <div class="card-body">
            <h5 class="mb-3">Informasi Permintaan</h5>
            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-sm table-bordered">
                        <tr>
                            <th width="40%">Diminta Oleh</th>
                            <td><?= esc($revision['requested_by_name']) ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Request</th>
                            <td><?= date('d/m/Y H:i', strtotime($revision['created_at'])) ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-bordered">
                        <tr>
                            <th width="40%">Status</th>
                            <td>
                                <?php if ($revision['status'] === 'pending'): ?>
                                    <span class="badge badge-warning">Menunggu Review</span>
                                <?php elseif ($revision['status'] === 'approved'): ?>
                                    <span class="badge badge-success">Disetujui</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Ditolak</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php if ($revision['status'] != 'pending'): ?>
                            <tr>
                                <th>Direview Oleh</th>
                                <td><?= $revision['reviewed_by_name'] ?? '-' ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Review</th>
                                <td><?= $revision['reviewed_at'] ? date('d/m/Y H:i', strtotime($revision['reviewed_at'])) : '-' ?></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>

            <div class="mb-4">
                <h5>Alasan Revisi:</h5>
                <div class="border p-3 bg-light">
                    <?= nl2br(esc($revision['alasan_revisi'])) ?>
                </div>
            </div>

            <?php if ($revision['review_notes']): ?>
                <div class="mb-4">
                    <h5>Catatan Review:</h5>
                    <div class="border p-3 bg-light">
                        <?= nl2br(esc($revision['review_notes'])) ?>
                    </div>
                </div>
            <?php endif; ?>

            <h5 class="mb-3">Data Energy & Climate yang Akan Direvisi</h5>
            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-sm table-bordered">
                        <tr>
                            <th width="50%">Tahun</th>
                            <td><?= $EducationResearch['tahun'] ?></td>
                        </tr>
                        <tr>
                            <th>Total Konsumsi Listrik</th>
                            <td><?= number_format($EducationResearch['total_konsumsi_listrik'], 2) ?> kWh</td>
                        </tr>
                        <tr>
                            <th>Energi Terbarukan</th>
                            <td><?= number_format($EducationResearch['konsumsi_energi_terbarukan'], 2) ?> kWh</td>
                        </tr>
                        <tr>
                            <th>Persentase Terbarukan</th>
                            <td><strong class="text-success"><?= number_format($EducationResearch['persentase_energi_terbarukan'], 2) ?>%</strong></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-bordered">
                        <tr>
                            <th width="50%">Status Saat Ini</th>
                            <td>
                                <?php if ($EducationResearch['status_verifikasi'] === 'pending'): ?>
                                    <span class="badge badge-warning">Pending</span>
                                <?php elseif ($EducationResearch['status_verifikasi'] === 'approved'): ?>
                                    <span class="badge badge-success">Approved</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Rejected</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Capaian Persen</th>
                            <td><strong class="text-primary"><?= number_format($EducationResearch['capaian_persen'], 2) ?>%</strong></td>
                        </tr>
                        <tr>
                            <th>Jejak Karbon per Orang</th>
                            <td><?= number_format($EducationResearch['jejak_karbon_per_orang'], 2) ?> ton CO2</td>
                        </tr>
                    </table>
                </div>
            </div>

            <?php if ($EducationResearch['bukti_pendukung']): ?>
                <div class="mb-4">
                    <strong>Bukti Pendukung:</strong><br>
                    <a href="<?= base_url('education-research/download/' . $EducationResearch['id']) ?>" class="btn btn-info btn-sm mt-2">
                        <i class="fas fa-download"></i> Download Bukti
                    </a>
                </div>
            <?php endif; ?>

            <hr>

            <?php if ($revision['status'] == 'pending'): ?>
                <h5 class="mb-3">Proses Review</h5>
                <form action="<?= base_url('education-research/process-revision-review/' . $revision['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="form-group">
                        <label>Keputusan <span class="text-danger">*</span></label>
                        <select name="action" class="form-control" required>
                            <option value="">-- Pilih Keputusan --</option>
                            <option value="approve">Setujui Permintaan Revisi</option>
                            <option value="reject">Tolak Permintaan Revisi</option>
                        </select>
                        <small class="text-muted">
                            <strong>Setujui:</strong> Data akan dikembalikan ke status "Pending" dan dapat diedit oleh pemohon<br>
                            <strong>Tolak:</strong> Data tetap berstatus "Approved" dan tidak dapat diedit
                        </small>
                    </div>

                    <div class="form-group">
                        <label>Catatan Review</label>
                        <textarea name="review_notes" class="form-control" rows="4" 
                                  placeholder="Berikan catatan atau alasan keputusan Anda..."></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check"></i> Proses Review
                        </button>
                        <a href="<?= base_url('education-research/revisions') ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            <?php else: ?>
                <div class="alert alert-info">
                    Permintaan revisi ini sudah direview dan tidak dapat diubah lagi.
                </div>
                <a href="<?= base_url('education-research/revisions') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

