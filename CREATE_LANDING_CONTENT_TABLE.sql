-- ============================================
-- CREATE TABLE FOR LANDING PAGE CONTENT
-- ============================================

-- Cek apakah tabel sudah ada
DROP TABLE IF EXISTS `landing_contents`;

-- Buat tabel baru
CREATE TABLE `landing_contents` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `section` varchar(50) NOT NULL COMMENT 'deskripsi, program, berita, kontak',
  `title` varchar(255) NOT NULL COMMENT 'Judul section',
  `subtitle` varchar(255) DEFAULT NULL COMMENT 'Subtitle section',
  `content` text NOT NULL COMMENT 'Konten section',
  `image` varchar(255) DEFAULT NULL COMMENT 'Gambar section',
  `button_text` varchar(100) DEFAULT NULL COMMENT 'Text tombol (jika ada)',
  `button_url` varchar(255) DEFAULT NULL COMMENT 'URL tombol (jika ada)',
  `order` int(11) NOT NULL DEFAULT 0 COMMENT 'Urutan tampil',
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=aktif, 0=nonaktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `section` (`section`),
  KEY `is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert data default untuk landing page
INSERT INTO `landing_contents` (`section`, `title`, `subtitle`, `content`, `image`, `button_text`, `button_url`, `order`, `is_active`, `created_at`) VALUES
('deskripsi', 'Tentang Kampus Berkelanjutan', 'Komitmen Kami untuk Lingkungan', '<p>Politeknik Negeri Bandung berkomitmen untuk menjadi kampus berkelanjutan yang peduli terhadap lingkungan. Kami mengintegrasikan prinsip-prinsip keberlanjutan dalam setiap aspek operasional kampus.</p><p>Melalui berbagai program dan inisiatif, kami berupaya mengurangi dampak lingkungan, meningkatkan efisiensi energi, dan menciptakan lingkungan kampus yang hijau dan sehat.</p>', NULL, 'Pelajari Lebih Lanjut', '#program', 1, 1, NOW()),

('program', 'Program Kampus Berkelanjutan', 'Inisiatif Kami', '<ul><li><strong>Pengelolaan Energi:</strong> Penggunaan energi terbarukan dan efisiensi energi</li><li><strong>Manajemen Air:</strong> Konservasi air dan pengolahan air limbah</li><li><strong>Pengelolaan Limbah:</strong> Reduce, reuse, recycle</li><li><strong>Transportasi Hijau:</strong> Promosi transportasi ramah lingkungan</li><li><strong>Ruang Terbuka Hijau:</strong> Peningkatan area hijau kampus</li><li><strong>Pendidikan Lingkungan:</strong> Integrasi dalam kurikulum</li></ul>', NULL, 'Lihat Detail Program', '/dashboard', 2, 1, NOW()),

('berita', 'Berita Terkini', 'Update Kampus Berkelanjutan', '<p>Ikuti perkembangan terbaru program kampus berkelanjutan kami</p>', NULL, 'Lihat Semua Berita', '/news-admin', 3, 1, NOW()),

('kontak', 'Hubungi Kami', 'Tim Kampus Berkelanjutan', '<p><strong>Email:</strong> greenmetric@polban.ac.id</p><p><strong>Telepon:</strong> (022) 1234567</p><p><strong>Alamat:</strong> Jl. Gegerkalong Hilir, Bandung 40559</p><p><strong>Jam Operasional:</strong> Senin - Jumat, 08:00 - 16:00 WIB</p>', NULL, 'Kirim Pesan', 'mailto:greenmetric@polban.ac.id', 4, 1, NOW());

-- Verifikasi
SELECT * FROM landing_contents ORDER BY `order`;
