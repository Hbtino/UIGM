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

        // Check user role and redirect to appropriate dashboard
        $userRole = $session->get('role');

        // Route to specific dashboard based on role
        switch ($userRole) {
            case 'admin':
                return $this->adminPusatDashboard($user);
            case 'admin_unit':
            case 'sarpras':
            case 'umum':
            case 'lppm':
                return $this->adminUnitDashboard($user);
            case 'kaprodi':
                return $this->kaprodiDashboard($user);
            case 'dosen':
                return $this->dosenDashboard($user);
            case 'pimpinan':
            case 'direktur':
            case 'wakil_direktur':
                return $this->pimpinanDashboard($user);
            case 'user':
            case 'staff':
            default:
                // User biasa - tampilkan dashboard read-only
                $data = [
                    'title' => 'Dashboard User - Kampus Berkelanjutan',
                    'user_name' => $session->get('name'),
                    'user_role' => $userRole,
                    'user_unit' => $user['unit'] ?? null,
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
            // Required data for sidebar layout
            'title' => 'Dashboard - Kampus Berkelanjutan Polban',
            'page' => 'dashboard',
            'breadcrumb' => 'Dashboard',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_unit' => $user['unit'] ?? null,
            'profile_photo' => $user['profile_photo'] ?? null,

            // Dashboard specific data
            'chartData' => $this->getChartData(), // Legacy chart data
            'stats' => $this->getStats(), // Legacy stats
            'sdgsData' => $this->getSDGsData(),
            'dashboard_content' => $dashboard_content,
            'user_email' => $session->get('email'),
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

    /**
     * Dashboard Admin Pusat - Kontrol & Monitoring
     */
    private function adminPusatDashboard($user)
    {
        $session = session();

        // Get progress data per kategori
        $progress = $this->getProgressByCategory();
        $dataCount = $this->getDataCountByCategory();
        $pendingCount = $this->getPendingValidationByCategory();
        $validationSummary = $this->getValidationSummary();

        $data = [
            'title' => 'Dashboard Admin Pusat - UIGM 2025',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_email' => $session->get('email'),
            'profile_photo' => $user['profile_photo'] ?? null,
            'year_status' => $this->getYearStatus(),
            'progress' => $progress,
            'data_count' => $dataCount,
            'pending_count' => $pendingCount,
            'validation_summary' => $validationSummary,
            'total_data' => array_sum($dataCount),
            'completion_rate' => $this->calculateCompletionRate($progress),
            'active_users' => $this->getActiveUsersCount(),
            'uploads_today' => $this->getUploadsToday(),
            'issues_count' => $this->getOpenIssuesCount()
        ];

        return view('dashboard/admin_pusat', $data);
    }

    /**
     * Dashboard Admin Unit - Input & Update Data Unit
     */
    private function adminUnitDashboard($user)
    {
        $session = session();
        $userUnit = $user['unit'] ?? 'Sarpras';

        // Get unit specific data
        $unitProgress = $this->getUnitProgress($userUnit);
        $unitData = $this->getUnitData($userUnit);
        $unitCategories = $this->getUnitCategories($userUnit);

        $data = [
            'title' => 'Dashboard Admin Unit - ' . $userUnit,
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_unit' => $userUnit,
            'user_email' => $session->get('email'),
            'profile_photo' => $user['profile_photo'] ?? null,
            'unit_progress' => $unitProgress,
            'unit_data' => $unitData,
            'unit_categories' => $unitCategories,
            'evidence_needed' => $this->getEvidenceNeeded($userUnit),
            'evidence_uploaded' => $this->getEvidenceUploaded($userUnit),
            'ready_submit' => $this->getReadySubmit($userUnit),
            'pending_review' => $this->getPendingReview($userUnit),
            'recent_activities' => $this->getRecentActivities($userUnit)
        ];

        return view('dashboard/admin_unit', $data);
    }

    /**
     * Dashboard Kaprodi - Review Data Dosen
     */
    private function kaprodiDashboard($user)
    {
        $session = session();
        $userProdi = $user['prodi'] ?? 'Teknik Informatika';

        // Get kaprodi specific data
        $dosenStatus = $this->getDosenStatusByProdi($userProdi);
        $prodiProgress = $this->getProdiProgress($userProdi);
        $edData = $this->getEDDataByProdi($userProdi);
        $edRecap = $this->getEDRecapByProdi($userProdi);

        $data = [
            'title' => 'Dashboard Kaprodi - ' . $userProdi,
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_prodi' => $userProdi,
            'user_email' => $session->get('email'),
            'profile_photo' => $user['profile_photo'] ?? null,
            'total_dosen' => $this->getTotalDosenByProdi($userProdi),
            'active_dosen' => $this->getActiveDosenByProdi($userProdi),
            'dosen_status' => $dosenStatus,
            'prodi_progress' => $prodiProgress,
            'ed_data' => $edData,
            'ed_recap' => $edRecap,
            'dosen_list' => $this->getDosenListByProdi($userProdi)
        ];

        return view('dashboard/kaprodi', $data);
    }

    /**
     * Dashboard Dosen - Input Data Pribadi
     */
    private function dosenDashboard($user)
    {
        $session = session();
        $userId = $session->get('user_id');

        // Get dosen specific data
        $profileCompletion = $this->getProfileCompletion($userId);
        $edProgress = $this->getEDProgress($userId);
        $edData = $this->getEDDataByDosen($userId);
        $submissionStatus = $this->getSubmissionStatus($userId);

        $data = [
            'title' => 'Dashboard Dosen - Education & Research',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_email' => $session->get('email'),
            'profile_photo' => $user['profile_photo'] ?? null,
            'profile_completion' => $profileCompletion,
            'ed_progress' => $edProgress,
            'ed_data' => $edData,
            'submission_status' => $submissionStatus,
            'days_left' => $this->getDaysLeftToDeadline(),
            'last_saved' => $this->getLastSaved($userId),
            'recent_activities' => $this->getRecentActivitiesByDosen($userId)
        ];

        return view('dashboard/dosen', $data);
    }

    /**
     * Dashboard Pimpinan - Monitoring Read-only
     */
    private function pimpinanDashboard($user)
    {
        $session = session();

        // Get executive summary data
        $currentScore = $this->getCurrentScore();
        $worldRank = $this->getWorldRank();
        $indonesiaRank = $this->getIndonesiaRank();
        $completionRate = $this->getOverallCompletionRate();
        $nationalStats = $this->getNationalStats();

        $data = [
            'title' => 'Dashboard Pimpinan - Executive Overview',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_email' => $session->get('email'),
            'profile_photo' => $user['profile_photo'] ?? null,
            'current_score' => $currentScore,
            'world_rank' => $worldRank,
            'indonesia_rank' => $indonesiaRank,
            'completion_rate' => $completionRate,
            'national_stats' => $nationalStats
        ];

        return view('dashboard/pimpinan', $data);
    }

    // Helper methods for data retrieval
    private function getProgressByCategory()
    {
        return [
            'si' => 75,
            'ec' => 82,
            'ws' => 68,
            'wr' => 71,
            'tr' => 85,
            'ed' => 92
        ];
    }

    private function getDataCountByCategory()
    {
        return [
            'si' => 45,
            'ec' => 49,
            'ws' => 41,
            'wr' => 43,
            'tr' => 51,
            'ed' => 55
        ];
    }

    private function getPendingValidationByCategory()
    {
        return [
            'si' => 8,
            'ec' => 3,
            'ws' => 12,
            'wr' => 9,
            'tr' => 2,
            'ed' => 1
        ];
    }

    private function getValidationSummary()
    {
        return [
            'pending' => 35,
            'today' => 12
        ];
    }

    private function getYearStatus()
    {
        return 'open'; // open, review, locked
    }

    private function calculateCompletionRate($progress)
    {
        return round(array_sum($progress) / count($progress));
    }

    private function getActiveUsersCount()
    {
        return 23;
    }

    private function getUploadsToday()
    {
        return 8;
    }

    private function getOpenIssuesCount()
    {
        return 3;
    }

    private function getUnitProgress($unit)
    {
        return 68;
    }

    private function getUnitData($unit)
    {
        return [
            'total' => 45,
            'completed' => 31,
            'draft' => 8,
            'review' => 6
        ];
    }

    private function getUnitCategories($unit)
    {
        // Categories based on unit responsibility
        $categories = [
            'Sarpras' => ['si', 'ws', 'wr'],
            'Umum' => ['si', 'tr'],
            'LPPM' => ['ed']
        ];

        $unitCategories = [];
        $categoryNames = [
            'si' => 'Setting & Infrastructure',
            'ec' => 'Energy & Climate Change',
            'ws' => 'Waste Management',
            'wr' => 'Water Management',
            'tr' => 'Transportation',
            'ed' => 'Education & Research'
        ];

        foreach ($categories[$unit] ?? ['si'] as $cat) {
            $unitCategories[$cat] = [
                'name' => $categoryNames[$cat],
                'progress' => rand(60, 90),
                'total' => rand(15, 25),
                'completed' => rand(10, 20)
            ];
        }

        return $unitCategories;
    }

    private function getEvidenceNeeded($unit)
    {
        return 12;
    }

    private function getEvidenceUploaded($unit)
    {
        return 8;
    }

    private function getReadySubmit($unit)
    {
        return 5;
    }

    private function getPendingReview($unit)
    {
        return 3;
    }

    private function getRecentActivities($unit)
    {
        return [
            ['action' => 'Data SI-001 diupdate', 'time' => '2 jam lalu', 'status' => 'success'],
            ['action' => 'Upload bukti WS-005', 'time' => '1 hari lalu', 'status' => 'info'],
            ['action' => 'Submit review WR-003', 'time' => '2 hari lalu', 'status' => 'warning']
        ];
    }

    private function getDosenStatusByProdi($prodi)
    {
        return [
            'belum_submit' => 8,
            'menunggu_review' => 12,
            'perlu_revisi' => 3,
            'selesai' => 2
        ];
    }

    private function getProdiProgress($prodi)
    {
        return 68;
    }

    private function getEDDataByProdi($prodi)
    {
        return [
            'total' => 156,
            'approved' => 89
        ];
    }

    private function getEDRecapByProdi($prodi)
    {
        return [
            'publikasi' => ['jurnal' => 45, 'konferensi' => 23, 'buku' => 8],
            'penelitian' => ['internal' => 12, 'eksternal' => 8, 'kolaborasi' => 5],
            'pengabdian' => ['masyarakat' => 15, 'industri' => 7, 'pemerintah' => 3]
        ];
    }

    private function getTotalDosenByProdi($prodi)
    {
        return 25;
    }

    private function getActiveDosenByProdi($prodi)
    {
        return 23;
    }

    private function getDosenListByProdi($prodi)
    {
        return [
            ['nama' => 'Dr. Ahmad Hidayat, M.T.', 'nidn' => '0123456789', 'status' => 'menunggu_review', 'data_count' => 8, 'last_update' => '2 hari lalu'],
            ['nama' => 'Prof. Siti Nurhaliza, Ph.D.', 'nidn' => '0987654321', 'status' => 'selesai', 'data_count' => 12, 'last_update' => '1 minggu lalu']
        ];
    }

    private function getProfileCompletion($userId)
    {
        return 85;
    }

    private function getEDProgress($userId)
    {
        return 68;
    }

    private function getEDDataByDosen($userId)
    {
        return [
            'publikasi' => ['count' => 8, 'jurnal' => 3, 'konferensi' => 4, 'buku' => 1],
            'penelitian' => ['count' => 5, 'internal' => 2, 'eksternal' => 2, 'kolaborasi' => 1],
            'pengabdian' => ['count' => 3, 'masyarakat' => 2, 'industri' => 1]
        ];
    }

    private function getSubmissionStatus($userId)
    {
        return 'draft'; // draft, review, submitted
    }

    private function getDaysLeftToDeadline()
    {
        return 15;
    }

    private function getLastSaved($userId)
    {
        return '2 jam lalu';
    }

    private function getRecentActivitiesByDosen($userId)
    {
        return [
            ['action' => 'Menambahkan publikasi jurnal internasional', 'time' => '2 jam lalu', 'type' => 'publikasi'],
            ['action' => 'Update data penelitian internal', 'time' => '1 hari lalu', 'type' => 'penelitian']
        ];
    }

    private function getCurrentScore()
    {
        return 5410;
    }

    private function getWorldRank()
    {
        return 942;
    }

    private function getIndonesiaRank()
    {
        return 25;
    }

    private function getOverallCompletionRate()
    {
        return 78;
    }

    private function getNationalStats()
    {
        return [
            'total_universities' => 150,
            'polban_rank' => 25,
            'top_percentage' => 17
        ];
    }

    private function getChartData()
    {
        // Data target UI GreenMetric 2024-2028
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
