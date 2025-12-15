<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        // Sistem approval dihapus

        // Get current user data including profile photo
        $currentUser = $userModel->find(session()->get('user_id'));
        $data['profile_photo'] = $currentUser['profile_photo'] ?? null;

        // Add user session data for sidebar
        $data = array_merge($data, $this->getSidebarData('users'));
        $data['title'] = 'Manajemen User - Kampus Berkelanjutan';

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

        // Get current user data for profile photo
        $currentUser = $userModel->find(session()->get('user_id'));

        $data = array_merge($this->getSidebarData('users'), [
            'user' => $user,
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

        // Validasi password jika diisi
        $newPassword = $this->request->getVar('new_password');
        $confirmPassword = $this->request->getVar('confirm_password');

        if (!empty($newPassword)) {
            $rules['new_password'] = 'required|min_length[6]';
            $rules['confirm_password'] = 'required|matches[new_password]';
        }

        if (!$this->validate($rules)) {
            // Get current user data for profile photo
            $currentUser = $userModel->find(session()->get('user_id'));

            return view('users/edit', [
                "validation" => $this->validator,
                "user" => $userModel->find($id),
                'title' => 'Edit User - Kampus Berkelanjutan',
                'page' => 'users',

            ]);
        }

        // Data yang akan diupdate
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'role' => $this->request->getVar('role'),
            'jurusan' => $this->request->getVar('jurusan')
        ];

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

        $data = [
            'title' => 'Tambah User - Kampus Berkelanjutan',
            'page' => 'users',

        ];

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

        if (!$this->validate($rules)) {
            // Get current user data for profile photo
            $currentUser = $userModel->find(session()->get('user_id'));

            return view('users/create', [
                'validation' => $this->validator,
                'title' => 'Tambah User - Kampus Berkelanjutan',
                'page' => 'users',

            ]);
        }

        $userModel->insert([
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'role' => $this->request->getVar('role'),
            'jurusan' => $this->request->getVar('jurusan'),
            'approval_status' => 'approved' // Otomatis disetujui ketika dibuat oleh admin
        ]);

        return redirect()->to('/users')->with('success', 'User berhasil ditambahkan dan langsung diaktifkan');
    }
} // ✅ pastikan ini menutup class
