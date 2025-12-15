-- Insert data informasi untuk landing page dan dashboard
-- Pastikan tabel sudah diupdate dengan field baru

-- Insert/Update landing_contents untuk section informasi
INSERT INTO landing_contents (
    section, title, subtitle, content, address, phone, email, map_embed, map_latitude, map_longitude, `order`, is_active, created_at, updated_at
) VALUES (
    'informasi',
    'Informasi Kontak',
    'Hubungi Kami',
    'Untuk informasi lebih lanjut tentang program GreenMetric dan Kampus Berkelanjutan Polban, silakan hubungi kami melalui kontak di bawah ini.',
    'Jl. Gegerkalong Hilir, Ds. Ciwaruga, Parongpong, Kabupaten Bandung Barat, Jawa Barat 40559',
    '(022) 2013789',
    'info@polban.ac.id',
    '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0956!2d107.5740603!3d-6.8715374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9adf177bf8d%3A0x437398556f9fa03!2sPoliteknik%20Negeri%20Bandung!5e0!3m2!1sid!2sid!4v1234567890!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
    -6.871537,
    107.574060,
    5,
    1,
    NOW(),
    NOW()
) ON DUPLICATE KEY UPDATE
    title = VALUES(title),
    subtitle = VALUES(subtitle),
    content = VALUES(content),
    address = VALUES(address),
    phone = VALUES(phone),
    email = VALUES(email),
    map_embed = VALUES(map_embed),
    map_latitude = VALUES(map_latitude),
    map_longitude = VALUES(map_longitude),
    updated_at = NOW();

-- Insert/Update dashboard_contents untuk info_box (sinkronisasi dengan landing page)
INSERT INTO dashboard_contents (
    section, title, subtitle, content, icon, color, `order`, is_active, created_at, updated_at
) VALUES (
    'info_box',
    'Tentang Renstra TMKB Polban',
    'Kampus Berkelanjutan 2024-2028',
    'Rencana Strategis Transformasi Menuju Kampus Berkelanjutan (TMKB) Politeknik Negeri Bandung periode 2024-2028 disusun untuk mendukung pencapaian Sustainable Development Goals (SDGs) yang ditetapkan oleh PBB. Dashboard ini menampilkan capaian 6 kriteria utama kampus berkelanjutan berdasarkan UI GreenMetric World University Rankings.',
    'fa-info-circle',
    '#149823ff',
    1,
    1,
    NOW(),
    NOW()
) ON DUPLICATE KEY UPDATE
    title = VALUES(title),
    subtitle = VALUES(subtitle),
    content = VALUES(content),
    icon = VALUES(icon),
    color = VALUES(color),
    updated_at = NOW();

-- Update menu dari "Kontak" menjadi "Informasi" jika ada
UPDATE menus SET 
    name = 'Informasi', 
    url = '#informasi',
    updated_at = NOW()
WHERE name IN ('Kontak', 'Contact') OR url IN ('#kontak', '#contact');