<?php

namespace App\Libraries;

class CriteriaDataService
{
    private $criteriaMapping = [
        'si' => [
            'name' => 'Setting & Infrastructure',
            'code' => 'SI',
            'description' => 'Kriteria ini mengevaluasi infrastruktur kampus yang mendukung keberlanjutan, termasuk bangunan hijau, sistem energi, dan fasilitas ramah lingkungan.',
            'icon' => 'fas fa-building',
            'color' => '#667eea',
            'weight' => '15%'
        ],
        'ec' => [
            'name' => 'Energy & Climate Change',
            'code' => 'EC',
            'description' => 'Kriteria ini menilai upaya kampus dalam pengelolaan energi terbarukan, efisiensi energi, dan mitigasi perubahan iklim.',
            'icon' => 'fas fa-bolt',
            'color' => '#f093fb',
            'weight' => '21%'
        ],
        'ws' => [
            'name' => 'Waste Management',
            'code' => 'WS',
            'description' => 'Kriteria ini mengevaluasi sistem pengelolaan limbah kampus, termasuk pengurangan, daur ulang, dan pengolahan limbah.',
            'icon' => 'fas fa-recycle',
            'color' => '#4facfe',
            'weight' => '18%'
        ],
        'wr' => [
            'name' => 'Water Management',
            'code' => 'WR',
            'description' => 'Kriteria ini menilai sistem pengelolaan air kampus, termasuk konservasi air, kualitas air, dan penggunaan air berkelanjutan.',
            'icon' => 'fas fa-tint',
            'color' => '#00f2fe',
            'weight' => '10%'
        ],
        'tr' => [
            'name' => 'Transportation',
            'code' => 'TR',
            'description' => 'Kriteria ini mengevaluasi sistem transportasi kampus yang ramah lingkungan dan kebijakan mobilitas berkelanjutan.',
            'icon' => 'fas fa-bus',
            'color' => '#fa709a',
            'weight' => '18%'
        ],
        'ed' => [
            'name' => 'Education & Research',
            'code' => 'ED',
            'description' => 'Kriteria ini menilai program pendidikan dan penelitian yang mendukung keberlanjutan lingkungan dan pembangunan berkelanjutan.',
            'icon' => 'fas fa-graduation-cap',
            'color' => '#ffecd2',
            'weight' => '18%'
        ]
    ];

    public function getCriteriaStatistics($criteriaType)
    {
        // Get statistics from dashboard chart data
        $dashboardData = $this->getDashboardChartData();
        
        if (!$dashboardData || !isset($dashboardData['datasets'])) {
            return $this->getFallbackStatistics($criteriaType);
        }

        // Map criteria type to dataset index
        $datasetMapping = [
            'si' => 0, // Setting & Infrastructure
            'ec' => 1, // Energy & Climate Change
            'ws' => 2, // Waste
            'wr' => 3, // Water
            'tr' => 4, // Transportation
            'ed' => 5  // Education & Research
        ];

        $datasetIndex = $datasetMapping[$criteriaType] ?? null;
        
        if ($datasetIndex === null || !isset($dashboardData['datasets'][$datasetIndex])) {
            return $this->getFallbackStatistics($criteriaType);
        }

        $dataset = $dashboardData['datasets'][$datasetIndex];
        $data = $dataset['data'] ?? [];
        
        // Get current year data (2024 - index 1) and target (2028 - index 5)
        $currentScore = $data[1] ?? 0; // 2024 data
        $targetScore = $data[5] ?? 0;  // 2028 target
        
        // Calculate progress percentage
        $progressPercentage = $targetScore > 0 ? round(($currentScore / $targetScore) * 100) : 0;
        
        // Determine status
        $status = $progressPercentage >= 70 ? 'On Track' : 'Needs Improvement';

        return [
            'current_score' => $currentScore,
            'target_2028' => $targetScore,
            'progress_percentage' => $progressPercentage,
            'status' => $status
        ];
    }

    public function getCriteriaTargets($criteriaType)
    {
        $statistics = $this->getCriteriaStatistics($criteriaType);
        
        return [
            'current' => $statistics['current_score'],
            'target' => $statistics['target_2028'],
            'progress' => $statistics['progress_percentage']
        ];
    }

    public function getCriteriaProgress($criteriaType)
    {
        $statistics = $this->getCriteriaStatistics($criteriaType);
        
        return [
            'percentage' => $statistics['progress_percentage'],
            'status' => $statistics['status']
        ];
    }

    public function mapDashboardData($criteriaType)
    {
        $baseData = $this->criteriaMapping[$criteriaType] ?? null;
        
        if (!$baseData) {
            return null;
        }

        $statistics = $this->getCriteriaStatistics($criteriaType);
        
        return array_merge($baseData, [
            'title' => $baseData['name'],
            'current_score' => $statistics['current_score'],
            'target_2028' => $statistics['target_2028'],
            'progress_percentage' => $statistics['progress_percentage'],
            'status' => $statistics['status']
        ]);
    }

    private function getDashboardChartData()
    {
        try {
            // Try to get chart data from database first
            if (class_exists('\App\Models\ChartIndicatorModel')) {
                $chartModel = new \App\Models\ChartIndicatorModel();

                // Get chart for "Capaian Kriteria Kampus Berkelanjutan"
                $sustainabilityChart = $chartModel->where('title', 'Capaian Kriteria Kampus Berkelanjutan')
                    ->where('display_location', 'landing')
                    ->where('is_active', 1)
                    ->first();

                if ($sustainabilityChart && !empty($sustainabilityChart['chart_data'])) {
                    return json_decode($sustainabilityChart['chart_data'], true);
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Error loading chart data from database: ' . $e->getMessage());
        }

        // Fallback to hardcoded data that matches dashboard
        return [
            'labels' => ['2023', '2024', '2025', '2026', '2027', '2028'],
            'datasets' => [
                [
                    'label' => 'Setting & Infrastructure (SI)',
                    'data' => [57, 68, 80, 88, 88, 90]
                ],
                [
                    'label' => 'Energy & Climate Change (EC)',
                    'data' => [50, 63, 69, 74, 82, 82]
                ],
                [
                    'label' => 'Waste (WS)',
                    'data' => [38, 50, 58, 71, 83, 88]
                ],
                [
                    'label' => 'Water (WR)',
                    'data' => [30, 45, 45, 55, 80, 95]
                ],
                [
                    'label' => 'Transportation (TR)',
                    'data' => [27, 30, 33, 37, 37, 39]
                ],
                [
                    'label' => 'Education & Research (ED)',
                    'data' => [53, 68, 81, 88, 90, 92]
                ]
            ]
        ];
    }

    private function getFallbackStatistics($criteriaType)
    {
        // Fallback data that matches the dashboard
        $fallbackData = [
            'si' => ['current_score' => 68, 'target_2028' => 90, 'progress_percentage' => 75, 'status' => 'On Track'],
            'ec' => ['current_score' => 63, 'target_2028' => 82, 'progress_percentage' => 77, 'status' => 'On Track'],
            'ws' => ['current_score' => 50, 'target_2028' => 88, 'progress_percentage' => 57, 'status' => 'Needs Improvement'],
            'wr' => ['current_score' => 45, 'target_2028' => 95, 'progress_percentage' => 47, 'status' => 'Needs Improvement'],
            'tr' => ['current_score' => 30, 'target_2028' => 39, 'progress_percentage' => 77, 'status' => 'On Track'],
            'ed' => ['current_score' => 68, 'target_2028' => 92, 'progress_percentage' => 74, 'status' => 'On Track']
        ];

        return $fallbackData[$criteriaType] ?? [
            'current_score' => 0,
            'target_2028' => 0,
            'progress_percentage' => 0,
            'status' => 'No Data'
        ];
    }
}