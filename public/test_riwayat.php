<?php
// Test page untuk debug riwayat laporan
// Akses: http://localhost/test_riwayat.php

session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Riwayat Laporan</title>
    <style>
        body { font-family: monospace; padding: 20px; background: #f5f5f5; }
        .section { background: white; padding: 15px; margin: 10px 0; border-radius: 5px; border-left: 4px solid #149823; }
        .error { border-left-color: #dc3545; }
        .success { border-left-color: #28a745; }
        h2 { margin-top: 0; color: #149823; }
        pre { background: #f8f9fa; padding: 10px; border-radius: 3px; overflow-x: auto; }
        .label { font-weight: bold; color: #666; }
    </style>
</head>
<body>
    <h1>🔍 Test Riwayat Laporan Debug</h1>
    
    <div class="section">
        <h2>1. Session Data</h2>
        <div class="label">Logged In:</div>
        <pre><?= isset($_SESSION['logged_in']) ? ($_SESSION['logged_in'] ? 'Yes ✅' : 'No ❌') : 'NOT SET ❌' ?></pre>
        
        <div class="label">User ID:</div>
        <pre><?= $_SESSION['user_id'] ?? 'NOT SET ❌' ?></pre>
        
        <div class="label">User Name:</div>
        <pre><?= $_SESSION['user_name'] ?? 'NOT SET ❌' ?></pre>
        
        <div class="label">User Role:</div>
        <pre><?= $_SESSION['user_role'] ?? 'NOT SET ❌' ?></pre>
    </div>
    
    <?php
    // Database connection
    $host = 'localhost';
    $db = 'capaian_kinerja';
    $user = 'root';
    $pass = '';
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        echo '<div class="section success">';
        echo '<h2>2. Database Connection</h2>';
        echo '<pre>✅ Connected to database: ' . $db . '</pre>';
        echo '</div>';
        
        // Get user_id from session
        $userId = $_SESSION['user_id'] ?? null;
        
        if ($userId) {
            echo '<div class="section">';
            echo '<h2>3. Query for User ID: ' . $userId . '</h2>';
            
            $stmt = $pdo->prepare("SELECT * FROM laporan_dosen WHERE user_id = ? ORDER BY created_at DESC");
            $stmt->execute([$userId]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo '<div class="label">Records Found:</div>';
            echo '<pre>' . count($results) . '</pre>';
            
            if (count($results) > 0) {
                echo '<div class="label">Data:</div>';
                echo '<pre>';
                foreach ($results as $row) {
                    echo "ID: {$row['id']}\n";
                    echo "User ID: {$row['user_id']}\n";
                    echo "User Name: {$row['user_name']}\n";
                    echo "Jurusan: {$row['jurusan']}\n";
                    echo "Program Studi: {$row['program_studi']}\n";
                    echo "Created: {$row['created_at']}\n";
                    echo "Updated: {$row['updated_at']}\n";
                    echo "---\n";
                }
                echo '</pre>';
            } else {
                echo '<div class="error" style="padding: 10px; background: #f8d7da; border-radius: 3px;">';
                echo '❌ No records found for user_id: ' . $userId;
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<div class="section error">';
            echo '<h2>3. Query Test</h2>';
            echo '<pre>❌ Cannot query: User ID not set in session</pre>';
            echo '<p><strong>Solution:</strong> Please login first at <a href="/login">Login Page</a></p>';
            echo '</div>';
        }
        
        // Show all users with laporan
        echo '<div class="section">';
        echo '<h2>4. All Users with Laporan</h2>';
        $stmt = $pdo->query("SELECT DISTINCT user_id, user_name, COUNT(*) as total FROM laporan_dosen GROUP BY user_id, user_name ORDER BY total DESC");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($users) > 0) {
            echo '<pre>';
            foreach ($users as $u) {
                echo "User ID: {$u['user_id']} | Name: {$u['user_name']} | Total Laporan: {$u['total']}\n";
            }
            echo '</pre>';
        } else {
            echo '<pre>No data in laporan_dosen table</pre>';
        }
        echo '</div>';
        
        // Test CodeIgniter Model
        echo '<div class="section">';
        echo '<h2>5. CodeIgniter Model Test</h2>';
        
        // Load CodeIgniter
        require_once '../vendor/autoload.php';
        
        // Check if we can load CI
        if (file_exists('../app/Config/Paths.php')) {
            echo '<pre>✅ CodeIgniter files found</pre>';
            
            // Try to test the query that controller uses
            if ($userId) {
                echo '<div class="label">Testing query:</div>';
                echo '<pre>SELECT * FROM laporan_dosen WHERE user_id = ' . $userId . ' ORDER BY created_at DESC</pre>';
                
                $stmt = $pdo->prepare("SELECT * FROM laporan_dosen WHERE user_id = ? ORDER BY created_at DESC");
                $stmt->execute([$userId]);
                $testResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo '<div class="label">Result:</div>';
                echo '<pre>' . count($testResults) . ' records (This is what controller should get)</pre>';
            }
        } else {
            echo '<pre>❌ CodeIgniter files not found</pre>';
        }
        echo '</div>';
        
    } catch (PDOException $e) {
        echo '<div class="section error">';
        echo '<h2>Database Error</h2>';
        echo '<pre>' . $e->getMessage() . '</pre>';
        echo '</div>';
    }
    ?>
    
    <div class="section">
        <h2>6. Quick Actions</h2>
        <p>
            <a href="/login" style="padding: 10px 20px; background: #149823; color: white; text-decoration: none; border-radius: 5px;">Login</a>
            <a href="/laporan/riwayat-dosen" style="padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; margin-left: 10px;">Go to Riwayat Dosen</a>
            <a href="/laporan/riwayat-dosen?debug=1" style="padding: 10px 20px; background: #ffc107; color: black; text-decoration: none; border-radius: 5px; margin-left: 10px;">Debug Mode</a>
        </p>
    </div>
    
    <div class="section">
        <h2>7. Troubleshooting</h2>
        <ul>
            <li>If "User ID" is NOT SET: <strong>Login first</strong></li>
            <li>If "Records Found" is 0: <strong>Save a laporan first</strong></li>
            <li>If database error: <strong>Check XAMPP MySQL is running</strong></li>
            <li>If still not working: <strong>Check writable/logs/ for errors</strong></li>
        </ul>
    </div>
</body>
</html>
