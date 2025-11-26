<?php

// Simple debug script
$host = 'localhost';
$db = 'capaian_kinerja';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== DEBUG RIWAYAT LAPORAN ===\n\n";
    
    // Check all data
    echo "=== ALL DATA IN laporan_dosen ===\n";
    $stmt = $pdo->query("SELECT * FROM laporan_dosen ORDER BY created_at DESC");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Total records: " . count($results) . "\n\n";
    
    foreach ($results as $row) {
        echo "ID: {$row['id']}\n";
        echo "User ID: {$row['user_id']}\n";
        echo "User Name: {$row['user_name']}\n";
        echo "Jurusan: {$row['jurusan']}\n";
        echo "Program Studi: {$row['program_studi']}\n";
        echo "Created: {$row['created_at']}\n";
        echo "Updated: {$row['updated_at']}\n";
        echo "---\n\n";
    }
    
    // Test query with specific user_id
    $testUserId = 23;
    echo "=== QUERY FOR USER_ID = $testUserId ===\n";
    $stmt = $pdo->prepare("SELECT * FROM laporan_dosen WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$testUserId]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Records found: " . count($results) . "\n\n";
    
    foreach ($results as $row) {
        echo "ID: {$row['id']}\n";
        echo "User Name: {$row['user_name']}\n";
        echo "Created: {$row['created_at']}\n";
        echo "---\n";
    }
    
    echo "\n=== DEBUG COMPLETE ===\n";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
