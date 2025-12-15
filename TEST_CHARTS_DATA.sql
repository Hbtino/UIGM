-- Test query untuk memastikan data landing_charts ada dan benar

-- 1. Cek apakah tabel ada
SHOW TABLES LIKE 'landing_charts';
-- Hasil: Harus muncul 1 row dengan nama 'landing_charts'

-- 2. Hitung jumlah data
SELECT COUNT(*) as total_data FROM landing_charts;
-- Hasil: Harus 12 (6 ranking_dunia + 6 ranking_indonesia)

-- 3. Lihat semua data
SELECT * FROM landing_charts ORDER BY chart_type, order_position;
-- Hasil: Harus muncul 12 rows

-- 4. Cek data ranking_dunia
SELECT * FROM landing_charts WHERE chart_type = 'ranking_dunia' ORDER BY order_position;
-- Hasil: Harus 6 rows (2023-2028)

-- 5. Cek data ranking_indonesia  
SELECT * FROM landing_charts WHERE chart_type = 'ranking_indonesia' ORDER BY order_position;
-- Hasil: Harus 6 rows (2023-2028)

-- 6. Cek is_active
SELECT chart_type, COUNT(*) as total FROM landing_charts WHERE is_active = 1 GROUP BY chart_type;
-- Hasil: ranking_dunia = 6, ranking_indonesia = 6

-- Jika salah satu query di atas tidak mengembalikan hasil yang benar,
-- jalankan ulang file CREATE_LANDING_CHARTS_TABLE.sql
