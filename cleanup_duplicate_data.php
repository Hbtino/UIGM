<?php

// Script untuk membersihkan data duplikat di landing statistics
echo "<h2>Cleanup Data Duplikat - Landing Statistics</h2>";

// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'capaian_kinerja';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✅ Database connection successful<br><br>";

    // Step 1: Identify duplicates
    echo "<h3>🔍 Mengidentifikasi Data Duplikat</h3>";

    $duplicateQuery = "
        SELECT section, key_name, COUNT(*) as count 
        FROM landing_statistics 
        GROUP BY section, key_name 
        HAVING COUNT(*) > 1
        ORDER BY section, key_name
    ";

    $duplicates = $pdo->query($duplicateQuery)->fetchAll(PDO::FETCH_ASSOC);

    if (empty($duplicates)) {
        echo "✅ Tidak ada data duplikat ditemukan<br>";
    } else {
        echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
        echo "<tr style='background-color: #f0f0f0;'><th>Section</th><th>Key Name</th><th>Jumlah Duplikat</th></tr>";

        foreach ($duplicates as $dup) {
            echo "<tr>";
            echo "<td>{$dup['section']}</td>";
            echo "<td>{$dup['key_name']}</td>";
            echo "<td style='color: red; font-weight: bold;'>{$dup['count']}</td>";
            echo "</tr>";
        }
        echo "</table>";

        // Step 2: Clean up duplicates - keep the latest one
        echo "<h3>🧹 Membersihkan Data Duplikat</h3>";

        $cleanedCount = 0;

        foreach ($duplicates as $dup) {
            $section = $dup['section'];
            $keyName = $dup['key_name'];

            // Get all records for this section+key, ordered by ID (keep the latest)
            $getRecordsQuery = "
                SELECT id, value, created_at, updated_at 
                FROM landing_statistics 
                WHERE section = ? AND key_name = ? 
                ORDER BY id ASC
            ";

            $records = $pdo->prepare($getRecordsQuery);
            $records->execute([$section, $keyName]);
            $allRecords = $records->fetchAll(PDO::FETCH_ASSOC);

            if (count($allRecords) > 1) {
                // Keep the last record (highest ID), delete the rest
                $keepRecord = array_pop($allRecords); // Remove and get the last element

                echo "<strong>{$section}.{$keyName}:</strong> ";
                echo "Keeping ID {$keepRecord['id']} (value: {$keepRecord['value']}), ";
                echo "deleting " . count($allRecords) . " duplicates<br>";

                // Delete the duplicate records
                foreach ($allRecords as $record) {
                    $deleteStmt = $pdo->prepare("DELETE FROM landing_statistics WHERE id = ?");
                    $deleteStmt->execute([$record['id']]);
                    $cleanedCount++;
                }
            }
        }

        echo "<br>✅ <strong>Total {$cleanedCount} record duplikat berhasil dihapus</strong><br>";
    }

    // Step 3: Verify current data
    echo "<br><h3>📊 Data Setelah Cleanup</h3>";

    $currentDataQuery = "
        SELECT section, key_name, label, value 
        FROM landing_statistics 
        ORDER BY section, order_position, key_name
    ";

    $currentData = $pdo->query($currentDataQuery)->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1' style='border-collapse: collapse; width: 100%; font-size: 14px;'>";
    echo "<tr style='background-color: #f0f0f0;'><th>Section</th><th>Key</th><th>Label</th><th>Value</th></tr>";

    $currentSection = '';
    foreach ($currentData as $row) {
        $sectionDisplay = ($row['section'] != $currentSection) ? $row['section'] : '';
        $currentSection = $row['section'];

        $bgColor = $row['section'] == 'profil_kampus' ? '#e3f2fd' : '#e8f5e8';

        echo "<tr style='background-color: {$bgColor};'>";
        echo "<td><strong>{$sectionDisplay}</strong></td>";
        echo "<td>{$row['key_name']}</td>";
        echo "<td>{$row['label']}</td>";
        echo "<td><strong>{$row['value']}</strong></td>";
        echo "</tr>";
    }
    echo "</table>";

    // Step 4: Summary
    $totalRecords = count($currentData);

    echo "<br><div style='background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 5px;'>";
    echo "<h3>🎉 Cleanup Berhasil!</h3>";
    echo "<ul>";
    echo "<li>✅ <strong>Data duplikat dihapus:</strong> {$cleanedCount} records</li>";
    echo "<li>✅ <strong>Total data saat ini:</strong> {$totalRecords} records</li>";
    echo "<li>✅ <strong>Setiap item sekarang unik:</strong> Tidak ada duplikasi</li>";
    echo "</ul>";
    echo "<p><strong>Dashboard sekarang akan menampilkan setiap item hanya sekali!</strong></p>";
    echo "</div>";

    // Step 5: Recommendations
    echo "<br><h3>💡 Rekomendasi</h3>";
    echo "<ol>";
    echo "<li><strong>Refresh dashboard:</strong> Buka <code>/dashboard</code> untuk melihat perubahan</li>";
    echo "<li><strong>Cek landing page:</strong> Pastikan tidak ada duplikasi di homepage</li>";
    echo "<li><strong>Prevent future duplicates:</strong> Gunakan INSERT IGNORE atau ON DUPLICATE KEY UPDATE</li>";
    echo "</ol>";
} catch (PDOException $e) {
    echo "❌ Database Error: " . $e->getMessage() . "<br>";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
}

?>

<style>
    table {
        font-family: Arial, sans-serif;
        margin: 20px 0;
    }

    th,
    td {
        padding: 8px 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f5f5f5;
        font-weight: bold;
    }

    code {
        background-color: #f1f1f1;
        padding: 2px 4px;
        border-radius: 3px;
        font-family: monospace;
    }
</style>