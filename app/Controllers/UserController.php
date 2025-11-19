<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        $data['pending_count'] = $userModel->where('approval_status', 'pending')->countAllResults();
        
        // Get current user data including profile photo
        $currentUser = $userModel->find(session()->get('user_id'));
        $data['profile_photo'] = $currentUser['profile_photo'] ?? null;

        return view('users/index', $data);
    }
    
    public function pendingApprovals()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->where('approval_status', 'pending')->findAll();
        $data['pending_count'] = count($data['users']);

        return view('users/pending_approvals', $data);
    }
    
    public function approve($id)
    {
        $session = session();
        if ($session->get('role') != 'admin') {
            return redirect()->to('/users')->with('error', 'Hanya admin yang dapat menyetujui user');
        }
        
        $userModel = new UserModel();
        $user = $userModel->find($id);
        
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }
        
        $userModel->update($id, [
            'approval_status' => 'approved',
            'approved_by' => $session->get('user_id'),
            'approved_at' => date('Y-m-d H:i:s')
        ]);
        
        return redirect()->back()->with('success', 'User berhasil disetujui');
    }
    
    public function reject($id)
    {
        $session = session();
        if ($session->get('role') != 'admin') {
            return redirect()->to('/users')->with('error', 'Hanya admin yang dapat menolak user');
        }
        
        $userModel = new UserModel();
        $user = $userModel->find($id);
        
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }
        
        $reason = $this->request->getPost('rejection_reason') ?? 'Tidak memenuhi kriteria';
        
        $userModel->update($id, [
            'approval_status' => 'rejected',
            'approved_by' => $session->get('user_id'),
            'approved_at' => date('Y-m-d H:i:s'),
            'rejection_reason' => $reason
        ]);
        
        return redirect()->back()->with('success', 'User berhasil ditolak');
    }
    
    public function getPendingCount()
    {
        $userModel = new UserModel();
        $count = $userModel->where('approval_status', 'pending')->countAllResults();
        
        return $this->response->setJSON(['count' => $count]);
    }

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

        return view('users/edit', ['user' => $user]);
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
            return view('users/edit', [
                "validation" => $this->validator,
                "user" => $userModel->find($id)
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
        return view('users/create');
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
            return view('users/create', [
                'validation' => $this->validator
            ]);
        }

        $userModel->insert([
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'role' => $this->request->getVar('role'),
            'jurusan' => $this->request->getVar('jurusan'),
            'approval_status' => 'approved', // Langsung approved jika ditambahkan oleh admin
            'approved_by' => session()->get('user_id'),
            'approved_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/users')->with('success', 'User berhasil ditambahkan dan langsung diaktifkan');
    }
} // ✅ pastikan ini menutup class
