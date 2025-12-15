<?php
// Debug sederhana untuk test PHP dan CodeIgniter
echo "<!DOCTYPE html>";
echo "<html lang='id'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<title>🔍 Debug PHP & CodeIgniter</title>";
echo "<style>";
echo "body { font-family: Arial, sans-serif; padding: 20px; background: #f8f9fa; }";
echo ".box { background: white; border: 2px solid #007bff; border-radius: 10px; padding: 20px; margin: 15px 0; }";
echo ".success { border-color: #28a745; background: #d4edda; }";
echo ".error { border-color: #dc3545; background: #f8d7da; }";
echo "</style>";
echo "</head>";
echo "<body>";

echo "<h1>🔍 Debug PHP & CodeIgniter</h1>";

// Test 1: PHP Basic
echo "<div class='box success'>";
echo "<h3>✅ Test 1: PHP Berfungsi</h3>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Server: " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
echo "<p>Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
echo "<p>Script Name: " . $_SERVER['SCRIPT_NAME'] . "</p>";
echo "</div>";

// Test 2: File System
echo "<div class='box'>";
echo "<h3>📁 Test 2: File System</h3>";
try {
    $currentDir = __DIR__;
    echo "<p>Current Directory: $currentDir</p>";

    // Check if CodeIgniter files exist
    $ciFiles = [
        'app/Controllers/StatisticsController.php',
        'app/Views/admin/statistics/landing.php',
        'app/Config/Routes.php',
        'vendor/autoload.php'
    ];

    foreach ($ciFiles as $file) {
        $fullPath = $currentDir . '/' . $file;
        if (file_exists($fullPath)) {
            echo "<p>✅ $file - EXISTS</p>";
        } else {
            echo "<p>❌ $file - NOT FOUND</p>";
        }
    }
} catch (Exception $e) {
    echo "<p>❌ Error: " . $e->getMessage() . "</p>";
}
echo "</div>";

// Test 3: CodeIgniter Bootstrap
echo "<div class='box'>";
echo "<h3>🚀 Test 3: CodeIgniter Bootstrap</h3>";
try {
    // Try to load CodeIgniter
    if (file_exists(__DIR__ . '/vendor/autoload.php')) {
        require_once __DIR__ . '/vendor/autoload.php';
        echo "<p>✅ Composer autoload berhasil</p>";

        // Try to bootstrap CodeIgniter
        if (file_exists(__DIR__ . '/app/Config/Paths.php')) {
            echo "<p>✅ CodeIgniter Paths config ditemukan</p>";

            // Define paths
            $pathsConfig = __DIR__ . '/app/Config/Paths.php';
            $paths = require $pathsConfig;
            echo "<p>✅ Paths config loaded</p>";
        } else {
            echo "<p>❌ CodeIgniter Paths config tidak ditemukan</p>";
        }
    } else {
        echo "<p>❌ Composer autoload tidak ditemukan</p>";
        echo "<p>Jalankan: <code>composer install</code></p>";
    }
} catch (Exception $e) {
    echo "<p>❌ CodeIgniter Bootstrap Error: " . $e->getMessage() . "</p>";
}
echo "</div>";

// Test 4: Database Connection (jika bisa)
echo "<div class='box'>";
echo "<h3>🗄️ Test 4: Database Connection</h3>";
try {
    // Try to read .env file
    if (file_exists(__DIR__ . '/.env')) {
        echo "<p>✅ .env file ditemukan</p>";

        $envContent = file_get_contents(__DIR__ . '/.env');
        if (strpos($envContent, 'database.default.hostname') !== false) {
            echo "<p>✅ Database config ditemukan di .env</p>";
        } else {
            echo "<p>⚠️ Database config tidak lengkap di .env</p>";
        }
    } else {
        echo "<p>❌ .env file tidak ditemukan</p>";
    }
} catch (Exception $e) {
    echo "<p>❌ Database test error: " . $e->getMessage() . "</p>";
}
echo "</div>";

// Test 5: JavaScript Test
echo "<div class='box'>";
echo "<h3>🔧 Test 5: JavaScript dalam PHP</h3>";
echo "<button onclick='testJS()'>Test JavaScript</button>";
echo "<div id='jsResult'>Belum ditest</div>";
echo "</div>";

// Test 6: Session Test
echo "<div class='box'>";
echo "<h3>🔐 Test 6: Session</h3>";
session_start();
echo "<p>Session ID: " . session_id() . "</p>";
echo "<p>Session Status: " . session_status() . "</p>";

// Set test session
$_SESSION['test'] = 'PHP Session berfungsi!';
echo "<p>Test Session: " . $_SESSION['test'] . "</p>";
echo "</div>";

// JavaScript untuk test
echo "<script>";
echo "console.log('🚀 DEBUG PHP: JavaScript loaded from PHP file!');";
echo "console.log('📅 Time:', new Date().toISOString());";
echo "alert('DEBUG PHP: JavaScript berfungsi dari file PHP!');";

echo "function testJS() {";
echo "  console.log('✅ JavaScript function called from PHP page!');";
echo "  document.getElementById('jsResult').innerHTML = '✅ JavaScript berfungsi!';";
echo "  alert('JavaScript test berhasil!');";
echo "}";

echo "setTimeout(function() {";
echo "  console.log('⏰ Delayed test: JavaScript masih berjalan setelah 2 detik');";
echo "}, 2000);";
echo "</script>";

echo "</body>";
echo "</html>";
