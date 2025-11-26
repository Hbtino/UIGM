<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Dosen - UI GreenMetric</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #149823ff;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #149823ff;
            font-size: 18px;
            margin: 5px 0;
        }
        .header p {
            margin: 3px 0;
            font-size: 10px;
        }
        .section-title {
            background: #149823ff;
            color: white;
            padding: 8px 10px;
            margin: 15px 0 10px;
            font-weight: bold;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background: #149823ff;
            color: white;
            padding: 6px;
            font-size: 10px;
        }
        td {
            padding: 5px;
            font-size: 10px;
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
        <h1>Laporan UI GreenMetric</h1>
        <p>Form Pelaporan Kontribusi Dosen untuk UI GreenMetric World University Ranking</p>
        <p><strong>Periode: 2024-2028</strong></p>
    </div>

    <div class="section-title">1. Informasi Dosen</div>
    <table class="info-table">
        <tr>
            <td>Nama Dosen</td>
            <td><?= esc($user_name) ?></td>
        </tr>
        <tr>
            <td>Jurusan</td>
            <td><?= esc($laporan['jurusan'] ?? '-') ?></td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td><?= esc($laporan['program_studi'] ?? '-') ?></td>
        </tr>
    </table>

    <div class="section-title">2. Kursus/Mata Kuliah tentang Keberlanjutan</div>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="10%">Kode MK</th>
                <th width="20%">Nama Mata Kuliah</th>
                <th width="35%">Deskripsi Relevansi</th>
                <th width="10%">SKS</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($data['mata_kuliah']) && is_array($data['mata_kuliah'])): ?>
                <?php foreach ($data['mata_kuliah'] as $index => $mk): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($mk['kode'] ?? '-') ?></td>
                        <td><?= esc($mk['nama'] ?? '-') ?></td>
                        <td><?= esc($mk['deskripsi'] ?? '-') ?></td>
                        <td><?= esc($mk['sks'] ?? '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" style="text-align: center;">Tidak ada data</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="section-title">3. Acara Ilmiah</div>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama Acara</th>
                <th width="15%">Tanggal</th>
                <th width="15%">Peran</th>
                <th width="40%">Topik</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($data['acara']) && is_array($data['acara'])): ?>
                <?php foreach ($data['acara'] as $index => $acara): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($acara['nama'] ?? '-') ?></td>
                        <td><?= esc($acara['tanggal'] ?? '-') ?></td>
                        <td><?= esc($acara['peran'] ?? '-') ?></td>
                        <td><?= esc($acara['topik'] ?? '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" style="text-align: center;">Tidak ada data</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if (isset($data['praktik'])): ?>
        <?php $praktik = json_decode($data['praktik'], true); ?>
        <?php if (!empty($praktik)): ?>
            <div class="section-title">4. Praktik Ramah Lingkungan</div>
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="30%">Inisiatif/Program</th>
                        <th width="45%">Deskripsi</th>
                        <th width="20%">Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($praktik as $index => $item): ?>
                        <?php if (!empty($item['inisiatif'])): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($item['inisiatif'] ?? '-') ?></td>
                                <td><?= esc($item['deskripsi'] ?? '-') ?></td>
                                <td><?= esc($item['kategori'] ?? '-') ?></td>
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
            <div class="section-title">5. Kontribusi Kebijakan</div>
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="30%">Bentuk Kontribusi</th>
                        <th width="45%">Deskripsi</th>
                        <th width="20%">Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kontribusi as $index => $item): ?>
                        <?php if (!empty($item['bentuk'])): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($item['bentuk'] ?? '-') ?></td>
                                <td><?= esc($item['deskripsi'] ?? '-') ?></td>
                                <td><?= esc($item['kategori'] ?? '-') ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    <?php endif; ?>

    <p style="margin-top: 30px; font-size: 10px;">
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
