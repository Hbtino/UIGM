-- ============================================
-- TAMBAH SECTION BERITA DI LANDING PAGE
-- ============================================

-- Tambah data berita di landing_contents
INSERT INTO `landing_contents` (`section`, `title`, `subtitle`, `content`, `button_text`, `button_url`, `order`, `is_active`, `created_at`) 
VALUES ('berita', 'Berita Terkini', 'Update Kampus Berkelanjutan', '<p>Ikuti perkembangan terbaru program kampus berkelanjutan kami</p>', 'Lihat Semua Berita', '/news-admin', 3, 1, NOW());

-- Update order kontak jadi 4
UPDATE `landing_contents` SET `order` = 4 WHERE `section` = 'kontak';

-- Verifikasi
SELECT * FROM landing_contents ORDER BY `order`;
