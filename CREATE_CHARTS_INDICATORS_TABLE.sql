-- Tabel untuk menyimpan chart/indikator yang bisa di-CRUD
-- Untuk dashboard dan landing page dengan sinkronisasi

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
'both', 'comparison_charts', 1, 1, 1);