-- Tambah chart untuk landing page jika belum ada

-- Pastikan tabel charts_indicators ada
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

-- Insert chart untuk landing page
INSERT INTO `charts_indicators` (`chart_type`, `title`, `description`, `data_source`, `chart_data`, `chart_config`, `display_location`, `section`, `order_position`, `is_active`, `sync_with_statistics`) VALUES

-- Chart Progress Ranking Indonesia untuk Landing Page
('area', 'Progress Ranking Indonesia', 'Grafik progress ranking Indonesia dari 2023-2028', 'manual',
'{"labels":["2023","2024","2025","2026","2027","2028"],"datasets":[{"label":"Ranking Indonesia","data":[87,70,53,39,29,26],"borderColor":"#ec4899","backgroundColor":"rgba(236,72,153,0.2)","fill":true,"tension":0.4}]}',
'{"responsive":true,"plugins":{"legend":{"position":"top"},"title":{"display":false}},"scales":{"y":{"reverse":true,"beginAtZero":false,"title":{"display":true,"text":"Ranking"}},"x":{"title":{"display":true,"text":"Tahun"}}}}',
'landing', 'statistics_section', 1, 1, 1),

-- Chart Progress Ranking Dunia untuk Landing Page
('line', 'Progress Ranking Dunia', 'Grafik progress ranking dunia dari 2023-2028', 'manual',
'{"labels":["2023","2024","2025","2026","2027","2028"],"datasets":[{"label":"Ranking Dunia","data":[896,705,561,374,228,176],"borderColor":"#10b981","backgroundColor":"rgba(16,185,129,0.1)","tension":0.4}]}',
'{"responsive":true,"plugins":{"legend":{"position":"top"},"title":{"display":false}},"scales":{"y":{"reverse":true,"beginAtZero":false,"title":{"display":true,"text":"Ranking"}},"x":{"title":{"display":true,"text":"Tahun"}}}}',
'landing', 'statistics_section', 2, 1, 1),

-- Chart Distribusi Fasilitas Kampus untuk Landing Page
('pie', 'Distribusi Fasilitas Kampus', 'Perbandingan jumlah fasilitas kampus', 'manual',
'{"labels":["Bangunan","Laboratorium","Kelas","Perpustakaan"],"datasets":[{"data":[86,119,105,12],"backgroundColor":["#1e3a8a","#10b981","#06b6d4","#f59e0b"],"borderWidth":2,"borderColor":"#ffffff"}]}',
'{"responsive":true,"plugins":{"legend":{"position":"bottom"},"title":{"display":false}}}',
'landing', 'statistics_section', 3, 1, 0),

-- Chart Target vs Pencapaian Skor untuk Landing Page
('bar', 'Target vs Pencapaian Skor', 'Perbandingan target dan pencapaian skor UI GreenMetric', 'manual',
'{"labels":["2023","2024","2025","2026","2027","2028"],"datasets":[{"label":"Target","data":[45,55,65,70,75,80],"backgroundColor":"rgba(99,102,241,0.8)","borderColor":"#6366f1","borderWidth":2},{"label":"Pencapaian","data":[42,52,0,0,0,0],"backgroundColor":"rgba(16,185,129,0.8)","borderColor":"#10b981","borderWidth":2}]}',
'{"responsive":true,"plugins":{"legend":{"position":"top"},"title":{"display":false}},"scales":{"y":{"beginAtZero":true,"max":100,"title":{"display":true,"text":"Skor (%)"}},"x":{"title":{"display":true,"text":"Tahun"}}}}',
'landing', 'statistics_section', 4, 1, 1)

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

-- Verifikasi hasil
SELECT 'Landing Charts Summary:' as info;
SELECT display_location, COUNT(*) as total_charts 
FROM charts_indicators 
WHERE display_location IN ('landing', 'both')
GROUP BY display_location 
ORDER BY display_location;

SELECT 'All Landing Charts:' as info;
SELECT id, title, chart_type, display_location, section, is_active
FROM charts_indicators 
WHERE display_location IN ('landing', 'both')
ORDER BY section, order_position;