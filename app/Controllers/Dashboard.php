<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    // Middleware untuk cek login
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        // Cek session login
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Get user data including profile photo
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        // Check user role - redirect to user dashboard if role is 'user'
        $userRole = $session->get('role');
        if (in_array($userRole, ['user', 'staff'])) {
            // User biasa - tampilkan dashboard read-only
            $data = [
                'title' => 'Dashboard User - Kampus Berkelanjutan',
                'user_name' => $session->get('name'),
                'user_role' => $userRole,
                'user_email' => $session->get('email'),
                'profile_photo' => $user['profile_photo'] ?? null
            ];
            return view('dashboard/user', $data);
        }

        // Admin, Dosen, Kaprodi, Reviewer - tampilkan dashboard lengkap
        // Get dashboard content
        $contentModel = new \App\Models\DashboardContentModel();
        $dashboard_content = $contentModel->getDashboardData();

        // Load new statistics and charts system (with error handling)
        $realTimeStats = ['summary' => ['total_data' => 0, 'approved_data' => 0, 'pending_data' => 0, 'rejected_data' => 0, 'score_percentage' => 0]];
        $staticStats = [];
        $dashboardCharts = [];

        try {
            helper('statistics');

            // Get real-time statistics
            if (function_exists('get_real_time_statistics')) {
                $realTimeStats = get_real_time_statistics();
            }

            // Load dashboard statistics from database
            if (class_exists('\App\Models\DashboardStatisticModel')) {
                $dashboardModel = new \App\Models\DashboardStatisticModel();
                $staticStats = $dashboardModel->getAsArray();
            }

            // Load dashboard charts
            if (class_exists('\App\Models\ChartIndicatorModel')) {
                $chartModel = new \App\Models\ChartIndicatorModel();
                $dashboardCharts = $chartModel->getByLocation('dashboard');

                // Sync chart data with latest statistics
                $chartModel->syncWithStatistics();
            }
        } catch (\Exception $e) {
            // Log error but continue with empty data
            log_message('error', 'Statistics system error: ' . $e->getMessage());
        }

        $data = [
            'title' => 'Dashboard - Kampus Berkelanjutan Polban',
            'page' => 'dashboard',
            'chartData' => $this->getChartData(), // Legacy chart data
            'stats' => $this->getStats(), // Legacy stats
            'sdgsData' => $this->getSDGsData(),
            'dashboard_content' => $dashboard_content,
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_email' => $session->get('email'),
            'profile_photo' => $user['profile_photo'] ?? null,
            // New statistics system
            'realTimeStats' => $realTimeStats,
            'staticStats' => $staticStats,
            'dashboardCharts' => $dashboardCharts,
            'combinedStats' => array_merge($staticStats, [
                'total_data' => $realTimeStats['summary']['total_data'],
                'approved_data' => $realTimeStats['summary']['approved_data'],
                'pending_data' => $realTimeStats['summary']['pending_data'],
                'rejected_data' => $realTimeStats['summary']['rejected_data'],
                'score_percentage' => $realTimeStats['summary']['score_percentage']
            ])
        ];

        return view('dashboard/index', $data);
    }

    private function getChartData()
    {
        // Data dari Renstra TMKB Polban 2024-2028 (Tabel 7 & Gambar 6)
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

    private function getStats()
    {
        // Data statistik dari Tabel 1 dan Tabel 7
        return [
            'targetSkor2028' => 80,
            'targetRankingDunia' => 176,
            'targetRankingIndonesia' => 26,
            'jumlahKriteria' => 6,
            'skorSekarang' => 43,
            'rankingDuniaSekarang' => 896,
            'rankingIndonesiaSekarang' => 87,
            'jumlahMahasiswa' => 6605,
            'jumlahDosen' => 482,
            'jumlahJurusan' => 10,
            'jumlahProdi' => 39,
            'luasKampus' => 246269,
            'luasBangunan' => 93435,
            'jumlahBangunan' => 86,
            'jumlahKelas' => 105,
            'jumlahLaboratorium' => 119
        ];
    }

    private function getSDGsData()
    {
        // 17 SDGs Goals
        return [
            ['id' => 1, 'name' => 'Tanpa Kemiskinan', 'icon' => 'fa-hand-holding-heart'],
            ['id' => 2, 'name' => 'Tanpa Kelaparan', 'icon' => 'fa-wheat-awn'],
            ['id' => 3, 'name' => 'Kehidupan Sehat', 'icon' => 'fa-heart-pulse'],
            ['id' => 4, 'name' => 'Pendidikan Berkualitas', 'icon' => 'fa-graduation-cap'],
            ['id' => 5, 'name' => 'Kesetaraan Gender', 'icon' => 'fa-venus-mars'],
            ['id' => 6, 'name' => 'Air Bersih & Sanitasi', 'icon' => 'fa-droplet'],
            ['id' => 7, 'name' => 'Energi Bersih', 'icon' => 'fa-bolt'],
            ['id' => 8, 'name' => 'Pekerjaan Layak', 'icon' => 'fa-briefcase'],
            ['id' => 9, 'name' => 'Industri & Inovasi', 'icon' => 'fa-industry'],
            ['id' => 10, 'name' => 'Berkurang Kesenjangan', 'icon' => 'fa-scale-balanced'],
            ['id' => 11, 'name' => 'Kota Berkelanjutan', 'icon' => 'fa-city'],
            ['id' => 12, 'name' => 'Konsumsi Bertanggung Jawab', 'icon' => 'fa-recycle'],
            ['id' => 13, 'name' => 'Penanganan Iklim', 'icon' => 'fa-temperature-half'],
            ['id' => 14, 'name' => 'Ekosistem Laut', 'icon' => 'fa-water'],
            ['id' => 15, 'name' => 'Ekosistem Daratan', 'icon' => 'fa-tree'],
            ['id' => 16, 'name' => 'Perdamaian & Keadilan', 'icon' => 'fa-scale-unbalanced'],
            ['id' => 17, 'name' => 'Kemitraan Tujuan', 'icon' => 'fa-handshake']
        ];
    }

    public function pengaturanInfrastruktur()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Pengaturan & Infrastruktur',
            'page' => 'pengaturan-infrastruktur',
            'chartData' => $this->getDetailChartData('SI'),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        // Redirect ke halaman CRUD kriteria
        return redirect()->to('/setting-infrastructure');
    }

    public function energiIklim()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Redirect ke halaman CRUD Energy Climate
        return redirect()->to('/energy-climate');
    }

    public function limbah()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Redirect ke halaman CRUD Waste Management
        return redirect()->to('/waste-management');
    }

    public function air()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Redirect ke halaman CRUD Water Management
        return redirect()->to('/water-management');
    }

    public function transportasi()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Redirect ke halaman CRUD Transportation
        return redirect()->to('/transportation');
    }

    public function pendidikanPenelitian()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Redirect ke halaman CRUD Education Research
        return redirect()->to('/education-research');
    }

    public function laporan()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Laporan Keberlanjutan',
            'page' => 'laporan',
            'chartData' => $this->getChartData(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        return view('dashboard/laporan', $data);
    }

    public function pengaturan()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Pengaturan Sistem',
            'page' => 'pengaturan',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        return view('dashboard/pengaturan', $data);
    }

    private function getDetailChartData($type)
    {
        $dataMap = [
            'SI' => [57, 68, 80, 88, 88, 90],
            'EC' => [50, 63, 69, 74, 82, 82],
            'WS' => [38, 50, 58, 71, 83, 88],
            'WR' => [30, 45, 45, 55, 80, 95],
            'TR' => [27, 30, 33, 37, 37, 39],
            'ED' => [53, 68, 81, 88, 90, 92]
        ];

        return [
            'labels' => ['2023', '2024', '2025', '2026', '2027', '2028'],
            'data' => $dataMap[$type] ?? []
        ];
    }

    // Method untuk admin/kaprodi/dosen (kompatibilitas dengan DashboardController lama)
    public function admin()
    {
        return $this->index();
    }

    public function kaprodi()
    {
        return $this->index();
    }

    public function dosen()
    {
        return $this->index();
    }

    public function reviewer()
    {
        return $this->index();
    }

    public function staff()
    {
        return $this->index();
    }

    // User Dashboard - Info SDGs
    public function userInfoSdgs()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        $data = [
            'title' => 'Tentang SDGs - Kampus Berkelanjutan',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('dashboard/user_info_sdgs', $data);
    }

    // User Dashboard - Kriteria
    public function userKriteria()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        $data = [
            'title' => 'Kriteria UI GreenMetric - Kampus Berkelanjutan',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('dashboard/user_kriteria', $data);
    }
}
