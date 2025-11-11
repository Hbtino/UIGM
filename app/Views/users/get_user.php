<?php
// get_user.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Koneksi ke database
$host = '127.0.0.1';
$dbname = 'capaian_kinerja';
$username = 'root';
$password = '';

// Enable error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get user ID from request
    $userId = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($userId <= 0) {
        http_response_code(400);
        echo json_encode(['error' => 'User ID tidak valid']);
        exit;
    }

    // Query database
    $stmt = $pdo->prepare("SELECT id, name, email, role FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Ensure all fields have values
        $user['id'] = $user['id'] ?? '';
        $user['name'] = $user['name'] ?? '';
        $user['email'] = $user['email'] ?? '';
        $user['role'] = $user['role'] ?? '';
        
        echo json_encode($user);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'User tidak ditemukan']);
    }

} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
} catch(Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
}
?>