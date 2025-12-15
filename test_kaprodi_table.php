<?php
// Test if laporan_kaprodi table exists and has correct structure

require 'vendor/autoload.php';

// Bootstrap CodeIgniter
$pathsConfig = new Config\Paths();
$bootstrap = \CodeIgniter\Boot::bootWeb($pathsConfig);

$db = \Config\Database::connect();

echo "Testing laporan_kaprodi table...\n\n";

// Check if table exists
if ($db->tableExists('laporan_kaprodi')) {
    echo "✓ Table 'laporan_kaprodi' exists\n\n";
    
    // Get table structure
    $fields = $db->getFieldData('laporan_kaprodi');
    echo "Table structure:\n";
    foreach ($fields as $field) {
        echo "  - {$field->name} ({$field->type})\n";
    }
    
    // Count records
    $count = $db->table('laporan_kaprodi')->countAllResults();
    echo "\nTotal records: {$count}\n";
    
} else {
    echo "✗ Table 'laporan_kaprodi' does NOT exist\n";
}
