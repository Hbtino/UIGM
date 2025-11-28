-- Create table for dashboard statistics configuration
-- This allows admin to configure static values and calculation formulas

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

-- Insert default statistics configuration
INSERT INTO `dashboard_statistics` (`key`, `label`, `value`, `type`, `category`, `description`, `order`, `is_active`) VALUES
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
('jumlah_laboratorium', 'Jumlah Laboratorium', '119', 'static', 'campus_info', 'Total laboratorium', 14, 1)
ON DUPLICATE KEY UPDATE
    label = VALUES(label),
    value = VALUES(value),
    type = VALUES(type),
    category = VALUES(category),
    description = VALUES(description),
    `order` = VALUES(`order`),
    is_active = VALUES(is_active),
    updated_at = CURRENT_TIMESTAMP;

-- Verify installation
SELECT `key`, label, value, type, category, is_active 
FROM dashboard_statistics 
ORDER BY `order` ASC;
