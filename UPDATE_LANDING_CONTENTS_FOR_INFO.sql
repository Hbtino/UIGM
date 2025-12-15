-- Update landing_contents table untuk mendukung informasi yang lebih lengkap
-- Menambah field untuk alamat, telepon, email, dan map

ALTER TABLE landing_contents 
ADD COLUMN address TEXT NULL AFTER content,
ADD COLUMN phone VARCHAR(50) NULL AFTER address,
ADD COLUMN email VARCHAR(100) NULL AFTER phone,
ADD COLUMN map_embed TEXT NULL AFTER email,
ADD COLUMN map_latitude DECIMAL(10, 8) NULL AFTER map_embed,
ADD COLUMN map_longitude DECIMAL(11, 8) NULL AFTER map_latitude;

-- Update existing data untuk section informasi
UPDATE landing_contents 
SET 
    address = 'Jl. Gegerkalong Hilir, Ds. Ciwaruga, Parongpong, Kabupaten Bandung Barat, Jawa Barat 40559',
    phone = '(022) 2013789',
    email = 'info@polban.ac.id',
    map_embed = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0!2d107.6!3d-6.9!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9adf177bf8d%3A0x437398556f9fa03!2sPoliteknik%20Negeri%20Bandung!5e0!3m2!1sid!2sid!4v1234567890!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
    map_latitude = -6.871537,
    map_longitude = 107.574060
WHERE section = 'informasi';

-- Insert data informasi jika belum ada
INSERT IGNORE INTO landing_contents (
    section, title, subtitle, content, address, phone, email, map_embed, map_latitude, map_longitude, `order`, is_active
) VALUES (
    'informasi',
    'Informasi Kontak',
    'Hubungi Kami',
    'Untuk informasi lebih lanjut tentang program GreenMetric dan Kampus Berkelanjutan Polban, silakan hubungi kami melalui kontak di bawah ini.',
    'Jl. Gegerkalong Hilir, Ds. Ciwaruga, Parongpong, Kabupaten Bandung Barat, Jawa Barat 40559',
    '(022) 2013789',
    'info@polban.ac.id',
    '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0!2d107.6!3d-6.9!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9adf177bf8d%3A0x437398556f9fa03!2sPoliteknik%20Negeri%20Bandung!5e0!3m2!1sid!2sid!4v1234567890!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
    -6.871537,
    107.574060,
    5,
    1
);

-- Update menu dari "Kontak" menjadi "Informasi"
UPDATE menus SET title = 'Informasi', url = '#informasi', updated_at = NOW() 
WHERE title IN ('Kontak', 'Contact') OR url IN ('#kontak', '#contact');