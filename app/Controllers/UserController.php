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

        // Cek apakah user dengan ID tersebut ada
        $user = $userModel->find($id);
        if (!$user) {
            return redirect()->to('/users')->with('error', 'User tidak ditemukan');
        }

        // Cegah hapus diri sendiri
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
}
