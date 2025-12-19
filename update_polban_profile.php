<?php

// Script untuk mengupdate data profil kampus Polban dengan data aktual
echo "<h2>Update Data Profil Kampus Polban</h2>";

// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'capaian_kinerja';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✅ Database connection successful<br><br>";

    // Data aktual Polban yang akan diupdate
    $polbanData = [
        'profil_kampus' => [
            'mahasiswa' => ['value' => '6605', 'label' => 'Mahasiswa'],
            'dosen' => ['value' => '482', 'label' => 'Tenaga Pendidik'],
            'jurusan' => ['value' => '10', 'label' => 'Jurusan'],
            'program_studi' => ['value' => '39', 'label' => 'Program Studi'],
            'akreditasi' => ['value' => 'Unggul', 'label' => 'Akreditasi PT BAN-PT'],
            'prodi_unggul' => ['value' => '25 (66%)', 'label' => 'Prodi Terakreditasi Unggul'],
            'kelembagaan' => ['value' => 'BLU (Sep 2022)', 'label' => 'Status Kelembagaan']
        ],
        'fasilitas' => [
            'luas_kampus' => ['value' => '246269', 'label' => 'Luas Kampus (m²)'],
            'luas_bangunan' => ['value' => '93435', 'label' => 'Luas Bangunan (m²)'],
            'jumlah_bangunan' => ['value' => '86', 'label' => 'Jumlah Bangunan'],
            'laboratorium' => ['value' => '119', 'label' => 'Laboratorium & Bengkel'],
            'ruang_kelas' => ['value' => '105', 'label' => 'Ruang Kelas'],
            'sertifikasi_lsp' => ['value' => '5', 'label' => 'Skema Sertifikasi LSP P1']
        ]
    ];

    $updateCount = 0;
    $insertCount = 0;

    // Update/Insert landing statistics
    foreach ($polbanData as $section => $items) {
        foreach ($items as $key => $data) {
            // Check if record exists
            $checkStmt = $pdo->prepare("SELECT id FROM landing_statistics WHERE section = ? AND key_name = ?");
            $checkStmt->execute([$section, $key]);

            if ($checkStmt->fetch()) {
                // Update existing record
                $updateStmt = $pdo->prepare("
                    UPDATE landing_statistics 
                    SET value = ?, label = ?, updated_at = NOW() 
                    WHERE section = ? AND key_name = ?
                ");
                $updateStmt->execute([$data['value'], $data['label'], $section, $key]);
                $updateCount++;
                echo "✅ Updated: {$section}.{$key} = {$data['value']}<br>";
            } else {
                // Insert new record
                $insertStmt = $pdo->prepare("
                    INSERT INTO landing_statistics (section, key_name, label, value, icon, color, order_position, is_active, created_at, updated_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, 1, NOW(), NOW())
                ");

                // Set default icon and color based on section
                $icon = $section == 'profil_kampus' ? 'fas fa-university' : 'fas fa-building';
                $color = $section == 'profil_kampus' ? '#2196F3' : '#4CAF50';
                $order = count($items) + 1;

                $insertStmt->execute([$section, $key, $data['label'], $data['value'], $icon, $color, $order]);
                $insertCount++;
                echo "✅ Inserted: {$section}.{$key} = {$data['value']}<br>";
            }
        }
    }

    echo "<br><h3>📊 Summary Update Data Polban</h3>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%; font-size: 14px;'>";
    echo "<tr style='background-color: #f0f0f0;'><th>Kategori</th><th>Item</th><th>Nilai Baru</th><th>Keterangan</th></tr>";

    // Profil Kampus
    echo "<tr><td rowspan='7' style='vertical-align: top; background-color: #e3f2fd;'><strong>Profil Kampus</strong></td>";
    echo "<td>Mahasiswa</td><td><strong>6,605</strong></td><td>Total mahasiswa aktif</td></tr>";
    echo "<tr><td>Tenaga Pendidik</td><td><strong>482</strong></td><td>Total dosen</td></tr>";
    echo "<tr><td>Jurusan</td><td><strong>10</strong></td><td>Total jurusan</td></tr>";
    echo "<tr><td>Program Studi</td><td><strong>39</strong></td><td>Total program studi</td></tr>";
    echo "<tr><td>Akreditasi PT</td><td><strong>Unggul</strong></td><td>BAN-PT</td></tr>";
    echo "<tr><td>Prodi Unggul</td><td><strong>25 (66%)</strong></td><td>Prodi terakreditasi unggul</td></tr>";
    echo "<tr><td>Kelembagaan</td><td><strong>BLU</strong></td><td>Sejak September 2022</td></tr>";

    // Fasilitas Kampus
    echo "<tr><td rowspan='6' style='vertical-align: top; background-color: #e8f5e8;'><strong>Fasilitas Kampus</strong></td>";
    echo "<td>Luas Kampus</td><td><strong>246,269 m²</strong></td><td>Total luas area kampus</td></tr>";
    echo "<tr><td>Luas Bangunan</td><td><strong>93,435 m²</strong></td><td>Total luas bangunan</td></tr>";
    echo "<tr><td>Jumlah Bangunan</td><td><strong>86</strong></td><td>Total bangunan</td></tr>";
    echo "<tr><td>Ruang Kelas</td><td><strong>105</strong></td><td>Total ruang kelas</td></tr>";
    echo "<tr><td>Laboratorium</td><td><strong>119</strong></td><td>Lab & bengkel</td></tr>";
    echo "<tr><td>Sertifikasi LSP P1</td><td><strong>5</strong></td><td>Skema sertifikasi prodi</td></tr>";

    echo "</table>";

    echo "<br><div style='background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 5px;'>";
    echo "<h3>🎉 Update Berhasil!</h3>";
    echo "<p><strong>Total operasi:</strong></p>";
    echo "<ul>";
    echo "<li>✅ Data diupdate: {$updateCount} record</li>";
    echo "<li>✅ Data baru ditambah: {$insertCount} record</li>";
    echo "<li>✅ Total data Polban: " . ($updateCount + $insertCount) . " record</li>";
    echo "</ul>";
    echo "<p><strong>Data profil kampus Polban sekarang sudah akurat dan up-to-date!</strong></p>";
    echo "</div>";

    echo "<br><h4>🔄 Langkah Selanjutnya:</h4>";
    echo "<ol>";
    echo "<li>Refresh halaman dashboard untuk melihat data terbaru</li>";
    echo "<li>Periksa landing page untuk memastikan data sudah terupdate</li>";
    echo "<li>Verifikasi data di halaman statistik management</li>";
    echo "</ol>";
} catch (PDOException $e) {
    echo "❌ Database Error: " . $e->getMessage() . "<br>";
    echo "<br><p>Pastikan:</p>";
    echo "<ul>";
    echo "<li>Database server berjalan</li>";
    echo "<li>Nama database, username, dan password benar</li>";
    echo "<li>Table 'landing_statistics' sudah ada</li>";
    echo "</ul>";
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

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>