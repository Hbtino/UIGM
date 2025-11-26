<?php
// Fix CMS Duplicate Menus
// Run this file once to remove duplicate menus

// Database connection
$host = 'localhost';
$dbname = 'capaian_kinerja';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Fixing CMS duplicate menus...\n\n";
    
    // Delete all menus with /cms/ prefix (wrong URLs)
    $stmt1 = $pdo->exec("DELETE FROM menus WHERE url LIKE '/cms/%'");
    echo "Deleted all menus with /cms/ prefix: Success ($stmt1 rows affected)\n";
    
    echo "\nVerifying remaining menus:\n";
    $query = $pdo->query("SELECT id, title, url FROM menus WHERE title LIKE '%Manajemen%' OR title LIKE '%CMS%' ORDER BY id");
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($results as $row) {
        echo "ID: {$row['id']} - {$row['title']} - {$row['url']}\n";
    }
    
    echo "\nDone!\n";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
