-- Membuat tabel dashboard_statistics untuk mengelola statistik dashboard
-- Mirip dengan landing_statistics tapi khusus untuk dashboard admin

CREATE TABLE IF NOT EXISTS `dashboard_statistics` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL COMMENT 'Kategori statistik: target_values, current_values, campus_info, calculated_stats',
  `key_name` varchar(100) NOT NULL COMMENT 'Key untuk data statistik',
  `label` varchar(255) NOT NULL COMMENT 'Label yang ditampilkan',
  `value` text NOT NULL COMMENT 'Nilai statistik',
  `icon` varchar(100) DEFAULT NULL COMMENT 'Icon class (fas fa-xxx)',
  `color` varchar(50) DEFAULT NULL COMMENT 'Warna untuk styling',
  `order_position` int(11) DEFAULT 0 COMMENT 'Urutan tampilan',
  `is_active` tinyint(1) DEFAULT 1 COMMENT 'Status aktif/nonaktif',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_category_key` (`category`, `key_name`),
  KEY `idx_dashboard_stats_category` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert sample data untuk dashboard statistics
INSERT INTO `dashboard_statistics` (`category`, `key_name`, `label`, `value`, `icon`, `color`, `order_position`, `is_active`) VALUES
-- Target Values
('target_values', 'target_skor_2028', 'Target Skor 2028', '80', 'fa-chart-line', '#667eea', 1, 1),
('target_values', 'target_ranking_dunia', 'Target Ranking Dunia', '176', 'fa-trophy', '#11998e', 2, 1),
('target_values', 'target_ranking_indonesia', 'Target Ranking Indonesia', '26', 'fa-flag', '#f093fb', 3, 1),

-- Current Values
('current_values', 'current_skor', 'Skor Saat Ini', '43', 'fa-percentage', '#667eea', 1, 1),
('current_values', 'current_ranking_dunia', 'Ranking Dunia Saat Ini', '896', 'fa-globe', '#11998e', 2, 1),
('current_values', 'current_ranking_indonesia', 'Ranking Indonesia Saat Ini', '87', 'fa-map-marker-alt', '#f093fb', 3, 1),

-- Campus Information
('campus_info', 'jumlah_mahasiswa', 'Jumlah Mahasiswa', '6605', 'fa-user-graduate', '#4facfe', 1, 1),
('campus_info', 'jumlah_dosen', 'Jumlah Dosen', '482', 'fa-chalkboard-teacher', '#4facfe', 2, 1),
('campus_info', 'jumlah_jurusan', 'Jumlah Jurusan', '10', 'fa-building', '#4facfe', 3, 1),
('campus_info', 'jumlah_prodi', 'Jumlah Program Studi', '39', 'fa-graduation-cap', '#4facfe', 4, 1),
('campus_info', 'luas_kampus', 'Luas Kampus (m²)', '25000', 'fa-expand-arrows-alt', '#4facfe', 5, 1),
('campus_info', 'luas_bangunan', 'Luas Bangunan (m²)', '93435', 'fa-building', '#4facfe', 6, 1),

-- Calculated Stats (Real-time calculated values)
('calculated_stats', 'progress_percentage', 'Progress Menuju Target', '53.75', 'fa-chart-pie', '#38ef7d', 1, 1),
('calculated_stats', 'improvement_dunia', 'Peningkatan Ranking Dunia', '0', 'fa-arrow-up', '#38ef7d', 2, 1),
('calculated_stats', 'improvement_indonesia', 'Peningkatan Ranking Indonesia', '0', 'fa-arrow-up', '#38ef7d', 3, 1),
('calculated_stats', 'kriteria_count', 'Jumlah Kriteria SDGs', '6', 'fa-leaf', '#38ef7d', 4, 1);

-- Verifikasi data
SELECT category, COUNT(*) as total_records 
FROM dashboard_statistics 
GROUP BY category 
ORDER BY category;