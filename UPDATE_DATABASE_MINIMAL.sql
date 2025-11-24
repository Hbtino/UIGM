-- ============================================
-- UPDATE DATABASE MINIMAL (PALING AMAN)
-- Hanya tambah kolom menu_type, tidak insert data baru
-- ============================================

-- STEP 1: Tambah kolom menu_type
ALTER TABLE `menus` 
ADD COLUMN `menu_type` VARCHAR(50) DEFAULT 'dashboard' 
COMMENT 'dashboard atau landing' 
AFTER `roles`;

-- STEP 2: Update menu existing
UPDATE `menus` SET `menu_type` = 'dashboard' WHERE `menu_type` IS NULL;

-- SELESAI!
-- Sekarang Anda bisa tambah menu baru via interface admin di /cms/menus
