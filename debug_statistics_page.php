<?php
// Debug statistics page loading
echo "<h1>Debug Statistics Page Loading</h1>";

// Test 1: Basic PHP
echo "<h2>Test 1: Basic PHP</h2>";
echo "✅ PHP is working<br>";
echo "Current time: " . date('Y-m-d H:i:s') . "<br>";

// Test 2: Session
echo "<h2>Test 2: Session</h2>";
session_start();
echo "Session ID: " . session_id() . "<br>";
echo "Session data: <pre>" . print_r($_SESSION, true) . "</pre>";

// Test 3: CodeIgniter Bootstrap
echo "<h2>Test 3: CodeIgniter Bootstrap</h2>";
try {
    // Try to load CodeIgniter
    require_once 'vendor/autoload.php';

    // Set environment
    define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
    define('SYSTEMPATH', __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'codeigniter4' . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR);
    define('APPPATH', __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR);
    define('WRITEPATH', __DIR__ . DIRECTORY_SEPARATOR . 'writable' . DIRECTORY_SEPARATOR);

    echo "✅ CodeIgniter paths defined<br>";

    // Test database
    $db = \Config\Database::connect();
    echo "✅ Database connected<br>";

    // Test session service
    $session = \Config\Services::session();
    echo "✅ Session service loaded<br>";
} catch (Exception $e) {
    echo "❌ CodeIgniter Error: " . $e->getMessage() . "<br>";
}

// Test 4: Direct URL Test
echo "<h2>Test 4: URL Tests</h2>";
echo "<a href='http://localhost/UIGM/public/test-simple.html' target='_blank'>Test Simple HTML</a><br>";
echo "<a href='http://localhost/UIGM/debug-js' target='_blank'>Test Debug JS Controller</a><br>";
echo "<a href='http://localhost/UIGM/landing-statistics' target='_blank'>Test Statistics Page</a><br>";

// Test 5: JavaScript Test
echo "<h2>Test 5: JavaScript Test</h2>";
?>
<script>
    console.log('🚀 DEBUG PAGE: JavaScript working!');
    alert('DEBUG PAGE: JavaScript test!');
</script>

<p>Jika Anda melihat alert dan pesan di console, JavaScript berfungsi di halaman ini.</p>