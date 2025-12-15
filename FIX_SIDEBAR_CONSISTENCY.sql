-- SQL untuk memastikan konsistensi data session dan role
-- Mengatasi masalah sidebar yang kadang hilang

-- 1. Cek apakah ada user dengan role yang tidak valid
SELECT id, name, email, role, approval_status 
FROM users 
WHERE role NOT IN ('admin', 'dosen', 'kaprodi', 'user', 'staff', 'reviewer');

-- 2. Update user yang mungkin punya role kosong atau NULL
UPDATE users 
SET role = 'user' 
WHERE role IS NULL OR role = '';

-- 3. Pastikan semua user yang approved punya role yang valid
UPDATE users 
SET role = 'user' 
WHERE approval_status = 'approved' 
AND role NOT IN ('admin', 'dosen', 'kaprodi', 'user', 'staff', 'reviewer');

-- 4. Verifikasi hasil
SELECT role, COUNT(*) as count 
FROM users 
GROUP BY role 
ORDER BY role;

-- 5. Cek user yang mungkin bermasalah
SELECT id, name, email, role, approval_status, created_at 
FROM users 
WHERE approval_status = 'approved' 
ORDER BY role, name;