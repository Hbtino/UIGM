<?php
// Debug script untuk cek data laporan

require 'vendor/autoload.php';

// Load CodeIgniter
$app = require_once FCPATH . '../app/Config/Paths.php';
$paths = new Config\Paths();
$bootstrap = rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';
$app = require realpath($bootstrap) ?: $bootstrap;

// Get database connection
$db = \Config\Database::connect();

// Query laporan_dosen
echo "=== LAPORAN DOSEN ===\n";
$query = $db->query("SELECT id, user_id, user_name, jurusan, program_studi, created_at FROM laporan_dosen ORDER BY created_at DESC");
$results = $query->getResultArray();

if (empty($results)) {
    echo "Tidak ada data\n";
} else {
    foreach ($results as $row) {
        echo "ID: {$row['id']}\n";
        echo "User ID: {$row['user_id']}\n";
        echo "User Name: {$row['user_name']}\n";
        echo "Jurusan: {$row['jurusan']}\n";
        echo "Program Studi: {$row['program_studi']}\n";
        echo "Created: {$row['created_at']}\n";
        echo "---\n";
    }
}

// Query users untuk cek user_id
echo "\n=== USERS (Dosen) ===\n";
$query = $db->query("SELECT id, name, email, role FROM users WHERE role = 'dosen' ORDER BY id");
$results = $query->getResultArray();

foreach ($results as $row) {
    echo "ID: {$row['id']}\n";
    echo "Name: {$row['name']}\n";
    echo "Email: {$row['email']}\n";
    echo "Role: {$row['role']}\n";
    echo "---\n";
}
