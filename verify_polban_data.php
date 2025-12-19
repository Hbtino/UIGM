<?php

// Script untuk memverifikasi data profil kampus Polban yang sudah diupdate
echo "<h2>Verifikasi Data Profil Kampus Polban</h2>";

// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'capaian_kinerja';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✅ Database connection successful<br><br>";

    // Expected data berdasarkan informasi yang diberikan
    $expectedData = [
        'profil_kampus' => [
            'mahasiswa' => '6605',
            'dosen' => '482',
            'jurusan' => '10',
            'program_studi' => '39',
            'akreditasi' => 'Unggul',
            'prodi_unggul' => '25 (66%)',
            'kelembagaan' => 'BLU (Sep 2022)'
        ],
        'fasilitas' => [
            'luas_kampus' => '246269',
            'luas_bangunan' => '93435',
            'jumlah_bangunan' => '86',
            'laboratorium' => '119',
            'ruang_kelas' => '105',
            'sertifikasi_lsp' => '5'
        ]
    ];

    echo "<h3>📋 Verifikasi Data Landing Statistics</h3>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%; font-size: 14px;'>";
    echo "<tr style='background-color: #f0f0f0;'><th>Section</th><th>Key</th><th>Expected</th><th>Actual</th><th>Status</th></tr>";

    $allCorrect = true;

    foreach ($expectedData as $section => $items) {
        foreach ($items as $key => $expectedValue) {
            // Get actual value from database
            $stmt = $pdo->prepare("SELECT value, label FROM landing_statistics WHERE section = ? AND key_name = ?");
            $stmt->execute([$section, $key]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $actualValue = $result ? $result['value'] : 'NOT FOUND';
            $label = $result ? $result['label'] : '-';
            $status = ($actualValue === $expectedValue) ? '✅ Correct' : '❌ Mismatch';

            if ($actualValue !== $expectedValue) {
                $allCorrect = false;
            }

            $rowColor = ($actualValue === $expectedValue) ? '#e8f5e8' : '#ffe8e8';
            echo "<tr style='background-color: {$rowColor};'>";
            echo "<td>{$section}</td>";
            echo "<td>{$key}</td>";
            echo "<td><strong>{$expectedValue}</strong></td>";
            echo "<td>{$actualValue}</td>";
            echo "<td>{$status}</td>";
            echo "</tr>";
        }
    }
    echo "</table>";

    // Summary verification
    if ($allCorrect) {
        echo "<div style='background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
        echo "<h3>🎉 VERIFIKASI BERHASIL!</h3>";
        echo "<p>Semua data profil kampus Polban telah berhasil diupdate dengan benar:</p>";
        echo "<ul>";
        echo "<li>✅ <strong>Mahasiswa:</strong> 6,605 orang</li>";
        echo "<li>✅ <strong>Tenaga Pendidik:</strong> 482 dosen</li>";
        echo "<li>✅ <strong>Jurusan:</strong> 10 jurusan</li>";
        echo "<li>✅ <strong>Program Studi:</strong> 39 prodi</li>";
        echo "<li>✅ <strong>Akreditasi PT:</strong> Unggul (BAN-PT)</li>";
        echo "<li>✅ <strong>Prodi Unggul:</strong> 25 prodi (66%)</li>";
        echo "<li>✅ <strong>Status Kelembagaan:</strong> BLU sejak September 2022</li>";
        echo "<li>✅ <strong>Luas Kampus:</strong> 246,269 m²</li>";
        echo "<li>✅ <strong>Luas Bangunan:</strong> 93,435 m²</li>";
        echo "<li>✅ <strong>Jumlah Bangunan:</strong> 86 bangunan</li>";
        echo "<li>✅ <strong>Ruang Kelas:</strong> 105 ruang</li>";
        echo "<li>✅ <strong>Laboratorium:</strong> 119 lab & bengkel</li>";
        echo "<li>✅ <strong>Sertifikasi LSP P1:</strong> 5 prodi</li>";
        echo "</ul>";
        echo "<p><strong>Dashboard dan landing page sekarang menampilkan data Polban yang akurat!</strong></p>";
        echo "</div>";
    } else {
        echo "<div style='background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
        echo "<h3>⚠️ Ada Data yang Tidak Sesuai</h3>";
        echo "<p>Silakan periksa kembali data yang ditandai dengan ❌</p>";
        echo "</div>";
    }

    // Additional info about Polban
    echo "<h3>📖 Informasi Tambahan Polban</h3>";
    echo "<div style='background-color: #e3f2fd; border: 1px solid #bbdefb; padding: 15px; border-radius: 5px;'>";
    echo "<h4>🏛️ Politeknik Negeri Bandung (POLBAN)</h4>";
    echo "<ul>";
    echo "<li><strong>Status Kelembagaan:</strong> Badan Layanan Umum (BLU) sejak September 2022</li>";
    echo "<li><strong>Akreditasi Institusi:</strong> Unggul dari BAN-PT</li>";
    echo "<li><strong>Prodi Terakreditasi Unggul:</strong> 25 dari 39 prodi (66%)</li>";
    echo "<li><strong>Fokus Pendidikan:</strong> Vokasi dan Terapan</li>";
    echo "<li><strong>Sertifikasi Profesi:</strong> 5 prodi memiliki skema sertifikasi LSP P1</li>";
    echo "</ul>";
    echo "</div>";

    // Check if data appears correctly in views
    echo "<h3>🔍 Cara Memverifikasi di Website</h3>";
    echo "<ol>";
    echo "<li><strong>Dashboard:</strong> Buka <code>/dashboard</code> - lihat section 'Profil Kampus Polban' dan 'Fasilitas Kampus'</li>";
    echo "<li><strong>Landing Page:</strong> Buka homepage - scroll ke bagian statistik kampus</li>";
    echo "<li><strong>Statistics Management:</strong> Buka <code>/statistics/landing</code> untuk edit data</li>";
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