<?php
// Test session dan query
session_start();

echo "=== TEST SESSION & QUERY ===\n\n";

// Check session
echo "1. SESSION DATA:\n";
echo "   Logged In: " . (isset($_SESSION['logged_in']) ? ($_SESSION['logged_in'] ? 'Yes' : 'No') : 'NOT SET') . "\n";
echo "   User ID: " . ($_SESSION['user_id'] ?? 'NOT SET') . "\n";
echo "   User Name: " . ($_SESSION['user_name'] ?? 'NOT SET') . "\n";
echo "   User Role: " . ($_SESSION['user_role'] ?? 'NOT SET') . "\n\n";

// Database connection
$host = 'localhost';
$db = 'capaian_kinerja';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get user_id from session or use default for testing
    $testUserId = $_SESSION['user_id'] ?? 23;
    
    echo "2. QUERY TEST (User ID: $testUserId):\n";
    
    // Test query
    $stmt = $pdo->prepare("SELECT * FROM laporan_dosen WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$testUserId]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "   Records found: " . count($results) . "\n\n";
    
    if (count($results) > 0) {
        echo "3. FIRST RECORD:\n";
        $first = $results[0];
        echo "   ID: {$first['id']}\n";
        echo "   User ID: {$first['user_id']}\n";
        echo "   User Name: {$first['user_name']}\n";
        echo "   Jurusan: {$first['jurusan']}\n";
        echo "   Program Studi: {$first['program_studi']}\n";
        echo "   Created: {$first['created_at']}\n";
        echo "   Updated: {$first['updated_at']}\n";
    } else {
        echo "3. NO RECORDS FOUND\n";
        echo "   Possible reasons:\n";
        echo "   - User ID $testUserId has no laporan\n";
        echo "   - Table is empty\n";
        echo "   - Wrong user_id\n";
    }
    
    echo "\n4. ALL USERS WITH LAPORAN:\n";
    $stmt = $pdo->query("SELECT DISTINCT user_id, user_name, COUNT(*) as total FROM laporan_dosen GROUP BY user_id, user_name");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($users as $u) {
        echo "   User ID {$u['user_id']} ({$u['user_name']}): {$u['total']} laporan\n";
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "\n=== TEST COMPLETE ===\n";
