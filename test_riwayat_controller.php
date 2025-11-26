<?php

// Test script untuk controller riwayat
require __DIR__ . '/vendor/autoload.php';

// Bootstrap CodeIgniter
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
$pathsConfig = new Config\Paths();
$bootstrap = rtrim($pathsConfig->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';
require realpath($bootstrap) ?: $bootstrap;

// Start session
$session = \Config\Services::session();
$session->start();

// Set test session data
$_SESSION['logged_in'] = true;
$_SESSION['user_id'] = 23;
$_SESSION['user_name'] = 'Ahmad Hidayat';
$_SESSION['user_role'] = 'dosen';

echo "=== TEST RIWAYAT CONTROLLER ===\n\n";

// Test LaporanDosenModel
echo "1. Testing LaporanDosenModel\n";
$laporanModel = new \App\Models\LaporanDosenModel();
$userId = 23;

echo "   User ID: $userId\n";

// Test method 1: getLaporanByUserId
$result1 = $laporanModel->getLaporanByUserId($userId);
echo "   getLaporanByUserId() count: " . (is_array($result1) ? count($result1) : 'NOT ARRAY') . "\n";

// Test method 2: Direct query
$result2 = $laporanModel->where('user_id', $userId)
                        ->orderBy('created_at', 'DESC')
                        ->findAll();
echo "   Direct query count: " . (is_array($result2) ? count($result2) : 'NOT ARRAY') . "\n";

if (is_array($result2) && !empty($result2)) {
    echo "\n   First record:\n";
    echo "   - ID: {$result2[0]['id']}\n";
    echo "   - User Name: {$result2[0]['user_name']}\n";
    echo "   - Jurusan: {$result2[0]['jurusan']}\n";
    echo "   - Created: {$result2[0]['created_at']}\n";
}

echo "\n2. Testing LaporanKaprodiModel\n";
$laporanKaprodiModel = new \App\Models\LaporanKaprodiModel();

$result3 = $laporanKaprodiModel->where('user_id', $userId)
                               ->orderBy('created_at', 'DESC')
                               ->findAll();
echo "   Direct query count: " . (is_array($result3) ? count($result3) : 'NOT ARRAY') . "\n";

echo "\n=== TEST COMPLETE ===\n";
