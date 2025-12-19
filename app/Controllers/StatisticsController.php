<?php

namespace App\Controllers;

use App\Models\LandingStatisticModel;
use App\Models\DashboardStatisticModel;
use App\Models\ChartIndicatorModel;

class StatisticsController extends BaseController
{
    protected $landingModel;
    protected $dashboardModel;
    protected $chartModel;
    protected $session;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->landingModel = new LandingStatisticModel();
        $this->dashboardModel = new DashboardStatisticModel();
        $this->chartModel = new ChartIndicatorModel();
        $this->session = \Config\Services::session();
    }

    /**
     * Check authentication for admin access
     */
    private function checkAuth()
    {
        $isLoggedIn = $this->session->get('isLoggedIn') || $this->session->get('logged_in');
        $userRole = $this->session->get('role');

        if (!$isLoggedIn || $userRole !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        return true;
    }

    /**
     * Admin panel untuk manage semua statistik
     */
    public function index()
    {
        // Cek akses admin (cek kedua kemungkinan session key)
        $isLoggedIn = $this->session->get('isLoggedIn') || $this->session->get('logged_in');
        $userRole = $this->session->get('role');

        if (!$isLoggedIn || $userRole !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        // Muat data dengan penanganan error
        $landingStats = [];
        $dashboardStats = [];
        $charts = [];

        try {
            $landingStats = $this->landingModel->getAllGrouped();
        } catch (\Exception $e) {
            log_message('error', 'Landing stats error: ' . $e->getMessage());
        }

        try {
            $dashboardStats = $this->dashboardModel->getGroupedByCategory();
        } catch (\Exception $e) {
            log_message('error', 'Dashboard stats error: ' . $e->getMessage());
        }

        try {
            $charts = $this->chartModel->getAllGrouped();
        } catch (\Exception $e) {
            log_message('error', 'Charts error: ' . $e->getMessage());
        }

        $data = array_merge([
            'title' => 'Manajemen Statistik & Chart',
            'landingStats' => $landingStats,
            'dashboardStats' => $dashboardStats,
            'charts' => $charts,
            'session' => $this->session
        ], $this->getUserData('statistics'));

        return view('admin/statistics/simple', $data);
    }

    /**
     * CRUD Landing Statistics
     */
    public function landingStats()
    {
        // Cek akses admin (cek kedua kemungkinan session key)
        $isLoggedIn = $this->session->get('isLoggedIn') || $this->session->get('logged_in');
        $userRole = $this->session->get('role');

        if (!$isLoggedIn || $userRole !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        // Ambil data chart untuk landing page dari database
        $chartData = $this->getChartDataFromDatabase();

        $data = array_merge([
            'title' => 'Landing Page Statistics',
            'stats' => $this->landingModel->getAllGrouped(),
            'chartData' => $chartData,
            'session' => $this->session
        ], $this->getUserData('landing-statistics'));

        return view('admin/statistics/landing', $data);
    }

    /**
     * Fixed version of landing stats page
     */
    public function landingStatsFixed()
    {
        // Cek akses admin
        $isLoggedIn = $this->session->get('isLoggedIn') || $this->session->get('logged_in');
        $userRole = $this->session->get('role');

        if (!$isLoggedIn || $userRole !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        $data = array_merge([
            'title' => 'Landing Page Statistics (Fixed)',
            'session' => $this->session
        ], $this->getUserData('landing-statistics-fixed'));

        return view('admin/statistics/landing_fixed', $data);
    }

    /**
     * Get chart data from database for admin panel editing
     */
    private function getChartDataFromDatabase()
    {
        try {
            // Get chart for "Capaian Kriteria Kampus Berkelanjutan"
            $sustainabilityChart = $this->chartModel->where('title', 'Capaian Kriteria Kampus Berkelanjutan')
                ->where('display_location', 'landing')
                ->where('is_active', 1)
                ->first();

            if ($sustainabilityChart && !empty($sustainabilityChart['chart_data'])) {
                return json_decode($sustainabilityChart['chart_data'], true);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error loading chart data from database: ' . $e->getMessage());
        }

        // Fallback to default data
        return $this->getDefaultChartData();
    }

    /**
     * Get default chart data (fallback) - Updated with actual GreenMetric data
     */
    private function getDefaultChartData()
    {
        return [
            'labels' => ['2023', '2024', '2025', '2026', '2027', '2028'],
            'datasets' => [
                [
                    'label' => 'Setting & Infrastructure (SI)',
                    'data' => [1085, 900, 1090, 1200, 1300, 1400], // Actual: 2023=1085, 2024=900, 2025=1090
                    'backgroundColor' => 'rgba(54, 162, 235, 0.8)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 2,
                    'borderRadius' => 6
                ],
                [
                    'label' => 'Energy & Climate Change (EC)',
                    'data' => [1050, 1300, 1260, 1350, 1400, 1450], // Actual: 2023=1050, 2024=1300, 2025=1260
                    'backgroundColor' => 'rgba(255, 206, 86, 0.8)',
                    'borderColor' => 'rgba(255, 206, 86, 1)',
                    'borderWidth' => 2,
                    'borderRadius' => 6
                ],
                [
                    'label' => 'Waste (WS)',
                    'data' => [675, 600, 725, 800, 850, 900], // Actual: 2023=675, 2024=600, 2025=725
                    'backgroundColor' => 'rgba(75, 192, 192, 0.8)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 2,
                    'borderRadius' => 6
                ],
                [
                    'label' => 'Water (WR)',
                    'data' => [300, 300, 288, 350, 400, 450], // Actual: 2023=300, 2024=300, 2025=288
                    'backgroundColor' => 'rgba(153, 102, 255, 0.8)',
                    'borderColor' => 'rgba(153, 102, 255, 1)',
                    'borderWidth' => 2,
                    'borderRadius' => 6
                ],
                [
                    'label' => 'Transportation (TR)',
                    'data' => [485, 535, 875, 900, 950, 1000], // Actual: 2023=485, 2024=535, 2025=875
                    'backgroundColor' => 'rgba(255, 99, 132, 0.8)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 2,
                    'borderRadius' => 6
                ],
                [
                    'label' => 'Education & Research (ED)',
                    'data' => [950, 925, 1363, 1400, 1450, 1500], // Actual: 2023=950, 2024=925, 2025=1363
                    'backgroundColor' => 'rgba(255, 159, 64, 0.8)',
                    'borderColor' => 'rgba(255, 159, 64, 1)',
                    'borderWidth' => 2,
                    'borderRadius' => 6
                ]
            ],
            'totalScore' => [4345, 4560, 5410, 5800, 6200, 6500], // Actual: 2023=4345, 2024=4560, 2025=5410
            'worldRank' => [null, 1032, 942, 800, 700, 600], // Actual: 2024=1032, 2025=942
            'indonesiaRank' => [87, null, null, 60, 50, 40] // Actual: 2023=87 (from GreenMetric ranking by country)
        ];
    }

    /**
     * Update landing statistic
     */
    public function updateLandingStat()
    {
        // Cek akses admin (cek kedua kemungkinan session key)
        $isLoggedIn = $this->session->get('isLoggedIn') || $this->session->get('logged_in');
        $userRole = $this->session->get('role');

        if (!$isLoggedIn || $userRole !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Tidak memiliki akses']);
        }

        $section = $this->request->getVar('section');
        $key = $this->request->getVar('key');
        $value = $this->request->getVar('value');
        $id = $this->request->getVar('id');

        if (empty($section) || empty($key)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Section dan key harus diisi']);
        }

        try {
            // Update berdasarkan ID jika ada, atau section+key
            if (!empty($id)) {
                $result = $this->landingModel->update($id, ['value' => $value]);
            } else {
                $result = $this->landingModel->updateValue($section, $key, $value);
            }

            if ($result) {
                // Sinkronisasi dengan chart jika diperlukan
                $this->syncStatisticsToCharts();

                // Bersihkan cache jika ada
                cache()->delete('landing_statistics');

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Statistik berhasil diupdate dan landing page akan otomatis terupdate'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal mengupdate statistik'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Update landing stat error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Get all landing statistics for CRUD table
     */
    public function getAllLandingStats()
    {
        // Cek akses admin (cek kedua kemungkinan session key)
        $isLoggedIn = $this->session->get('isLoggedIn') || $this->session->get('logged_in');
        $userRole = $this->session->get('role');

        if (!$isLoggedIn || $userRole !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Tidak memiliki akses']);
        }

        try {
            $stats = $this->landingModel->orderBy('section', 'ASC')
                ->orderBy('order_position', 'ASC')
                ->findAll();

            return $this->response->setJSON([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Get all landing stats error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memuat data statistik: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Get single landing statistic for editing
     */
    public function getLandingStat($id)
    {
        // Cek akses admin (cek kedua kemungkinan session key)
        $isLoggedIn = $this->session->get('isLoggedIn') || $this->session->get('logged_in');
        $userRole = $this->session->get('role');

        if (!$isLoggedIn || $userRole !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Tidak memiliki akses']);
        }

        try {
            $stat = $this->landingModel->find($id);

            if (!$stat) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Statistik tidak ditemukan'
                ]);
            }

            return $this->response->setJSON([
                'success' => true,
                'data' => $stat
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Get landing stat error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memuat data statistik: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Update single landing statistic by ID
     */
    public function updateLandingStatById($id)
    {
        // Cek akses admin (cek kedua kemungkinan session key)
        $isLoggedIn = $this->session->get('isLoggedIn') || $this->session->get('logged_in');
        $userRole = $this->session->get('role');

        if (!$isLoggedIn || $userRole !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Tidak memiliki akses']);
        }

        // Cek apakah statistik exists
        $existingStat = $this->landingModel->find($id);
        if (!$existingStat) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Statistik tidak ditemukan'
            ]);
        }

        $data = [
            'section' => $this->request->getVar('section'),
            'key_name' => $this->request->getVar('key_name'),
            'label' => $this->request->getVar('label'),
            'value' => $this->request->getVar('value'),
            'icon' => $this->request->getVar('icon'),
            'color' => $this->request->getVar('color'),
            'order' => $this->request->getVar('order') ?? $existingStat['order']
        ];

        // Validasi field yang wajib diisi
        if (empty($data['section']) || empty($data['key_name']) || empty($data['label'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Section, key name, dan label harus diisi']);
        }

        try {
            $result = $this->landingModel->update($id, $data);

            if ($result) {
                // Sinkronisasi dengan chart jika diperlukan
                $this->syncStatisticsToCharts();

                // Bersihkan cache
                cache()->delete('landing_statistics');

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Statistik berhasil diupdate dan landing page akan otomatis terupdate'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal mengupdate statistik'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Update landing stat by ID error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * CRUD Dashboard Statistics  
     */
    public function dashboardStats()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck !== true) {
            return $authCheck; // Return redirect if not authenticated
        }

        $data = [
            'title' => 'Dashboard Statistics Management',
            'user_name' => $this->session->get('name'),
            'user_role' => $this->session->get('role'),
            'user_email' => $this->session->get('email')
        ];

        return view('admin/statistics/dashboard_stats', $data);
    }

    /**
     * Update dashboard statistic
     */
    public function updateDashboardStat()
    {
        try {
            $input = $this->request->getJSON(true);

            if (!isset($input['id']) || !isset($input['value'])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Data tidak lengkap'
                ]);
            }

            if (!class_exists('\App\Models\DashboardStatisticModel')) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'DashboardStatisticModel tidak ditemukan'
                ]);
            }

            $dashboardModel = new \App\Models\DashboardStatisticModel();

            $updateData = [
                'label' => $input['label'] ?? null,
                'value' => $input['value'],
                'icon' => $input['icon'] ?? null,
                'color' => $input['color'] ?? null
            ];

            // Remove null values
            $updateData = array_filter($updateData, function ($value) {
                return $value !== null;
            });

            $result = $dashboardModel->update($input['id'], $updateData);

            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Dashboard statistic berhasil diperbarui'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal memperbarui dashboard statistic'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * CRUD Charts & Indicators Management
     */
    public function charts()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck !== true) {
            return $authCheck; // Return redirect if not authenticated
        }

        $data = [
            'title' => 'Charts & Indicators Management',
            'user_name' => $this->session->get('name'),
            'user_role' => $this->session->get('role'),
            'user_email' => $this->session->get('email')
        ];

        return view('admin/statistics/charts_management', $data);
    }

    /**
     * AJAX: Get dashboard statistics
     */
    public function getDashboardStatistics()
    {
        try {
            if (!class_exists('\App\Models\DashboardStatisticModel')) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'DashboardStatisticModel tidak ditemukan'
                ]);
            }

            $dashboardModel = new \App\Models\DashboardStatisticModel();
            $stats = $dashboardModel->getGroupedByCategory();

            return $this->response->setJSON([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * AJAX: Delete dashboard statistic
     */
    public function deleteDashboardStat()
    {
        try {
            $input = $this->request->getJSON(true);

            if (!isset($input['id'])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'ID tidak ditemukan'
                ]);
            }

            if (!class_exists('\App\Models\DashboardStatisticModel')) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'DashboardStatisticModel tidak ditemukan'
                ]);
            }

            $dashboardModel = new \App\Models\DashboardStatisticModel();
            $result = $dashboardModel->delete($input['id']);

            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Dashboard statistic berhasil dihapus'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus dashboard statistic'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * AJAX: Get charts and indicators
     */
    public function getChartsIndicators()
    {
        try {
            if (!class_exists('\App\Models\ChartIndicatorModel')) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'ChartIndicatorModel tidak ditemukan'
                ]);
            }

            $chartModel = new \App\Models\ChartIndicatorModel();
            $charts = $chartModel->orderBy('order_position', 'ASC')->findAll();

            return $this->response->setJSON([
                'success' => true,
                'data' => $charts
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * AJAX: Update chart
     */
    public function updateChart()
    {
        try {
            $input = $this->request->getJSON(true);

            if (!isset($input['id'])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'ID tidak ditemukan'
                ]);
            }

            if (!class_exists('\App\Models\ChartIndicatorModel')) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'ChartIndicatorModel tidak ditemukan'
                ]);
            }

            $chartModel = new \App\Models\ChartIndicatorModel();

            $updateData = [
                'title' => $input['title'] ?? null,
                'chart_type' => $input['chart_type'] ?? null,
                'display_location' => $input['display_location'] ?? null,
                'section' => $input['section'] ?? null,
                'description' => $input['description'] ?? null,
                'chart_data' => $input['chart_data'] ?? null
            ];

            // Remove null values
            $updateData = array_filter($updateData, function ($value) {
                return $value !== null;
            });

            $result = $chartModel->update($input['id'], $updateData);

            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Chart berhasil diperbarui'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal memperbarui chart'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * AJAX: Delete chart
     */
    public function deleteChart()
    {
        try {
            $input = $this->request->getJSON(true);

            if (!isset($input['id'])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'ID tidak ditemukan'
                ]);
            }

            if (!class_exists('\App\Models\ChartIndicatorModel')) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'ChartIndicatorModel tidak ditemukan'
                ]);
            }

            $chartModel = new \App\Models\ChartIndicatorModel();
            $result = $chartModel->delete($input['id']);

            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Chart berhasil dihapus'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus chart'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * AJAX: Sync charts with database
     */
    public function syncCharts()
    {
        try {
            if (!class_exists('\App\Models\ChartIndicatorModel')) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'ChartIndicatorModel tidak ditemukan'
                ]);
            }

            $chartModel = new \App\Models\ChartIndicatorModel();

            // Sync with statistics data (if method exists)
            if (method_exists($chartModel, 'syncWithStatistics')) {
                $result = $chartModel->syncWithStatistics();
            } else {
                $result = true; // Assume success if method doesn't exist
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Charts berhasil disinkronkan dengan database'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * CRUD Charts & Indicators (Original method)
     */
    public function chartsOriginal()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Manajemen Chart & Indikator',
            'charts' => $this->chartModel->getAllGrouped(),
            'session' => $this->session
        ];

        return view('admin/statistics/charts', $data);
    }

    /**
     * Create new chart
     */
    public function createChart()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        // Validasi input
        $title = $this->request->getVar('title');
        $chartType = $this->request->getVar('chart_type');
        $chartData = $this->request->getVar('chart_data');

        if (empty($title) || empty($chartType)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Judul dan tipe chart harus diisi'
            ]);
        }

        // Validasi JSON chart data jika ada
        if (!empty($chartData)) {
            $decodedData = json_decode($chartData, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Format JSON data chart tidak valid'
                ]);
            }
        }

        $data = [
            'chart_type' => $chartType,
            'title' => $title,
            'description' => $this->request->getVar('description') ?? '',
            'data_source' => 'manual',
            'chart_data' => $chartData ?? '{}',
            'chart_config' => '{}',
            'display_location' => 'landing', // Default untuk landing page
            'section' => 'charts',
            'order_position' => $this->request->getVar('order_position') ?? 0,
            'is_active' => $this->request->getVar('is_active') ? 1 : 0,
            'sync_with_statistics' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        try {
            $result = $this->chartModel->insert($data);

            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Chart berhasil dibuat',
                    'id' => $result
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal membuat chart'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Create chart error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Delete chart (original method with parameter)
     */
    public function deleteChartById($id)
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $result = $this->chartModel->delete($id);

        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Chart berhasil dihapus'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menghapus chart'
            ]);
        }
    }

    /**
     * Sync statistics dengan charts
     */
    public function syncStatisticsToCharts()
    {
        try {
            $this->chartModel->syncWithStatistics();
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Sinkronisasi berhasil'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal sinkronisasi: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Get landing charts for CRUD interface
     */
    public function getLandingCharts()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        try {
            $charts = $this->chartModel->where('display_location', 'landing')
                ->orderBy('order_position', 'ASC')
                ->findAll();

            return $this->response->setJSON([
                'success' => true,
                'charts' => $charts
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Get landing charts error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memuat daftar chart: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Get single chart data for editing
     */
    public function getChart($id)
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        try {
            $chart = $this->chartModel->find($id);

            if (!$chart) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Chart tidak ditemukan'
                ]);
            }

            return $this->response->setJSON([
                'success' => true,
                'chart' => $chart
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Get chart error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memuat data chart: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * API untuk mendapatkan data chart
     */
    public function getChartData($location = 'dashboard')
    {
        $charts = $this->chartModel->getByLocation($location);

        // Sinkronisasi data terbaru jika ada chart yang auto-sync
        $this->chartModel->syncWithStatistics();

        return $this->response->setJSON([
            'success' => true,
            'data' => $charts
        ]);
    }

    /**
     * Bulk sync semua data
     */
    public function bulkSync()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        try {
            // Sinkronisasi data chart
            $this->chartModel->syncWithStatistics();

            // Sinkronisasi landing dengan dashboard stats jika diperlukan
            $this->syncLandingWithDashboard();

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Semua data berhasil disinkronkan'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal sinkronisasi: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Update chart data for landing page
     */
    public function updateChartData()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $input = $this->request->getJSON(true);

        if (empty($input)) {
            return $this->response->setJSON(['success' => false, 'message' => 'No data provided']);
        }

        try {
            // Get existing chart data
            $existingChart = $this->chartModel->where('title', 'Capaian Kriteria Kampus Berkelanjutan')
                ->where('display_location', 'landing')
                ->first();

            if ($existingChart) {
                // Decode existing chart data
                $chartData = json_decode($existingChart['chart_data'], true);

                // Update chart data with new values
                foreach ($input as $type => $changes) {
                    if ($type === 'datasets') {
                        foreach ($changes as $datasetIndex => $yearChanges) {
                            foreach ($yearChanges as $yearIndex => $newValue) {
                                if (isset($chartData['datasets'][$datasetIndex]['data'][$yearIndex])) {
                                    $chartData['datasets'][$datasetIndex]['data'][$yearIndex] = (float)$newValue;
                                }
                            }
                        }
                    } elseif (in_array($type, ['totalScore', 'worldRank', 'indonesiaRank'])) {
                        foreach ($changes as $yearIndex => $newValue) {
                            if (isset($chartData[$type][$yearIndex])) {
                                $chartData[$type][$yearIndex] = (float)$newValue;
                            }
                        }
                    }
                }

                // Update database
                $updateData = [
                    'chart_data' => json_encode($chartData),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $result = $this->chartModel->update($existingChart['id'], $updateData);

                if ($result) {
                    return $this->response->setJSON([
                        'success' => true,
                        'message' => 'Data chart berhasil disimpan ke database'
                    ]);
                } else {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Gagal menyimpan ke database'
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Chart tidak ditemukan di database'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Chart data update error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menyimpan data chart: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Sync all statistics data
     */
    public function syncAll()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        try {
            // Sinkronisasi statistik ke chart
            $this->syncLandingWithDashboard();

            // Sinkronisasi chart data
            $this->chartModel->syncWithStatistics();

            // Clear cache
            cache()->delete('landing_statistics');

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Semua data berhasil disinkronisasi'
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Sync all error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal sinkronisasi: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Create new landing statistic
     */
    public function createLandingStat()
    {
        if ((!$this->session->get('isLoggedIn') && !$this->session->get('logged_in')) || $this->session->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $data = [
            'section' => $this->request->getVar('section'),
            'key_name' => $this->request->getVar('key_name'),
            'label' => $this->request->getVar('label'),
            'value' => $this->request->getVar('value'),
            'icon' => $this->request->getVar('icon'),
            'color' => $this->request->getVar('color'),
            'order' => $this->request->getVar('order') ?? 0,
            'is_active' => 1
        ];

        // Validasi field yang wajib diisi
        if (empty($data['section']) || empty($data['key_name']) || empty($data['label'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Section, key name, dan label harus diisi']);
        }

        try {
            $result = $this->landingModel->insert($data);

            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Statistik berhasil ditambahkan',
                    'id' => $result
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menambahkan statistik'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Create landing stat error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Delete landing statistic
     */
    public function deleteLandingStat()
    {
        if ((!$this->session->get('isLoggedIn') && !$this->session->get('logged_in')) || $this->session->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $section = $this->request->getVar('section');
        $key = $this->request->getVar('key');
        $id = $this->request->getVar('id');

        // Jika ada ID, tidak perlu section dan key
        if (empty($id) && (empty($section) || empty($key))) {
            return $this->response->setJSON(['success' => false, 'message' => 'ID atau (Section dan key) harus diisi']);
        }

        try {
            // Coba hapus berdasarkan ID dulu, lalu berdasarkan section dan key
            $result = false;
            if (!empty($id)) {
                $result = $this->landingModel->delete($id);
            } else {
                // Hapus berdasarkan section dan key
                $result = $this->landingModel->where('section', $section)
                    ->where('key_name', $key)
                    ->delete();
            }

            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Statistik berhasil dihapus'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus statistik'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Delete landing stat error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Sync data landing dengan dashboard
     */
    private function syncLandingWithDashboard()
    {
        // Pemetaan data yang perlu disinkronisasi
        $syncMapping = [
            // dashboard_key => [landing_section, landing_key]
            'jumlah_mahasiswa' => ['profil_kampus', 'mahasiswa'],
            'jumlah_dosen' => ['profil_kampus', 'dosen'],
            'jumlah_jurusan' => ['profil_kampus', 'jurusan'],
            'jumlah_prodi' => ['profil_kampus', 'program_studi'],
            'luas_kampus' => ['fasilitas', 'luas_kampus'],
            'luas_bangunan' => ['fasilitas', 'luas_bangunan'],
            'jumlah_bangunan' => ['fasilitas', 'jumlah_bangunan'],
            'jumlah_laboratorium' => ['fasilitas', 'laboratorium'],
            'target_ranking_dunia' => ['info_box', 'ranking_dunia'],
            'target_ranking_indonesia' => ['info_box', 'ranking_indonesia']
        ];

        foreach ($syncMapping as $dashboardKey => $landingInfo) {
            $dashboardStat = $this->dashboardModel->getByKey($dashboardKey);
            if ($dashboardStat) {
                $this->landingModel->updateValue(
                    $landingInfo[0],
                    $landingInfo[1],
                    $dashboardStat['value']
                );
            }
        }
    }
}
