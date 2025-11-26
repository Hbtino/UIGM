<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kaprodi - UI GreenMetric</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.3;
            margin: 15px;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #149823ff;
            padding-bottom: 8px;
        }
        .header h1 {
            color: #149823ff;
            font-size: 16px;
            margin: 3px 0;
        }
        .header p {
            margin: 2px 0;
            font-size: 9px;
        }
        .section-title {
            background: #149823ff;
            color: white;
            padding: 6px 8px;
            margin: 12px 0 8px;
            font-weight: bold;
            font-size: 11px;
        }
        .section-subtitle {
            background: #f8f9fa;
            padding: 5px 8px;
            border-left: 3px solid #149823ff;
            margin: 10px 0 6px;
            font-weight: bold;
            font-size: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background: #149823ff;
            color: white;
            padding: 4px;
            font-size: 9px;
        }
        td {
            padding: 4px;
            font-size: 9px;
        }
        .info-table td:first-child {
            background: #f8f9fa;
            font-weight: bold;
            width: 30%;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Program Studi - UI GreenMetric</h1>
        <p>Form Pelaporan Kontribusi Program Studi untuk UI GreenMetric World University Ranking</p>
        <p><strong>Periode: 2024-2028</strong></p>
    </div>

    <div class="section-title">Informasi Program Studi</div>
    <table class="info-table">
        <tr>
            <td>Nama Program Studi</td>
            <td><?= esc($laporan['prodi_name'] ?? '-') ?></td>
        </tr>
        <tr>
            <td>Nama Kaprodi</td>
            <td><?= esc($laporan['kaprodi_name'] ?? '-') ?></td>
        </tr>
        <tr>
            <td>Jurusan</td>
            <td><?= esc($laporan['jurusan'] ?? '-') ?></td>
        </tr>
        <tr>
            <td>Tanggal Laporan</td>
            <td><?= esc($laporan['tanggal_laporan'] ?? '-') ?></td>
        </tr>
    </table>

    <div class="section-title">Kontribusi Berdasarkan Kriteria UI GreenMetric</div>

    <div class="section-subtitle">SI (Setting and Infrastructure)</div>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="45%">Kegiatan/Inisiatif</th>
                <th width="50%">Data/Bukti</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($data['si']) && is_array($data['si'])): ?>
                <?php foreach ($data['si'] as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($item['kegiatan'] ?? '-') ?></td>
                        <td><?= esc($item['bukti'] ?? '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3" style="text-align: center;">Tidak ada data</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="section-subtitle">EC (Energy and Climate Change)</div>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="45%">Kegiatan/Inisiatif</th>
                <th width="50%">Data/Bukti</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($data['ec']) && is_array($data['ec'])): ?>
                <?php foreach ($data['ec'] as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($item['kegiatan'] ?? '-') ?></td>
                        <td><?= esc($item['bukti'] ?? '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3" style="text-align: center;">Tidak ada data</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="section-subtitle">WS (Waste)</div>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="45%">Kegiatan/Inisiatif</th>
                <th width="50%">Data/Bukti</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($data['ws']) && is_array($data['ws'])): ?>
                <?php foreach ($data['ws'] as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($item['kegiatan'] ?? '-') ?></td>
                        <td><?= esc($item['bukti'] ?? '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3" style="text-align: center;">Tidak ada data</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <p style="margin-top: 20px; font-size: 9px;">
        <?php if (isset($last_saved) && $last_saved): ?>
            <strong>Laporan disimpan:</strong> 
            <?php
                $date = new DateTime($last_saved);
                echo $date->format('d F Y, H:i:s');
            ?><br>
        <?php endif; ?>
        <strong>Tanggal Cetak:</strong> 
        <?php
            $now = new DateTime();
            echo $now->format('d F Y, H:i:s');
        ?><br>
        <strong>Dicetak oleh:</strong> <?= esc($user_name) ?>
    </p>
</body>
</html>
