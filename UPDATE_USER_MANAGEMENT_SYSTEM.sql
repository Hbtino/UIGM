-- ============================================
-- UPDATE USER MANAGEMENT SYSTEM
-- Menambahkan role baru dan field conditional
-- ============================================

-- 1. Update enum role di tabel users
ALTER TABLE `users` 
MODIFY COLUMN `role` enum('admin','admin_unit','kaprodi','dosen') NOT NULL DEFAULT 'dosen';

-- 2. Tambahkan kolom unit dan prodi_id jika belum ada
ALTER TABLE `users` 
ADD COLUMN IF NOT EXISTS `unit` enum('sarpras','lppm','umum') NULL AFTER `role`,
ADD COLUMN IF NOT EXISTS `prodi_id` int(11) NULL AFTER `unit`,
ADD COLUMN IF NOT EXISTS `is_active` tinyint(1) DEFAULT 1 AFTER `prodi_id`;

-- 3. Buat tabel prodi jika belum ada
CREATE TABLE IF NOT EXISTS `prodi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_prodi` varchar(255) NOT NULL,
  `jenjang` enum('D3','D4','S2') NOT NULL,
  `kode_prodi` varchar(10) NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_prodi` (`kode_prodi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Insert data program studi POLBAN
INSERT INTO `prodi` (`nama_prodi`, `jenjang`, `kode_prodi`) VALUES
-- D3 Programs
('D3 Teknik Informatika', 'D3', 'D3TI'),
('D3 Teknik Komputer', 'D3', 'D3TK'),
('D3 Teknik Telekomunikasi', 'D3', 'D3TT'),
('D3 Teknik Elektronika', 'D3', 'D3TE'),
('D3 Teknik Listrik', 'D3', 'D3TL'),
('D3 Teknik Mesin', 'D3', 'D3TM'),
('D3 Teknik Aeronautika', 'D3', 'D3TA'),
('D3 Teknik Otomotif', 'D3', 'D3TO'),
('D3 Teknik Refrigerasi dan Tata Udara', 'D3', 'D3TRTU'),
('D3 Teknik Konversi Energi', 'D3', 'D3TKE'),
('D3 Teknik Kimia', 'D3', 'D3TKIM'),
('D3 Analis Kimia', 'D3', 'D3AK'),
('D3 Teknik Sipil', 'D3', 'D3TS'),
('D3 Konstruksi Sipil', 'D3', 'D3KS'),
('D3 Konstruksi Gedung', 'D3', 'D3KG'),
('D3 Teknik Survei dan Pemetaan', 'D3', 'D3TSP'),
('D3 Akuntansi', 'D3', 'D3AKT'),
('D3 Keuangan dan Perbankan', 'D3', 'D3KP'),
('D3 Administrasi Bisnis', 'D3', 'D3AB'),
('D3 Usaha Perjalanan Wisata', 'D3', 'D3UPW'),
('D3 Bahasa Inggris', 'D3', 'D3BI'),

-- D4 Programs  
('D4 Teknik Informatika', 'D4', 'D4TI'),
('D4 Teknik Komputer', 'D4', 'D4TK'),
('D4 Teknik Telekomunikasi', 'D4', 'D4TT'),
('D4 Teknik Elektronika', 'D4', 'D4TE'),
('D4 Teknik Mesin', 'D4', 'D4TM'),
('D4 Teknik Perancangan Manufaktur', 'D4', 'D4TPM'),
('D4 Teknik Kimia', 'D4', 'D4TKIM'),
('D4 Teknik Sipil', 'D4', 'D4TS'),
('D4 Perencanaan Wilayah dan Kota', 'D4', 'D4PWK'),
('D4 Teknik Survei dan Pemetaan', 'D4', 'D4TSP'),
('D4 Akuntansi Manajemen Pemerintahan', 'D4', 'D4AMP'),
('D4 Keuangan Syariah', 'D4', 'D4KS'),
('D4 Administrasi Bisnis Terapan', 'D4', 'D4ABT'),
('D4 Logistik Bisnis', 'D4', 'D4LB'),

-- S2 Programs
('S2 Teknik Informatika', 'S2', 'S2TI'),
('S2 Teknik Mesin', 'S2', 'S2TM'),
('S2 Teknik Sipil', 'S2', 'S2TS'),
('S2 Rekayasa Infrastruktur', 'S2', 'S2RI'),
('S2 Keuangan dan Perbankan Syariah', 'S2', 'S2KPS');

-- 5. Tambahkan foreign key constraint
ALTER TABLE `users` 
ADD CONSTRAINT `fk_users_prodi` 
FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) 
ON DELETE SET NULL ON UPDATE CASCADE;

-- 6. Update existing users dengan role baru
-- Convert existing 'admin' to 'admin' (Admin Pusat)
-- Convert existing 'mahasiswa' to 'dosen' if any
UPDATE `users` SET `role` = 'dosen' WHERE `role` = 'mahasiswa';

-- 7. Set default unit untuk admin_unit yang sudah ada (jika ada)
UPDATE `users` SET `unit` = 'sarpras' WHERE `role` = 'admin_unit' AND `unit` IS NULL;

-- 8. Buat index untuk performa
CREATE INDEX IF NOT EXISTS `idx_users_role` ON `users` (`role`);
CREATE INDEX IF NOT EXISTS `idx_users_unit` ON `users` (`unit`);
CREATE INDEX IF NOT EXISTS `idx_users_prodi_id` ON `users` (`prodi_id`);
CREATE INDEX IF NOT EXISTS `idx_prodi_jenjang` ON `prodi` (`jenjang`);

-- ============================================
-- VERIFICATION QUERIES
-- ============================================

-- Check updated users table structure
DESCRIBE `users`;

-- Check prodi table
SELECT COUNT(*) as total_prodi FROM `prodi`;
SELECT jenjang, COUNT(*) as jumlah FROM `prodi` GROUP BY jenjang;

-- Check users by role
SELECT role, COUNT(*) as jumlah FROM `users` GROUP BY role;

-- Check users with unit/prodi info
SELECT 
    u.id,
    u.name,
    u.email,
    u.role,
    u.unit,
    p.nama_prodi,
    p.jenjang
FROM users u
LEFT JOIN prodi p ON u.prodi_id = p.id
ORDER BY u.role, u.name;

COMMIT;