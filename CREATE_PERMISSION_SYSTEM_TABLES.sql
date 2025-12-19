-- =====================================================
-- UIGM Permission System Database Tables
-- =====================================================

-- 1. Tabel untuk periode UIGM
CREATE TABLE IF NOT EXISTS `uigm_periods` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `year` varchar(10) NOT NULL,
    `start_date` date NOT NULL,
    `end_date` date NOT NULL,
    `status` enum('OPEN','REVIEW','LOCKED') DEFAULT 'OPEN',
    `is_active` tinyint(1) DEFAULT 0,
    `description` text,
    `created_by` int(11),
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `unique_active_period` (`is_active`),
    KEY `idx_year` (`year`),
    KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Update tabel users untuk menambah kolom unit
ALTER TABLE `users` 
ADD COLUMN IF NOT EXISTS `unit` enum('sarpras','lppm','umum') NULL AFTER `role`,
ADD COLUMN IF NOT EXISTS `prodi_id` int(11) NULL AFTER `unit`,
ADD COLUMN IF NOT EXISTS `is_active` tinyint(1) DEFAULT 1 AFTER `prodi_id`;

-- 3. Tabel untuk audit trail aktivitas user
CREATE TABLE IF NOT EXISTS `user_activity_logs` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `user_name` varchar(255) NOT NULL,
    `action` varchar(50) NOT NULL,
    `module` varchar(100) NOT NULL,
    `data_id` int(11) NULL,
    `description` text,
    `ip_address` varchar(45),
    `user_agent` text,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_user_id` (`user_id`),
    KEY `idx_action` (`action`),
    KEY `idx_module` (`module`),
    KEY `idx_created_at` (`created_at`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Tabel untuk role permissions (opsional, untuk konfigurasi dinamis)
CREATE TABLE IF NOT EXISTS `role_permissions` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `role` varchar(50) NOT NULL,
    `module` varchar(100) NOT NULL,
    `action` varchar(50) NOT NULL,
    `is_allowed` tinyint(1) DEFAULT 1,
    `conditions` json NULL,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `unique_permission` (`role`, `module`, `action`),
    KEY `idx_role` (`role`),
    KEY `idx_module` (`module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Update tabel kategori untuk menambah kolom ownership dan status
-- Setting Infrastructure
ALTER TABLE `setting_infrastructure` 
ADD COLUMN IF NOT EXISTS `user_id` int(11) NULL AFTER `id`,
ADD COLUMN IF NOT EXISTS `unit` varchar(50) DEFAULT 'sarpras' AFTER `user_id`,
ADD COLUMN IF NOT EXISTS `status` enum('draft','submitted','approved','rejected') DEFAULT 'draft' AFTER `unit`,
ADD COLUMN IF NOT EXISTS `approved_by` int(11) NULL AFTER `status`,
ADD COLUMN IF NOT EXISTS `approved_at` timestamp NULL AFTER `approved_by`,
ADD COLUMN IF NOT EXISTS `uigm_year` varchar(10) DEFAULT '2025' AFTER `approved_at`;

-- Energy Climate
ALTER TABLE `energy_climate` 
ADD COLUMN IF NOT EXISTS `user_id` int(11) NULL AFTER `id`,
ADD COLUMN IF NOT EXISTS `unit` varchar(50) DEFAULT 'sarpras' AFTER `user_id`,
ADD COLUMN IF NOT EXISTS `status` enum('draft','submitted','approved','rejected') DEFAULT 'draft' AFTER `unit`,
ADD COLUMN IF NOT EXISTS `approved_by` int(11) NULL AFTER `status`,
ADD COLUMN IF NOT EXISTS `approved_at` timestamp NULL AFTER `approved_by`,
ADD COLUMN IF NOT EXISTS `uigm_year` varchar(10) DEFAULT '2025' AFTER `approved_at`;

-- Water Management
ALTER TABLE `water_management` 
ADD COLUMN IF NOT EXISTS `user_id` int(11) NULL AFTER `id`,
ADD COLUMN IF NOT EXISTS `unit` varchar(50) DEFAULT 'sarpras' AFTER `user_id`,
ADD COLUMN IF NOT EXISTS `status` enum('draft','submitted','approved','rejected') DEFAULT 'draft' AFTER `unit`,
ADD COLUMN IF NOT EXISTS `approved_by` int(11) NULL AFTER `status`,
ADD COLUMN IF NOT EXISTS `approved_at` timestamp NULL AFTER `approved_by`,
ADD COLUMN IF NOT EXISTS `uigm_year` varchar(10) DEFAULT '2025' AFTER `approved_at`;

-- Waste Management
ALTER TABLE `waste_management` 
ADD COLUMN IF NOT EXISTS `user_id` int(11) NULL AFTER `id`,
ADD COLUMN IF NOT EXISTS `unit` varchar(50) DEFAULT 'umum' AFTER `user_id`,
ADD COLUMN IF NOT EXISTS `status` enum('draft','submitted','approved','rejected') DEFAULT 'draft' AFTER `unit`,
ADD COLUMN IF NOT EXISTS `approved_by` int(11) NULL AFTER `status`,
ADD COLUMN IF NOT EXISTS `approved_at` timestamp NULL AFTER `approved_by`,
ADD COLUMN IF NOT EXISTS `uigm_year` varchar(10) DEFAULT '2025' AFTER `approved_at`;

-- Transportation
ALTER TABLE `transportation` 
ADD COLUMN IF NOT EXISTS `user_id` int(11) NULL AFTER `id`,
ADD COLUMN IF NOT EXISTS `unit` varchar(50) DEFAULT 'sarpras' AFTER `user_id`,
ADD COLUMN IF NOT EXISTS `status` enum('draft','submitted','approved','rejected') DEFAULT 'draft' AFTER `unit`,
ADD COLUMN IF NOT EXISTS `approved_by` int(11) NULL AFTER `status`,
ADD COLUMN IF NOT EXISTS `approved_at` timestamp NULL AFTER `approved_by`,
ADD COLUMN IF NOT EXISTS `uigm_year` varchar(10) DEFAULT '2025' AFTER `approved_at`;

-- Education Research
ALTER TABLE `education_research` 
ADD COLUMN IF NOT EXISTS `user_id` int(11) NULL AFTER `id`,
ADD COLUMN IF NOT EXISTS `unit` varchar(50) DEFAULT 'lppm' AFTER `user_id`,
ADD COLUMN IF NOT EXISTS `status` enum('draft','submitted','approved','rejected') DEFAULT 'draft' AFTER `unit`,
ADD COLUMN IF NOT EXISTS `approved_by` int(11) NULL AFTER `status`,
ADD COLUMN IF NOT EXISTS `approved_at` timestamp NULL AFTER `approved_by`,
ADD COLUMN IF NOT EXISTS `uigm_year` varchar(10) DEFAULT '2025' AFTER `approved_at`;

-- 6. Insert default UIGM period
INSERT IGNORE INTO `uigm_periods` (`year`, `start_date`, `end_date`, `status`, `is_active`, `description`) 
VALUES ('2025', '2025-01-01', '2025-12-31', 'OPEN', 1, 'Periode UIGM 2025 - Aktif');

-- 7. Insert default role permissions
INSERT IGNORE INTO `role_permissions` (`role`, `module`, `action`, `is_allowed`) VALUES
-- Admin Pusat - Full Access
('admin', '*', 'create', 1),
('admin', '*', 'read', 1),
('admin', '*', 'update', 1),
('admin', '*', 'delete', 1),
('admin', '*', 'approve', 1),
('admin', '*', 'finalize', 1),

-- Admin Unit - Limited Access
('admin_unit', 'kategori_unit', 'create', 1),
('admin_unit', 'kategori_unit', 'read', 1),
('admin_unit', 'kategori_unit', 'update', 1),
('admin_unit', 'kategori_unit', 'delete', 0),
('admin_unit', 'kategori_unit', 'approve', 0),
('admin_unit', 'kategori_unit', 'finalize', 0),

-- Kaprodi - Review Only
('kaprodi', 'review_dosen', 'read', 1),
('kaprodi', 'review_dosen', 'approve', 1),
('kaprodi', 'laporan_prodi', 'read', 1),
('kaprodi', 'statistik_prodi', 'read', 1),

-- Dosen - Own Data Only
('dosen', 'education_research', 'create', 1),
('dosen', 'education_research', 'read', 1),
('dosen', 'education_research', 'update', 1),
('dosen', 'education_research', 'delete', 0);

-- 8. Create indexes for better performance
CREATE INDEX IF NOT EXISTS `idx_user_unit` ON `users` (`unit`);
CREATE INDEX IF NOT EXISTS `idx_user_role_active` ON `users` (`role`, `is_active`);
CREATE INDEX IF NOT EXISTS `idx_si_user_year` ON `setting_infrastructure` (`user_id`, `uigm_year`);
CREATE INDEX IF NOT EXISTS `idx_ec_user_year` ON `energy_climate` (`user_id`, `uigm_year`);
CREATE INDEX IF NOT EXISTS `idx_wm_user_year` ON `water_management` (`user_id`, `uigm_year`);
CREATE INDEX IF NOT EXISTS `idx_ws_user_year` ON `waste_management` (`user_id`, `uigm_year`);
CREATE INDEX IF NOT EXISTS `idx_tr_user_year` ON `transportation` (`user_id`, `uigm_year`);
CREATE INDEX IF NOT EXISTS `idx_er_user_year` ON `education_research` (`user_id`, `uigm_year`);

-- 9. Update existing users dengan role dan unit default
UPDATE `users` SET 
    `unit` = CASE 
        WHEN `role` = 'admin' THEN NULL
        WHEN `role` = 'dosen' THEN 'lppm'
        WHEN `role` = 'kaprodi' THEN NULL
        ELSE 'sarpras'
    END,
    `is_active` = 1
WHERE `unit` IS NULL;

-- =====================================================
-- VERIFICATION QUERIES
-- =====================================================

-- Check tabel yang sudah dibuat
SELECT 'uigm_periods' as table_name, COUNT(*) as record_count FROM uigm_periods
UNION ALL
SELECT 'user_activity_logs', COUNT(*) FROM user_activity_logs  
UNION ALL
SELECT 'role_permissions', COUNT(*) FROM role_permissions;

-- Check kolom baru di tabel users
DESCRIBE users;

-- Check kolom baru di tabel kategori
DESCRIBE setting_infrastructure;
DESCRIBE energy_climate;
DESCRIBE water_management;
DESCRIBE waste_management;
DESCRIBE transportation;
DESCRIBE education_research;

-- =====================================================
-- NOTES
-- =====================================================
/*
1. Tabel uigm_periods: Mengelola periode UIGM dan status (OPEN/REVIEW/LOCKED)
2. user_activity_logs: Audit trail untuk semua aktivitas user
3. role_permissions: Konfigurasi permission yang bisa diubah secara dinamis
4. Kolom tambahan di tabel kategori: user_id, unit, status, approval info, uigm_year
5. Indexes ditambahkan untuk performa query yang lebih baik
6. Default data untuk periode 2025 dan role permissions

Setelah menjalankan script ini:
- Sistem permission sudah siap digunakan
- Audit trail akan mencatat semua aktivitas
- Data ownership sudah terlacak per user dan unit
- Status approval workflow sudah tersedia
*/