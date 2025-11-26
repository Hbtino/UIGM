<?php
// Test delete functionality
$host = 'localhost';
$db = 'capaian_kinerja';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== TEST DELETE LAPORAN ===\n\n";
    
    // Get a laporan to test
    $stmt = $pdo->query("SELECT id, user_id, user_name FROM laporan_dosen ORDER BY id DESC LIMIT 1");
    $laporan = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($laporan) {
        echo "Found laporan:\n";
        echo "  ID: {$laporan['id']}\n";
        echo "  User ID: {$laporan['user_id']}\n";
        echo "  User Name: {$laporan['user_name']}\n\n";
        
        // Test if we can find it
        $stmt = $pdo->prepare("SELECT * FROM laporan_dosen WHERE id = ?");
        $stmt->execute([$laporan['id']]);
        $found = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($found) {
            echo "✅ Laporan found by ID\n";
        } else {
            echo "❌ Laporan NOT found by ID\n";
        }
    } else {
        echo "No laporan found in database\n";
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
