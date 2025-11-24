-- ============================================
-- FIX DUPLICATE LANDING PAGE MENUS
-- ============================================

-- 1. CEK MENU DUPLIKAT
SELECT title, menu_type, COUNT(*) as jumlah
FROM menus
WHERE menu_type = 'landing'
GROUP BY title, menu_type
HAVING COUNT(*) > 1;

-- 2. LIHAT DETAIL MENU DUPLIKAT
SELECT id, title, url, menu_type, `order`, created_at
FROM menus
WHERE menu_type = 'landing'
ORDER BY title, id;

-- 3. HAPUS DUPLIKAT (KEEP YANG ID LEBIH KECIL)
-- Jalankan query ini untuk setiap menu yang duplikat

-- Contoh: Jika ada 2 menu "Deskripsi" dengan ID 14 dan 18, hapus yang ID 18
-- DELETE FROM menus WHERE id = 18;

-- Atau gunakan query otomatis ini (HATI-HATI!):
DELETE m1 FROM menus m1
INNER JOIN menus m2 
WHERE m1.id > m2.id 
  AND m1.title = m2.title 
  AND m1.menu_type = m2.menu_type
  AND m1.menu_type = 'landing';

-- 4. VERIFIKASI HASIL
SELECT id, title, url, menu_type, `order`
FROM menus
WHERE menu_type = 'landing'
ORDER BY `order`;

-- 5. PASTIKAN TIDAK ADA DUPLIKAT LAGI
SELECT title, COUNT(*) as jumlah
FROM menus
WHERE menu_type = 'landing'
GROUP BY title
HAVING COUNT(*) > 1;
