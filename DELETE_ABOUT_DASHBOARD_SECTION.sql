-- SQL untuk menghapus section "Tentang Dashboard Kampus Berkelanjutan" 
-- dari tabel landing_statistics

-- Hapus semua data dengan section = 'about_dashboard'
DELETE FROM `landing_statistics` 
WHERE `section` = 'about_dashboard';

-- Verifikasi data sudah terhapus
SELECT * FROM `landing_statistics` 
WHERE `section` = 'about_dashboard';
-- Seharusnya return 0 rows jika berhasil dihapus
