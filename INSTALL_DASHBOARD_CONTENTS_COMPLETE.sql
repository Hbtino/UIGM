-- ============================================
-- COMPLETE INSTALLATION FOR DASHBOARD CONTENTS
-- ============================================
-- File ini menggabungkan CREATE dan UPDATE
-- Aman dijalankan berkali-kali tanpa error
-- ============================================

-- Step 1: Create table if not exists
CREATE TABLE IF NOT EXISTS `dashboard_contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(50) NOT NULL COMMENT 'Section identifier: info_box, stat_card_1, stat_card_2, stat_card_3, stat_card_4, chart_title, chart_description',
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL COMMENT 'For stat cards numeric value',
  `icon` varchar(50) DEFAULT NULL COMMENT 'Font Awesome icon class',
  `color` varchar(20) DEFAULT NULL COMMENT 'Color theme: blue, green, orange, purple',
  `trend_text` varchar(100) DEFAULT NULL COMMENT 'Trend indicator text',
  `trend_type` varchar(20) DEFAULT NULL COMMENT 'Trend type: up, down, target',
  `order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `section` (`section`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Step 2: Insert or update default dashboard contents
INSERT INTO `dashboard_contents` (`section`, `title`, `subtitle`, `content`, `value`, `icon`, `color`, `trend_text`, `trend_type`, `order`, `is_active`) VALUES
('info_box', 'Tentang Renstra TMKB Polban', NULL, 'Rencana Strategis Transformasi Menuju Kampus Berkelanjutan (TMKB) Politeknik Negeri Bandung periode 2024-2028 disusun untuk mendukung pencapaian Sustainable Development Goals (SDGs) yang ditetapkan oleh PBB. Dashboard ini menampilkan capaian 6 kriteria utama kampus berkelanjutan berdasarkan UI GreenMetric World University Ranking.', NULL, 'fa-info-circle', NULL, NULL, NULL, 1, 1),
('stat_card_1', 'Target Skor 2028', NULL, NULL, '80', 'fa-chart-line', 'blue', 'Target: 80%', 'target', 2, 1),
('stat_card_2', 'Target Ranking Dunia', NULL, NULL, '176', 'fa-trophy', 'green', 'dari #896', 'up', 3, 1),
('stat_card_3', 'Target Ranking Indonesia', NULL, NULL, '26', 'fa-flag', 'orange', 'dari #87', 'up', 4, 1),
('stat_card_4', 'Kriteria Keberlanjutan', NULL, NULL, '6', 'fa-leaf', 'purple', '6 Kriteria SDGs', 'target', 5, 1),
('chart_title', 'Capaian Kriteria Kampus Berkelanjutan (2023-2028)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, 1),
('chart_description', NULL, 'Proyeksi pencapaian berdasarkan UI GreenMetric World University Ranking', NULL, NULL, NULL, NULL, NULL, NULL, 7, 1),
('top_bar_title', 'Dashboard Kampus Berkelanjutan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 1),
('top_bar_subtitle', 'Renstra TMKB Polban 2024-2028 | UI GreenMetric', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 1)
ON DUPLICATE KEY UPDATE
    title = VALUES(title),
    subtitle = VALUES(subtitle),
    content = VALUES(content),
    value = VALUES(value),
    icon = VALUES(icon),
    color = VALUES(color),
    trend_text = VALUES(trend_text),
    trend_type = VALUES(trend_type),
    `order` = VALUES(`order`),
    is_active = VALUES(is_active),
    updated_at = CURRENT_TIMESTAMP;

-- Step 3: Verify installation
SELECT 
    section, 
    title, 
    value, 
    icon, 
    color, 
    is_active,
    updated_at
FROM dashboard_contents 
ORDER BY `order` ASC;

-- ============================================
-- INSTALLATION COMPLETE!
-- ============================================
-- Sekarang Anda bisa:
-- 1. Login sebagai admin
-- 2. Buka menu "Konten Dashboard"
-- 3. Edit content sesuai kebutuhan
-- ============================================
