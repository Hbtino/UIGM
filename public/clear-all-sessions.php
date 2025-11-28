<?php
// Script untuk membersihkan semua session dan remember token
require_once '../vendor/autoload.php';

// Load CodeIgniter
$app = \Config\Services::codeigniter();
$app->initialize();

// Connect to database
$db = \Config\Database::connect();

echo "<h2>Clear All Sessions & Remember Tokens</h2>";

try {
    // 1. Clear all remember tokens from database
    $result = $db->table('users')->update([
        'remember_token' => null,
        'remember_token_active' => 0,
        'remember_token_expires' => null
    ]);

    echo "✓ Cleared " . $db->affectedRows() . " remember tokens from database<br>";

    // 2. Clear session files (if using file-based sessions)
    $sessionPath = WRITEPATH . 'session';
    if (is_dir($sessionPath)) {
        $files = glob($sessionPath . '/ci_session*');
        $deletedFiles = 0;
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
                $deletedFiles++;
            }
        }
        echo "✓ Deleted " . $deletedFiles . " session files<br>";
    }

    // 3. Clear current session and cookies
    session_start();
    session_destroy();

    if (isset($_COOKIE['remember_token'])) {
        setcookie('remember_token', '', time() - 3600, '/');
    }
    if (isset($_COOKIE['user_id'])) {
        setcookie('user_id', '', time() - 3600, '/');
    }
    if (isset($_COOKIE['ci_session'])) {
        setcookie('ci_session', '', time() - 3600, '/');
    }

    echo "✓ Cleared current session and cookies<br>";

    echo "<br><strong>All sessions and remember tokens have been cleared!</strong><br>";
    echo "<br>Now you can test the login functionality:<br>";
    echo "1. Go to <a href='/login'>/login</a><br>";
    echo "2. Login WITHOUT checking 'Remember Me'<br>";
    echo "3. Close the browser tab<br>";
    echo "4. Open a new tab and go to your website<br>";
    echo "5. You should be redirected to login page (not dashboard)<br>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}

echo "<br><br><a href='/'>Back to Home</a> | <a href='/login'>Login Page</a>";
