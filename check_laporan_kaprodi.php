<?php
// Check laporan_kaprodi data
// Bootstrap CodeIgniter
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
require __DIR__ . '/vendor/autoload.php';

// Load CodeIgniter
$pathsConfig = APPPATH . 'Config/Paths.php';
require realpath($pathsConfig) ?: $pathsConfig;

$paths = new Config\Paths();
$bootstrap = rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';
$app = require realpath($bootstrap) ?: $bootstrap;

$db = \Config\Database::connect();

echo "<h2>Checking laporan_kaprodi table</h2>";

// Get all laporan
$query = $db->query("SELECT * FROM laporan_kaprodi ORDER BY created_at DESC LIMIT 5");
$results = $query->getResultArray();

echo "<p>Total records found: " . count($results) . "</p>";

if (!empty($results)) {
    echo "<h3>Sample Data:</h3>";
    foreach ($results as $row) {
        echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px 0;'>";
        echo "<strong>ID:</strong> " . ($row['id'] ?? 'NULL') . "<br>";
        echo "<strong>User ID:</strong> " . ($row['user_id'] ?? 'NULL') . "<br>";
        echo "<strong>Prodi ID:</strong> " . ($row['prodi_id'] ?? 'NULL') . "<br>";
        echo "<strong>Prodi Name:</strong> " . ($row['prodi_name'] ?? 'NULL') . "<br>";
        echo "<strong>Kaprodi Name:</strong> " . ($row['kaprodi_name'] ?? 'NULL') . "<br>";
        echo "<strong>Jurusan:</strong> " . ($row['jurusan'] ?? 'NULL') . "<br>";
        echo "<strong>Tanggal Laporan:</strong> " . ($row['tanggal_laporan'] ?? 'NULL') . "<br>";
        echo "<strong>Created At:</strong> " . ($row['created_at'] ?? 'NULL') . "<br>";
        
        // Check data_laporan JSON
        if (!empty($row['data_laporan'])) {
            $data = json_decode($row['data_laporan'], true);
            echo "<strong>Data Laporan (JSON):</strong><br>";
            echo "<pre style='background: #f5f5f5; padding: 10px; overflow: auto; max-height: 200px;'>";
            echo "prodi_name: " . ($data['prodi_name'] ?? 'NOT SET') . "\n";
            echo "kaprodi_name: " . ($data['kaprodi_name'] ?? 'NOT SET') . "\n";
            echo "jurusan: " . ($data['jurusan'] ?? 'NOT SET') . "\n";
            echo "</pre>";
        }
        echo "</div>";
    }
} else {
    echo "<p style='color: red;'>No records found in laporan_kaprodi table!</p>";
}

// Check table structure
echo "<h3>Table Structure:</h3>";
$query = $db->query("DESCRIBE laporan_kaprodi");
$columns = $query->getResultArray();
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
foreach ($columns as $col) {
    echo "<tr>";
    echo "<td>" . $col['Field'] . "</td>";
    echo "<td>" . $col['Type'] . "</td>";
    echo "<td>" . $col['Null'] . "</td>";
    echo "<td>" . $col['Key'] . "</td>";
    echo "<td>" . ($col['Default'] ?? 'NULL') . "</td>";
    echo "</tr>";
}
echo "</table>";
