-- ============================================
-- UPDATE DATABASE SIMPLE (DIJAMIN BERHASIL)
-- Database: capaian_kinerja
-- Jalankan satu per satu jika perlu
-- ============================================

-- ============================================
-- STEP 1: Tambah kolom menu_type
-- Jika error "Duplicate column", skip ke STEP 2
-- ============================================
ALTER TABLE `menus` 
ADD COLUMN `menu_type` VARCHAR(50) DEFAULT 'dashboard' 
COMMENT 'dashboard atau landing' 
AFTER `roles`;

-- ============================================
-- STEP 2: Update menu existing
-- ============================================
UPDATE `menus` 
SET `menu_type` = 'dashboard' 
WHERE `menu_type` IS NULL OR `menu_type` = '';

-- ============================================
-- STEP 3: Update menu "Manajemen Menu"
-- ============================================
UPDATE `menus` 
SET `title` = 'CMS Management', `url` = '/cms/menus'
WHERE `id` = 10;

-- ============================================
-- STEP 4: Tambah menu CMS
-- ============================================
INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`) 
VALUES (NULL, 'Manajemen Berita', '/cms/news', 'fas fa-newspaper', 11, 1, '["admin"]', 'dashboard', NOW());

INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`) 
VALUES (NULL, 'Manajemen Konten', '/cms/contents', 'fas fa-file-alt', 12, 1, '["admin"]', 'dashboard', NOW());

-- ============================================
-- STEP 5: Tambah menu landing page
-- ============================================
INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`) 
VALUES (NULL, 'Deskripsi', '#deskripsi', NULL, 101, 1, '["admin","reviewer","kaprodi","dosen"]', 'landing', NOW());

INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`) 
VALUES (NULL, 'Program', '#program', NULL, 102, 1, '["admin","reviewer","kaprodi","dosen"]', 'landing', NOW());

INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`) 
VALUES (NULL, 'Berita', '#berita', NULL, 103, 1, '["admin","reviewer","kaprodi","dosen"]', 'landing', NOW());

INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`) 
VALUES (NULL, 'Kontak', '#kontak', NULL, 104, 1, '["admin","reviewer","kaprodi","dosen"]', 'landing', NOW());

-- ============================================
-- SELESAI! Cek hasil
-- ============================================
SELECT * FROM `menus` ORDER BY `menu_type`, `order`;
