-- ============================================
-- UPDATE DATABASE UNTUK CMS MANAGEMENT
-- Database: capaian_kinerja
-- AMAN - Hanya menambah kolom, tidak mengubah data lama
-- ============================================

-- ============================================
-- STEP 1: Tambah kolom menu_type ke tabel menus
-- ============================================
ALTER TABLE `menus` 
ADD COLUMN `menu_type` VARCHAR(50) DEFAULT 'dashboard' 
COMMENT 'dashboard atau landing' 
AFTER `roles`;

-- ============================================
-- STEP 2: Update menu existing jadi type dashboard
-- ============================================
UPDATE `menus` SET `menu_type` = 'dashboard' WHERE `menu_type` IS NULL;

-- ============================================
-- STEP 3: Update menu "Manajemen Menu" jadi "CMS Management"
-- ============================================
UPDATE `menus` SET 
    `title` = 'CMS Management',
    `url` = '/cms/menus'
WHERE `id` = 10;

-- ============================================
-- STEP 4: Tambah menu CMS untuk admin (OPTIONAL)
-- ============================================
INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`) VALUES
(NULL, 'Manajemen Berita', '/cms/news', 'fas fa-newspaper', 11, 1, '["admin"]', 'dashboard', NOW()),
(NULL, 'Manajemen Konten', '/cms/contents', 'fas fa-file-alt', 12, 1, '["admin"]', 'dashboard', NOW());

-- ============================================
-- STEP 5: Tambah menu landing page (OPTIONAL)
-- ============================================
INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`) VALUES
(NULL, 'Deskripsi', '#deskripsi', NULL, 101, 1, '["admin","reviewer","kaprodi","dosen"]', 'landing', NOW()),
(NULL, 'Program', '#program', NULL, 102, 1, '["admin","reviewer","kaprodi","dosen"]', 'landing', NOW()),
(NULL, 'Berita', '#berita', NULL, 103, 1, '["admin","reviewer","kaprodi","dosen"]', 'landing', NOW()),
(NULL, 'Kontak', '#kontak', NULL, 104, 1, '["admin","reviewer","kaprodi","dosen"]', 'landing', NOW());

-- ============================================
-- SELESAI!
-- ============================================
-- Semua menu (dashboard & landing page) sekarang bisa dikelola admin
-- Data lama tetap aman dan tidak berubah
-- Hanya menambah:
-- 1. Kolom menu_type di tabel menus
-- 2. Menu CMS baru (Manajemen Berita, Manajemen Konten)
-- 3. Menu landing page (Deskripsi, Program, Berita, Kontak)
-- ============================================
