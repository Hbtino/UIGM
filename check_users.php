<?php
$pdo = new PDO('mysql:host=localhost;dbname=capaian_kinerja', 'root', '');
$stmt = $pdo->query('SELECT id, name, email, role FROM users WHERE id IN (2, 15, 23) ORDER BY id');

echo "=== USERS INFO ===\n\n";
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "ID: {$row['id']}\n";
    echo "Name: {$row['name']}\n";
    echo "Email: {$row['email']}\n";
    echo "Role: {$row['role']}\n";
    echo "---\n";
}
