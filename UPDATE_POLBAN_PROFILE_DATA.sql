-- Update data profil kampus Polban dengan data aktual terbaru
-- Berdasarkan informasi: Kelembagaan BLU mulai September 2022, Akreditasi Unggul, dll.

-- Update Landing Statistics dengan data aktual Polban
UPDATE landing_statistics SET value = '6605' WHERE section = 'profil_kampus' AND key_name = 'mahasiswa';
UPDATE landing_statistics SET value = '482' WHERE section = 'profil_kampus' AND key_name = 'dosen';
UPDATE landing_statistics SET value = '10' WHERE section = 'profil_kampus' AND key_name = 'jurusan';
UPDATE landing_statistics SET value = '39' WHERE section = 'profil_kampus' AND key_name = 'program_studi';

-- Update fasilitas kampus
UPDATE landing_statistics SET value = '246269' WHERE section = 'fasilitas' AND key_name = 'luas_kampus';
UPDATE landing_statistics SET value = '93435' WHERE section = 'fasilitas' AND key_name = 'luas_bangunan';
UPDATE landing_statistics SET value = '86' WHERE section = 'fasilitas' AND key_name = 'jumlah_bangunan';
UPDATE landing_statistics SET value = '119' WHERE section = 'fasilitas' AND key_name = 'laboratorium';

-- Tambah data baru jika belum ada
INSERT IGNORE INTO landing_statistics (section, key_name, label, value, icon, color, order_position, is_active, created_at, updated_at) VALUES
('profil_kampus', 'akreditasi', 'Akreditasi PT', 'Unggul', 'fas fa-award', '#FFD700', 5, 1, NOW(), NOW()),
('profil_kampus', 'prodi_unggul', 'Prodi Terakreditasi Unggul', '25 (66%)', 'fas fa-star', '#4CAF50', 6, 1, NOW(), NOW()),
('profil_kampus', 'kelembagaan', 'Status Kelembagaan', 'BLU (Sep 2022)', 'fas fa-building', '#2196F3', 7, 1, NOW(), NOW()),
('fasilitas', 'ruang_kelas', 'Jumlah Kelas', '105', 'fas fa-chalkboard', '#FF9800', 5, 1, NOW(), NOW()),
('fasilitas', 'sertifikasi_lsp', 'Skema Sertifikasi LSP P1', '5 prodi', 'fas fa-certificate', '#9C27B0', 6, 1, NOW(), NOW());

-- Update dashboard statistics jika ada
UPDATE dashboard_statistics SET value = '6605' WHERE category = 'campus_info' AND key_name = 'total_mahasiswa';
UPDATE dashboard_statistics SET value = '482' WHERE category = 'campus_info' AND key_name = 'total_dosen';
UPDATE dashboard_statistics SET value = '10' WHERE category = 'campus_info' AND key_name = 'total_jurusan';
UPDATE dashboard_statistics SET value = '39' WHERE category = 'campus_info' AND key_name = 'total_prodi';
UPDATE dashboard_statistics SET value = '246269' WHERE category = 'campus_info' AND key_name = 'luas_kampus';
UPDATE dashboard_statistics SET value = '93435' WHERE category = 'campus_info' AND key_name = 'luas_bangunan';
UPDATE dashboard_statistics SET value = '86' WHERE category = 'campus_info' AND key_name = 'jumlah_bangunan';
UPDATE dashboard_statistics SET value = '119' WHERE category = 'campus_info' AND key_name = 'jumlah_laboratorium';

-- Tambah data dashboard statistics baru
INSERT IGNORE INTO dashboard_statistics (category, key_name, label, value, icon, color, order_position, is_active, created_at, updated_at) VALUES
('campus_info', 'akreditasi_pt', 'Akreditasi PT', 'Unggul', 'fas fa-award', '#FFD700', 9, 1, NOW(), NOW()),
('campus_info', 'prodi_unggul_count', 'Prodi Unggul', '25', 'fas fa-star', '#4CAF50', 10, 1, NOW(), NOW()),
('campus_info', 'prodi_unggul_percentage', 'Persentase Prodi Unggul', '66%', 'fas fa-percentage', '#4CAF50', 11, 1, NOW(), NOW()),
('campus_info', 'status_kelembagaan', 'Status Kelembagaan', 'BLU', 'fas fa-building', '#2196F3', 12, 1, NOW(), NOW()),
('campus_info', 'ruang_kelas', 'Jumlah Kelas', '105', 'fas fa-chalkboard', '#FF9800', 13, 1, NOW(), NOW()),
('campus_info', 'sertifikasi_lsp', 'Sertifikasi LSP P1', '5', 'fas fa-certificate', '#9C27B0', 14, 1, NOW(), NOW());