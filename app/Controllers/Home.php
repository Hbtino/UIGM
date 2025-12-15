<?php

namespace App\Controllers;

use App\Models\NewsModel;
use App\Models\LandingContentModel;

class Home extends BaseController
{
    public function index()
    {
        // Check if this is a preview request - don't auto-login for preview
        $isPreview = $this->request->getGet('preview') || $this->request->getGet('no_auto_login');

        // Check if user is already logged in (via session or remember me cookie)
        if (session()->get('logged_in') && !$isPreview) {
            // Redirect to dashboard based on role
            $role = session()->get('role');

            if ($role == 'admin') {
                return redirect()->to('/dashboard');
            } elseif ($role == 'dosen') {
                return redirect()->to('/dashboard');
            } elseif ($role == 'kaprodi') {
                return redirect()->to('/dashboard');
            } else {
                return redirect()->to('/dashboard');
            }
        }

        $newsModel = new NewsModel();
        $landingContentModel = new LandingContentModel();
        $landingStatModel = new \App\Models\LandingStatisticModel();

        // Load new statistics and charts system
        helper('statistics');

        // Get 3 latest published news
        $news = $newsModel
            ->where('is_published', 1)
            ->orderBy('published_at', 'DESC')
            ->limit(3)
            ->findAll();

        // Get landing page contents
        $contents = $landingContentModel
            ->where('is_active', 1)
            ->orderBy('order', 'ASC')
            ->findAll();

        // Convert to associative array by section
        $contentsBySection = [];
        foreach ($contents as $content) {
            $contentsBySection[$content['section']] = $content;
        }

        // Get landing page statistics grouped by section (with caching and error handling)
        $landingStats = [];
        $landingCharts = [];

        try {
            // Try to get from cache first
            $landingStats = cache()->get('landing_statistics');

            if (!$landingStats) {
                // If not in cache, get from database and cache it
                $landingStats = $landingStatModel->getAllGrouped();

                // Cache for 1 hour (will be cleared when data is updated)
                cache()->save('landing_statistics', $landingStats, 3600);
            }

            // Transform ranking data to match view expectations
            if (isset($landingStats['ranking_dunia'])) {
                $rankingDunia = [];
                foreach ($landingStats['ranking_dunia'] as $stat) {
                    if (!str_contains($stat['key_name'], '_progress')) {
                        $rankingDunia[] = [
                            'year' => $stat['label'],
                            'rank_value' => $stat['value']
                        ];
                    }
                }
                $landingStats['ranking_dunia'] = $rankingDunia;
            }

            if (isset($landingStats['ranking_indonesia'])) {
                $rankingIndonesia = [];
                foreach ($landingStats['ranking_indonesia'] as $stat) {
                    if (!str_contains($stat['key_name'], '_progress')) {
                        $rankingIndonesia[] = [
                            'year' => $stat['label'],
                            'rank_value' => $stat['value']
                        ];
                    }
                }
                $landingStats['ranking_indonesia'] = $rankingIndonesia;
            }

            // Get landing page charts
            if (class_exists('\App\Models\ChartIndicatorModel')) {
                $chartModel = new \App\Models\ChartIndicatorModel();
                $landingCharts = $chartModel->getByLocation('landing');

                // Sync chart data with latest statistics
                $chartModel->syncWithStatistics();
            }
        } catch (\Exception $e) {
            // Log error but continue with empty data
            log_message('error', 'Landing statistics error: ' . $e->getMessage());
        }

        // Get dashboard chart data untuk ditampilkan di landing page
        $dashboardChartData = $this->getDashboardChartData();

        $data = [
            'news' => $news,
            'contents' => $contentsBySection,
            'landingStats' => $landingStats,
            'landingCharts' => $landingCharts,
            'chartData' => $dashboardChartData // Chart data dari dashboard
        ];

        return view('home', $data);
    }

    private function getDashboardChartData()
    {
        // Try to get chart data from database first
        try {
            if (class_exists('\App\Models\ChartIndicatorModel')) {
                $chartModel = new \App\Models\ChartIndicatorModel();

                // Get chart for "Capaian Kriteria Kampus Berkelanjutan"
                $sustainabilityChart = $chartModel->where('title', 'Capaian Kriteria Kampus Berkelanjutan')
                    ->where('display_location', 'landing')
                    ->where('is_active', 1)
                    ->first();

                if ($sustainabilityChart && !empty($sustainabilityChart['chart_data'])) {
                    $chartData = json_decode($sustainabilityChart['chart_data'], true);

                    // Add additional data for line charts if not present
                    if (!isset($chartData['totalScore'])) {
                        $chartData['totalScore'] = [43, 55, 62, 69, 76, 80];
                    }
                    if (!isset($chartData['worldRank'])) {
                        $chartData['worldRank'] = [896, 705, 561, 374, 228, 176];
                    }
                    if (!isset($chartData['indonesiaRank'])) {
                        $chartData['indonesiaRank'] = [87, 70, 53, 39, 29, 26];
                    }

                    return $chartData;
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Error loading chart data from database: ' . $e->getMessage());
        }

        // Fallback to hardcoded data if database fails
        return [
            'labels' => ['2023', '2024', '2025', '2026', '2027', '2028'],
            'datasets' => [
                [
                    'label' => 'Setting & Infrastructure (SI)',
                    'data' => [57, 68, 80, 88, 88, 90],
                    'backgroundColor' => 'rgba(54, 162, 235, 0.8)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 2,
                    'borderRadius' => 6
                ],
                [
                    'label' => 'Energy & Climate Change (EC)',
                    'data' => [50, 63, 69, 74, 82, 82],
                    'backgroundColor' => 'rgba(255, 206, 86, 0.8)',
                    'borderColor' => 'rgba(255, 206, 86, 1)',
                    'borderWidth' => 2,
                    'borderRadius' => 6
                ],
                [
                    'label' => 'Waste (WS)',
                    'data' => [38, 50, 58, 71, 83, 88],
                    'backgroundColor' => 'rgba(75, 192, 192, 0.8)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 2,
                    'borderRadius' => 6
                ],
                [
                    'label' => 'Water (WR)',
                    'data' => [30, 45, 45, 55, 80, 95],
                    'backgroundColor' => 'rgba(153, 102, 255, 0.8)',
                    'borderColor' => 'rgba(153, 102, 255, 1)',
                    'borderWidth' => 2,
                    'borderRadius' => 6
                ],
                [
                    'label' => 'Transportation (TR)',
                    'data' => [27, 30, 33, 37, 37, 39],
                    'backgroundColor' => 'rgba(255, 99, 132, 0.8)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 2,
                    'borderRadius' => 6
                ],
                [
                    'label' => 'Education & Research (ED)',
                    'data' => [53, 68, 81, 88, 90, 92],
                    'backgroundColor' => 'rgba(255, 159, 64, 0.8)',
                    'borderColor' => 'rgba(255, 159, 64, 1)',
                    'borderWidth' => 2,
                    'borderRadius' => 6
                ]
            ],
            'totalScore' => [43, 55, 62, 69, 76, 80],
            'worldRank' => [896, 705, 561, 374, 228, 176],
            'indonesiaRank' => [87, 70, 53, 39, 29, 26]
        ];
    }
}
