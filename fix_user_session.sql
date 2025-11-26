-- Check users table
SELECT id, name, email, role FROM users ORDER BY id;

-- Check laporan_dosen with user info
SELECT 
    ld.id,
    ld.user_id,
    ld.user_name,
    u.name as actual_user_name,
    u.role,
    ld.created_at
FROM laporan_dosen ld
LEFT JOIN users u ON ld.user_id = u.id
ORDER BY ld.created_at DESC;

-- Find mismatches
SELECT 
    ld.user_id,
    ld.user_name as laporan_user_name,
    u.name as users_table_name,
    CASE 
        WHEN u.id IS NULL THEN 'USER NOT FOUND'
        WHEN ld.user_name != u.name THEN 'NAME MISMATCH'
        ELSE 'OK'
    END as status
FROM laporan_dosen ld
LEFT JOIN users u ON ld.user_id = u.id;
