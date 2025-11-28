<?php
// Debug script untuk memeriksa session dan cookies
session_start();

echo "<h2>Debug Session & Cookies</h2>";

echo "<h3>1. Session Data:</h3>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<h3>2. All Cookies:</h3>";
echo "<pre>";
print_r($_COOKIE);
echo "</pre>";

echo "<h3>3. Session Config:</h3>";
echo "Driver: " . ini_get('session.save_handler') . "<br>";
echo "Cookie Name: " . ini_get('session.name') . "<br>";
echo "Expiration: " . ini_get('session.gc_maxlifetime') . " seconds<br>";
echo "Save Path: " . ini_get('session.save_path') . "<br>";

echo "<h3>4. PHP Session Info:</h3>";
echo "Session ID: " . session_id() . "<br>";
echo "Session Status: " . session_status() . "<br>";
echo "Session Cookie Params:<br>";
echo "<pre>";
print_r(session_get_cookie_params());
echo "</pre>";

echo "<h3>5. User Info from Database:</h3>";
if (isset($_COOKIE['user_id'])) {
    $userId = $_COOKIE['user_id'];
    echo "User ID from cookie: " . $userId . "<br>";

    // Connect to database (adjust connection details)
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
        $stmt = $pdo->prepare("SELECT id, name, email, role, remember_token, remember_token_active, remember_token_expires FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo "<pre>";
            print_r($user);
            echo "</pre>";
        } else {
            echo "User not found in database<br>";
        }
    } catch (Exception $e) {
        echo "Database connection error: " . $e->getMessage() . "<br>";
    }
} else {
    echo "No user_id cookie found<br>";
}

echo "<h3>Actions:</h3>";
echo '<a href="?action=clear_session">Clear Session</a> | ';
echo '<a href="?action=clear_cookies">Clear Cookies</a> | ';
echo '<a href="?action=clear_all">Clear All</a><br><br>';

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'clear_session':
            session_destroy();
            echo "Session cleared!<br>";
            break;
        case 'clear_cookies':
            if (isset($_COOKIE['remember_token'])) {
                setcookie('remember_token', '', time() - 3600, '/');
            }
            if (isset($_COOKIE['user_id'])) {
                setcookie('user_id', '', time() - 3600, '/');
            }
            echo "Cookies cleared!<br>";
            break;
        case 'clear_all':
            session_destroy();
            if (isset($_COOKIE['remember_token'])) {
                setcookie('remember_token', '', time() - 3600, '/');
            }
            if (isset($_COOKIE['user_id'])) {
                setcookie('user_id', '', time() - 3600, '/');
            }
            echo "Session and cookies cleared!<br>";
            break;
    }
    echo '<meta http-equiv="refresh" content="2">';
}

echo "<br><a href='/'>Back to Home</a> | <a href='/login'>Login Page</a> | <a href='/dashboard'>Dashboard</a>";
