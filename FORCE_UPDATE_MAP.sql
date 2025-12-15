-- =====================================================
-- FORCE UPDATE MAP - Solusi Cepat
-- =====================================================
-- Jika map tidak berubah di landing page, jalankan ini
-- =====================================================

-- 1. CEK DATA SAAT INI
SELECT '========================================' as '';
SELECT 'DATA SEBELUM UPDATE' as 'STATUS';
SELECT '========================================' as '';

SELECT 
    section,
    title,
    CASE 
        WHEN map_embed IS NULL THEN 'NULL'
        WHEN map_embed = '' THEN 'EMPTY'
        ELSE CONCAT('ADA - Length: ', LENGTH(map_embed))
    END as status_map,
    updated_at
FROM landing_contents 
WHERE section = 'informasi';

-- 2. FORCE UPDATE MAP
-- Ganti dengan kode embed yang kamu copy dari Google Maps
UPDATE landing_contents 
SET 
    map_embed = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.2321008560815!2d107.55152173276393!3d-6.898156142088757!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e1d990c5e5e5%3A0x5e5e5e5e5e5e5e5e!2sJl.%20Sukasenang%2C%20Cimahi!5e0!3m2!1sid!2sid!4v1234567890!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
    updated_at = NOW()
WHERE section = 'informasi';

-- 3. VERIFIKASI UPDATE
SELECT '' as '';
SELECT '========================================' as '';
SELECT 'DATA SETELAH UPDATE' as 'STATUS';
SELECT '========================================' as '';

SELECT 
    section,
    title,
    LENGTH(map_embed) as panjang_kode,
    LEFT(map_embed, 100) as preview_kode,
    updated_at
FROM landing_contents 
WHERE section = 'informasi';

-- =====================================================
-- SETELAH JALANKAN SQL INI:
-- =====================================================
-- 1. Refresh landing page (Ctrl + F5)
-- 2. Map seharusnya sudah berubah
-- 3. Jika masih belum berubah, cek browser console (F12)
-- =====================================================

-- =====================================================
-- JIKA INGIN GANTI KE MAP LAIN:
-- =====================================================
-- 1. Buka Google Maps
-- 2. Cari lokasi (JANGAN masuk Street View!)
-- 3. Share → Embed a map → Copy HTML
-- 4. Ganti kode di atas (baris UPDATE) dengan kode baru
-- 5. Jalankan lagi SQL ini
-- =====================================================