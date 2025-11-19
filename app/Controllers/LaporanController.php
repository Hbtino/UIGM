<?php

namespace App\Controllers;

use App\Models\UserModel;

class LaporanController extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        // Check if user is dosen or admin
        $userRole = session()->get('user_role');
        if (!in_array($userRole, ['admin', 'dosen'])) {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }
        
        // Get user data including profile photo
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));
        
        $laporanData = $this->getLaporanData();
        
        // Get list of dosen for admin
        $dosenList = [];
        if ($userRole === 'admin') {
            $dosenList = $userModel->where('role', 'dosen')->findAll();
        }
        
        $data = [
            'title' => 'Laporan UI GreenMetric',
            'page' => 'laporan',
            'user_name' => session()->get('user_name'),
            'user_id' => session()->get('user_id'),
            'user_role' => session()->get('user_role'),
            'profile_photo' => $user['profile_photo'] ?? null,
            'dosen_list' => $dosenList,
            'laporan_data' => $laporanData,
            // Add required variables from dashboard
            'stats' => [
                'targetSkor2028' => 80,
                'targetRankingDunia' => 500,
                'targetRankingIndonesia' => 50,
                'jumlahKriteria' => 6,
                'jumlahMahasiswa' => 12000,
                'jumlahDosen' => 500,
                'jumlahJurusan' => 7,
                'jumlahProdi' => 30,
                'luasKampus' => 200000,
                'luasBangunan' => 50000,
                'jumlahBangunan' => 50,
                'jumlahLaboratorium' => 100
            ],
            'chartData' => [
                'labels' => ['2023', '2024', '2025', '2026', '2027', '2028'],
                'datasets' => [],
                'totalScore' => [50, 55, 60, 65, 70, 80],
                'worldRank' => [896, 800, 700, 600, 550, 500],
                'indonesiaRank' => [87, 75, 65, 58, 52, 50]
            ]
        ];
        
        return view('laporan/index', $data);
    }
    
    public function kaprodi()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        // Check if user is kaprodi or admin
        $userRole = session()->get('user_role');
        if (!in_array($userRole, ['admin', 'kaprodi'])) {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }
        
        // Get user data including profile photo
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));
        
        $laporanData = $this->getLaporanData();
        
        // Get list of prodi for admin
        $prodiList = [];
        if ($userRole === 'admin') {
            // TODO: Implement ProdiModel to get list of program studi
            // For now, use dummy data
            $prodiList = [
                ['id' => 1, 'nama' => 'Teknik Informatika'],
                ['id' => 2, 'nama' => 'Sistem Informasi'],
                ['id' => 3, 'nama' => 'Teknik Elektro'],
                ['id' => 4, 'nama' => 'Teknik Mesin'],
                ['id' => 5, 'nama' => 'Teknik Sipil'],
                ['id' => 6, 'nama' => 'Teknik Refrigerasi dan Tata Udara'],
                ['id' => 7, 'nama' => 'Teknik Konversi Energi'],
            ];
        }
        
        $data = [
            'title' => 'Laporan Program Studi - UI GreenMetric',
            'page' => 'laporan_kaprodi',
            'user_name' => session()->get('user_name'),
            'user_prodi_id' => session()->get('user_prodi_id') ?? 1,
            'prodi_name' => session()->get('prodi_name') ?? 'Program Studi',
            'user_role' => session()->get('user_role'),
            'profile_photo' => $user['profile_photo'] ?? null,
            'prodi_list' => $prodiList,
            'laporan_data' => $laporanData,
            // Add required variables from dashboard
            'stats' => [
                'targetSkor2028' => 80,
                'targetRankingDunia' => 500,
                'targetRankingIndonesia' => 50,
                'jumlahKriteria' => 6,
                'jumlahMahasiswa' => 12000,
                'jumlahDosen' => 500,
                'jumlahJurusan' => 7,
                'jumlahProdi' => 30,
                'luasKampus' => 200000,
                'luasBangunan' => 50000,
                'jumlahBangunan' => 50,
                'jumlahLaboratorium' => 100
            ],
            'chartData' => [
                'labels' => ['2023', '2024', '2025', '2026', '2027', '2028'],
                'datasets' => [],
                'totalScore' => [50, 55, 60, 65, 70, 80],
                'worldRank' => [896, 800, 700, 600, 550, 500],
                'indonesiaRank' => [87, 75, 65, 58, 52, 50]
            ]
        ];
        
        return view('laporan/kaprodi', $data);
    }
    
    private function getLaporanData()
    {
        // Data laporan UI GreenMetric
        return [
            'periode' => '2024-2028',
            'kriteria' => [
                [
                    'nama' => 'Setting & Infrastructure (SI)',
                    'bobot' => '15%',
                    'skor_2023' => 57,
                    'target_2028' => 90,
                    'capaian' => 63,
                    'status' => 'On Track',
                    'icon' => 'building',
                    'color' => '#667eea'
                ],
                [
                    'nama' => 'Energy & Climate Change (EC)',
                    'bobot' => '21%',
                    'skor_2023' => 52,
                    'target_2028' => 85,
                    'capaian' => 58,
                    'status' => 'On Track',
                    'icon' => 'bolt',
                    'color' => '#11998e'
                ],
                [
                    'nama' => 'Waste Management (WS)',
                    'bobot' => '18%',
                    'skor_2023' => 48,
                    'target_2028' => 80,
                    'capaian' => 54,
                    'status' => 'On Track',
                    'icon' => 'recycle',
                    'color' => '#f093fb'
                ],
                [
                    'nama' => 'Water Management (WR)',
                    'bobot' => '10%',
                    'skor_2023' => 45,
                    'target_2028' => 75,
                    'capaian' => 51,
                    'status' => 'On Track',
                    'icon' => 'tint',
                    'color' => '#4facfe'
                ],
                [
                    'nama' => 'Transportation (TR)',
                    'bobot' => '18%',
                    'skor_2023' => 42,
                    'target_2028' => 70,
                    'capaian' => 48,
                    'status' => 'Need Improvement',
                    'icon' => 'bus',
                    'color' => '#f5576c'
                ],
                [
                    'nama' => 'Education & Research (ED)',
                    'bobot' => '18%',
                    'skor_2023' => 55,
                    'target_2028' => 85,
                    'capaian' => 62,
                    'status' => 'On Track',
                    'icon' => 'graduation-cap',
                    'color' => '#38ef7d'
                ]
            ],
            'summary' => [
                'total_skor_2023' => 50.2,
                'total_skor_current' => 56.8,
                'target_2028' => 80.0,
                'progress' => 71,
                'ranking_dunia_2023' => 896,
                'ranking_dunia_current' => 750,
                'ranking_indonesia_2023' => 87,
                'ranking_indonesia_current' => 65
            ]
        ];
    }
}
