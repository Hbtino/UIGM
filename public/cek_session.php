<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cek Session</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        .box { background: white; padding: 20px; border-radius: 10px; max-width: 600px; margin: 0 auto; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #149823; }
        .info { background: #e7f3ff; padding: 15px; border-left: 4px solid #2196F3; margin: 10px 0; }
        .success { background: #d4edda; border-left-color: #28a745; }
        .error { background: #f8d7da; border-left-color: #dc3545; }
        .label { font-weight: bold; color: #666; }
        .value { color: #333; font-size: 18px; }
        a { display: inline-block; margin: 10px 5px; padding: 10px 20px; background: #149823; color: white; text-decoration: none; border-radius: 5px; }
        a:hover { background: #0d6617; }
    </style>
</head>
<body>
    <div class="box">
        <h1>🔍 Cek Session Saat Ini</h1>
        
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
            <div class="info success">
                <h3>✅ Anda Sudah Login</h3>
            </div>
            
            <div class="info">
                <div class="label">User ID:</div>
                <div class="value"><?= $_SESSION['user_id'] ?? 'NOT SET' ?></div>
            </div>
            
            <div class="info">
                <div class="label">User Name:</div>
                <div class="value"><?= $_SESSION['user_name'] ?? 'NOT SET' ?></div>
            </div>
            
            <div class="info">
                <div class="label">User Role:</div>
                <div class="value"><?= $_SESSION['user_role'] ?? 'NOT SET' ?></div>
            </div>
            
            <div class="info">
                <div class="label">Email:</div>
                <div class="value"><?= $_SESSION['user_email'] ?? 'NOT SET' ?></div>
            </div>
            
            <hr>
            
            <h3>📊 Data Laporan di Database</h3>
            <?php
            $host = 'localhost';
            $db = 'capaian_kinerja';
            $user = 'root';
            $pass = '';
            
            try {
                $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
                $userId = $_SESSION['user_id'];
                
                $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM laporan_dosen WHERE user_id = ?");
                $stmt->execute([$userId]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($result['total'] > 0) {
                    echo '<div class="info success">';
                    echo '<div class="label">Jumlah Laporan Anda:</div>';
                    echo '<div class="value">' . $result['total'] . ' laporan</div>';
                    echo '</div>';
                    
                    echo '<p><strong>✅ Data laporan ditemukan!</strong> Seharusnya muncul di halaman riwayat.</p>';
                } else {
                    echo '<div class="info error">';
                    echo '<div class="label">Jumlah Laporan Anda:</div>';
                    echo '<div class="value">0 laporan</div>';
                    echo '</div>';
                    
                    echo '<p><strong>❌ Anda belum memiliki laporan.</strong> Silakan buat laporan terlebih dahulu.</p>';
                }
                
            } catch (PDOException $e) {
                echo '<div class="info error">Error: ' . $e->getMessage() . '</div>';
            }
            ?>
            
            <hr>
            
            <h3>🔗 Quick Links</h3>
            <a href="/laporan">Form Laporan</a>
            <a href="/laporan/riwayat-dosen">Riwayat Laporan</a>
            <a href="/laporan/riwayat-dosen?debug=1">Debug Mode</a>
            <a href="/logout">Logout</a>
            
        <?php else: ?>
            <div class="info error">
                <h3>❌ Anda Belum Login</h3>
                <p>Silakan login terlebih dahulu untuk melihat riwayat laporan.</p>
            </div>
            
            <a href="/login">Login Sekarang</a>
        <?php endif; ?>
    </div>
</body>
</html>
