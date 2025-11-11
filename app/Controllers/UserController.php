<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();

        return view('users/index', $data);
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

        if (!$this->validate($rules)) {
            return view('users/edit', [
                "validation" => $this->validator,
                "user" => $userModel->find($id)
            ]);
        }

        $userModel->update($id, [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'role' => $this->request->getVar('role')
        ]);

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
            'role' => $this->request->getVar('role')
        ]);

        return redirect()->to('/users')->with('success', 'User berhasil ditambahkan');
    }
} // ✅ pastikan ini menutup class
