<?php

// Simple script untuk update chart data tanpa CodeIgniter bootstrap
echo "<h2>Update GreenMetric Chart Data (Simple Version)</h2>";

// Database connection settings (dari .env)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'capaian_kinerja'; // Nama database dari .env

try {
    // Connect to database
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✅ Database connection successful<br><br>";

    // Data aktual GreenMetric
    $actualChartData = [
        'labels' => ['2023', '2024', '2025', '2026', '2027', '2028'],
        'datasets' => [
            [
                'label' => 'Setting & Infrastructure (SI)',
                'data' => [1085, 900, 1090, 1200, 1300, 1400],
                'backgroundColor' => 'rgba(54, 162, 235, 0.8)',
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 2,
                'borderRadius' => 6
            ],
            [
                'label' => 'Energy & Climate Change (EC)',
                'data' => [1050, 1300, 1260, 1350, 1400, 1450],
                'backgroundColor' => 'rgba(255, 206, 86, 0.8)',
                'borderColor' => 'rgba(255, 206, 86, 1)',
                'borderWidth' => 2,
                'borderRadius' => 6
            ],
            [
                'label' => 'Waste (WS)',
                'data' => [675, 600, 725, 800, 850, 900],
                'backgroundColor' => 'rgba(75, 192, 192, 0.8)',
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'borderWidth' => 2,
                'borderRadius' => 6
            ],
            [
                'label' => 'Water (WR)',
                'data' => [300, 300, 288, 350, 400, 450],
                'backgroundColor' => 'rgba(153, 102, 255, 0.8)',
                'borderColor' => 'rgba(153, 102, 255, 1)',
                'borderWidth' => 2,
                'borderRadius' => 6
            ],
            [
                'label' => 'Transportation (TR)',
                'data' => [485, 535, 875, 900, 950, 1000],
                'backgroundColor' => 'rgba(255, 99, 132, 0.8)',
                'borderColor' => 'rgba(255, 99, 132, 1)',
                'borderWidth' => 2,
                'borderRadius' => 6
            ],
            [
                'label' => 'Education & Research (ED)',
                'data' => [950, 925, 1363, 1400, 1450, 1500],
                'backgroundColor' => 'rgba(255, 159, 64, 0.8)',
                'borderColor' => 'rgba(255, 159, 64, 1)',
                'borderWidth' => 2,
                'borderRadius' => 6
            ]
        ],
        'totalScore' => [4345, 4560, 5410, 5800, 6200, 6500],
        'worldRank' => [null, 1032, 942, 800, 700, 600],
        'indonesiaRank' => [87, null, null, 60, 50, 40]
    ];

    // Convert to JSON
    $chartDataJson = json_encode($actualChartData, JSON_UNESCAPED_SLASHES);

    // Check if table exists
    $checkTable = $pdo->query("SHOW TABLES LIKE 'charts_indicators'");
    if ($checkTable->rowCount() == 0) {
        echo "❌ Table 'charts_indicators' tidak ditemukan<br>";
        echo "Silakan buat table terlebih dahulu atau jalankan migrasi database<br>";
        exit;
    }

    // Check if chart exists
    $stmt = $pdo->prepare("SELECT * FROM charts_indicators WHERE title = ? AND display_location = ?");
    $stmt->execute(['Capaian Kriteria Kampus Berkelanjutan', 'landing']);
    $existingChart = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingChart) {
        // Update existing chart
        $updateStmt = $pdo->prepare("
            UPDATE charts_indicators 
            SET chart_data = ?, 
                description = ?, 
                data_source = ?, 
                updated_at = NOW() 
            WHERE id = ?
        ");

        $result = $updateStmt->execute([
            $chartDataJson,
            'Grafik peningkatan skor keseluruhan kampus berkelanjutan berdasarkan data GreenMetric aktual 2023-2025',
            'greenmetric',
            $existingChart['id']
        ]);

        if ($result) {
            echo "✅ Chart data berhasil diupdate dengan data GreenMetric aktual<br>";
            echo "Chart ID: " . $existingChart['id'] . "<br>";
        } else {
            echo "❌ Gagal mengupdate chart data<br>";
        }
    } else {
        // Insert new chart
        $insertStmt = $pdo->prepare("
            INSERT INTO charts_indicators (
                chart_type, title, description, data_source, chart_data, 
                chart_config, display_location, section, order_position, 
                is_active, sync_with_statistics, created_at, updated_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
        ");

        $result = $insertStmt->execute([
            'bar',
            'Capaian Kriteria Kampus Berkelanjutan',
            'Grafik peningkatan skor keseluruhan kampus berkelanjutan berdasarkan data GreenMetric aktual 2023-2025',
            'greenmetric',
            $chartDataJson,
            '{}',
            'landing',
            'charts',
            1,
            1,
            0
        ]);

        if ($result) {
            echo "✅ Chart baru berhasil dibuat dengan data GreenMetric aktual<br>";
            echo "Chart ID: " . $pdo->lastInsertId() . "<br>";
        } else {
            echo "❌ Gagal membuat chart baru<br>";
        }
    }

    echo "<br><h3>Data GreenMetric yang diupdate:</h3>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%; font-size: 12px;'>";
    echo "<tr style='background-color: #f0f0f0;'><th>Tahun</th><th>Global Rank</th><th>Total Score</th><th>SI</th><th>EC</th><th>WS</th><th>WR</th><th>TR</th><th>ED</th></tr>";
    echo "<tr><td>2023</td><td>-</td><td><strong>4345</strong></td><td>1085</td><td>1050</td><td>675</td><td>300</td><td>485</td><td>950</td></tr>";
    echo "<tr><td>2024</td><td><strong>1032</strong></td><td><strong>4560</strong></td><td>900</td><td>1300</td><td>600</td><td>300</td><td>535</td><td>925</td></tr>";
    echo "<tr><td>2025</td><td><strong>942</strong></td><td><strong>5410</strong></td><td>1090</td><td>1260</td><td>725</td><td>288</td><td>875</td><td>1363</td></tr>";
    echo "<tr style='background-color: #e8f4f8;'><td>2026</td><td>800 (target)</td><td>5800 (target)</td><td>1200</td><td>1350</td><td>800</td><td>350</td><td>900</td><td>1400</td></tr>";
    echo "<tr style='background-color: #e8f4f8;'><td>2027</td><td>700 (target)</td><td>6200 (target)</td><td>1300</td><td>1400</td><td>850</td><td>400</td><td>950</td><td>1450</td></tr>";
    echo "<tr style='background-color: #e8f4f8;'><td>2028</td><td>600 (target)</td><td>6500 (target)</td><td>1400</td><td>1450</td><td>900</td><td>450</td><td>1000</td><td>1500</td></tr>";
    echo "</table>";

    echo "<br><p><strong>Keterangan:</strong></p>";
    echo "<ul>";
    echo "<li><strong>Data 2023-2025:</strong> Data aktual dari GreenMetric (warna putih)</li>";
    echo "<li><strong>Data 2026-2028:</strong> Proyeksi target masa depan (warna biru muda)</li>";
    echo "<li><strong>Peningkatan Global Rank:</strong> 1032 (2024) → 942 (2025) = naik 90 posisi</li>";
    echo "<li><strong>Peningkatan Total Score:</strong> 4560 (2024) → 5410 (2025) = +850 poin (+18.6%)</li>";
    echo "</ul>";

    echo "<br><p><strong>✅ Update berhasil!</strong> Grafik di landing page sekarang menampilkan data GreenMetric yang akurat.</p>";
} catch (PDOException $e) {
    echo "❌ Database Error: " . $e->getMessage() . "<br>";
    echo "<br><p>Pastikan:</p>";
    echo "<ul>";
    echo "<li>Database server berjalan</li>";
    echo "<li>Nama database, username, dan password benar</li>";
    echo "<li>Table 'charts_indicators' sudah ada</li>";
    echo "</ul>";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
}
