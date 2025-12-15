-- Tabel untuk menyimpan data grafik ranking di landing page
-- Grafik: Ranking Dunia dan Ranking Indonesia

CREATE TABLE IF NOT EXISTS `landing_charts` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `chart_type` varchar(50) NOT NULL COMMENT 'Tipe grafik: ranking_dunia, ranking_indonesia',
  `year` varchar(10) NOT NULL COMMENT 'Tahun data',
  `rank_value` int(11) NOT NULL COMMENT 'Nilai ranking',
  `order_position` int(11) DEFAULT 0 COMMENT 'Urutan tampilan',
  `is_active` tinyint(1) DEFAULT 1 COMMENT 'Status aktif/nonaktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_chart_year` (`chart_type`, `year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data default untuk Ranking Dunia
INSERT INTO `landing_charts` (`chart_type`, `year`, `rank_value`, `order_position`, `is_active`) VALUES
('ranking_dunia', '2023', 896, 1, 1),
('ranking_dunia', '2024', 705, 2, 1),
('ranking_dunia', '2025', 561, 3, 1),
('ranking_dunia', '2026', 374, 4, 1),
('ranking_dunia', '2027', 228, 5, 1),
('ranking_dunia', '2028', 176, 6, 1);

-- Insert data default untuk Ranking Indonesia
INSERT INTO `landing_charts` (`chart_type`, `year`, `rank_value`, `order_position`, `is_active`) VALUES
('ranking_indonesia', '2023', 87, 1, 1),
('ranking_indonesia', '2024', 70, 2, 1),
('ranking_indonesia', '2025', 53, 3, 1),
('ranking_indonesia', '2026', 39, 4, 1),
('ranking_indonesia', '2027', 29, 5, 1),
('ranking_indonesia', '2028', 26, 6, 1);

-- Verifikasi data
SELECT * FROM `landing_charts` ORDER BY `chart_type`, `order_position`;
