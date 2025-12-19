<?php

// Script untuk memverifikasi update chart data
echo "<h2>Verifikasi Update Chart GreenMetric</h2>";

// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'capaian_kinerja';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get chart data
    $stmt = $pdo->prepare("SELECT * FROM charts_indicators WHERE title = ? AND display_location = ?");
    $stmt->execute(['Capaian Kriteria Kampus Berkelanjutan', 'landing']);
    $chart = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($chart) {
        echo "✅ Chart ditemukan di database<br>";
        echo "<strong>Chart ID:</strong> " . $chart['id'] . "<br>";
        echo "<strong>Title:</strong> " . $chart['title'] . "<br>";
        echo "<strong>Description:</strong> " . $chart['description'] . "<br>";
        echo "<strong>Data Source:</strong> " . $chart['data_source'] . "<br>";
        echo "<strong>Last Updated:</strong> " . $chart['updated_at'] . "<br><br>";

        // Parse chart data
        $chartData = json_decode($chart['chart_data'], true);

        if ($chartData) {
            echo "<h3>✅ Data Chart Berhasil Diverifikasi</h3>";

            // Verify actual data points
            echo "<h4>Verifikasi Data Aktual GreenMetric:</h4>";
            echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
            echo "<tr style='background-color: #f0f0f0;'><th>Kategori</th><th>2023</th><th>2024</th><th>2025</th><th>Status</th></tr>";

            $expectedData = [
                'Setting & Infrastructure' => [1085, 900, 1090],
                'Energy & Climate Change' => [1050, 1300, 1260],
                'Waste' => [675, 600, 725],
                'Water' => [300, 300, 288],
                'Transportation' => [485, 535, 875],
                'Education & Research' => [950, 925, 1363]
            ];

            $allCorrect = true;
            foreach ($chartData['datasets'] as $index => $dataset) {
                $categoryName = $dataset['label'];
                $actualData = array_slice($dataset['data'], 0, 3); // Get 2023-2025 data

                // Find expected data for this category
                $expectedKey = null;
                foreach ($expectedData as $key => $expected) {
                    if (strpos($categoryName, explode(' ', $key)[0]) !== false) {
                        $expectedKey = $key;
                        break;
                    }
                }

                if ($expectedKey && $expectedData[$expectedKey] === $actualData) {
                    $status = "✅ Benar";
                } else {
                    $status = "❌ Salah";
                    $allCorrect = false;
                }

                echo "<tr>";
                echo "<td>" . $categoryName . "</td>";
                echo "<td>" . $actualData[0] . "</td>";
                echo "<td>" . $actualData[1] . "</td>";
                echo "<td>" . $actualData[2] . "</td>";
                echo "<td>" . $status . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            // Verify total scores and rankings
            echo "<h4>Verifikasi Total Score & Ranking:</h4>";
            echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
            echo "<tr style='background-color: #f0f0f0;'><th>Metrik</th><th>2023</th><th>2024</th><th>2025</th><th>Status</th></tr>";

            $expectedTotalScore = [4345, 4560, 5410];
            $expectedWorldRank = [null, 1032, 942];
            $expectedIndonesiaRank = [87, null, null];

            $actualTotalScore = array_slice($chartData['totalScore'], 0, 3);
            $actualWorldRank = array_slice($chartData['worldRank'], 0, 3);
            $actualIndonesiaRank = array_slice($chartData['indonesiaRank'], 0, 3);

            // Check Total Score
            $totalScoreStatus = ($expectedTotalScore === $actualTotalScore) ? "✅ Benar" : "❌ Salah";
            echo "<tr>";
            echo "<td>Total Score</td>";
            echo "<td>" . $actualTotalScore[0] . "</td>";
            echo "<td>" . $actualTotalScore[1] . "</td>";
            echo "<td>" . $actualTotalScore[2] . "</td>";
            echo "<td>" . $totalScoreStatus . "</td>";
            echo "</tr>";

            // Check World Rank
            $worldRankStatus = ($expectedWorldRank === $actualWorldRank) ? "✅ Benar" : "❌ Salah";
            echo "<tr>";
            echo "<td>Global Rank</td>";
            echo "<td>" . ($actualWorldRank[0] ?? '-') . "</td>";
            echo "<td>" . ($actualWorldRank[1] ?? '-') . "</td>";
            echo "<td>" . ($actualWorldRank[2] ?? '-') . "</td>";
            echo "<td>" . $worldRankStatus . "</td>";
            echo "</tr>";

            // Check Indonesia Rank
            $indonesiaRankStatus = ($expectedIndonesiaRank === $actualIndonesiaRank) ? "✅ Benar" : "❌ Salah";
            echo "<tr>";
            echo "<td>Indonesia Rank</td>";
            echo "<td>" . ($actualIndonesiaRank[0] ?? '-') . "</td>";
            echo "<td>" . ($actualIndonesiaRank[1] ?? '-') . "</td>";
            echo "<td>" . ($actualIndonesiaRank[2] ?? '-') . "</td>";
            echo "<td>" . $indonesiaRankStatus . "</td>";
            echo "</tr>";
            echo "</table>";

            if ($allCorrect && $totalScoreStatus === "✅ Benar" && $worldRankStatus === "✅ Benar" && $indonesiaRankStatus === "✅ Benar") {
                echo "<div style='background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
                echo "<h3>🎉 VERIFIKASI BERHASIL!</h3>";
                echo "<p>Semua data GreenMetric telah berhasil diupdate dengan benar:</p>";
                echo "<ul>";
                echo "<li>✅ Data kategori 2023-2025 sesuai dengan GreenMetric</li>";
                echo "<li>✅ Total Score: 4345 → 4560 → 5410</li>";
                echo "<li>✅ Global Rank: 1032 (2024) → 942 (2025)</li>";
                echo "<li>✅ Indonesia Rank: 87 (2023)</li>";
                echo "</ul>";
                echo "<p><strong>Grafik di landing page sekarang menampilkan data yang akurat!</strong></p>";
                echo "</div>";
            } else {
                echo "<div style='background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
                echo "<h3>⚠️ Ada Data yang Tidak Sesuai</h3>";
                echo "<p>Silakan periksa kembali data yang ditandai dengan ❌</p>";
                echo "</div>";
            }
        } else {
            echo "❌ Gagal parsing chart data JSON<br>";
        }
    } else {
        echo "❌ Chart tidak ditemukan di database<br>";
        echo "Silakan jalankan script update terlebih dahulu<br>";
    }
} catch (PDOException $e) {
    echo "❌ Database Error: " . $e->getMessage() . "<br>";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
}

?>

<style>
    table {
        font-family: Arial, sans-serif;
        font-size: 12px;
    }

    th,
    td {
        padding: 8px;
        text-align: center;
    }

    th {
        font-weight: bold;
    }
</style>