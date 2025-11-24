-- ============================================
-- UPDATE DATABASE UNTUK CMS MANAGEMENT (FULL VERSION - FIXED)
-- Database: capaian_kinerja
-- AMAN - Cek kolom dulu sebelum tambah
-- ============================================

-- ============================================
-- STEP 1: Tambah kolom menu_type (jika belum ada)
-- ============================================
-- Cek dulu, jika sudah ada akan skip otomatis
SET @col_exists = 0;
SELECT COUNT(*) INTO @col_exists 
FROM information_schema.COLUMNS 
WHERE TABLE_SCHEMA = 'capaian_kinerja' 
AND TABLE_NAME = 'menus' 
AND COLUMN_NAME = 'menu_type';

SET @query = IF(@col_exists = 0,
    'ALTER TABLE `menus` ADD COLUMN `menu_type` VARCHAR(50) DEFAULT "dashboard" COMMENT "dashboard atau landing" AFTER `roles`',
    'SELECT "Column menu_type already exists" AS message'
);

PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- ============================================
-- STEP 2: Update menu existing jadi type dashboard
-- ============================================
UPDATE `menus` SET `menu_type` = 'dashboard' WHERE `menu_type` IS NULL OR `menu_type` = '';

-- ============================================
-- STEP 3: Update menu "Manajemen Menu" jadi "CMS Management"
-- ============================================
UPDATE `menus` SET 
    `title` = 'CMS Management',
    `url` = '/cms/menus'
WHERE `id` = 10 AND `title` = 'Manajemen Menu';

-- ============================================
-- STEP 4: Tambah menu CMS untuk admin (jika belum ada)
-- ============================================
-- Cek apakah menu "Manajemen Berita" sudah ada
INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`)
SELECT NULL, 'Manajemen Berita', '/cms/news', 'fas fa-newspaper', 11, 1, '["admin"]', 'dashboard', NOW()
WHERE NOT EXISTS (
    SELECT 1 FROM `menus` WHERE `title` = 'Manajemen Berita'
);

-- Cek apakah menu "Manajemen Konten" sudah ada
INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`)
SELECT NULL, 'Manajemen Konten', '/cms/contents', 'fas fa-file-alt', 12, 1, '["admin"]', 'dashboard', NOW()
WHERE NOT EXISTS (
    SELECT 1 FROM `menus` WHERE `title` = 'Manajemen Konten'
);

-- ============================================
-- STEP 5: Tambah menu landing page (jika belum ada)
-- ============================================
INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`)
SELECT NULL, 'Deskripsi', '#deskripsi', NULL, 101, 1, '["admin","reviewer","kaprodi","dosen"]', 'landing', NOW()
WHERE NOT EXISTS (
    SELECT 1 FROM `menus` WHERE `title` = 'Deskripsi' AND `menu_type` = 'landing'
);

INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`)
SELECT NULL, 'Program', '#program', NULL, 102, 1, '["admin","reviewer","kaprodi","dosen"]', 'landing', NOW()
WHERE NOT EXISTS (
    SELECT 1 FROM `menus` WHERE `title` = 'Program' AND `menu_type` = 'landing'
);

INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`)
SELECT NULL, 'Berita', '#berita', NULL, 103, 1, '["admin","reviewer","kaprodi","dosen"]', 'landing', NOW()
WHERE NOT EXISTS (
    SELECT 1 FROM `menus` WHERE `title` = 'Berita' AND `menu_type` = 'landing'
);

INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`)
SELECT NULL, 'Kontak', '#kontak', NULL, 104, 1, '["admin","reviewer","kaprodi","dosen"]', 'landing', NOW()
WHERE NOT EXISTS (
    SELECT 1 FROM `menus` WHERE `title` = 'Kontak' AND `menu_type` = 'landing'
);

-- ============================================
-- SELESAI!
-- ============================================
-- Cek hasil:
SELECT 'Setup CMS selesai!' AS status;
SELECT COUNT(*) AS total_menus FROM `menus`;
SELECT COUNT(*) AS menu_dashboard FROM `menus` WHERE `menu_type` = 'dashboard';
SELECT COUNT(*) AS menu_landing FROM `menus` WHERE `menu_type` = 'landing';
