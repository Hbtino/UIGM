<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header  text-white" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%) !important;">
                <h4 class="mb-0">Review Permintaan Revisi</h4>
            </div>
            <div class="card-body">
                <h5 class="mb-3">Informasi Permintaan</h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <table class="table table-sm table-bordered">
                            <tr>
                                <th width="40%">Diminta Oleh</th>
                                <td><?= esc($requester['name']) ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?= esc($requester['email']) ?></td>
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
                                    <?php
                                    $statusBadge = [
                                        'pending' => 'bg-warning',
                                        'approved' => 'bg-success',
                                        'rejected' => 'bg-danger'
                                    ];
                                    $statusText = [
                                        'pending' => 'Menunggu Review',
                                        'approved' => 'Disetujui',
                                        'rejected' => 'Ditolak'
                                    ];
                                    ?>
                                    <span class="badge <?= $statusBadge[$revision['status']] ?>">
                                        <?= $statusText[$revision['status']] ?>
                                    </span>
                                </td>
                            </tr>
                            <?php if ($revision['status'] != 'pending'): ?>
                                <tr>
                                    <th>Direview Oleh</th>
                                    <td><?= $revision['reviewed_by'] ? 'User ID: ' . $revision['reviewed_by'] : '-' ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Review</th>
                                    <td><?= $revision['reviewed_at'] ? date('d/m/Y H:i', strtotime($revision['reviewed_at'])) : '-' ?></td>
                                </tr>
                            <?php endif ?>
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
                <?php endif ?>

                <h5 class="mb-3">Data Transportation yang Akan Direvisi</h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <table class="table table-sm table-bordered">
                            <tr>
                                <th width="50%">Tahun</th>
                                <td><?= $transportation_data['tahun'] ?></td>
                            </tr>
                            <tr>
                                <th>Total Perjalanan</th>
                                <td><?= number_format($transportation_data['total_perjalanan']) ?></td>
                            </tr>
                            <tr>
                                <th>Perjalanan Ramah Lingkungan</th>
                                <td><?= number_format($transportation_data['perjalanan_ramah_lingkungan']) ?></td>
                            </tr>
                            <tr>
                                <th>Persentase</th>
                                <td><strong class="text-success"><?= $transportation_data['capaian_persen'] ?>%</strong></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm table-bordered">
                            <tr>
                                <th width="50%">Status Saat Ini</th>
                                <td>
                                    <?php
                                    $statusBadge = [
                                        'pending' => 'bg-warning',
                                        'approved' => 'bg-success',
                                        'rejected' => 'bg-danger'
                                    ];
                                    ?>
                                    <span class="badge <?= $statusBadge[$transportation_data['status_verifikasi']] ?>">
                                        <?= ucfirst($transportation_data['status_verifikasi']) ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Jumlah Kendaraan</th>
                                <td><?= number_format($transportation_data['jumlah_kendaraan']) ?></td>
                            </tr>
                            <tr>
                                <th>Sepeda Kampus</th>
                                <td><?= number_format($transportation_data['sepeda_kampus']) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <?php if ($transportation_data['bukti_pendukung']): ?>
                    <div class="mb-4">
                        <strong>Bukti Pendukung:</strong><br>
                        <a href="/transportation/download/<?= $transportation_data['id'] ?>" class="btn btn-info btn-sm mt-2">
                            Download Bukti Pendukung
                        </a>
                    </div>
                <?php endif ?>

                <hr>

                <?php if ($revision['status'] == 'pending'): ?>
                    <h5 class="mb-3">Proses Review</h5>
                    <form action="/transportation/process-revision-review/<?= $revision['id'] ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="mb-3">
                            <label class="form-label">Keputusan <span class="text-danger">*</span></label>
                            <select name="action" class="form-select" required>
                                <option value="">-- Pilih Keputusan --</option>
                                <option value="approved">Setujui Permintaan Revisi</option>
                                <option value="rejected">Tolak Permintaan Revisi</option>
                            </select>
                            <small class="text-muted">
                                <strong>Setujui:</strong> Data akan dikembalikan ke status "Pending" dan dapat diedit oleh pemohon<br>
                                <strong>Tolak:</strong> Data tetap berstatus "Approved" dan tidak dapat diedit
                            </small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catatan Review</label>
                            <textarea name="review_notes" class="form-control" rows="4" placeholder="Berikan catatan atau alasan keputusan Anda..."></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Proses Review</button>
                            <a href="/transportation/revisions" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="alert alert-info">
                        Permintaan revisi ini sudah direview dan tidak dapat diubah lagi.
                    </div>
                    <a href="/transportation/revisions" class="btn btn-secondary">Kembali ke Daftar</a>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

