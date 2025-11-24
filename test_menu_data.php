<?php
// Test script untuk cek data menu
require_once 'vendor/autoload.php';

$db = \Config\Database::connect();

echo "=== MENU DASHBOARD ===\n";
$dashboard = $db->query("SELECT id, title, menu_type, roles FROM menus WHERE menu_type = 'dashboard' LIMIT 3")->getResultArray();
foreach ($dashboard as $m) {
    echo "ID: {$m['id']} | Title: {$m['title']} | Roles: {$m['roles']}\n";
}

echo "\n=== MENU LANDING ===\n";
$landing = $db->query("SELECT id, title, menu_type, roles FROM menus WHERE menu_type = 'landing' LIMIT 5")->getResultArray();
foreach ($landing as $m) {
    echo "ID: {$m['id']} | Title: {$m['title']} | Roles: {$m['roles']}\n";
}

echo "\n=== SEMUA MENU ===\n";
$all = $db->query("SELECT id, title, menu_type, roles FROM menus ORDER BY menu_type, `order`")->getResultArray();
foreach ($all as $m) {
    $type = $m['menu_type'] ?? 'dashboard';
    echo "ID: {$m['id']} | {$m['title']} | Type: {$type} | Roles: {$m['roles']}\n";
}
