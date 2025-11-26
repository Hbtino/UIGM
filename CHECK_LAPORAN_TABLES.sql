-- Check laporan_dosen table structure
DESCRIBE laporan_dosen;

-- Check laporan_kaprodi table structure  
DESCRIBE laporan_kaprodi;

-- Check data in laporan_dosen
SELECT id, user_id, user_name, jurusan, program_studi, created_at, updated_at 
FROM laporan_dosen 
ORDER BY created_at DESC;

-- Check data in laporan_kaprodi
SELECT id, user_id, user_name, prodi_id, prodi_name, created_at, updated_at 
FROM laporan_kaprodi 
ORDER BY created_at DESC;

-- Count records per user in laporan_dosen
SELECT user_id, user_name, COUNT(*) as total_laporan
FROM laporan_dosen
GROUP BY user_id, user_name
ORDER BY total_laporan DESC;

-- Count records per user in laporan_kaprodi
SELECT user_id, user_name, COUNT(*) as total_laporan
FROM laporan_kaprodi
GROUP BY user_id, user_name
ORDER BY total_laporan DESC;
