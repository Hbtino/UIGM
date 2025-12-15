-- Fix role mahasiswa menjadi user
-- Karena role mahasiswa sudah tidak digunakan lagi dalam sistem

UPDATE users 
SET role = 'user' 
WHERE role = 'mahasiswa';

-- Cek hasil update (tanpa kolom status yang tidak ada)
SELECT id, name, email, role 
FROM users 
WHERE role IN ('user', 'mahasiswa')
ORDER BY role, name;