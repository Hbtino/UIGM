-- Fix CMS Duplicate Menus
-- Menghapus duplikat menu Manajemen Berita dan Manajemen Konten

-- Hapus duplikat Manajemen Berita (ID 13)
DELETE FROM menus WHERE id = 13 AND title = 'Manajemen Berita' AND url = '/cms/news';

-- Hapus duplikat Manajemen Konten (ID 15)
DELETE FROM menus WHERE id = 15 AND title = 'Manajemen Konten' AND url = '/cms/contents';

-- Verifikasi hasil
SELECT * FROM menus WHERE title LIKE '%Manajemen%' ORDER BY id;
