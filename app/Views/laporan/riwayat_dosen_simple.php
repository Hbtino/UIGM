<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Laporan Dosen - Simple</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .debug { background: #f0f0f0; padding: 10px; margin: 10px 0; border-radius: 5px; }
        .laporan { background: white; border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Riwayat Laporan Dosen (Simple View)</h1>
    
    <div class="debug">
        <h3>Debug Info:</h3>
        <p>User ID: <?= session()->get('user_id') ?></p>
        <p>User Role: <?= session()->get('user_role') ?></p>
        <p>Laporan Count: <?= is_array($laporan) ? count($laporan) : 0 ?></p>
        <p>Laporan Type: <?= gettype($laporan) ?></p>
    </div>
    
    <?php if (!empty($laporan) && is_array($laporan)): ?>
        <h2>Daftar Laporan (<?= count($laporan) ?>):</h2>
        
        <?php foreach ($laporan as $index => $item): ?>
            <div class="laporan">
                <h3>Laporan #<?= $index + 1 ?></h3>
                <pre><?php print_r($item); ?></pre>
            </div>
        <?php endforeach; ?>
        
    <?php else: ?>
        <div class="debug">
            <h3>Tidak Ada Laporan</h3>
            <p>Belum ada laporan yang tersimpan.</p>
        </div>
    <?php endif; ?>
    
    <hr>
    <p>
        <a href="<?= base_url('dashboard') ?>">Kembali ke Dashboard</a> |
        <a href="<?= base_url('laporan') ?>">Buat Laporan Baru</a>
    </p>
</body>
</html>
