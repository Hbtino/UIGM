-- ============================================
-- CREATE TABLE: user_waste_inputs
-- Tabel untuk menyimpan input data limbah dari user
-- ============================================

-- Drop table jika sudah ada (hati-hati, ini akan menghapus data!)
-- DROP TABLE IF EXISTS `user_waste_inputs`;

-- Create table user_waste_inputs
CREATE TABLE IF NOT EXISTS `user_waste_inputs` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tanggal_input` DATE NOT NULL COMMENT 'Tanggal input data limbah',
  `jenis_sampah` ENUM('sampah_anorganik_bersih', 'sampah_anorganik_kotor', 'sampah_organik', 'limbah_air', 'limbah_b3') NOT NULL COMMENT 'Jenis sampah yang diinput',
  `jumlah` DECIMAL(10,2) NOT NULL COMMENT 'Jumlah sampah',
  `satuan` ENUM('kg', 'liter') NOT NULL COMMENT 'Satuan: kg untuk sampah padat, liter untuk limbah cair',
  `gedung` VARCHAR(100) NOT NULL COMMENT 'Lokasi/gedung tempat sampah dikumpulkan',
  `status_verifikasi` ENUM('pending', 'approved', 'rejected') DEFAULT 'pending' COMMENT 'Status verifikasi oleh admin',
  `catatan_verifikasi` TEXT NULL COMMENT 'Catatan dari admin saat verifikasi',
  `verified_by` INT(11) UNSIGNED NULL COMMENT 'ID admin yang melakukan verifikasi',
  `verified_at` DATETIME NULL COMMENT 'Waktu verifikasi',
  `created_by` INT(11) UNSIGNED NOT NULL COMMENT 'ID user yang menginput data',
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_created_by` (`created_by`),
  KEY `idx_verified_by` (`verified_by`),
  KEY `idx_status` (`status_verifikasi`),
  KEY `idx_tanggal` (`tanggal_input`),
  KEY `idx_jenis_sampah` (`jenis_sampah`),
  CONSTRAINT `fk_user_waste_inputs_created_by` 
    FOREIGN KEY (`created_by`) 
    REFERENCES `users` (`id`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
  CONSTRAINT `fk_user_waste_inputs_verified_by` 
    FOREIGN KEY (`verified_by`) 
    REFERENCES `users` (`id`) 
    ON DELETE SET NULL 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabel input data limbah dari user';

-- ============================================
-- SAMPLE DATA (Optional - untuk testing)
-- ============================================

-- Contoh data input dari user (uncomment jika ingin insert sample data)
/*
INSERT INTO `user_waste_inputs` 
  (`tanggal_input`, `jenis_sampah`, `jumlah`, `satuan`, `gedung`, `status_verifikasi`, `created_by`) 
VALUES
  ('2024-01-15', 'sampah_anorganik_bersih', 25.50, 'kg', 'Gedung A', 'pending', 1),
  ('2024-01-15', 'sampah_organik', 15.00, 'kg', 'Kantin', 'approved', 1),
  ('2024-01-16', 'limbah_air', 100.00, 'liter', 'Lab Kimia', 'pending', 1),
  ('2024-01-16', 'limbah_b3', 5.50, 'kg', 'Lab Kimia', 'rejected', 1),
  ('2024-01-17', 'sampah_anorganik_kotor', 30.00, 'kg', 'Gedung B', 'approved', 1);
*/

-- ============================================
-- QUERY UNTUK CEK DATA
-- ============================================

-- Cek semua data input user
-- SELECT * FROM user_waste_inputs ORDER BY created_at DESC;

-- Cek data berdasarkan status
-- SELECT * FROM user_waste_inputs WHERE status_verifikasi = 'pending';

-- Cek data dengan informasi user
-- SELECT 
--   uwi.*,
--   u.name as user_name,
--   u.email as user_email,
--   v.name as verifier_name
-- FROM user_waste_inputs uwi
-- LEFT JOIN users u ON u.id = uwi.created_by
-- LEFT JOIN users v ON v.id = uwi.verified_by
-- ORDER BY uwi.created_at DESC;

-- Statistik per user
-- SELECT 
--   u.name,
--   COUNT(*) as total_input,
--   SUM(CASE WHEN uwi.status_verifikasi = 'pending' THEN 1 ELSE 0 END) as pending,
--   SUM(CASE WHEN uwi.status_verifikasi = 'approved' THEN 1 ELSE 0 END) as approved,
--   SUM(CASE WHEN uwi.status_verifikasi = 'rejected' THEN 1 ELSE 0 END) as rejected
-- FROM user_waste_inputs uwi
-- JOIN users u ON u.id = uwi.created_by
-- GROUP BY u.id, u.name;

-- ============================================
-- NOTES
-- ============================================

-- 1. Tabel ini akan auto-created oleh WasteManagementModel::insertUserInput()
--    jika belum ada, tapi Anda bisa menjalankan SQL ini secara manual
--
-- 2. Satuan:
--    - kg: untuk sampah anorganik bersih, kotor, dan organik
--    - liter: untuk limbah air
--    - kg/liter: untuk limbah B3 (tergantung jenis)
--
-- 3. Status verifikasi:
--    - pending: menunggu verifikasi admin
--    - approved: disetujui admin
--    - rejected: ditolak admin
--
-- 4. Foreign key constraints:
--    - created_by: CASCADE (jika user dihapus, data input juga dihapus)
--    - verified_by: SET NULL (jika admin dihapus, verified_by jadi NULL)
--
-- 5. Indexes untuk performa query:
--    - idx_created_by: untuk query berdasarkan user
--    - idx_verified_by: untuk query berdasarkan verifier
--    - idx_status: untuk filter berdasarkan status
--    - idx_tanggal: untuk filter berdasarkan tanggal
--    - idx_jenis_sampah: untuk filter berdasarkan jenis sampah

-- ============================================
-- END OF SQL
-- ============================================
