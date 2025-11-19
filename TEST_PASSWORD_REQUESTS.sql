-- Test queries untuk debugging password change requests

-- 1. Cek apakah tabel ada
SHOW TABLES LIKE 'password_change_requests';

-- 2. Cek struktur tabel
DESCRIBE password_change_requests;

-- 3. Cek semua data di tabel
SELECT * FROM password_change_requests;

-- 4. Cek pending requests dengan join users
SELECT 
    pcr.*,
    u.name,
    u.email,
    u.role
FROM password_change_requests pcr
JOIN users u ON u.id = pcr.user_id
WHERE pcr.status = 'pending'
ORDER BY pcr.requested_at DESC;

-- 5. Count pending requests
SELECT COUNT(*) as pending_count
FROM password_change_requests
WHERE status = 'pending';

-- 6. Cek user yang buat request
SELECT 
    u.id,
    u.name,
    u.email,
    u.role,
    COUNT(pcr.id) as total_requests
FROM users u
LEFT JOIN password_change_requests pcr ON pcr.user_id = u.id
GROUP BY u.id;

-- 7. Insert test data (jika perlu)
-- INSERT INTO password_change_requests (user_id, new_password, status, requested_at)
-- VALUES (5, '$2y$10$test_hashed_password', 'pending', NOW());
