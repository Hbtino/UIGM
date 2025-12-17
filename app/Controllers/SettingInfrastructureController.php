<?php

namespace App\Controllers;

use App\Models\LandingStatisticModel;

class SettingInfrastructureController extends BaseController
{
    protected $landingModel;
    protected $session;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->landingModel = new LandingStatisticModel();
        $this->session = \Config\Services::session();
    }

    /**
     * Halaman utama Setting & Infrastructure dengan manajemen statistik landing page
     */
    public function index()
    {
        // Cek akses admin
        $isLoggedIn = $this->session->get('isLoggedIn') || $this->session->get('logged_in');
        $userRole = $this->session->get('role');

        if (!$isLoggedIn || $userRole !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        // Ambil statistik yang terkait dengan Setting & Infrastructure
        $relatedStats = $this->getRelatedLandingStats();

        // Get user data for sidebar layout
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($this->session->get('user_id'));

        $data = [
            // Required data for sidebar layout
            'title' => 'Setting & Infrastructure - Manajemen Data Landing Page',
            'page' => 'setting-infrastructure',
            'breadcrumb' => 'Home / Kriteria SDGs / Pengaturan & Infrastruktur',
            'user_name' => $this->session->get('name'),
            'user_role' => $this->session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null,
            
            // Page specific data
            'relatedStats' => $relatedStats,
            'criteriaInfo' => [
                'name' => 'Setting & Infrastructure (SI)',
                'description' => 'Pengaturan dan infrastruktur kampus berkelanjutan',
                'icon' => 'fas fa-building',
                'color' => '#54a0ff'
            ]
        ];

        return view('criteria/setting_infrastructure', $data);
    }

    /**
     * Ambil statistik landing page yang terkait dengan Setting & Infrastructure
     */
    private function getRelatedLandingStats()
    {
        try {
            // Mapping statistik yang terkait dengan Setting & Infrastructure
            $relatedSections = [
                'fasilitas' => [
                    'luas_kampus' => 'Luas Kampus',
                    'luas_bangunan' => 'Luas Bangunan',
                    'jumlah_bangunan' => 'Jumlah Bangunan',
                    'laboratorium' => 'Laboratorium'
                ],
                'profil_kampus' => [
                    'mahasiswa' => 'Jumlah Mahasiswa',
                    'dosen' => 'Jumlah Dosen'
                ]
            ];

            $stats = [];
            foreach ($relatedSections as $section => $keys) {
                $sectionStats = $this->landingModel->getBySection($section);
                foreach ($sectionStats as $stat) {
                    if (isset($keys[$stat['key_name']])) {
                        $stats[] = [
                            'id' => $stat['id'],
                            'section' => $section,
                            'key_name' => $stat['key_name'],
                            'label' => $stat['label'],
                            'value' => $stat['value'],
                            'icon' => $stat['icon'],
                            'color' => $stat['color'],
                            'category' => 'Setting & Infrastructure'
                        ];
                    }
                }
            }

            return $stats;
        } catch (\Exception $e) {
            log_message('error', 'Error getting related landing stats: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Update statistik landing page dari halaman Setting & Infrastructure
     */
    public function updateLandingStatistic()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Tidak memiliki akses']);
        }

        $id = $this->request->getVar('id');
        $value = $this->request->getVar('value');

        if (empty($id) || empty($value)) {
            return $this->response->setJSON(['success' => false, 'message' => 'ID dan value harus diisi']);
        }

        try {
            $result = $this->landingModel->update($id, ['value' => $value]);

            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Statistik berhasil diupdate dan akan otomatis terlihat di landing page'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal mengupdate statistik'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Update landing statistic error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
    
    /**
     * Display data management page for Setting & Infrastructure
     */
    public function dataManagement()
    {
        // Cek akses admin
        $isLoggedIn = $this->session->get('isLoggedIn') || $this->session->get('logged_in');
        $userRole = $this->session->get('role');

        if (!$isLoggedIn) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Get user data for profile photo
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($this->session->get('user_id'));
        
        // Get setting infrastructure data (you'll need to create this model)
        // For now, we'll use empty data
        $settingInfrastructure = [];

        $data = [
            // Required data for sidebar layout
            'title' => 'Setting & Infrastructure - Data Capaian',
            'page' => 'setting-infrastructure',
            'breadcrumb' => 'Home / Kriteria SDGs / Pengaturan & Infrastruktur',
            'user_name' => $this->session->get('name'),
            'user_role' => $this->session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null,
            
            // Page specific data
            'settingInfrastructure' => $settingInfrastructure
        ];

        return view('kriteria/setting_infrastructure/index', $data);
    }
}
