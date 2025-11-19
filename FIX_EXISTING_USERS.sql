-- ============================================
-- FIX EXISTING USERS - Set Approval Status
-- ============================================
-- Script ini untuk memastikan user yang sudah ada (terutama admin)
-- tidak terblokir oleh sistem approval

-- 1. SET ALL EXISTING USERS TO APPROVED
-- ============================================
-- Ini akan set semua user yang sudah ada menjadi 'approved'
-- sehingga mereka bisa login tanpa masalah

UPDATE users 
SET approval_status = 'approved',
    approved_at = NOW()
WHERE approval_status IS NULL 
   OR approval_status = '';

-- 2. SPECIFICALLY SET ADMIN USERS TO APPROVED
-- ============================================
-- Pastikan semua admin bisa login

UPDATE users 
SET approval_status = 'approved',
    approved_at = NOW()
WHERE role = 'admin';

-- 3. SET REVIEWER TO APPROVED
-- ============================================
-- Pastikan reviewer juga bisa login

UPDATE users 
SET approval_status = 'approved',
    approved_at = NOW()
WHERE role = 'reviewer';

-- 4. CHECK CURRENT STATUS
-- ============================================
-- Lihat status approval semua user

SELECT 
    id,
    name,
    email,
    role,
    approval_status,
    created_at
FROM users
ORDER BY role, created_at;

-- 5. ALTERNATIVE: SET SPECIFIC USER TO APPROVED
-- ============================================
-- Jika ingin set user tertentu saja

-- UPDATE users 
-- SET approval_status = 'approved',
--     approved_at = NOW()
-- WHERE email = 'admin@polban.ac.id';

-- 6. CHECK PENDING USERS
-- ============================================
-- Lihat user yang masih pending

SELECT 
    id,
    name,
    email,
    role,
    approval_status,
    created_at
FROM users
WHERE approval_status = 'pending'
ORDER BY created_at DESC;

-- ============================================
-- NOTES:
-- ============================================
-- 1. Jalankan query #1 atau #2 untuk fix existing users
-- 2. User baru yang register akan otomatis pending
-- 3. Admin harus approve user baru melalui dashboard
-- 4. User lama (yang sudah ada sebelum sistem approval) akan tetap bisa login

-- ============================================
-- VERIFICATION QUERIES
-- ============================================

-- Count users by approval status
SELECT 
    approval_status,
    COUNT(*) as total
FROM users
GROUP BY approval_status;

-- List all admin users
SELECT 
    id,
    name,
    email,
    role,
    approval_status
FROM users
WHERE role = 'admin';
