-- SQL Script untuk membuat tabel waste_management yang benar
-- Mengganti struktur lama yang masih menggunakan energy management

-- Drop tabel lama jika ada
DROP TABLE IF EXISTS `waste_management`;

-- Buat tabel waste_management yang baru dengan struktur yang benar
CREATE TABLE `waste_management` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(4) NOT NULL,
  `jenis_sampah` enum('sampah_anorganik_bersih','sampah_anorganik_kotor','sampah_organik','limbah_air','limbah_b3') NOT NULL,
  
  -- Data Sampah Berdasarkan Kategori
  `total_sampah_anorganik_bersih` decimal(10,2) DEFAULT 0.00 COMMENT 'Sampah anorganik bersih dalam kg',
  `total_sampah_anorganik_kotor` decimal(10,2) DEFAULT 0.00 COMMENT 'Sampah anorganik kotor dalam kg',
  `total_sampah_organik` decimal(10,2) DEFAULT 0.00 COMMENT 'Sampah organik dalam kg',
  `total_limbah_air` decimal(10,2) DEFAULT 0.00 COMMENT 'Limbah air dalam liter',
  `total_limbah_b3` decimal(10,2) DEFAULT 0.00 COMMENT 'Limbah B3 dalam kg',
  `total_sampah_keseluruhan` decimal(10,2) DEFAULT 0.00 COMMENT 'Total semua sampah dalam kg',
  
  -- Program 3R (Reduce, Reuse, Recycle)
  `program_reduce` int(11) DEFAULT 0 COMMENT 'Jumlah program reduce',
  `program_reuse` int(11) DEFAULT 0 COMMENT 'Jumlah program reuse',
  `program_recycle` int(11) DEFAULT 0 COMMENT 'Jumlah program recycle',
  
  -- Fasilitas & Program Pengelolaan
  `tempat_sampah_terpilah` int(11) DEFAULT 0 COMMENT 'Jumlah tempat sampah terpilah',
  `kompos_organik` decimal(10,2) DEFAULT 0.00 COMMENT 'Kompos organik yang dihasilkan dalam kg',
  `daur_ulang_persentase` decimal(5,2) DEFAULT 0.00 COMMENT 'Persentase daur ulang',
  `zero_waste_program` tinyint(1) DEFAULT 0 COMMENT 'Program zero waste (1=ada, 0=tidak ada)',
  `bank_sampah` tinyint(1) DEFAULT 0 COMMENT 'Bank sampah (1=ada, 0=tidak ada)',
  
  -- Capaian & Verifikasi
  `capaian_persen` decimal(5,2) DEFAULT 0.00 COMMENT 'Persentase capaian keseluruhan',
  `keterangan` text DEFAULT NULL COMMENT 'Keterangan tambahan',
  `status_verifikasi` enum('pending','approved','rejected') DEFAULT 'pending',
  `catatan_verifikasi` text DEFAULT NULL,
  `bukti_pendukung` varchar(255) DEFAULT NULL COMMENT 'File bukti pendukung',
  `verified_by` int(11) DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  
  -- Audit Trail
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_tahun` (`tahun`),
  KEY `idx_jenis_sampah` (`jenis_sampah`),
  KEY `idx_status_verifikasi` (`status_verifikasi`),
  KEY `idx_created_by` (`created_by`),
  KEY `idx_verified_by` (`verified_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabel data waste management kampus berkelanjutan';

-- Insert sample data
INSERT INTO `waste_management` (
  `tahun`, 
  `jenis_sampah`, 
  `total_sampah_anorganik_bersih`, 
  `total_sampah_anorganik_kotor`, 
  `total_sampah_organik`, 
  `total_limbah_air`, 
  `total_limbah_b3`, 
  `total_sampah_keseluruhan`,
  `program_reduce`, 
  `program_reuse`, 
  `program_recycle`, 
  `tempat_sampah_terpilah`, 
  `kompos_organik`, 
  `daur_ulang_persentase`, 
  `zero_waste_program`, 
  `bank_sampah`, 
  `capaian_persen`, 
  `keterangan`, 
  `status_verifikasi`, 
  `created_by`
) VALUES 
(2024, 'sampah_organik', 1200.50, 850.75, 1250.00, 2500.00, 125.25, 2851.00, 5, 3, 8, 85, 1250.00, 65.50, 1, 1, 72.5, 'Data waste management tahun 2024 dengan program 3R yang komprehensif', 'approved', 1),
(2023, 'sampah_anorganik_bersih', 1100.00, 800.00, 1150.00, 2200.00, 100.00, 2650.00, 4, 2, 6, 75, 1150.00, 60.00, 1, 0, 68.0, 'Data waste management tahun 2023', 'approved', 1);

-- Tambahkan foreign key constraints jika tabel users sudah ada
-- ALTER TABLE `waste_management` ADD CONSTRAINT `fk_waste_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;
-- ALTER TABLE `waste_management` ADD CONSTRAINT `fk_waste_verified_by` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

-- Buat view untuk statistik waste management
CREATE OR REPLACE VIEW `v_waste_management_stats` AS
SELECT 
  tahun,
  SUM(total_sampah_anorganik_bersih) as total_anorganik_bersih,
  SUM(total_sampah_anorganik_kotor) as total_anorganik_kotor,
  SUM(total_sampah_organik) as total_organik,
  SUM(total_limbah_air) as total_limbah_air,
  SUM(total_limbah_b3) as total_limbah_b3,
  SUM(total_sampah_keseluruhan) as total_keseluruhan,
  AVG(daur_ulang_persentase) as avg_daur_ulang,
  AVG(capaian_persen) as avg_capaian,
  COUNT(*) as jumlah_data,
  SUM(CASE WHEN zero_waste_program = 1 THEN 1 ELSE 0 END) as program_zero_waste,
  SUM(CASE WHEN bank_sampah = 1 THEN 1 ELSE 0 END) as program_bank_sampah
FROM waste_management 
WHERE status_verifikasi = 'approved'
GROUP BY tahun
ORDER BY tahun DESC;

-- Index untuk optimasi query
CREATE INDEX idx_waste_tahun_status ON waste_management(tahun, status_verifikasi);
CREATE INDEX idx_waste_jenis_tahun ON waste_management(jenis_sampah, tahun);

COMMIT;