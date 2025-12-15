<?php

/**
 * Statistics Helper
 * Helper functions untuk mengelola statistik dan chart
 */

if (!function_exists('load_statistics')) {
    /**
     * Load statistics by location and section
     */
    function load_statistics($location = 'dashboard', $section = null)
    {
        $landingModel = new \App\Models\LandingStatisticModel();
        $dashboardModel = new \App\Models\DashboardStatisticModel();

        $statistics = [];

        if ($location === 'landing') {
            if ($section) {
                $statistics = $landingModel->getBySection($section);
            } else {
                $statistics = $landingModel->getAllGrouped();
            }
        } elseif ($location === 'dashboard') {
            if ($section) {
                $statistics = $dashboardModel->getByCategory($section);
            } else {
                $statistics = $dashboardModel->getGroupedByCategory();
            }
        }

        return $statistics;
    }
}

if (!function_exists('load_charts')) {
    /**
     * Load charts by location and section
     */
    function load_charts($location = 'dashboard', $section = null)
    {
        $chartModel = new \App\Models\ChartIndicatorModel();

        if ($section) {
            return $chartModel->getBySection($section, $location);
        } else {
            return $chartModel->getByLocation($location);
        }
    }
}

if (!function_exists('render_statistics')) {
    /**
     * Render statistics component
     */
    function render_statistics($statistics, $location = 'dashboard', $section = 'default')
    {
        return view('components/statistics_display', [
            'statistics' => $statistics,
            'location' => $location,
            'section' => $section
        ]);
    }
}

if (!function_exists('render_chart')) {
    /**
     * Render single chart component
     */
    function render_chart($chart)
    {
        return view('components/chart_display', [
            'chart' => $chart
        ]);
    }
}

if (!function_exists('render_charts')) {
    /**
     * Render multiple charts
     */
    function render_charts($charts, $columns = 2)
    {
        if (empty($charts)) {
            return '<div class="alert alert-info"><i class="fas fa-info-circle"></i> Belum ada chart untuk ditampilkan.</div>';
        }

        $html = '<div class="row">';
        $colClass = 'col-lg-' . (12 / $columns) . ' col-md-6 col-sm-12';

        foreach ($charts as $chart) {
            $html .= '<div class="' . $colClass . ' mb-4">';
            $html .= render_chart($chart);
            $html .= '</div>';
        }

        $html .= '</div>';

        return $html;
    }
}

if (!function_exists('sync_statistics_data')) {
    /**
     * Sync statistics data between tables
     */
    function sync_statistics_data()
    {
        $chartModel = new \App\Models\ChartIndicatorModel();

        try {
            $chartModel->syncWithStatistics();
            return ['success' => true, 'message' => 'Data berhasil disinkronkan'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Gagal sinkronisasi: ' . $e->getMessage()];
        }
    }
}

if (!function_exists('get_real_time_statistics')) {
    /**
     * Get real-time calculated statistics
     */
    function get_real_time_statistics()
    {
        $db = \Config\Database::connect();

        $stats = [];

        // Count data per kriteria
        $tables = [
            'setting_infrastructure' => 'Setting & Infrastructure',
            'energy_climate' => 'Energy & Climate',
            'water_management' => 'Water Management',
            'waste_management' => 'Waste Management',
            'transportation' => 'Transportation',
            'education_research' => 'Education & Research'
        ];

        $totalData = 0;
        $approvedData = 0;
        $pendingData = 0;
        $rejectedData = 0;

        foreach ($tables as $table => $label) {
            if ($db->tableExists($table)) {
                $count = $db->table($table)->countAllResults();
                $approved = $db->table($table)->where('status_verifikasi', 'approved')->countAllResults();
                $pending = $db->table($table)->where('status_verifikasi', 'pending')->countAllResults();
                $rejected = $db->table($table)->where('status_verifikasi', 'rejected')->countAllResults();

                $stats['criteria'][$table] = [
                    'label' => $label,
                    'total' => $count,
                    'approved' => $approved,
                    'pending' => $pending,
                    'rejected' => $rejected
                ];

                $totalData += $count;
                $approvedData += $approved;
                $pendingData += $pending;
                $rejectedData += $rejected;
            }
        }

        // Calculate score percentage
        $maxPossibleScore = $totalData * 6; // Assuming 6 criteria
        $scorePercentage = $maxPossibleScore > 0 ? ($approvedData / $maxPossibleScore) * 100 : 0;

        // User statistics
        if ($db->tableExists('users')) {
            $totalUsers = $db->table('users')->countAllResults();
            $approvedUsers = $totalUsers; // Semua user otomatis approved
            $pendingUsers = 0; // Tidak ada pending users

            $stats['users'] = [
                'total' => $totalUsers,
                'approved' => $approvedUsers,
                'pending' => 0 // Sistem approval dihapus
            ];
        }

        $stats['summary'] = [
            'total_data' => $totalData,
            'approved_data' => $approvedData,
            'pending_data' => $pendingData,
            'rejected_data' => $rejectedData,
            'score_percentage' => round($scorePercentage, 2)
        ];

        return $stats;
    }
}

if (!function_exists('format_statistic_value')) {
    /**
     * Format statistic value for display
     */
    function format_statistic_value($value, $type = 'number')
    {
        switch ($type) {
            case 'percentage':
                return number_format($value, 1) . '%';
            case 'currency':
                return 'Rp ' . number_format($value, 0, ',', '.');
            case 'number':
                return number_format($value, 0, ',', '.');
            case 'decimal':
                return number_format($value, 2, ',', '.');
            default:
                return $value;
        }
    }
}

if (!function_exists('get_statistic_icon')) {
    /**
     * Get appropriate icon for statistic type
     */
    function get_statistic_icon($key)
    {
        $icons = [
            'mahasiswa' => 'fa-user-graduate',
            'dosen' => 'fa-chalkboard-teacher',
            'jurusan' => 'fa-building',
            'program_studi' => 'fa-graduation-cap',
            'luas_kampus' => 'fa-map',
            'luas_bangunan' => 'fa-building',
            'jumlah_bangunan' => 'fa-city',
            'laboratorium' => 'fa-flask',
            'target_skor' => 'fa-chart-line',
            'ranking_dunia' => 'fa-trophy',
            'ranking_indonesia' => 'fa-flag',
            'kriteria_sdgs' => 'fa-leaf',
            'total_data' => 'fa-database',
            'approved_data' => 'fa-check-circle',
            'pending_data' => 'fa-clock',
            'rejected_data' => 'fa-times-circle',
            'score_percentage' => 'fa-percentage'
        ];

        return $icons[$key] ?? 'fa-chart-bar';
    }
}

if (!function_exists('get_statistic_color')) {
    /**
     * Get appropriate color for statistic type
     */
    function get_statistic_color($key)
    {
        $colors = [
            'mahasiswa' => '#1e3a8a',
            'dosen' => '#1e3a8a',
            'jurusan' => '#1e3a8a',
            'program_studi' => '#1e3a8a',
            'luas_kampus' => '#1e3a8a',
            'luas_bangunan' => '#1e3a8a',
            'jumlah_bangunan' => '#1e3a8a',
            'laboratorium' => '#1e3a8a',
            'target_skor' => '#6366f1',
            'ranking_dunia' => '#10b981',
            'ranking_indonesia' => '#ec4899',
            'kriteria_sdgs' => '#06b6d4',
            'total_data' => '#6366f1',
            'approved_data' => '#10b981',
            'pending_data' => '#f59e0b',
            'rejected_data' => '#ef4444',
            'score_percentage' => '#8b5cf6'
        ];

        return $colors[$key] ?? '#6c757d';
    }
}
