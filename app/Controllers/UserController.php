<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        // Get users with prodi information
        $db = \Config\Database::connect();
        $users = $db->table('users u')
            ->select('u.*, p.nama_prodi, p.jenjang')
            ->join('prodi p', 'u.prodi_id = p.id', 'left')
            ->orderBy('u.created_at', 'DESC')
            ->get()
            ->getResultArray();

        $data['users'] = $users;

        // Get current user data including profile photo
        $currentUser = $userModel->find(session()->get('user_id'));
        $data['profile_photo'] = $currentUser['profile_photo'] ?? null;

        // Add user session data for sidebar
        $data = array_merge($data, $this->getSidebarData('users'));
        $data['title'] = 'Manajemen User - Kampus Berkelanjutan';
        $data['breadcrumb'] = 'Manajemen User';

        return view('users/index', $data);
    }

    // Method approval dihapus - tidak ada sistem registrasi

    // Semua method approval dihapus - tidak ada sistem registrasi

    public function delete($id)
    {
        $userModel = new UserModel();

        $user = $userModel->find($id);
        if (!$user) {
            return redirect()->to('/users')->with('error', 'User tidak ditemukan');
        }

        if ($id == session()->get('user_id')) {
            return redirect()->to('/users')->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        $userModel->delete($id);
        return redirect()->to('/users')->with('success', 'User berhasil dihapus');
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/users')->with('error', 'User tidak ditemukan');
        }

        // Get prodi data for dropdown
        $db = \Config\Database::connect();
        $prodi = $db->table('prodi')
            ->where('is_active', 1)
            ->orderBy('jenjang', 'ASC')
            ->orderBy('nama_prodi', 'ASC')
            ->get()
            ->getResultArray();

        $data = array_merge($this->getSidebarData('users'), [
            'user' => $user,
            'prodi' => $prodi,
            'title' => 'Edit User - Kampus Berkelanjutan'
        ]);

        return view('users/edit', $data);
    }

    public function update($id)
    {
        helper(['form']);
        $userModel = new UserModel();

        $rules = [
            'name' => 'required|min_length[3]',
            'email' => "required|valid_email|is_unique[users.email,id,{$id}]",
            'role' => 'required'
        ];

        // Conditional validation based on role
        $role = $this->request->getVar('role');
        if ($role === 'admin_unit') {
            $rules['unit'] = 'required';
        }
        if (in_array($role, ['kaprodi', 'dosen'])) {
            $rules['prodi_id'] = 'required|is_natural_no_zero';
        }

        // Validasi password jika diisi
        $newPassword = $this->request->getVar('new_password');
        $confirmPassword = $this->request->getVar('confirm_password');

        if (!empty($newPassword)) {
            $rules['new_password'] = 'required|min_length[6]';
            $rules['confirm_password'] = 'required|matches[new_password]';
        }

        if (!$this->validate($rules)) {
            // Get prodi data for dropdown
            $db = \Config\Database::connect();
            $prodi = $db->table('prodi')
                ->where('is_active', 1)
                ->orderBy('jenjang', 'ASC')
                ->orderBy('nama_prodi', 'ASC')
                ->get()
                ->getResultArray();

            $data = array_merge($this->getSidebarData('users'), [
                "validation" => $this->validator,
                "user" => $userModel->find($id),
                'prodi' => $prodi,
                'title' => 'Edit User - Kampus Berkelanjutan'
            ]);
            return view('users/edit', $data);
        }

        // Data yang akan diupdate
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'role' => $role
        ];

        // Reset conditional fields first
        $data['unit'] = null;
        $data['prodi_id'] = null;
        $data['jurusan'] = null; // Keep for backward compatibility

        // Add conditional fields based on role
        if ($role === 'admin_unit') {
            $data['unit'] = $this->request->getVar('unit');
        }
        if (in_array($role, ['kaprodi', 'dosen'])) {
            $data['prodi_id'] = $this->request->getVar('prodi_id');
        }

        // Tambahkan password jika diisi
        if (!empty($newPassword)) {
            $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $userModel->update($id, $data);

        return redirect()->to('/users')->with('success', 'User berhasil diperbarui');
    }

    // 🟢 Tambahkan method create dan store di sini, sebelum kurung penutup kelas
    public function create()
    {
        helper(['form']);

        // Get current user data for profile photo
        $userModel = new UserModel();
        $currentUser = $userModel->find(session()->get('user_id'));

        // Get prodi data for dropdown
        $db = \Config\Database::connect();
        $prodi = $db->table('prodi')
            ->where('is_active', 1)
            ->orderBy('jenjang', 'ASC')
            ->orderBy('nama_prodi', 'ASC')
            ->get()
            ->getResultArray();

        $data = array_merge($this->getSidebarData('users'), [
            'title' => 'Tambah User - Kampus Berkelanjutan',
            'prodi' => $prodi
        ]);

        return view('users/create', $data);
    }

    public function store()
    {
        helper(['form']);
        $userModel = new UserModel();

        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'role' => 'required'
        ];

        // Conditional validation based on role
        $role = $this->request->getVar('role');
        if ($role === 'admin_unit') {
            $rules['unit'] = 'required';
        }
        if (in_array($role, ['kaprodi', 'dosen'])) {
            $rules['prodi_id'] = 'required|is_natural_no_zero';
        }

        if (!$this->validate($rules)) {
            // Get prodi data for dropdown
            $db = \Config\Database::connect();
            $prodi = $db->table('prodi')
                ->where('is_active', 1)
                ->orderBy('jenjang', 'ASC')
                ->orderBy('nama_prodi', 'ASC')
                ->get()
                ->getResultArray();

            $data = array_merge($this->getSidebarData('users'), [
                'validation' => $this->validator,
                'title' => 'Tambah User - Kampus Berkelanjutan',
                'prodi' => $prodi
            ]);
            return view('users/create', $data);
        }

        // Prepare data for insertion
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'role' => $role,
            'approval_status' => 'approved', // Otomatis disetujui ketika dibuat oleh admin
            'is_active' => 1
        ];

        // Add conditional fields based on role
        if ($role === 'admin_unit') {
            $data['unit'] = $this->request->getVar('unit');
        }
        if (in_array($role, ['kaprodi', 'dosen'])) {
            $data['prodi_id'] = $this->request->getVar('prodi_id');
        }

        $userModel->insert($data);

        return redirect()->to('/users')->with('success', 'User berhasil ditambahkan dan langsung diaktifkan');
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
            'page' => $page,
            'breadcrumb' => ucfirst(str_replace('_', ' ', $page)),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_email' => $session->get('email'),
            'profile_photo' => $user['profile_photo'] ?? null
        ];
    }
} // ✅ pastikan ini menutup class
