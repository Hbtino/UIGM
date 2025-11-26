<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 1400px;
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
        .section-subtitle {
            background: #e9ecef;
            padding: 8px 12px;
            border-left: 4px solid #149823ff;
            margin: 15px 0 10px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
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
            font-size: 12px;
        }
        .data-table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            font-size: 12px;
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
</head>
<body>
    <div class="container">
        <a href="<?= base_url('dashboard') ?>" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
        
        <div class="header">
            <h1><i class="fas fa-history"></i> Riwayat Laporan Program Studi</h1>
            <p>Lihat laporan yang sudah Anda simpan</p>
        </div>

        <?php if (!empty($laporan) && is_array($laporan)): ?>
            <?php foreach ($laporan as $item): ?>
            <?php 
                $data = json_decode($item['data_laporan'], true);
                $lastSaved = $item['updated_at'] ?? $item['created_at'];
                $date = new DateTime($lastSaved);
            ?>
            
            <div class="laporan-card">
                <div class="laporan-header">
                    <div class="laporan-title">
                        <i class="fas fa-file-alt"></i> Laporan Program Studi - UI GreenMetric
                    </div>
                    <div class="laporan-date">
                        <i class="fas fa-clock"></i> Disimpan: <?= $date->format('d F Y, H:i:s') ?>
                    </div>
                </div>

                <div class="section-title">
                    <i class="fas fa-university"></i> Informasi Program Studi
                </div>
                <div class="info-row">
                    <div class="info-label">Program Studi:</div>
                    <div class="info-value"><?= esc($item['prodi_name'] ?? '-') ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Nama Kaprodi:</div>
                    <div class="info-value"><?= esc($item['kaprodi_name'] ?? '-') ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Jurusan:</div>
                    <div class="info-value"><?= esc($item['jurusan'] ?? '-') ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Laporan:</div>
                    <div class="info-value"><?= esc($item['tanggal_laporan'] ?? '-') ?></div>
                </div>

                <div class="section-title">
                    <i class="fas fa-tasks"></i> Kontribusi Berdasarkan Kriteria UI GreenMetric
                </div>

                <?php if (isset($data['si'])): ?>
                    <?php $siData = json_decode($data['si'], true); ?>
                    <?php if (!empty($siData)): ?>
                        <div class="section-subtitle">
                            <i class="fas fa-building"></i> SI (Setting and Infrastructure)
                        </div>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="45%">Kegiatan/Inisiatif</th>
                                    <th width="50%">Data/Bukti</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($siData as $index => $item): ?>
                                    <?php if (!empty($item['kegiatan'])): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= esc($item['kegiatan'] ?? '-') ?></td>
                                            <td><?= esc($item['bukti'] ?? '-') ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (isset($data['ec'])): ?>
                    <?php $ecData = json_decode($data['ec'], true); ?>
                    <?php if (!empty($ecData)): ?>
                        <div class="section-subtitle">
                            <i class="fas fa-bolt"></i> EC (Energy and Climate Change)
                        </div>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="45%">Kegiatan/Inisiatif</th>
                                    <th width="50%">Data/Bukti</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ecData as $index => $item): ?>
                                    <?php if (!empty($item['kegiatan'])): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= esc($item['kegiatan'] ?? '-') ?></td>
                                            <td><?= esc($item['bukti'] ?? '-') ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (isset($data['ws'])): ?>
                    <?php $wsData = json_decode($data['ws'], true); ?>
                    <?php if (!empty($wsData)): ?>
                        <div class="section-subtitle">
                            <i class="fas fa-recycle"></i> WS (Waste)
                        </div>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="45%">Kegiatan/Inisiatif</th>
                                    <th width="50%">Data/Bukti</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($wsData as $index => $item): ?>
                                    <?php if (!empty($item['kegiatan'])): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= esc($item['kegiatan'] ?? '-') ?></td>
                                            <td><?= esc($item['bukti'] ?? '-') ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="action-buttons">
                    <a href="<?= base_url('laporan/edit-kaprodi/' . $item['id']) ?>" class="btn-edit">
                        <i class="fas fa-edit"></i> Edit Laporan
                    </a>
                    <a href="<?= base_url('laporan/export-kaprodi-pdf/' . $item['id']) ?>" class="btn-pdf">
                        <i class="fas fa-file-pdf"></i> Download PDF
                    </a>
                    <form method="POST" action="<?= base_url('laporan/delete-kaprodi/' . $item['id']) ?>" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.');">
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
                <a href="<?= base_url('laporan/kaprodi') ?>" class="btn btn-success btn-lg mt-3">
                    <i class="fas fa-plus"></i> Buat Laporan Baru
                </a>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDeleteKaprodi(id) {
            if (confirm('Apakah Anda yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.')) {
                // Send delete request
                fetch('<?= base_url('laporan/delete-kaprodi/') ?>' + id, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Laporan berhasil dihapus');
                        location.reload();
                    } else {
                        alert('Gagal menghapus laporan: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus laporan');
                });
            }
        }
    </script>
</body>
</html>
