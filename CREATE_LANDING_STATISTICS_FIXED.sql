-- Tabel untuk menyimpan statistik yang ditampilkan di landing page
-- FIXED VERSION - Tanpa duplicate entries

-- Drop table jika sudah ada (opsional)
-- DROP TABLE IF EXISTS `landing_statistics`;

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

-- Hapus data lama jika ada
DELETE FROM `landing_statistics`;

-- Insert data default untuk landing page (menggunakan INSERT IGNORE untuk avoid duplicate)

-- Section: Info Box (4 box di atas)
INSERT IGNORE INTO `landing_statistics` (`section`, `key_name`, `label`, `value`, `icon`, `color`, `order_position`, `is_active`) VALUES
('info_box', 'target_skor', 'Target Skor 2028', '80%', 'fa-chart-line', '#6366f1', 1, 1),
('info_box', 'ranking_dunia', 'Target Ranking Dunia', '#176', 'fa-trophy', '#10b981', 2, 1),
('info_box', 'ranking_indonesia', 'Target Ranking Indonesia', '#26', 'fa-flag', '#ec4899', 3, 1),
('info_box', 'kriteria_sdgs', 'Kriteria Keberlanjutan', '6', 'fa-leaf', '#06b6d4', 4, 1);

-- Section: Profil Kampus
INSERT IGNORE INTO `landing_statistics` (`section`, `key_name`, `label`, `value`, `icon`, `color`, `order_position`, `is_active`) VALUES
('profil_kampus', 'mahasiswa', 'Mahasiswa', '6605', 'fa-user-graduate', '#1e3a8a', 1, 1),
('profil_kampus', 'dosen', 'Dosen', '482', 'fa-chalkboard-teacher', '#1e3a8a', 2, 1),
('profil_kampus', 'jurusan', 'Jurusan', '10', 'fa-building', '#1e3a8a', 3, 1),
('profil_kampus', 'program_studi', 'Program Studi', '39', 'fa-graduation-cap', '#1e3a8a', 4, 1);

-- Section: Fasilitas Kampus
INSERT IGNORE INTO `landing_statistics` (`section`, `key_name`, `label`, `value`, `icon`, `color`, `order_position`, `is_active`) VALUES
('fasilitas', 'luas_kampus', 'Luas Kampus (m2)', '246269', 'fa-map', '#1e3a8a', 1, 1),
('fasilitas', 'luas_bangunan', 'Luas Bangunan (m2)', '93435', 'fa-building', '#1e3a8a', 2, 1),
('fasilitas', 'jumlah_bangunan', 'Jumlah Bangunan', '86', 'fa-city', '#1e3a8a', 3, 1),
('fasilitas', 'laboratorium', 'Laboratorium', '119', 'fa-flask', '#1e3a8a', 4, 1);

-- Section: Ranking Progress Dunia (simplified - hanya data penting)
INSERT IGNORE INTO `landing_statistics` (`section`, `key_name`, `label`, `value`, `icon`, `color`, `order_position`, `is_active`) VALUES
('ranking_dunia', 'tahun_2023', '2023', '896', NULL, NULL, 1, 1),
('ranking_dunia', 'tahun_2024', '2024', '705', NULL, NULL, 2, 1),
('ranking_dunia', 'tahun_2025', '2025', '561', NULL, NULL, 3, 1),
('ranking_dunia', 'tahun_2026', '2026', '374', NULL, NULL, 4, 1),
('ranking_dunia', 'tahun_2027', '2027', '228', NULL, NULL, 5, 1),
('ranking_dunia', 'tahun_2028', '2028', '176', NULL, NULL, 6, 1);

-- Section: Ranking Progress Indonesia (simplified - hanya data penting)
INSERT IGNORE INTO `landing_statistics` (`section`, `key_name`, `label`, `value`, `icon`, `color`, `order_position`, `is_active`) VALUES
('ranking_indonesia', 'tahun_2023', '2023', '87', NULL, NULL, 1, 1),
('ranking_indonesia', 'tahun_2024', '2024', '70', NULL, NULL, 2, 1),
('ranking_indonesia', 'tahun_2025', '2025', '53', NULL, NULL, 3, 1),
('ranking_indonesia', 'tahun_2026', '2026', '39', NULL, NULL, 4, 1),
('ranking_indonesia', 'tahun_2027', '2027', '29', NULL, NULL, 5, 1),
('ranking_indonesia', 'tahun_2028', '2028', '26', NULL, NULL, 6, 1);

-- Verifikasi data berhasil diinsert
SELECT COUNT(*) as total_records FROM `landing_statistics`;
SELECT section, COUNT(*) as count_per_section FROM `landing_statistics` GROUP BY section;