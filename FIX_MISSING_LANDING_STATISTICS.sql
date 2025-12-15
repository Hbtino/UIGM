-- Fix missing landing statistics data
-- Hapus data lama dan insert ulang untuk memastikan semua section ada

-- Hapus semua data landing_statistics (hati-hati!)
DELETE FROM `landing_statistics`;

-- Insert ulang semua data dengan benar
INSERT INTO `landing_statistics` (`section`, `key_name`, `label`, `value`, `icon`, `color`, `order_position`, `is_active`) VALUES

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

-- Section: Ranking Progress Dunia
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

-- Section: Ranking Progress Indonesia
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

-- Verifikasi hasil
SELECT 'Section Summary:' as info;
SELECT section, COUNT(*) as total_records 
FROM landing_statistics 
GROUP BY section 
ORDER BY section;

SELECT 'Total Records:' as info;
SELECT COUNT(*) as total_records FROM landing_statistics;