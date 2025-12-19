-- =====================================================
-- UIGM Permission System Database Tables (FIXED VERSION)
-- =====================================================

-- 1. Tabel untuk audit trail aktivitas user (without foreign key constraint)
CREATE TABLE IF NOT EXISTS `user_activity_logs` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(10) unsigned NOT NULL,
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
    KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Tabel untuk role permissions (opsional, untuk konfigurasi dinamis)
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

-- 3. Update tabel kategori untuk menambah kolom ownership dan status
-- Setting Infrastructure
ALTER TABLE `setting_infrastructure` 
ADD COLUMN IF NOT EXISTS `user_id` int(10) unsigned NULL AFTER `id`,
ADD COLUMN IF NOT EXISTS `unit` varchar(50) DEFAULT 'sarpras' AFTER `user_id`,
ADD COLUMN IF NOT EXISTS `status` enum('draft','submitted','approved','rejected') DEFAULT 'draft' AFTER `unit`,
ADD COLUMN IF NOT EXISTS `approved_by` int(10) unsigned NULL AFTER `status`,
ADD COLUMN IF NOT EXISTS `approved_at` timestamp NULL AFTER `approved_by`,
ADD COLUMN IF NOT EXISTS `uigm_year` varchar(10) DEFAULT '2025' AFTER `approved_at`;

-- Energy Climate
ALTER TABLE `energy_climate` 
ADD COLUMN IF NOT EXISTS `user_id` int(10) unsigned NULL AFTER `id`,
ADD COLUMN IF NOT EXISTS `unit` varchar(50) DEFAULT 'sarpras' AFTER `user_id`,
ADD COLUMN IF NOT EXISTS `status` enum('draft','submitted','approved','rejected') DEFAULT 'draft' AFTER `unit`,
ADD COLUMN IF NOT EXISTS `approved_by` int(10) unsigned NULL AFTER `status`,
ADD COLUMN IF NOT EXISTS `approved_at` timestamp NULL AFTER `approved_by`,
ADD COLUMN IF NOT EXISTS `uigm_year` varchar(10) DEFAULT '2025' AFTER `approved_at`;

-- Water Management
ALTER TABLE `water_management` 
ADD COLUMN IF NOT EXISTS `user_id` int(10) unsigned NULL AFTER `id`,
ADD COLUMN IF NOT EXISTS `unit` varchar(50) DEFAULT 'sarpras' AFTER `user_id`,
ADD COLUMN IF NOT EXISTS `status` enum('draft','submitted','approved','rejected') DEFAULT 'draft' AFTER `unit`,
ADD COLUMN IF NOT EXISTS `approved_by` int(10) unsigned NULL AFTER `status`,
ADD COLUMN IF NOT EXISTS `approved_at` timestamp NULL AFTER `approved_by`,
ADD COLUMN IF NOT EXISTS `uigm_year` varchar(10) DEFAULT '2025' AFTER `approved_at`;

-- Waste Management
ALTER TABLE `waste_management` 
ADD COLUMN IF NOT EXISTS `user_id` int(10) unsigned NULL AFTER `id`,
ADD COLUMN IF NOT EXISTS `unit` varchar(50) DEFAULT 'umum' AFTER `user_id`,
ADD COLUMN IF NOT EXISTS `status` enum('draft','submitted','approved','rejected') DEFAULT 'draft' AFTER `unit`,
ADD COLUMN IF NOT EXISTS `approved_by` int(10) unsigned NULL AFTER `status`,
ADD COLUMN IF NOT EXISTS `approved_at` timestamp NULL AFTER `approved_by`,
ADD COLUMN IF NOT EXISTS `uigm_year` varchar(10) DEFAULT '2025' AFTER `approved_at`;

-- Transportation
ALTER TABLE `transportation` 
ADD COLUMN IF NOT EXISTS `user_id` int(10) unsigned NULL AFTER `id`,
ADD COLUMN IF NOT EXISTS `unit` varchar(50) DEFAULT 'sarpras' AFTER `user_id`,
ADD COLUMN IF NOT EXISTS `status` enum('draft','submitted','approved','rejected') DEFAULT 'draft' AFTER `unit`,
ADD COLUMN IF NOT EXISTS `approved_by` int(10) unsigned NULL AFTER `status`,
ADD COLUMN IF NOT EXISTS `approved_at` timestamp NULL AFTER `approved_by`,
ADD COLUMN IF NOT EXISTS `uigm_year` varchar(10) DEFAULT '2025' AFTER `approved_at`;

-- Education Research
ALTER TABLE `education_research` 
ADD COLUMN IF NOT EXISTS `user_id` int(10) unsigned NULL AFTER `id`,
ADD COLUMN IF NOT EXISTS `unit` varchar(50) DEFAULT 'lppm' AFTER `user_id`,
ADD COLUMN IF NOT EXISTS `status` enum('draft','submitted','approved','rejected') DEFAULT 'draft' AFTER `unit`,
ADD COLUMN IF NOT EXISTS `approved_by` int(10) unsigned NULL AFTER `status`,
ADD COLUMN IF NOT EXISTS `approved_at` timestamp NULL AFTER `approved_by`,
ADD COLUMN IF NOT EXISTS `uigm_year` varchar(10) DEFAULT '2025' AFTER `approved_at`;

-- 4. Insert default role permissions
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

-- 5. Create indexes for better performance
CREATE INDEX IF NOT EXISTS `idx_user_unit` ON `users` (`unit`);
CREATE INDEX IF NOT EXISTS `idx_user_role_active` ON `users` (`role`, `is_active`);
CREATE INDEX IF NOT EXISTS `idx_si_user_year` ON `setting_infrastructure` (`user_id`, `uigm_year`);
CREATE INDEX IF NOT EXISTS `idx_ec_user_year` ON `energy_climate` (`user_id`, `uigm_year`);
CREATE INDEX IF NOT EXISTS `idx_wm_user_year` ON `water_management` (`user_id`, `uigm_year`);
CREATE INDEX IF NOT EXISTS `idx_ws_user_year` ON `waste_management` (`user_id`, `uigm_year`);
CREATE INDEX IF NOT EXISTS `idx_tr_user_year` ON `transportation` (`user_id`, `uigm_year`);
CREATE INDEX IF NOT EXISTS `idx_er_user_year` ON `education_research` (`user_id`, `uigm_year`);

-- 6. Update existing users dengan role dan unit default (only if unit is NULL)
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