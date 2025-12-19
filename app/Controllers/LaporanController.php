<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\LaporanDosenModel;
use App\Models\LaporanKaprodiModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class LaporanController extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Check if user is dosen or admin
        $userRole = session()->get('role');
        if (!in_array($userRole, ['admin', 'dosen'])) {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        $laporanData = $this->getLaporanData();

        // Get list of dosen for admin
        $dosenList = [];
        if ($userRole === 'admin') {
            $userModel = new UserModel();
            $dosenList = $userModel->where('role', 'dosen')->findAll();
        }

        // Check if editing existing laporan
        $savedData = null;
        $lastSaved = null;
        $editId = null;

        if (session()->getFlashdata('edit_laporan_id')) {
            // Load data from edit
            $editId = session()->getFlashdata('edit_laporan_id');
            $editData = session()->getFlashdata('edit_laporan_data');
            if ($editData) {
                $savedData = json_decode($editData, true);
            }
        } else {
            // Load latest laporan if available
            $laporanModel = new LaporanDosenModel();
            $existingLaporan = $laporanModel->getLatestLaporanByUserId(session()->get('user_id'));

            if ($existingLaporan) {
                $savedData = json_decode($existingLaporan['data_laporan'], true);
                $lastSaved = $existingLaporan['updated_at'] ?? $existingLaporan['created_at'];
            }
        }

        $data = array_merge($this->getSidebarData('laporan'), [
            'title' => 'Laporan UI GreenMetric',
            'user_id' => session()->get('user_id'),
            'dosen_list' => $dosenList,
            'laporan_data' => $laporanData,
            'saved_data' => $savedData,
            'last_saved' => $lastSaved,
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
        ]);

        return view('laporan/index', $data);
    }

    public function kaprodi()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Check if user is kaprodi or admin
        $userRole = session()->get('role');
        if (!in_array($userRole, ['admin', 'kaprodi'])) {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

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

        // Load latest laporan if available
        $laporanModel = new LaporanKaprodiModel();
        $existingLaporan = $laporanModel->getLatestLaporanByUserId(session()->get('user_id'));
        $savedData = null;
        $lastSaved = null;

        if ($existingLaporan) {
            $savedData = json_decode($existingLaporan['data_laporan'], true);
            $lastSaved = $existingLaporan['updated_at'] ?? $existingLaporan['created_at'];
        }

        $data = array_merge($this->getSidebarData('laporan_kaprodi'), [
            'title' => 'Laporan Program Studi - UI GreenMetric',
            'user_id' => session()->get('user_id'),
            'user_prodi_id' => session()->get('user_prodi_id') ?? 1,
            'prodi_name' => session()->get('prodi_name') ?? 'Program Studi',
            'prodi_list' => $prodiList,
            'laporan_data' => $laporanData,
            'saved_data' => $savedData,
            'last_saved' => $lastSaved,
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
        ]);

        return view('laporan/kaprodi', $data);
    }

    public function saveDosen()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $laporanModel = new LaporanDosenModel();
        $postData = $this->request->getPost();

        // Get user_name - either from post data or get from database if admin selected different user
        $userName = $postData['user_name'] ?? session()->get('name');

        // If admin selected a different dosen, get that dosen's name
        if (isset($postData['selected_dosen_id']) && !empty($postData['selected_dosen_id'])) {
            $userModel = new UserModel();
            $selectedUser = $userModel->find($postData['selected_dosen_id']);
            if ($selectedUser) {
                $userName = $selectedUser['name'];
                $postData['user_id'] = $selectedUser['id'];
            }
        }

        $data = [
            'user_id' => $postData['user_id'],
            'user_name' => $userName,
            'jurusan' => $postData['jurusan'] ?? '',
            'program_studi' => $postData['program_studi'] ?? '',
            'data_laporan' => json_encode($postData)
        ];

        if ($laporanModel->saveLaporan($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Laporan berhasil disimpan']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menyimpan laporan']);
        }
    }

    public function saveKaprodi()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $laporanModel = new LaporanKaprodiModel();
        $postData = $this->request->getPost();

        // Get user_name - either from post data or get from database if admin selected different user
        $userName = $postData['user_name'] ?? session()->get('name');

        // If admin selected a different kaprodi, get that kaprodi's name
        if (isset($postData['selected_kaprodi_id']) && !empty($postData['selected_kaprodi_id'])) {
            $userModel = new UserModel();
            $selectedUser = $userModel->find($postData['selected_kaprodi_id']);
            if ($selectedUser) {
                $userName = $selectedUser['name'];
                $postData['user_id'] = $selectedUser['id'];
            }
        }

        $data = [
            'user_id' => $postData['user_id'],
            'user_name' => $userName,
            'prodi_id' => $postData['prodi_id'] ?? null,
            'prodi_name' => $postData['prodi_name'] ?? '',
            'kaprodi_name' => $postData['kaprodi_name'] ?? '',
            'jurusan' => $postData['jurusan'] ?? '',
            'tanggal_laporan' => $postData['tanggal_laporan'] ?? date('Y-m-d'),
            'data_laporan' => json_encode($postData)
        ];

        if ($laporanModel->saveLaporan($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Laporan berhasil disimpan']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menyimpan laporan']);
        }
    }

    public function exportDosenPdf($id = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $laporanModel = new LaporanDosenModel();

        // If ID provided, get specific laporan, otherwise get latest
        if ($id) {
            $laporan = $laporanModel->find($id);
        } else {
            $laporan = $laporanModel->getLatestLaporanByUserId(session()->get('user_id'));
        }

        if (!$laporan) {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan. Silakan simpan laporan terlebih dahulu.');
        }

        $data = json_decode($laporan['data_laporan'], true);

        // Get user name from laporan record
        $userName = $laporan['user_name'] ?? session()->get('name');

        $html = view('laporan/pdf_dosen', [
            'laporan' => $laporan,
            'data' => $data,
            'user_name' => $userName,
            'last_saved' => $laporan['updated_at'] ?? $laporan['created_at']
        ]);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream('Laporan_Dosen_' . date('Y-m-d') . '.pdf', ['Attachment' => true]);
    }

    public function exportKaprodiPdf($id = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $laporanModel = new LaporanKaprodiModel();

        // If ID provided, get specific laporan, otherwise get latest
        if ($id) {
            $laporan = $laporanModel->find($id);
        } else {
            $laporan = $laporanModel->getLatestLaporanByUserId(session()->get('user_id'));
        }

        if (!$laporan) {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan. Silakan simpan laporan terlebih dahulu.');
        }

        $data = json_decode($laporan['data_laporan'], true);

        // Get user name from laporan record
        $userName = $laporan['user_name'] ?? session()->get('name');

        $html = view('laporan/pdf_kaprodi', [
            'laporan' => $laporan,
            'data' => $data,
            'user_name' => $userName,
            'last_saved' => $laporan['updated_at'] ?? $laporan['created_at']
        ]);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream('Laporan_Kaprodi_' . date('Y-m-d') . '.pdf', ['Attachment' => true]);
    }

    public function riwayatDosen()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Check if user is dosen or admin
        $userRole = session()->get('role');
        if (!in_array($userRole, ['admin', 'dosen'])) {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        // Get user data
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        // Get laporan - Admin sees all, Dosen sees only their own
        $db = \Config\Database::connect();
        $builder = $db->table('laporan_dosen');
        $builder->select('*'); // Explicitly select all columns including id

        if ($userRole === 'admin') {
            // Admin: Get ALL laporan from all dosen
            $laporan = $builder->orderBy('created_at', 'DESC')
                ->get()
                ->getResultArray();
        } else {
            // Dosen: Get only their own laporan
            $userId = session()->get('user_id');
            $laporan = $builder->where('user_id', $userId)
                ->orderBy('created_at', 'DESC')
                ->get()
                ->getResultArray();
        }

        // Debug log
        if (!empty($laporan)) {
            log_message('debug', 'Riwayat Dosen - First item keys: ' . implode(', ', array_keys($laporan[0])));
        }

        // Get list of all dosen for filter (admin only)
        $dosenList = [];
        if ($userRole === 'admin') {
            $dosenList = $userModel->where('role', 'dosen')->findAll();
        }

        // Debug: log the result
        log_message('debug', 'Riwayat Dosen - User Role: ' . $userRole);
        log_message('debug', 'Riwayat Dosen - Laporan count: ' . count($laporan));

        // Debug mode - show debug page
        if ($this->request->getGet('debug') === '1') {
            echo "<h2>DEBUG MODE - Riwayat Dosen</h2>";
            echo "<pre>";
            echo "Session Data:\n";
            echo "  User ID: " . session()->get('user_id') . "\n";
            echo "  User Name: " . session()->get('name') . "\n";
            echo "  User Role: " . session()->get('role') . "\n";
            echo "  Logged In: " . (session()->get('logged_in') ? 'Yes' : 'No') . "\n\n";

            echo "Query Result:\n";
            echo "  Laporan Type: " . gettype($laporan) . "\n";
            echo "  Laporan Count: " . count($laporan) . "\n";
            echo "  Is Array: " . (is_array($laporan) ? 'Yes' : 'No') . "\n";
            echo "  Is Empty: " . (empty($laporan) ? 'Yes' : 'No') . "\n\n";

            echo "Laporan Data:\n";
            print_r($laporan);

            echo "</pre>";
            exit;
        }

        $data = array_merge($this->getSidebarData('riwayat_laporan'), [
            'title' => 'Riwayat Laporan Dosen',
            'user_id' => session()->get('user_id'),
            'laporan' => $laporan,
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
        ]);

        return view('laporan/riwayat_dosen', $data);
    }

    public function debugKaprodi()
    {
        // Debug method to check laporan_kaprodi data
        $db = \Config\Database::connect();

        echo "<h2>Checking laporan_kaprodi table</h2>";

        // Get all laporan
        $query = $db->query("SELECT * FROM laporan_kaprodi ORDER BY created_at DESC LIMIT 5");
        $results = $query->getResultArray();

        echo "<p>Total records found: " . count($results) . "</p>";

        if (!empty($results)) {
            echo "<h3>Sample Data:</h3>";
            foreach ($results as $row) {
                echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px 0;'>";
                echo "<strong>ID:</strong> " . ($row['id'] ?? 'NULL') . "<br>";
                echo "<strong>User ID:</strong> " . ($row['user_id'] ?? 'NULL') . "<br>";
                echo "<strong>Prodi ID:</strong> " . ($row['prodi_id'] ?? 'NULL') . "<br>";
                echo "<strong>Prodi Name:</strong> " . ($row['prodi_name'] ?? 'NULL') . "<br>";
                echo "<strong>Kaprodi Name:</strong> " . ($row['kaprodi_name'] ?? 'NULL') . "<br>";
                echo "<strong>Jurusan:</strong> " . ($row['jurusan'] ?? 'NULL') . "<br>";
                echo "<strong>Tanggal Laporan:</strong> " . ($row['tanggal_laporan'] ?? 'NULL') . "<br>";
                echo "<strong>Created At:</strong> " . ($row['created_at'] ?? 'NULL') . "<br>";

                // Check data_laporan JSON
                if (!empty($row['data_laporan'])) {
                    $data = json_decode($row['data_laporan'], true);
                    echo "<strong>Data Laporan (JSON):</strong><br>";
                    echo "<pre style='background: #f5f5f5; padding: 10px; overflow: auto; max-height: 200px;'>";
                    echo "prodi_name: " . ($data['prodi_name'] ?? 'NOT SET') . "\n";
                    echo "kaprodi_name: " . ($data['kaprodi_name'] ?? 'NOT SET') . "\n";
                    echo "jurusan: " . ($data['jurusan'] ?? 'NOT SET') . "\n";
                    echo "</pre>";
                }
                echo "</div>";
            }
        } else {
            echo "<p style='color: red;'>No records found in laporan_kaprodi table!</p>";
        }

        // Check table structure
        echo "<h3>Table Structure:</h3>";
        $query = $db->query("DESCRIBE laporan_kaprodi");
        $columns = $query->getResultArray();
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
        foreach ($columns as $col) {
            echo "<tr>";
            echo "<td>" . $col['Field'] . "</td>";
            echo "<td>" . $col['Type'] . "</td>";
            echo "<td>" . $col['Null'] . "</td>";
            echo "<td>" . $col['Key'] . "</td>";
            echo "<td>" . ($col['Default'] ?? 'NULL') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    public function riwayatKaprodi()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Check if user is kaprodi or admin
        $userRole = session()->get('role');
        if (!in_array($userRole, ['admin', 'kaprodi'])) {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        // Get user data
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        // Get laporan using model
        $laporanModel = new LaporanKaprodiModel();

        if ($userRole === 'admin') {
            // Admin: Get ALL laporan from all kaprodi
            $laporan = $laporanModel->orderBy('created_at', 'DESC')->findAll();
        } else {
            // Kaprodi: Get only their own laporan
            $userId = session()->get('user_id');
            $laporan = $laporanModel->getLaporanByUserId($userId);
        }

        // Enrich laporan with kaprodi names from users table
        if (!empty($laporan)) {
            foreach ($laporan as &$item) {
                if (!empty($item['user_id'])) {
                    $kaprodiUser = $userModel->find($item['user_id']);
                    if ($kaprodiUser && empty($item['kaprodi_name'])) {
                        $item['kaprodi_name'] = $kaprodiUser['name'];
                    }
                }
            }
        }

        // Get list of all kaprodi for filter (admin only)
        $kaprodiList = [];
        if ($userRole === 'admin') {
            $kaprodiList = $userModel->where('role', 'kaprodi')->findAll();
        }

        // Debug: log the result
        log_message('debug', 'Riwayat Kaprodi - User Role: ' . $userRole);
        log_message('debug', 'Riwayat Kaprodi - Laporan count: ' . count($laporan));
        if (!empty($laporan)) {
            log_message('debug', 'Riwayat Kaprodi - First item keys: ' . implode(', ', array_keys($laporan[0])));
        }

        $data = array_merge($this->getSidebarData('riwayat_laporan_kaprodi'), [
            'title' => 'Riwayat Laporan Kaprodi',
            'user_id' => session()->get('user_id'),
            'laporan' => $laporan,
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
        ]);

        return view('laporan/riwayat_kaprodi', $data);
    }

    public function editDosen($id)
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Get laporan using direct database query
        $db = \Config\Database::connect();
        $builder = $db->table('laporan_dosen');
        $laporan = $builder->where('id', $id)->get()->getRowArray();

        if (!$laporan) {
            return redirect()->to('/laporan/riwayat-dosen')->with('error', 'Laporan tidak ditemukan');
        }

        // Check authorization
        $userRole = session()->get('role');
        if ($userRole !== 'admin' && $laporan['user_id'] != session()->get('user_id')) {
            return redirect()->to('/laporan/riwayat-dosen')->with('error', 'Anda tidak memiliki akses untuk mengedit laporan ini');
        }

        // Store edit data in session
        session()->setFlashdata('edit_laporan_id', $id);
        session()->setFlashdata('edit_laporan_data', $laporan['data_laporan']);

        // Redirect to form laporan
        return redirect()->to('/laporan');
    }

    public function deleteDosen($id)
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Get laporan using direct database query
        $db = \Config\Database::connect();
        $builder = $db->table('laporan_dosen');
        $laporan = $builder->where('id', $id)->get()->getRowArray();

        log_message('debug', 'Delete Dosen - ID: ' . $id);
        log_message('debug', 'Delete Dosen - Laporan found: ' . ($laporan ? 'Yes' : 'No'));

        if (!$laporan) {
            return redirect()->to('/laporan/riwayat-dosen')->with('error', 'Laporan tidak ditemukan');
        }

        // Check authorization
        $userRole = session()->get('role');
        if ($userRole !== 'admin' && $laporan['user_id'] != session()->get('user_id')) {
            return redirect()->to('/laporan/riwayat-dosen')->with('error', 'Anda tidak memiliki akses untuk menghapus laporan ini');
        }

        // Delete laporan using direct query
        $deleted = $builder->where('id', $id)->delete();

        if ($deleted) {
            return redirect()->to('/laporan/riwayat-dosen')->with('success', 'Laporan berhasil dihapus');
        } else {
            return redirect()->to('/laporan/riwayat-dosen')->with('error', 'Gagal menghapus laporan');
        }
    }

    public function editKaprodi($id)
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Get laporan using direct database query
        $db = \Config\Database::connect();
        $builder = $db->table('laporan_kaprodi');
        $laporan = $builder->where('id', $id)->get()->getRowArray();

        if (!$laporan) {
            return redirect()->to('/laporan/riwayat-kaprodi')->with('error', 'Laporan tidak ditemukan');
        }

        // Check authorization
        $userRole = session()->get('role');
        if ($userRole !== 'admin' && $laporan['user_id'] != session()->get('user_id')) {
            return redirect()->to('/laporan/riwayat-kaprodi')->with('error', 'Anda tidak memiliki akses untuk mengedit laporan ini');
        }

        // Store edit data in session
        session()->setFlashdata('edit_laporan_kaprodi_id', $id);
        session()->setFlashdata('edit_laporan_kaprodi_data', $laporan['data_laporan']);

        // Redirect to form laporan
        return redirect()->to('/laporan/kaprodi');
    }

    public function deleteKaprodi($id)
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Get laporan using direct database query
        $db = \Config\Database::connect();
        $builder = $db->table('laporan_kaprodi');
        $laporan = $builder->where('id', $id)->get()->getRowArray();

        log_message('debug', 'Delete Kaprodi - ID: ' . $id);
        log_message('debug', 'Delete Kaprodi - Laporan found: ' . ($laporan ? 'Yes' : 'No'));

        if (!$laporan) {
            return redirect()->to('/laporan/riwayat-kaprodi')->with('error', 'Laporan tidak ditemukan');
        }

        // Check authorization
        $userRole = session()->get('role');
        if ($userRole !== 'admin' && $laporan['user_id'] != session()->get('user_id')) {
            return redirect()->to('/laporan/riwayat-kaprodi')->with('error', 'Anda tidak memiliki akses untuk menghapus laporan ini');
        }

        // Delete laporan using direct query
        $deleted = $builder->where('id', $id)->delete();

        if ($deleted) {
            return redirect()->to('/laporan/riwayat-kaprodi')->with('success', 'Laporan berhasil dihapus');
        } else {
            return redirect()->to('/laporan/riwayat-kaprodi')->with('error', 'Gagal menghapus laporan');
        }
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

    /**
     * Get sidebar data for views
     */
    protected function getSidebarData($page = '')
    {
        $session = session();
        $userModel = new UserModel();
        $user = $userModel->find($session->get('user_id'));
        
        return [
            'title' => 'Laporan - Kampus Berkelanjutan',
            'page' => $page,
            'breadcrumb' => 'Laporan',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_email' => $session->get('email'),
            'profile_photo' => $user['profile_photo'] ?? null
        ];
    }
}