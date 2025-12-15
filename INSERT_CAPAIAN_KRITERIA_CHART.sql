-- Insert chart data untuk "Capaian Kriteria Kampus Berkelanjutan" di landing page
-- Chart ini akan bisa di-edit melalui admin panel

INSERT INTO `charts_indicators` (
    `chart_type`, 
    `title`, 
    `description`, 
    `data_source`, 
    `chart_data`, 
    `chart_config`, 
    `display_location`, 
    `section`, 
    `order_position`, 
    `is_active`, 
    `sync_with_statistics`
) VALUES (
    'bar',
    'Capaian Kriteria Kampus Berkelanjutan',
    'Grafik capaian 6 kriteria kampus berkelanjutan dari 2023-2028 berdasarkan UI GreenMetric',
    'manual',
    '{
        "labels": ["2023", "2024", "2025", "2026", "2027", "2028"],
        "datasets": [
            {
                "label": "Setting & Infrastructure (SI)",
                "data": [57, 68, 80, 88, 88, 90],
                "backgroundColor": "rgba(54, 162, 235, 0.8)",
                "borderColor": "rgba(54, 162, 235, 1)",
                "borderWidth": 2,
                "borderRadius": 6
            },
            {
                "label": "Energy & Climate Change (EC)",
                "data": [50, 63, 69, 74, 82, 82],
                "backgroundColor": "rgba(255, 206, 86, 0.8)",
                "borderColor": "rgba(255, 206, 86, 1)",
                "borderWidth": 2,
                "borderRadius": 6
            },
            {
                "label": "Waste (WS)",
                "data": [38, 50, 58, 71, 83, 88],
                "backgroundColor": "rgba(75, 192, 192, 0.8)",
                "borderColor": "rgba(75, 192, 192, 1)",
                "borderWidth": 2,
                "borderRadius": 6
            },
            {
                "label": "Water (WR)",
                "data": [30, 45, 45, 55, 80, 95],
                "backgroundColor": "rgba(153, 102, 255, 0.8)",
                "borderColor": "rgba(153, 102, 255, 1)",
                "borderWidth": 2,
                "borderRadius": 6
            },
            {
                "label": "Transportation (TR)",
                "data": [27, 30, 33, 37, 37, 39],
                "backgroundColor": "rgba(255, 99, 132, 0.8)",
                "borderColor": "rgba(255, 99, 132, 1)",
                "borderWidth": 2,
                "borderRadius": 6
            },
            {
                "label": "Education & Research (ED)",
                "data": [53, 68, 81, 88, 90, 92],
                "backgroundColor": "rgba(255, 159, 64, 0.8)",
                "borderColor": "rgba(255, 159, 64, 1)",
                "borderWidth": 2,
                "borderRadius": 6
            }
        ],
        "totalScore": [43, 55, 62, 69, 76, 80],
        "worldRank": [896, 705, 561, 374, 228, 176],
        "indonesiaRank": [87, 70, 53, 39, 29, 26]
    }',
    '{
        "responsive": true,
        "maintainAspectRatio": false,
        "plugins": {
            "legend": {
                "display": true,
                "position": "bottom",
                "labels": {
                    "padding": 15,
                    "font": {
                        "size": 11
                    },
                    "usePointStyle": true,
                    "pointStyle": "rect",
                    "boxWidth": 12,
                    "boxHeight": 12
                }
            },
            "title": {
                "display": false
            },
            "tooltip": {
                "backgroundColor": "rgba(0, 0, 0, 0.8)",
                "padding": 12,
                "titleFont": {
                    "size": 13,
                    "weight": "bold"
                },
                "bodyFont": {
                    "size": 12
                }
            }
        },
        "scales": {
            "x": {
                "grid": {
                    "display": false
                },
                "ticks": {
                    "font": {
                        "size": 11,
                        "weight": "600"
                    },
                    "color": "#64748b"
                }
            },
            "y": {
                "beginAtZero": true,
                "max": 100,
                "grid": {
                    "color": "rgba(0, 0, 0, 0.05)"
                },
                "ticks": {
                    "font": {
                        "size": 11
                    },
                    "color": "#64748b",
                    "callback": "function(value) { return value + \"%\"; }"
                }
            }
        }
    }',
    'landing',
    'statistics_section',
    1,
    1,
    0
);

-- Cek apakah data berhasil diinsert
SELECT 
    id,
    title,
    chart_type,
    display_location,
    is_active
FROM charts_indicators 
WHERE title = 'Capaian Kriteria Kampus Berkelanjutan';