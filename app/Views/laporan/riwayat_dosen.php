<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>
<style>
    .container {
        max-width: 1200px;
        background: white;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .header {
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 3px solid #149823ff;
    }
    .header h1 {
        color: #149823ff;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .btn-back {
        background: #6c757d;
        color: white;
        padding: 10px 25px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 20px;
    }
    .btn-back:hover {
        background: #5a6268;
        color: white;
    }
    .laporan-card {
        border: 2px solid #149823ff;
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 20px;
        background: #f8f9fa;
    }
    .laporan-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #149823ff;
    }
    .laporan-title {
        font-size: 20px;
        font-weight: 700;
        color: #149823ff;
    }
    .laporan-date {
        font-size: 14px;
        color: #666;
    }
    .info-row {
        display: flex;
        margin-bottom: 10px;
    }
    .info-label {
        font-weight: 600;
        width: 200px;
        color: #333;
    }
    .info-value {
        color: #666;
    }
    .section-title {
        background: #149823ff;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        margin: 20px 0 10px;
        font-weight: 600;
    }
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }
    .data-table th {
        background: #149823ff;
        color: white;
        padding: 8px;
        text-align: left;
        font-size: 13px;
    }
    .data-table td {
        padding: 8px;
        border-bottom: 1px solid #ddd;
        font-size: 13px;
    }
    .no-data {
        text-align: center;
        padding: 30px;
        color: #999;
        font-style: italic;
    }
    .action-buttons {
        margin-top: 20px;
        text-align: center;
    }
    .btn-edit {
        background: #ffc107;
        color: #000;
        padding: 10px 30px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        margin: 0 5px;
    }
    .btn-edit:hover {
        background: #e0a800;
        color: #000;
    }
    .btn-pdf {
        background: #dc3545;
        color: white;
        padding: 10px 30px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        margin: 0 5px;
    }
    .btn-pdf:hover {
        background: #c82333;
        color: white;
    }
    .btn-delete {
        background: #dc3545;
        color: white;
        padding: 10px 30px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        display: inline-block;
        margin: 0 5px;
        font-size: 16px;
    }
    .btn-delete:hover {
        background: #c82333;
    }
</style>

<div class="container">
    <div class="header">
        <h1><i class="fas fa-history"></i> Riwayat Laporan Dosen</h1>
        <?php if ($user_role === 'admin'): ?>
            <p>Lihat semua laporan dari semua dosen</p>
        <?php else: ?>
            <p>Lihat laporan yang sudah Anda simpan</p>
        <?php endif; ?>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($laporan) && is_array($laporan)): ?>
        <?php foreach ($laporan as $item): ?>
        <?php 
            // Safely decode JSON
            $data = [];
            if (isset($item['data_laporan']) && !empty($item['data_laporan'])) {
                $data = json_decode($item['data_laporan'], true);
                if (!is_array($data)) {
                    $data = [];
                }
            }
            
            // Safely get date
            $lastSaved = $item['updated_at'] ?? ($item['created_at'] ?? date('Y-m-d H:i:s'));
            try {
                $date = new DateTime($lastSaved);
            } catch (Exception $e) {
                $date = new DateTime();
            }
        ?>
        
        <div class="laporan-card">
            <div class="laporan-header">
                <div class="laporan-title">
                    <i class="fas fa-file-alt"></i> Laporan UI GreenMetric
                    <?php if ($user_role === 'admin'): ?>
                        <span style="font-size: 14px; color: #666; font-weight: normal;">
                            (ID: <?= isset($item['id']) ? $item['id'] : 'N/A' ?> | User ID: <?= isset($item['user_id']) ? $item['user_id'] : 'N/A' ?>)
                        </span>
                    <?php endif; ?>
                </div>
                <div class="laporan-date">
                    <i class="fas fa-clock"></i> Disimpan: <?= $date->format('d F Y, H:i:s') ?>
                </div>
            </div>

            <div class="section-title">
                <i class="fas fa-user"></i> Informasi Dosen
            </div>
            <div class="info-row">
                <div class="info-label">Nama Dosen:</div>
                <div class="info-value"><?= esc($item['user_name'] ?? $user_name) ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Jurusan:</div>
                <div class="info-value"><?= esc($item['jurusan'] ?? '-') ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Program Studi:</div>
                <div class="info-value"><?= esc($item['program_studi'] ?? '-') ?></div>
            </div>

            <?php if (isset($data['mata_kuliah'])): ?>
                <?php $mataKuliah = json_decode($data['mata_kuliah'], true); ?>
                <?php if (!empty($mataKuliah)): ?>
                    <div class="section-title">
                        <i class="fas fa-book"></i> Mata Kuliah tentang Keberlanjutan
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Kode MK</th>
                                <th width="25%">Nama Mata Kuliah</th>
                                <th width="40%">Deskripsi</th>
                                <th width="15%">SKS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mataKuliah as $index => $mk): ?>
                                <?php if (!empty($mk['kode']) || !empty($mk['nama'])): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= esc($mk['kode'] ?? '-') ?></td>
                                        <td><?= esc($mk['nama'] ?? '-') ?></td>
                                        <td><?= esc($mk['deskripsi'] ?? '-') ?></td>
                                        <td><?= esc($mk['sks'] ?? '-') ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (isset($data['acara'])): ?>
                <?php $acara = json_decode($data['acara'], true); ?>
                <?php if (!empty($acara)): ?>
                    <div class="section-title">
                        <i class="fas fa-calendar-alt"></i> Acara Ilmiah
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="30%">Nama Acara</th>
                                <th width="15%">Tanggal</th>
                                <th width="15%">Peran</th>
                                <th width="35%">Topik</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($acara as $index => $acaraItem): ?>
                                <?php if (!empty($acaraItem['nama'])): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= esc($acaraItem['nama'] ?? '-') ?></td>
                                        <td><?= esc($acaraItem['tanggal'] ?? '-') ?></td>
                                        <td><?= esc($acaraItem['peran'] ?? '-') ?></td>
                                        <td><?= esc($acaraItem['topik'] ?? '-') ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (isset($data['praktik'])): ?>
                <?php $praktik = json_decode($data['praktik'], true); ?>
                <?php if (!empty($praktik)): ?>
                    <div class="section-title">
                        <i class="fas fa-leaf"></i> Praktik Ramah Lingkungan
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="25%">Inisiatif/Program</th>
                                <th width="50%">Deskripsi</th>
                                <th width="20%">Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($praktik as $index => $praktikItem): ?>
                                <?php if (!empty($praktikItem['inisiatif'])): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= esc($praktikItem['inisiatif'] ?? '-') ?></td>
                                        <td><?= esc($praktikItem['deskripsi'] ?? '-') ?></td>
                                        <td><?= esc($praktikItem['kategori'] ?? '-') ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (isset($data['kontribusi'])): ?>
                <?php $kontribusi = json_decode($data['kontribusi'], true); ?>
                <?php if (!empty($kontribusi)): ?>
                    <div class="section-title">
                        <i class="fas fa-hands-helping"></i> Kontribusi Kebijakan
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="25%">Bentuk Kontribusi</th>
                                <th width="50%">Deskripsi</th>
                                <th width="20%">Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($kontribusi as $index => $kontribusiItem): ?>
                                <?php if (!empty($kontribusiItem['bentuk'])): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= esc($kontribusiItem['bentuk'] ?? '-') ?></td>
                                        <td><?= esc($kontribusiItem['deskripsi'] ?? '-') ?></td>
                                        <td><?= esc($kontribusiItem['kategori'] ?? '-') ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            <?php endif; ?>

            <div class="action-buttons">
                <a href="<?= base_url('laporan/edit-dosen/' . $item['id']) ?>" class="btn-edit">
                    <i class="fas fa-edit"></i> Edit Laporan
                </a>
                <a href="<?= base_url('laporan/export-dosen-pdf/' . $item['id']) ?>" class="btn-pdf">
                    <i class="fas fa-file-pdf"></i> Download PDF
                </a>
                <form method="POST" action="<?= base_url('laporan/delete-dosen/' . $item['id']) ?>" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.');">
                    <button type="submit" class="btn-delete">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>

    <?php else: ?>
        <div class="no-data">
            <i class="fas fa-inbox" style="font-size: 64px; color: #ccc; margin-bottom: 20px;"></i>
            <h4>Belum Ada Laporan</h4>
            <p>Anda belum menyimpan laporan. Silakan buat laporan baru.</p>
            <a href="<?= base_url('laporan') ?>" class="btn btn-primary mt-3">
                <i class="fas fa-plus"></i> Buat Laporan Baru
            </a>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>