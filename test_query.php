<?php
// Test query langsung
require __DIR__ . '/vendor/autoload.php';

// Bootstrap CodeIgniter
$pathsConfig = new \Config\Paths();
require rtrim($pathsConfig->systemDirectory, '\\/ ') . '/bootstrap.php';
$app = \Config\Services::codeigniter();
$app->initialize();

// Get database
$db = \Config\Database::connect();

echo "=== TEST QUERY LAPORAN ===\n\n";

// 1. Cek semua data di laporan_dosen
echo "1. Semua data di laporan_dosen:\n";
$query = $db->query("SELECT id, user_id, user_name, jurusan, program_studi, created_at FROM laporan_dosen ORDER BY created_at DESC");
$results = $query->getResultArray();
echo "Total records: " . count($results) . "\n";
foreach ($results as $row) {
    echo "  - ID: {$row['id']}, User ID: {$row['user_id']}, Name: {$row['user_name']}, Created: {$row['created_at']}\n";
}

// 2. Test dengan Model
echo "\n2. Test dengan LaporanDosenModel:\n";
$model = new \App\Models\LaporanDosenModel();

// Test untuk user_id 23 (dari database)
$userId = 23;
echo "Query untuk user_id = $userId:\n";
$laporan = $model->getLaporanByUserId($userId);
echo "Result type: " . gettype($laporan) . "\n";
echo "Result count: " . (is_array($laporan) ? count($laporan) : 'N/A') . "\n";
if (is_array($laporan) && !empty($laporan)) {
    echo "First record:\n";
    print_r($laporan[0]);
} else {
    echo "No data found!\n";
}

// 3. Test query builder langsung
echo "\n3. Test query builder langsung:\n";
$builder = $db->table('laporan_dosen');
$builder->where('user_id', $userId);
$builder->orderBy('created_at', 'DESC');
$query = $builder->get();
$results = $query->getResultArray();
echo "Result count: " . count($results) . "\n";
if (!empty($results)) {
    echo "First record:\n";
    print_r($results[0]);
}

// 4. Cek session (simulasi)
echo "\n4. Session info (jika ada):\n";
if (session()->has('user_id')) {
    echo "Session user_id: " . session()->get('user_id') . "\n";
    echo "Session user_name: " . session()->get('user_name') . "\n";
    
    // Test dengan session user_id
    $sessionUserId = session()->get('user_id');
    $laporanSession = $model->getLaporanByUserId($sessionUserId);
    echo "Laporan untuk session user_id ($sessionUserId): " . (is_array($laporanSession) ? count($laporanSession) : 'N/A') . " records\n";
} else {
    echo "No session data (run this from browser with active session)\n";
}

echo "\n=== END TEST ===\n";
