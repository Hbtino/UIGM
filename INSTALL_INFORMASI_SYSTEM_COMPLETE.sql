-- =====================================================
-- INSTALASI LENGKAP SISTEM INFORMASI LANDING PAGE
-- =====================================================
-- File ini berisi semua SQL yang diperlukan untuk:
-- 1. Update struktur tabel landing_contents
-- 2. Insert data informasi awal
-- 3. Update menu dari "Kontak" ke "Informasi"
-- 4. Sinkronisasi dengan dashboard content

-- =====================================================
-- 1. UPDATE STRUKTUR TABEL LANDING_CONTENTS
-- =====================================================

-- Tambah kolom baru untuk informasi kontak dan map
ALTER TABLE landing_contents 
ADD COLUMN IF NOT EXISTS address TEXT NULL AFTER content,
ADD COLUMN IF NOT EXISTS phone VARCHAR(50) NULL AFTER address,
ADD COLUMN IF NOT EXISTS email VARCHAR(100) NULL AFTER phone,
ADD COLUMN IF NOT EXISTS map_embed TEXT NULL AFTER email,
ADD COLUMN IF NOT EXISTS map_latitude DECIMAL(10, 8) NULL AFTER map_embed,
ADD COLUMN IF NOT EXISTS map_longitude DECIMAL(11, 8) NULL AFTER map_latitude;

-- =====================================================
-- 2. INSERT DATA INFORMASI AWAL
-- =====================================================

-- Insert/Update landing_contents untuk section informasi
INSERT INTO landing_contents (
    section, title, subtitle, content, address, phone, email, map_embed, map_latitude, map_longitude, `order`, is_active, created_at, updated_at
) VALUES (
    'informasi',
    'Informasi Kontak',
    'Hubungi Kami',
    'Untuk informasi lebih lanjut tentang program GreenMetric dan Kampus Berkelanjutan Polban, silakan hubungi kami melalui kontak di bawah ini.',
    'Jl. Gegerkalong Hilir, Ds. Ciwaruga, Parongpong, Kabupaten Bandung Barat, Jawa Barat 40559',
    '(022) 2013789',
    'info@polban.ac.id',
    '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0956!2d107.5740603!3d-6.8715374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9adf177bf8d%3A0x437398556f9fa03!2sPoliteknik%20Negeri%20Bandung!5e0!3m2!1sid!2sid!4v1234567890!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
    -6.871537,
    107.574060,
    5,
    1,
    NOW(),
    NOW()
) ON DUPLICATE KEY UPDATE
    title = VALUES(title),
    subtitle = VALUES(subtitle),
    content = VALUES(content),
    address = VALUES(address),
    phone = VALUES(phone),
    email = VALUES(email),
    map_embed = VALUES(map_embed),
    map_latitude = VALUES(map_latitude),
    map_longitude = VALUES(map_longitude),
    updated_at = NOW();

-- =====================================================
-- 3. SINKRONISASI DENGAN DASHBOARD CONTENT
-- =====================================================

-- Insert/Update dashboard_contents untuk info_box
INSERT INTO dashboard_contents (
    section, title, subtitle, content, icon, color, `order`, is_active, created_at, updated_at
) VALUES (
    'info_box',
    'Tentang Dashboard Kampus Berkelanjutan',
    'UI GreenMetric Polban 2024-2028',
    'Dashboard ini menampilkan capaian 6 kriteria utama kampus berkelanjutan berdasarkan UI GreenMetric World University Rankings. Rencana Strategis Transformasi Menuju Kampus Berkelanjutan (TMKB) Politeknik Negeri Bandung periode 2024-2028 disusun untuk mendukung pencapaian Sustainable Development Goals (SDGs) yang ditetapkan oleh PBB.',
    'fa-info-circle',
    '#149823ff',
    1,
    1,
    NOW(),
    NOW()
) ON DUPLICATE KEY UPDATE
    title = VALUES(title),
    subtitle = VALUES(subtitle),
    content = VALUES(content),
    icon = VALUES(icon),
    color = VALUES(color),
    updated_at = NOW();

-- =====================================================
-- 4. UPDATE MENU NAVIGATION
-- =====================================================

-- Update menu dari "Kontak" menjadi "Informasi"
UPDATE menus SET 
    title = 'Informasi', 
    url = '#informasi',
    updated_at = NOW()
WHERE title IN ('Kontak', 'Contact') OR url IN ('#kontak', '#contact');

-- Insert menu Informasi jika belum ada (untuk landing page)
INSERT INTO menus (parent_id, title, url, icon, `order`, is_active, roles, menu_type, created_at, updated_at)
SELECT NULL, 'Informasi', '#informasi', NULL, 104, 1, '["admin","reviewer","kaprodi","dosen"]', 'landing', NOW(), NOW()
WHERE NOT EXISTS (
    SELECT 1 FROM menus WHERE title = 'Informasi' AND menu_type = 'landing'
);

-- =====================================================
-- 5. VERIFIKASI DATA
-- =====================================================

-- Cek data yang sudah diinsert
SELECT 'LANDING CONTENTS - INFORMASI' as 'TABLE_CHECK';
SELECT section, title, subtitle, address, phone, email, is_active 
FROM landing_contents 
WHERE section = 'informasi';

SELECT 'DASHBOARD CONTENTS - INFO BOX' as 'TABLE_CHECK';
SELECT section, title, subtitle, LEFT(content, 100) as content_preview, is_active 
FROM dashboard_contents 
WHERE section = 'info_box';

SELECT 'MENUS - INFORMASI' as 'TABLE_CHECK';
SELECT title, url, `order`, is_active, menu_type 
FROM menus 
WHERE title = 'Informasi' OR url = '#informasi';

-- =====================================================
-- INSTALASI SELESAI
-- =====================================================
-- Sistem informasi landing page sudah siap digunakan!
-- 
-- FITUR YANG TERSEDIA:
-- 1. ✅ Kelola konten informasi melalui admin panel
-- 2. ✅ Edit alamat, telepon, email secara dinamis
-- 3. ✅ Upload dan edit Google Maps embed
-- 4. ✅ Sinkronisasi konten dashboard ke landing page
-- 5. ✅ Menu "Informasi" menggantikan "Kontak"
-- 
-- AKSES ADMIN:
-- - Login sebagai admin
-- - Menu: Sistem → Kelola Informasi
-- - URL: /informasi-contents
-- =====================================================