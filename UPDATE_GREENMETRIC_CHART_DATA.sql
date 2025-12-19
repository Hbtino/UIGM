-- Update chart data dengan data aktual GreenMetric 2023-2025
-- Script untuk mengupdate data chart "Capaian Kriteria Kampus Berkelanjutan"

UPDATE charts_indicators 
SET chart_data = '{
    "labels": ["2023", "2024", "2025", "2026", "2027", "2028"],
    "datasets": [
        {
            "label": "Setting & Infrastructure (SI)",
            "data": [1085, 900, 1090, 1200, 1300, 1400],
            "backgroundColor": "rgba(54, 162, 235, 0.8)",
            "borderColor": "rgba(54, 162, 235, 1)",
            "borderWidth": 2,
            "borderRadius": 6
        },
        {
            "label": "Energy & Climate Change (EC)",
            "data": [1050, 1300, 1260, 1350, 1400, 1450],
            "backgroundColor": "rgba(255, 206, 86, 0.8)",
            "borderColor": "rgba(255, 206, 86, 1)",
            "borderWidth": 2,
            "borderRadius": 6
        },
        {
            "label": "Waste (WS)",
            "data": [675, 600, 725, 800, 850, 900],
            "backgroundColor": "rgba(75, 192, 192, 0.8)",
            "borderColor": "rgba(75, 192, 192, 1)",
            "borderWidth": 2,
            "borderRadius": 6
        },
        {
            "label": "Water (WR)",
            "data": [300, 300, 288, 350, 400, 450],
            "backgroundColor": "rgba(153, 102, 255, 0.8)",
            "borderColor": "rgba(153, 102, 255, 1)",
            "borderWidth": 2,
            "borderRadius": 6
        },
        {
            "label": "Transportation (TR)",
            "data": [485, 535, 875, 900, 950, 1000],
            "backgroundColor": "rgba(255, 99, 132, 0.8)",
            "borderColor": "rgba(255, 99, 132, 1)",
            "borderWidth": 2,
            "borderRadius": 6
        },
        {
            "label": "Education & Research (ED)",
            "data": [950, 925, 1363, 1400, 1450, 1500],
            "backgroundColor": "rgba(255, 159, 64, 0.8)",
            "borderColor": "rgba(255, 159, 64, 1)",
            "borderWidth": 2,
            "borderRadius": 6
        }
    ],
    "totalScore": [4345, 4560, 5410, 5800, 6200, 6500],
    "worldRank": [null, 1032, 942, 800, 700, 600],
    "indonesiaRank": [87, null, null, 60, 50, 40]
}',
updated_at = NOW()
WHERE title = 'Capaian Kriteria Kampus Berkelanjutan' 
AND display_location = 'landing';

-- Jika chart belum ada, insert data baru
INSERT INTO charts_indicators (
    chart_type, 
    title, 
    description, 
    data_source, 
    chart_data, 
    chart_config, 
    display_location, 
    section, 
    order_position, 
    is_active, 
    sync_with_statistics,
    created_at,
    updated_at
) 
SELECT 
    'bar',
    'Capaian Kriteria Kampus Berkelanjutan',
    'Grafik peningkatan skor keseluruhan kampus berkelanjutan berdasarkan data GreenMetric aktual',
    'greenmetric',
    '{
        "labels": ["2023", "2024", "2025", "2026", "2027", "2028"],
        "datasets": [
            {
                "label": "Setting & Infrastructure (SI)",
                "data": [1085, 900, 1090, 1200, 1300, 1400],
                "backgroundColor": "rgba(54, 162, 235, 0.8)",
                "borderColor": "rgba(54, 162, 235, 1)",
                "borderWidth": 2,
                "borderRadius": 6
            },
            {
                "label": "Energy & Climate Change (EC)",
                "data": [1050, 1300, 1260, 1350, 1400, 1450],
                "backgroundColor": "rgba(255, 206, 86, 0.8)",
                "borderColor": "rgba(255, 206, 86, 1)",
                "borderWidth": 2,
                "borderRadius": 6
            },
            {
                "label": "Waste (WS)",
                "data": [675, 600, 725, 800, 850, 900],
                "backgroundColor": "rgba(75, 192, 192, 0.8)",
                "borderColor": "rgba(75, 192, 192, 1)",
                "borderWidth": 2,
                "borderRadius": 6
            },
            {
                "label": "Water (WR)",
                "data": [300, 300, 288, 350, 400, 450],
                "backgroundColor": "rgba(153, 102, 255, 0.8)",
                "borderColor": "rgba(153, 102, 255, 1)",
                "borderWidth": 2,
                "borderRadius": 6
            },
            {
                "label": "Transportation (TR)",
                "data": [485, 535, 875, 900, 950, 1000],
                "backgroundColor": "rgba(255, 99, 132, 0.8)",
                "borderColor": "rgba(255, 99, 132, 1)",
                "borderWidth": 2,
                "borderRadius": 6
            },
            {
                "label": "Education & Research (ED)",
                "data": [950, 925, 1363, 1400, 1450, 1500],
                "backgroundColor": "rgba(255, 159, 64, 0.8)",
                "borderColor": "rgba(255, 159, 64, 1)",
                "borderWidth": 2,
                "borderRadius": 6
            }
        ],
        "totalScore": [4345, 4560, 5410, 5800, 6200, 6500],
        "worldRank": [null, 1032, 942, 800, 700, 600],
        "indonesiaRank": [87, null, null, 60, 50, 40]
    }',
    '{}',
    'landing',
    'charts',
    1,
    1,
    0,
    NOW(),
    NOW()
WHERE NOT EXISTS (
    SELECT 1 FROM charts_indicators 
    WHERE title = 'Capaian Kriteria Kampus Berkelanjutan' 
    AND display_location = 'landing'
);