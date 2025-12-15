-- =====================================================
-- CLEANUP DATA DUPLIKAT INFORMASI
-- =====================================================
-- Menghapus data duplikat dan menyisakan 1 data saja
-- =====================================================

-- 1. CEK DATA DUPLIKAT
SELECT '========================================' as '';
SELECT 'DATA SEBELUM CLEANUP' as 'STATUS';
SELECT '========================================' as '';

SELECT 
    id,
    section,
    title,
    LENGTH(map_embed) as panjang_kode,
    is_active,
    created_at,
    updated_at
FROM landing_contents 
WHERE section = 'informasi'
ORDER BY id;

-- 2. HAPUS DATA DUPLIKAT (SISAKAN YANG TERBARU)
DELETE FROM landing_contents 
WHERE section = 'informasi' 
AND id NOT IN (
    SELECT * FROM (
        SELECT MAX(id) 
        FROM landing_contents 
        WHERE section = 'informasi'
    ) as temp
);

-- 3. VERIFIKASI SETELAH CLEANUP
SELECT '' as '';
SELECT '========================================' as '';
SELECT 'DATA SETELAH CLEANUP' as 'STATUS';
SELECT '========================================' as '';

SELECT 
    id,
    section,
    title,
    LENGTH(map_embed) as panjang_kode,
    is_active,
    updated_at
FROM landing_contents 
WHERE section = 'informasi';

-- 4. PASTIKAN HANYA ADA 1 DATA
SELECT '' as '';
SELECT CONCAT('Total data informasi: ', COUNT(*)) as 'RESULT'
FROM landing_contents 
WHERE section = 'informasi';

-- =====================================================
-- SETELAH JALANKAN SQL INI:
-- =====================================================
-- 1. Buka /informasi-contents di admin
-- 2. Edit dan save map baru
-- 3. Refresh landing page (Ctrl + F5)
-- 4. Map seharusnya sudah berubah!
-- =====================================================