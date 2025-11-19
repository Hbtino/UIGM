-- ============================================
-- SQL HELPERS FOR TRANSPORTATION CRUD SYSTEM
-- ============================================

-- 1. CREATE REVIEWER USER
-- ============================================
-- Note: Ganti password dengan hash yang sesuai
-- Generate hash: php -r "echo password_hash('password123', PASSWORD_DEFAULT);"

INSERT INTO users (name, email, password, role, created_at, updated_at) 
VALUES 
('Reviewer Polban', 'reviewer@polban.ac.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'reviewer', NOW(), NOW());

-- 2. UPDATE EXISTING USER TO REVIEWER
-- ============================================
UPDATE users 
SET role = 'reviewer', updated_at = NOW() 
WHERE email = 'user@example.com';

-- 3. VIEW ALL USERS BY ROLE
-- ============================================
SELECT id, name, email, role, created_at 
FROM users 
ORDER BY role, name;

-- 4. VIEW TRANSPORTATION DATA WITH STATUS
-- ============================================
SELECT 
    t.id,
    t.tahun,
    t.total_perjalanan,
    t.perjalanan_ramah_lingkungan,
    t.capaian_persen,
    t.status_verifikasi,
    creator.name as created_by_name,
    verifier.name as verified_by_name,
    t.created_at,
    t.verified_at
FROM transportation t
LEFT JOIN users creator ON t.created_by = creator.id
LEFT JOIN users verifier ON t.verified_by = verifier.id
ORDER BY t.tahun DESC;

-- 5. VIEW PENDING VERIFICATIONS
-- ============================================
SELECT 
    t.id,
    t.tahun,
    t.capaian_persen,
    u.name as created_by,
    t.created_at
FROM transportation t
LEFT JOIN users u ON t.created_by = u.id
WHERE t.status_verifikasi = 'pending'
ORDER BY t.created_at ASC;

-- 6. VIEW REVISION REQUESTS
-- ============================================
SELECT 
    tr.id,
    t.tahun,
    requester.name as requested_by,
    tr.alasan_revisi,
    tr.status,
    reviewer.name as reviewed_by,
    tr.created_at,
    tr.reviewed_at
FROM transportation_revisions tr
LEFT JOIN transportation t ON tr.transportation_id = t.id
LEFT JOIN users requester ON tr.requested_by = requester.id
LEFT JOIN users reviewer ON tr.reviewed_by = reviewer.id
ORDER BY tr.created_at DESC;

-- 7. VIEW PENDING REVISION REQUESTS
-- ============================================
SELECT 
    tr.id,
    t.tahun,
    requester.name as requested_by,
    requester.email,
    tr.alasan_revisi,
    tr.created_at
FROM transportation_revisions tr
LEFT JOIN transportation t ON tr.transportation_id = t.id
LEFT JOIN users requester ON tr.requested_by = requester.id
WHERE tr.status = 'pending'
ORDER BY tr.created_at ASC;

-- 8. STATISTICS - DATA BY STATUS
-- ============================================
SELECT 
    status_verifikasi,
    COUNT(*) as total,
    AVG(capaian_persen) as avg_percentage
FROM transportation
GROUP BY status_verifikasi;

-- 9. STATISTICS - REVISIONS BY STATUS
-- ============================================
SELECT 
    status,
    COUNT(*) as total
FROM transportation_revisions
GROUP BY status;

-- 10. STATISTICS - USER ACTIVITY
-- ============================================
SELECT 
    u.name,
    u.role,
    COUNT(DISTINCT t.id) as data_created,
    COUNT(DISTINCT tv.id) as data_verified,
    COUNT(DISTINCT tr.id) as revisions_requested
FROM users u
LEFT JOIN transportation t ON u.id = t.created_by
LEFT JOIN transportation tv ON u.id = tv.verified_by
LEFT JOIN transportation_revisions tr ON u.id = tr.requested_by
GROUP BY u.id, u.name, u.role
ORDER BY data_created DESC;

-- 11. FIND DATA WITHOUT BUKTI PENDUKUNG
-- ============================================
SELECT 
    id,
    tahun,
    status_verifikasi,
    created_at
FROM transportation
WHERE bukti_pendukung IS NULL OR bukti_pendukung = ''
ORDER BY tahun DESC;

-- 12. FIND APPROVED DATA OLDER THAN 1 YEAR
-- ============================================
SELECT 
    id,
    tahun,
    capaian_persen,
    verified_at
FROM transportation
WHERE status_verifikasi = 'approved'
AND verified_at < DATE_SUB(NOW(), INTERVAL 1 YEAR)
ORDER BY verified_at ASC;

-- 13. CLEANUP - DELETE OLD REJECTED DATA
-- ============================================
-- WARNING: Backup data sebelum menjalankan!
-- DELETE FROM transportation 
-- WHERE status_verifikasi = 'rejected' 
-- AND updated_at < DATE_SUB(NOW(), INTERVAL 6 MONTH);

-- 14. RESET DATA STATUS TO PENDING
-- ============================================
-- Untuk testing atau rollback
-- UPDATE transportation 
-- SET status_verifikasi = 'pending',
--     verified_by = NULL,
--     verified_at = NULL,
--     catatan_verifikasi = NULL
-- WHERE id = [ID];

-- 15. BULK APPROVE DATA (ADMIN ONLY)
-- ============================================
-- WARNING: Gunakan dengan hati-hati!
-- UPDATE transportation 
-- SET status_verifikasi = 'approved',
--     verified_by = [ADMIN_USER_ID],
--     verified_at = NOW(),
--     catatan_verifikasi = 'Bulk approved by admin'
-- WHERE status_verifikasi = 'pending'
-- AND tahun = 2024;

-- 16. VIEW REVISION HISTORY FOR SPECIFIC DATA
-- ============================================
SELECT 
    tr.id,
    tr.revision_type,
    tr.status,
    requester.name as requested_by,
    reviewer.name as reviewed_by,
    tr.alasan_revisi,
    tr.review_notes,
    tr.created_at,
    tr.reviewed_at
FROM transportation_revisions tr
LEFT JOIN users requester ON tr.requested_by = requester.id
LEFT JOIN users reviewer ON tr.reviewed_by = reviewer.id
WHERE tr.transportation_id = [TRANSPORTATION_ID]
ORDER BY tr.created_at DESC;

-- 17. FIND USERS WHO NEVER VERIFIED DATA
-- ============================================
SELECT 
    u.id,
    u.name,
    u.email,
    u.role
FROM users u
WHERE u.role IN ('admin', 'reviewer')
AND u.id NOT IN (
    SELECT DISTINCT verified_by 
    FROM transportation 
    WHERE verified_by IS NOT NULL
)
ORDER BY u.name;

-- 18. AVERAGE VERIFICATION TIME
-- ============================================
SELECT 
    AVG(TIMESTAMPDIFF(HOUR, created_at, verified_at)) as avg_hours,
    MIN(TIMESTAMPDIFF(HOUR, created_at, verified_at)) as min_hours,
    MAX(TIMESTAMPDIFF(HOUR, created_at, verified_at)) as max_hours
FROM transportation
WHERE verified_at IS NOT NULL;

-- 19. MONTHLY DATA SUBMISSION TREND
-- ============================================
SELECT 
    DATE_FORMAT(created_at, '%Y-%m') as month,
    COUNT(*) as total_submissions,
    SUM(CASE WHEN status_verifikasi = 'approved' THEN 1 ELSE 0 END) as approved,
    SUM(CASE WHEN status_verifikasi = 'rejected' THEN 1 ELSE 0 END) as rejected,
    SUM(CASE WHEN status_verifikasi = 'pending' THEN 1 ELSE 0 END) as pending
FROM transportation
GROUP BY DATE_FORMAT(created_at, '%Y-%m')
ORDER BY month DESC;

-- 20. BACKUP TABLES
-- ============================================
-- Backup transportation table
CREATE TABLE transportation_backup_20251113 AS 
SELECT * FROM transportation;

-- Backup revisions table
CREATE TABLE transportation_revisions_backup_20251113 AS 
SELECT * FROM transportation_revisions;

-- ============================================
-- USEFUL QUERIES FOR DEBUGGING
-- ============================================

-- Check table structure
DESCRIBE transportation;
DESCRIBE transportation_revisions;

-- Check indexes
SHOW INDEX FROM transportation;
SHOW INDEX FROM transportation_revisions;

-- Check table size
SELECT 
    table_name,
    ROUND(((data_length + index_length) / 1024 / 1024), 2) AS "Size (MB)"
FROM information_schema.TABLES
WHERE table_schema = DATABASE()
AND table_name IN ('transportation', 'transportation_revisions');

-- Check last 10 activities
SELECT 
    'Transportation' as table_name,
    id,
    tahun as identifier,
    created_at as activity_time,
    'Created' as activity_type
FROM transportation
UNION ALL
SELECT 
    'Transportation' as table_name,
    id,
    tahun as identifier,
    updated_at as activity_time,
    'Updated' as activity_type
FROM transportation
WHERE updated_at != created_at
UNION ALL
SELECT 
    'Revision' as table_name,
    id,
    CONCAT('Rev #', id) as identifier,
    created_at as activity_time,
    'Revision Requested' as activity_type
FROM transportation_revisions
ORDER BY activity_time DESC
LIMIT 10;
