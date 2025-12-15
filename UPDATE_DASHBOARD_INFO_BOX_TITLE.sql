-- =====================================================
-- UPDATE JUDUL INFO BOX DASHBOARD
-- =====================================================
-- Mengubah judul dari "Tentang Renstra TMKB Polban" 
-- menjadi "Tentang Dashboard Kampus Berkelanjutan"
-- =====================================================

-- Update judul info box di dashboard
UPDATE dashboard_contents 
SET 
    title = 'Tentang Dashboard Kampus Berkelanjutan',
    subtitle = 'UI GreenMetric Polban 2024-2028',
    content = 'Dashboard ini menampilkan capaian 6 kriteria utama kampus berkelanjutan berdasarkan UI GreenMetric World University Rankings. Rencana Strategis Transformasi Menuju Kampus Berkelanjutan (TMKB) Politeknik Negeri Bandung periode 2024-2028 disusun untuk mendukung pencapaian Sustainable Development Goals (SDGs) yang ditetapkan oleh PBB.',
    updated_at = NOW()
WHERE section = 'info_box';

-- Verifikasi perubahan
SELECT 'INFO BOX DASHBOARD - UPDATED' as 'STATUS';
SELECT section, title, subtitle, LEFT(content, 100) as content_preview 
FROM dashboard_contents 
WHERE section = 'info_box';

-- =====================================================
-- UPDATE SELESAI
-- =====================================================
-- Judul info box sudah diubah dari "Renstra TMKB" 
-- menjadi "Dashboard Kampus Berkelanjutan"
-- =====================================================