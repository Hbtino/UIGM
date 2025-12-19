<?php

// Script untuk mengupdate data GreenMetric dengan data aktual 2023-2025
require_once 'vendor/autoload.php';

echo "<h2>Update GreenMetric Chart Data</h2>";

try {
    // Load CodeIgniter
    $app = \Config\Services::codeigniter();
    $app->initialize();

    // Load database
    $db = \Config\Database::connect();

    // Data aktual GreenMetric
    $actualChartData = [
        'labels' => ['2023', '2024', '2025', '2026', '2027', '2028'],
        'datasets' => [
            [
                'label' => 'Setting & Infrastructure (SI)',
                'data' => [1085, 900, 1090, 1200, 1300, 1400], // Actual: 2023=1085, 2024=900, 2025=1090
                'backgroundColor' => 'rgba(54, 162, 235, 0.8)',
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 2,
                'borderRadius' => 6
            ],
            [
                'label' => 'Energy & Climate Change (EC)',
                'data' => [1050, 1300, 1260, 1350, 1400, 1450], // Actual: 2023=1050, 2024=1300, 2025=1260
                'backgroundColor' => 'rgba(255, 206, 86, 0.8)',
                'borderColor' => 'rgba(255, 206, 86, 1)',
                'borderWidth' => 2,
                'borderRadius' => 6
            ],
            [
                'label' => 'Waste (WS)',
                'data' => [675, 600, 725, 800, 850, 900], // Actual: 2023=675, 2024=600, 2025=725
                'backgroundColor' => 'rgba(75, 192, 192, 0.8)',
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'borderWidth' => 2,
                'borderRadius' => 6
            ],
            [
                'label' => 'Water (WR)',
                'data' => [300, 300, 288, 350, 400, 450], // Actual: 2023=300, 2024=300, 2025=288
                'backgroundColor' => 'rgba(153, 102, 255, 0.8)',
                'borderColor' => 'rgba(153, 102, 255, 1)',
                'borderWidth' => 2,
                'borderRadius' => 6
            ],
            [
                'label' => 'Transportation (TR)',
                'data' => [485, 535, 875, 900, 950, 1000], // Actual: 2023=485, 2024=535, 2025=875
                'backgroundColor' => 'rgba(255, 99, 132, 0.8)',
                'borderColor' => 'rgba(255, 99, 132, 1)',
                'borderWidth' => 2,
                'borderRadius' => 6
            ],
            [
                'label' => 'Education & Research (ED)',
                'data' => [950, 925, 1363, 1400, 1450, 1500], // Actual: 2023=950, 2024=925, 2025=1363
                'backgroundColor' => 'rgba(255, 159, 64, 0.8)',
                'borderColor' => 'rgba(255, 159, 64, 1)',
                'borderWidth' => 2,
                'borderRadius' => 6
            ]
        ],
        'totalScore' => [4345, 4560, 5410, 5800, 6200, 6500], // Actual: 2023=4345, 2024=4560, 2025=5410
        'worldRank' => [null, 1032, 942, 800, 700, 600], // Actual: 2024=1032, 2025=942
        'indonesiaRank' => [87, null, null, 60, 50, 40] // Actual: 2023=87
    ];

    // Convert to JSON
    $chartDataJson = json_encode($actualChartData);

    // Check if chart exists
    $existingChart = $db->table('charts_indicators')
        ->where('title', 'Capaian Kriteria Kampus Berkelanjutan')
        ->where('display_location', 'landing')
        ->get()
        ->getRowArray();

    if ($existingChart) {
        // Update existing chart
        $result = $db->table('charts_indicators')
            ->where('id', $existingChart['id'])
            ->update([
                'chart_data' => $chartDataJson,
                'description' => 'Grafik peningkatan skor keseluruhan kampus berkelanjutan berdasarkan data GreenMetric aktual 2023-2025',
                'data_source' => 'greenmetric',
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        if ($result) {
            echo "✅ Chart data berhasil diupdate dengan data GreenMetric aktual<br>";
        } else {
            echo "❌ Gagal mengupdate chart data<br>";
        }
    } else {
        // Insert new chart
        $result = $db->table('charts_indicators')->insert([
            'chart_type' => 'bar',
            'title' => 'Capaian Kriteria Kampus Berkelanjutan',
            'description' => 'Grafik peningkatan skor keseluruhan kampus berkelanjutan berdasarkan data GreenMetric aktual 2023-2025',
            'data_source' => 'greenmetric',
            'chart_data' => $chartDataJson,
            'chart_config' => '{}',
            'display_location' => 'landing',
            'section' => 'charts',
            'order_position' => 1,
            'is_active' => 1,
            'sync_with_statistics' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        if ($result) {
            echo "✅ Chart baru berhasil dibuat dengan data GreenMetric aktual<br>";
        } else {
            echo "❌ Gagal membuat chart baru<br>";
        }
    }

    echo "<br><h3>Data GreenMetric yang diupdate:</h3>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>Tahun</th><th>Global Rank</th><th>Total Score</th><th>SI</th><th>EC</th><th>WS</th><th>WR</th><th>TR</th><th>ED</th></tr>";
    echo "<tr><td>2023</td><td>-</td><td>4345</td><td>1085</td><td>1050</td><td>675</td><td>300</td><td>485</td><td>950</td></tr>";
    echo "<tr><td>2024</td><td>1032</td><td>4560</td><td>900</td><td>1300</td><td>600</td><td>300</td><td>535</td><td>925</td></tr>";
    echo "<tr><td>2025</td><td>942</td><td>5410</td><td>1090</td><td>1260</td><td>725</td><td>288</td><td>875</td><td>1363</td></tr>";
    echo "</table>";

    echo "<br><p><strong>Catatan:</strong></p>";
    echo "<ul>";
    echo "<li>Data 2023-2025 adalah data aktual dari GreenMetric</li>";
    echo "<li>Data 2026-2028 adalah proyeksi untuk target masa depan</li>";
    echo "<li>Ranking Indonesia 2023: 87 (berdasarkan Ranking by Country 2023)</li>";
    echo "<li>Global Rank 2024: 1032, 2025: 942 (menunjukkan peningkatan)</li>";
    echo "</ul>";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
}
