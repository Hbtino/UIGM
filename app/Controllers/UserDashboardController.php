<?php

namespace App\Controllers;

use App\Models\WasteManagementModel;
use App\Models\UserModel;

class UserDashboardController extends BaseController
{
    protected $wasteModel;
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->wasteModel = new WasteManagementModel();
        $this->userModel = new UserModel();
        $this->session = session();
        helper(['form', 'url']);
    }

    /**
     * Halaman dashboard utama user
     */
    public function index()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Cek apakah user adalah user biasa
        if ($this->session->get('role') !== 'user') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak. Halaman ini khusus untuk User.');
        }

        // Ambil data user untuk foto profil
        $user = $this->userModel->find($this->session->get('user_id'));

        // Ambil statistik user
        $statistics = $this->getUserStatistics();

        $data = [
            'title' => 'Dashboard User - UIGM',
            'page' => 'dashboard-user',
            'breadcrumb' => 'Dashboard / User',
            'user_name' => $this->session->get('name'),
            'user_role' => $this->session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null,
            'statistics' => $statistics,
        ];

        return view('user/dashboard/index', $data);
    }

    /**
     * Halaman form input pengelolaan limbah
     */
    public function wasteManagement()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Cek apakah user adalah user biasa
        if ($this->session->get('role') !== 'user') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak. Halaman ini khusus untuk User.');
        }

        // Ambil data user untuk foto profil
        $user = $this->userModel->find($this->session->get('user_id'));

        $data = [
            'title' => 'Input Data Pengelolaan Limbah - User',
            'page' => 'waste-management-input',
            'breadcrumb' => 'Dashboard / User / Pengelolaan Limbah',
            'user_name' => $this->session->get('name'),
            'user_role' => $this->session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null,
            'validation' => \Config\Services::validation(),
        ];

        return view('user/waste_management/input', $data);
    }

    /**
     * Simpan data input pengelolaan limbah
     */
    public function storeWasteData()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Validasi input
        $rules = [
            'tanggal' => 'required|valid_date',
            'jenis_sampah' => 'required|in_list[sampah_anorganik_bersih,sampah_anorganik_kotor,sampah_organik,limbah_air,limbah_b3]',
            'jumlah' => 'required|decimal|greater_than[0]',
            'satuan' => 'required|in_list[kg,liter]',
            'gedung' => 'required|min_length[3]|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data dari form
        $tanggal = $this->request->getPost('tanggal');
        $jenisSampah = $this->request->getPost('jenis_sampah');
        $jumlah = floatval($this->request->getPost('jumlah'));
        $satuan = $this->request->getPost('satuan');
        $gedung = $this->request->getPost('gedung');

        // Validasi satuan berdasarkan jenis sampah
        if (($jenisSampah == 'sampah_anorganik_bersih' || $jenisSampah == 'sampah_anorganik_kotor' || $jenisSampah == 'sampah_organik') && $satuan != 'kg') {
            return redirect()->back()->withInput()->with('error', 'Sampah anorganik dan organik harus menggunakan satuan kg');
        }

        if ($jenisSampah == 'limbah_air' && $satuan != 'liter') {
            return redirect()->back()->withInput()->with('error', 'Limbah air harus menggunakan satuan liter');
        }

        // Siapkan data untuk disimpan
        $data = [
            'tanggal_input' => $tanggal,
            'jenis_sampah' => $jenisSampah,
            'jumlah' => $jumlah,
            'satuan' => $satuan,
            'gedung' => $gedung,
            'status_verifikasi' => 'pending',
            'created_by' => $this->session->get('user_id'),
        ];

        // Simpan ke database
        if ($this->wasteModel->insertUserInput($data)) {
            return redirect()->to('/user-dashboard/waste-management')->with('success', 'Data berhasil disimpan dan menunggu verifikasi');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data');
        }
    }

    /**
     * Halaman pengaturan user
     */
    public function settings()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Cek apakah user adalah user biasa
        if ($this->session->get('role') !== 'user') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak. Halaman ini khusus untuk User.');
        }

        // Ambil data user
        $user = $this->userModel->find($this->session->get('user_id'));

        // Ambil statistik user
        $statistics = $this->getUserStatistics();

        $data = [
            'title' => 'Pengaturan User',
            'page' => 'settings',
            'breadcrumb' => 'Dashboard / User / Pengaturan',
            'user_name' => $this->session->get('name'),
            'user_role' => $this->session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null,
            'user_data' => $user,
            'statistics' => $statistics,
            'validation' => \Config\Services::validation(),
        ];

        return view('user/settings/index', $data);
    }

    /**
     * Logout user
     */
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login')->with('success', 'Berhasil logout');
    }

    /**
     * Get statistics untuk user
     */
    private function getUserStatistics()
    {
        $userId = $this->session->get('user_id');

        // Query untuk mendapatkan statistik dari tabel user_waste_inputs
        $db = \Config\Database::connect();

        // Total input dari user ini
        $totalInput = $db->table('user_waste_inputs')
            ->where('created_by', $userId)
            ->countAllResults();

        // Data pending
        $pending = $db->table('user_waste_inputs')
            ->where('created_by', $userId)
            ->where('status_verifikasi', 'pending')
            ->countAllResults();

        // Data approved
        $approved = $db->table('user_waste_inputs')
            ->where('created_by', $userId)
            ->where('status_verifikasi', 'approved')
            ->countAllResults();

        // Data rejected
        $rejected = $db->table('user_waste_inputs')
            ->where('created_by', $userId)
            ->where('status_verifikasi', 'rejected')
            ->countAllResults();

        return [
            'total_input' => $totalInput,
            'pending' => $pending,
            'approved' => $approved,
            'rejected' => $rejected
        ];
    }
}
