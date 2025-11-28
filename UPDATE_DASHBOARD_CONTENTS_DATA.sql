-- Update existing dashboard contents data
-- Gunakan ini jika tabel sudah ada dan hanya ingin update data

-- Update Info Box
UPDATE `dashboard_contents` 
SET 
    title = 'Tentang Renstra TMKB Polban',
    content = 'Rencana Strategis Transformasi Menuju Kampus Berkelanjutan (TMKB) Politeknik Negeri Bandung periode 2024-2028 disusun untuk mendukung pencapaian Sustainable Development Goals (SDGs) yang ditetapkan oleh PBB. Dashboard ini menampilkan capaian 6 kriteria utama kampus berkelanjutan berdasarkan UI GreenMetric World University Ranking.',
    icon = 'fa-info-circle',
    `order` = 1,
    is_active = 1,
    updated_at = CURRENT_TIMESTAMP
WHERE section = 'info_box';

-- Update Stat Card 1
UPDATE `dashboard_contents` 
SET 
    title = 'Target Skor 2028',
    value = '80',
    icon = 'fa-chart-line',
    color = 'blue',
    trend_text = 'Target: 80%',
    trend_type = 'target',
    `order` = 2,
    is_active = 1,
    updated_at = CURRENT_TIMESTAMP
WHERE section = 'stat_card_1';

-- Update Stat Card 2
UPDATE `dashboard_contents` 
SET 
    title = 'Target Ranking Dunia',
    value = '176',
    icon = 'fa-trophy',
    color = 'green',
    trend_text = 'dari #896',
    trend_type = 'up',
    `order` = 3,
    is_active = 1,
    updated_at = CURRENT_TIMESTAMP
WHERE section = 'stat_card_2';

-- Update Stat Card 3
UPDATE `dashboard_contents` 
SET 
    title = 'Target Ranking Indonesia',
    value = '26',
    icon = 'fa-flag',
    color = 'orange',
    trend_text = 'dari #87',
    trend_type = 'up',
    `order` = 4,
    is_active = 1,
    updated_at = CURRENT_TIMESTAMP
WHERE section = 'stat_card_3';

-- Update Stat Card 4
UPDATE `dashboard_contents` 
SET 
    title = 'Kriteria Keberlanjutan',
    value = '6',
    icon = 'fa-leaf',
    color = 'purple',
    trend_text = '6 Kriteria SDGs',
    trend_type = 'target',
    `order` = 5,
    is_active = 1,
    updated_at = CURRENT_TIMESTAMP
WHERE section = 'stat_card_4';

-- Update Chart Title
UPDATE `dashboard_contents` 
SET 
    title = 'Capaian Kriteria Kampus Berkelanjutan (2023-2028)',
    `order` = 6,
    is_active = 1,
    updated_at = CURRENT_TIMESTAMP
WHERE section = 'chart_title';

-- Update Chart Description
UPDATE `dashboard_contents` 
SET 
    subtitle = 'Proyeksi pencapaian berdasarkan UI GreenMetric World University Ranking',
    `order` = 7,
    is_active = 1,
    updated_at = CURRENT_TIMESTAMP
WHERE section = 'chart_description';

-- Update Top Bar Title
UPDATE `dashboard_contents` 
SET 
    title = 'Dashboard Kampus Berkelanjutan',
    `order` = 8,
    is_active = 1,
    updated_at = CURRENT_TIMESTAMP
WHERE section = 'top_bar_title';

-- Update Top Bar Subtitle
UPDATE `dashboard_contents` 
SET 
    subtitle = 'Renstra TMKB Polban 2024-2028 | UI GreenMetric',
    `order` = 9,
    is_active = 1,
    updated_at = CURRENT_TIMESTAMP
WHERE section = 'top_bar_subtitle';

-- Verify updates
SELECT section, title, value, icon, color, is_active 
FROM dashboard_contents 
ORDER BY `order` ASC;
