-- Fix encoding issues in landing_statistics table
-- Menghapus entry yang bermasalah dan menggantinya dengan data yang benar

-- Hapus data lama di section fasilitas
DELETE FROM `landing_statistics` WHERE `section` = 'fasilitas';

-- Insert ulang data fasilitas dengan label yang benar (tanpa karakter khusus)
INSERT INTO `landing_statistics` (`section`, `key_name`, `label`, `value`, `icon`, `color`, `order_position`, `is_active`) VALUES
('fasilitas', 'luas_kampus', 'Luas Kampus (m2)', '246269', 'fa-map', '#1e3a8a', 1, 1),
('fasilitas', 'luas_bangunan', 'Luas Bangunan (m2)', '93435', 'fa-building', '#1e3a8a', 2, 1),
('fasilitas', 'jumlah_bangunan', 'Jumlah Bangunan', '86', 'fa-city', '#1e3a8a', 3, 1),
('fasilitas', 'laboratorium', 'Laboratorium', '119', 'fa-flask', '#1e3a8a', 4, 1);

-- Verifikasi hasil
SELECT * FROM `landing_statistics` WHERE `section` = 'fasilitas' ORDER BY `order_position`;
