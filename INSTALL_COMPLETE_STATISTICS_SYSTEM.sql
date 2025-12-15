-- ============================================
-- COMPLETE STATISTICS & CHARTS SYSTEM INSTALLATION
-- ============================================
-- Sistem CRUD lengkap untuk statistik landing page, dashboard, dan chart
-- dengan sinkronisasi database otomatis

-- 1. Create Charts & Indicators Table
CREATE TABLE IF NOT EXISTS `charts_indicators` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `chart_type` varchar(50) NOT NULL COMMENT 'Type: line, bar, pie, donut, area',
  `title` varchar(255) NOT NULL COMMENT 'Judul chart',
  `description` text DEFAULT NULL COMMENT 'Deskripsi chart',
  `data_source` varchar(100) NOT NULL COMMENT 'Source data: manual, database_table, api',
  `chart_data` longtext DEFAULT NULL COMMENT 'JSON data untuk chart',
  `chart_config` longtext DEFAULT NULL COMMENT 'JSON config untuk chart options',
  `display_location` varchar(100) NOT NULL COMMENT 'dashboard, landing, both',
  `section` varchar(100) DEFAULT NULL COMMENT 'Section placement',
  `order_position` int(11) DEFAULT 0 COMMENT 'Urutan tampilan',
  `is_active` tinyint(1) DEFAULT 1 COMMENT 'Status aktif/nonaktif',
  `sync_with_statistics` tinyint(1) DEFAULT 0 COMMENT 'Sinkron dengan tabel statistics',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_display_location` (`display_location`),
  KEY `idx_section` (`section`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Ensure Landing Statistics Table exists (from previous installation)
CREATE TABLE IF NOT EXISTS `landing_statistics` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `section` varchar(100) NOT NULL COMMENT 'Section identifier: info_box, profil_kampus, fasilitas, ranking',
  `key_name` varchar(100) NOT NULL COMMENT 'Key untuk data statistik',
  `label` varchar(255) NOT NULL COMMENT 'Label yang ditampilkan',
  `value` text NOT NULL COMMENT 'Nilai statistik',
  `icon` varchar(100) DEFAULT NULL COMMENT 'Icon class (fas fa-xxx)',
  `color` varchar(50) DEFAULT NULL COMMENT 'Warna untuk styling',
  `order_position` int(11) DEFAULT 0 COMMENT 'Urutan tampilan',
  `is_active` tinyint(1) DEFAULT 1 COMMENT 'Status aktif/nonaktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_section_key` (`section`, `key_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Ensure Dashboard Statistics Table exists (from previous installation)
CREATE TABLE IF NOT EXISTS `dashboard_statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL COMMENT 'Statistic key identifier',
  `label` varchar(255) NOT NULL COMMENT 'Display label',
  `value` varchar(255) DEFAULT NULL COMMENT 'Static value or formula',
  `type` enum('static','calculated','target') DEFAULT 'static' COMMENT 'Value type',
  `category` varchar(50) DEFAULT NULL COMMENT 'Category: target, current, campus_info, user_stats',
  `description` text DEFAULT NULL COMMENT 'Description of the statistic',
  `is_active` tinyint(1) DEFAULT 1,
  `order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- ============================================
-- INSERT DEFAULT DATA
-- ============================================

-- Insert default charts/indicators
INSERT INTO `charts_indicators` (`chart_type`, `title`, `description`, `data_source`, `chart_data`, `chart_config`, `display_location`, `section`, `order_position`, `is_active`, `sync_with_statistics`) VALUES

-- Chart untuk Dashboard
('line', 'Progress Ranking Dunia', 'Grafik progress ranking dunia dari 2023-2028', 'manual', 
'{"labels":["2023","2024","2025","2026","2027","2028"],"datasets":[{"label":"Ranking Dunia","data":[896,705,561,374,228,176],"borderColor":"#10b981","backgroundColor":"rgba(16,185,129,0.1)","tension":0.4}]}',
'{"responsive":true,"plugins":{"legend":{"position":"top"},"title":{"display":true,"text":"Progress Ranking Dunia"}},"scales":{"y":{"reverse":true,"beginAtZero":false}}}',
'dashboard', 'main_charts', 1, 1, 1),

('bar', 'Data per Kriteria SDGs', 'Jumlah data yang diinput per kriteria keberlanjutan', 'database_table',
'{"labels":["Setting & Infrastructure","Energy & Climate","Water Management","Waste Management","Transportation","Education & Research"],"datasets":[{"label":"Total Data","data":[0,0,0,0,0,0],"backgroundColor":["#6366f1","#10b981","#06b6d4","#ec4899","#f59e0b","#8b5cf6"]}]}',
'{"responsive":true,"plugins":{"legend":{"display":false},"title":{"display":true,"text":"Data per Kriteria SDGs"}},"scales":{"y":{"beginAtZero":true}}}',
'dashboard', 'main_charts', 2, 1, 1),

('donut', 'Status Verifikasi Data', 'Distribusi status verifikasi semua data', 'database_table',
'{"labels":["Approved","Pending","Rejected"],"datasets":[{"data":[0,0,0],"backgroundColor":["#10b981","#f59e0b","#ef4444"]}]}',
'{"responsive":true,"plugins":{"legend":{"position":"bottom"},"title":{"display":true,"text":"Status Verifikasi Data"}}}',
'dashboard', 'main_charts', 3, 1, 1),

-- Chart untuk Landing Page
('area', 'Progress Ranking Indonesia', 'Grafik progress ranking Indonesia dari 2023-2028', 'manual',
'{"labels":["2023","2024","2025","2026","2027","2028"],"datasets":[{"label":"Ranking Indonesia","data":[87,70,53,39,29,26],"borderColor":"#ec4899","backgroundColor":"rgba(236,72,153,0.1)","fill":true,"tension":0.4}]}',
'{"responsive":true,"plugins":{"legend":{"position":"top"},"title":{"display":true,"text":"Progress Ranking Indonesia"}},"scales":{"y":{"reverse":true,"beginAtZero":false}}}',
'landing', 'statistics_section', 1, 1, 1),

('pie', 'Distribusi Fasilitas Kampus', 'Perbandingan jumlah fasilitas kampus', 'manual',
'{"labels":["Bangunan","Laboratorium","Kelas","Perpustakaan"],"datasets":[{"data":[86,119,105,12],"backgroundColor":["#1e3a8a","#10b981","#06b6d4","#f59e0b"]}]}',
'{"responsive":true,"plugins":{"legend":{"position":"bottom"},"title":{"display":true,"text":"Distribusi Fasilitas Kampus"}}}',
'landing', 'statistics_section', 2, 1, 0),

-- Chart untuk Both (Dashboard & Landing)
('line', 'Target vs Pencapaian Skor', 'Perbandingan target dan pencapaian skor UI GreenMetric', 'manual',
'{"labels":["2023","2024","2025","2026","2027","2028"],"datasets":[{"label":"Target","data":[45,55,65,70,75,80],"borderColor":"#6366f1","backgroundColor":"rgba(99,102,241,0.1)","borderDash":[5,5]},{"label":"Pencapaian","data":[42,52,0,0,0,0],"borderColor":"#10b981","backgroundColor":"rgba(16,185,129,0.1)","tension":0.4}]}',
'{"responsive":true,"plugins":{"legend":{"position":"top"},"title":{"display":true,"text":"Target vs Pencapaian Skor"}},"scales":{"y":{"beginAtZero":true,"max":100}}}',
'both', 'comparison_charts', 1, 1, 1)

ON DUPLICATE KEY UPDATE
    chart_type = VALUES(chart_type),
    title = VALUES(title),
    description = VALUES(description),
    data_source = VALUES(data_source),
    chart_data = VALUES(chart_data),
    chart_config = VALUES(chart_config),
    display_location = VALUES(display_location),
    section = VALUES(section),
    order_position = VALUES(order_position),
    is_active = VALUES(is_active),
    sync_with_statistics = VALUES(sync_with_statistics),
    updated_at = CURRENT_TIMESTAMP;
-- Insert default landing statistics (if not exists)
INSERT IGNORE INTO `landing_statistics` (`section`, `key_name`, `label`, `value`, `icon`, `color`, `order_position`, `is_active`) VALUES
-- Section: Info Box (4 box di atas)
('info_box', 'target_skor', 'Target Skor 2028', '80%', 'fa-chart-line', '#6366f1', 1, 1),
('info_box', 'target_skor_subtitle', 'Target: 80%', 'Target: 80%', NULL, '#6366f1', 2, 1),
('info_box', 'ranking_dunia', 'Target Ranking Dunia', '#176', 'fa-trophy', '#10b981', 3, 1),
('info_box', 'ranking_dunia_progress', '↑ dari #896', '↑ dari #896', NULL, '#10b981', 4, 1),
('info_box', 'ranking_indonesia', 'Target Ranking Indonesia', '#26', 'fa-flag', '#ec4899', 5, 1),
('info_box', 'ranking_indonesia_progress', '↑ dari #87', '↑ dari #87', NULL, '#ec4899', 6, 1),
('info_box', 'kriteria_sdgs', 'Kriteria Keberlanjutan', '6', 'fa-leaf', '#06b6d4', 7, 1),
('info_box', 'kriteria_sdgs_subtitle', '6 Kriteria SDGs', '6 Kriteria SDGs', NULL, '#06b6d4', 8, 1),

-- Section: Profil Kampus
('profil_kampus', 'mahasiswa', 'Mahasiswa', '6605', 'fa-user-graduate', '#1e3a8a', 1, 1),
('profil_kampus', 'dosen', 'Dosen', '482', 'fa-chalkboard-teacher', '#1e3a8a', 2, 1),
('profil_kampus', 'jurusan', 'Jurusan', '10', 'fa-building', '#1e3a8a', 3, 1),
('profil_kampus', 'program_studi', 'Program Studi', '39', 'fa-graduation-cap', '#1e3a8a', 4, 1),

-- Section: Fasilitas Kampus
('fasilitas', 'luas_kampus', 'Luas Kampus', '246269', 'fa-map', '#1e3a8a', 1, 1),
('fasilitas', 'luas_kampus_unit', 'Unit Luas Kampus', 'm²', NULL, NULL, 2, 1),
('fasilitas', 'luas_bangunan', 'Luas Bangunan', '93435', 'fa-building', '#1e3a8a', 3, 1),
('fasilitas', 'luas_bangunan_unit', 'Unit Luas Bangunan', 'm²', NULL, NULL, 4, 1),
('fasilitas', 'jumlah_bangunan', 'Jumlah Bangunan', '86', 'fa-city', '#1e3a8a', 5, 1),
('fasilitas', 'laboratorium', 'Laboratorium', '119', 'fa-flask', '#1e3a8a', 6, 1),

-- Section: Ranking Progress (untuk tabel ranking dunia & indonesia)
('ranking_dunia', '2023', '2023', '896', NULL, NULL, 1, 1),
('ranking_dunia', '2024', '2024', '705', NULL, NULL, 2, 1),
('ranking_dunia', '2024_progress', 'Progress 2024', '191', NULL, '#10b981', 3, 1),
('ranking_dunia', '2025', '2025', '561', NULL, NULL, 4, 1),
('ranking_dunia', '2025_progress', 'Progress 2025', '144', NULL, '#10b981', 5, 1),
('ranking_dunia', '2026', '2026', '374', NULL, NULL, 6, 1),
('ranking_dunia', '2026_progress', 'Progress 2026', '187', NULL, '#10b981', 7, 1),
('ranking_dunia', '2027', '2027', '228', NULL, NULL, 8, 1),
('ranking_dunia', '2027_progress', 'Progress 2027', '146', NULL, '#10b981', 9, 1),
('ranking_dunia', '2028', '2028', '176', NULL, NULL, 10, 1),
('ranking_dunia', '2028_progress', 'Progress 2028', '52', NULL, '#10b981', 11, 1),

('ranking_indonesia', '2023', '2023', '87', NULL, NULL, 1, 1),
('ranking_indonesia', '2024', '2024', '70', NULL, NULL, 2, 1),
('ranking_indonesia', '2024_progress', 'Progress 2024', '17', NULL, '#10b981', 3, 1),
('ranking_indonesia', '2025', '2025', '53', NULL, NULL, 4, 1),
('ranking_indonesia', '2025_progress', 'Progress 2025', '17', NULL, '#10b981', 5, 1),
('ranking_indonesia', '2026', '2026', '39', NULL, NULL, 6, 1),
('ranking_indonesia', '2026_progress', 'Progress 2026', '14', NULL, '#10b981', 7, 1),
('ranking_indonesia', '2027', '2027', '29', NULL, NULL, 8, 1),
('ranking_indonesia', '2027_progress', 'Progress 2027', '10', NULL, '#10b981', 9, 1),
('ranking_indonesia', '2028', '2028', '26', NULL, NULL, 10, 1),
('ranking_indonesia', '2028_progress', 'Progress 2028', '3', NULL, '#10b981', 11, 1);
-- Insert default dashboard statistics (if not exists)
INSERT IGNORE INTO `dashboard_statistics` (`key`, `label`, `value`, `type`, `category`, `description`, `order`, `is_active`) VALUES
-- Target values
('target_skor_2028', 'Target Skor 2028', '80', 'target', 'target', 'Target skor UI GreenMetric tahun 2028', 1, 1),
('target_ranking_dunia', 'Target Ranking Dunia', '176', 'target', 'target', 'Target ranking dunia tahun 2028', 2, 1),
('target_ranking_indonesia', 'Target Ranking Indonesia', '26', 'target', 'target', 'Target ranking Indonesia tahun 2028', 3, 1),

-- Current values
('ranking_dunia_sekarang', 'Ranking Dunia Saat Ini', '896', 'static', 'current', 'Ranking dunia saat ini', 4, 1),
('ranking_indonesia_sekarang', 'Ranking Indonesia Saat Ini', '87', 'static', 'current', 'Ranking Indonesia saat ini', 5, 1),

-- Campus information
('jumlah_mahasiswa', 'Jumlah Mahasiswa', '6605', 'static', 'campus_info', 'Total mahasiswa aktif', 6, 1),
('jumlah_dosen', 'Jumlah Dosen', '482', 'static', 'campus_info', 'Total dosen aktif', 7, 1),
('jumlah_jurusan', 'Jumlah Jurusan', '10', 'static', 'campus_info', 'Total jurusan', 8, 1),
('jumlah_prodi', 'Jumlah Program Studi', '39', 'static', 'campus_info', 'Total program studi', 9, 1),
('luas_kampus', 'Luas Kampus (m²)', '246269', 'static', 'campus_info', 'Luas total kampus dalam meter persegi', 10, 1),
('luas_bangunan', 'Luas Bangunan (m²)', '93435', 'static', 'campus_info', 'Luas total bangunan dalam meter persegi', 11, 1),
('jumlah_bangunan', 'Jumlah Bangunan', '86', 'static', 'campus_info', 'Total bangunan di kampus', 12, 1),
('jumlah_kelas', 'Jumlah Kelas', '105', 'static', 'campus_info', 'Total ruang kelas', 13, 1),
('jumlah_laboratorium', 'Jumlah Laboratorium', '119', 'static', 'campus_info', 'Total laboratorium', 14, 1);

-- ============================================
-- VERIFICATION QUERIES
-- ============================================

-- Check installation
SELECT 'Charts & Indicators' as 'Table', COUNT(*) as 'Records' FROM charts_indicators
UNION ALL
SELECT 'Landing Statistics' as 'Table', COUNT(*) as 'Records' FROM landing_statistics  
UNION ALL
SELECT 'Dashboard Statistics' as 'Table', COUNT(*) as 'Records' FROM dashboard_statistics;

-- Show sample data
SELECT 'Sample Charts:' as 'Info';
SELECT id, title, chart_type, display_location, section FROM charts_indicators LIMIT 5;

SELECT 'Sample Landing Stats:' as 'Info';
SELECT id, section, key_name, label, value FROM landing_statistics LIMIT 5;

SELECT 'Sample Dashboard Stats:' as 'Info';
SELECT id, `key`, label, value, category FROM dashboard_statistics LIMIT 5;

-- ============================================
-- INSTALLATION COMPLETE
-- ============================================

/*
INSTALASI SELESAI!

Sistem CRUD Statistik & Chart telah berhasil diinstall dengan fitur:

✅ CRUD Landing Page Statistics
   - Info boxes (Target skor, ranking, kriteria)
   - Profil kampus (mahasiswa, dosen, jurusan, prodi)
   - Fasilitas kampus (luas, bangunan, lab)
   - Progress ranking (dunia & indonesia)

✅ CRUD Dashboard Statistics  
   - Target values (skor, ranking)
   - Current values (ranking saat ini)
   - Campus information (data kampus)

✅ CRUD Charts & Indicators
   - Dashboard charts (line, bar, donut)
   - Landing page charts (area, pie)
   - Both location charts (comparison)
   - Auto-sync dengan database statistics

✅ Sinkronisasi Database
   - Real-time data dari tabel kriteria
   - Auto-update chart data
   - Sync landing dengan dashboard stats

AKSES ADMIN PANEL:
- URL: /statistics
- Menu: "Manajemen Statistik & Chart"
- Role: Admin only

API ENDPOINTS:
- GET /statistics/api/chart-data/dashboard
- GET /statistics/api/chart-data/landing
- POST /statistics/bulk-sync

NEXT STEPS:
1. Login sebagai admin
2. Akses menu "Manajemen Statistik & Chart"
3. Edit nilai-nilai statistik sesuai kebutuhan
4. Tambah chart baru jika diperlukan
5. Lakukan sync data secara berkala

Semua statistik sekarang bisa di-CRUD lengkap dan tersinkronisasi!
*/