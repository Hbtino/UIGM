-- =====================================================
-- DEBUG MAP ISSUE - Cek Data di Database
-- =====================================================

-- 1. Cek apakah data informasi ada
SELECT '========================================' as '';
SELECT 'CEK DATA INFORMASI' as 'STATUS';
SELECT '========================================' as '';

SELECT 
    id,
    section,
    title,
    subtitle,
    address,
    phone,
    email,
    CASE 
        WHEN map_embed IS NULL THEN 'NULL'
        WHEN map_embed = '' THEN 'EMPTY'
        ELSE CONCAT('LENGTH: ', LENGTH(map_embed), ' chars')
    END as map_embed_status,
    LEFT(map_embed, 100) as map_embed_preview,
    is_active,
    updated_at
FROM landing_contents 
WHERE section = 'informasi';

-- 2. Cek struktur tabel
SELECT '' as '';
SELECT 'CEK STRUKTUR TABEL' as 'STATUS';
SHOW COLUMNS FROM landing_contents LIKE 'map%';

-- 3. Cek semua data landing_contents
SELECT '' as '';
SELECT 'SEMUA DATA LANDING CONTENTS' as 'STATUS';
SELECT section, title, is_active FROM landing_contents ORDER BY `order`;

-- =====================================================
-- SOLUSI JIKA MAP_EMBED NULL ATAU EMPTY:
-- =====================================================
-- Jalankan query ini untuk insert manual:
/*
UPDATE landing_contents 
SET map_embed = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0956!2d107.5740603!3d-6.8715374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9adf177bf8d%3A0x437398556f9fa03!2sPoliteknik%20Negeri%20Bandung!5e0!3m2!1sid!2sid!4v1234567890!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
    updated_at = NOW()
WHERE section = 'informasi';
*/

-- =====================================================
-- CARA CEK DI BROWSER:
-- =====================================================
-- 1. Buka landing page
-- 2. Klik kanan → Inspect Element
-- 3. Cari section id="informasi"
-- 4. Lihat apakah ada <iframe> di dalam col-md-4
-- 5. Jika tidak ada, berarti data tidak ter-load dari database
-- =====================================================