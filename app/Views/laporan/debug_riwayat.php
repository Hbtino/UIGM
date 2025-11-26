<!DOCTYPE html>
<html>
<head>
    <title>Debug Riwayat</title>
</head>
<body>
    <h1>Debug Information</h1>
    
    <h2>Session Data:</h2>
    <pre><?php print_r(session()->get()); ?></pre>
    
    <h2>User ID:</h2>
    <p><?= session()->get('user_id') ?></p>
    
    <h2>Laporan Variable:</h2>
    <pre><?php 
        echo "Is Array: " . (is_array($laporan) ? 'YES' : 'NO') . "\n";
        echo "Count: " . (is_array($laporan) ? count($laporan) : 'N/A') . "\n";
        echo "Empty: " . (empty($laporan) ? 'YES' : 'NO') . "\n";
        echo "\nData:\n";
        print_r($laporan); 
    ?></pre>
    
    <h2>All Laporan in Database:</h2>
    <?php
    $db = \Config\Database::connect();
    $query = $db->query("SELECT id, user_id, user_name, created_at FROM laporan_dosen ORDER BY created_at DESC");
    $all = $query->getResultArray();
    ?>
    <pre><?php print_r($all); ?></pre>
    
    <hr>
    <a href="<?= base_url('laporan/riwayat-dosen') ?>">Back to Riwayat</a>
</body>
</html>
