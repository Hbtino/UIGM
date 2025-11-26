<?php
// Add CMS Menus (without duplicates)
// Run this file once to add CMS menus

// Database connection
$host = 'localhost';
$dbname = 'capaian_kinerja';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Adding CMS menus...\n\n";
    
    // Check if menus already exist
    $check = $pdo->query("SELECT COUNT(*) as count FROM menus WHERE url IN ('/menus', '/news-admin', '/landing-contents')");
    $existing = $check->fetch(PDO::FETCH_ASSOC)['count'];
    
    if ($existing > 0) {
        echo "CMS menus already exist. Skipping...\n";
    } else {
        // Get max order number
        $maxOrder = $pdo->query("SELECT MAX(`order`) as max_order FROM menus")->fetch(PDO::FETCH_ASSOC)['max_order'];
        $nextOrder = $maxOrder + 1;
        
        // Insert Manajemen Menu
        $stmt1 = $pdo->prepare("INSERT INTO menus (title, url, icon, parent_id, `order`, is_active, roles, menu_type, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt1->execute(['Manajemen Menu', '/menus', 'fas fa-bars', null, $nextOrder, 1, '["admin"]', 'Dashboard']);
        echo "Added 'Manajemen Menu': Success\n";
        
        // Insert Manajemen Berita
        $stmt2 = $pdo->prepare("INSERT INTO menus (title, url, icon, parent_id, `order`, is_active, roles, menu_type, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt2->execute(['Manajemen Berita', '/news-admin', 'fas fa-newspaper', null, $nextOrder + 1, 1, '["admin"]', 'Dashboard']);
        echo "Added 'Manajemen Berita': Success\n";
        
        // Insert Konten Landing Page
        $stmt3 = $pdo->prepare("INSERT INTO menus (title, url, icon, parent_id, `order`, is_active, roles, menu_type, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt3->execute(['Konten Landing Page', '/landing-contents', 'fas fa-file-alt', null, $nextOrder + 2, 1, '["admin"]', 'Dashboard']);
        echo "Added 'Konten Landing Page': Success\n";
    }
    
    echo "\nVerifying all menus:\n";
    $query = $pdo->query("SELECT id, title, url, menu_type FROM menus WHERE menu_type = 'Dashboard' ORDER BY `order`");
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($results as $row) {
        echo "ID: {$row['id']} - {$row['title']} - {$row['url']}\n";
    }
    
    echo "\nDone!\n";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
