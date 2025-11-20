<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Register extends Controller
{
    public function index()
    {
        return view('auth/register');
    }

    public function process()
    {
        $validation = \Config\Services::validation();

        // Aturan validasi
        $validation->setRules([
            'name' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'min_length' => 'Nama minimal 3 karakter'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Email tidak valid',
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 6 karakter'
                ]
            ],
            'role' => [
                'rules' => 'required|in_list[admin,dosen,kaprodi]',
                'errors' => [
                    'required' => 'Role harus dipilih',
                    'in_list' => 'Role tidak valid'
                ]
            ]
        ]);

        // Cek validasi
        if (!$validation->withRequest($this->request)->run()) {
            return view('auth/register', [
                'validation' => $validation
            ]);
        }

        // Simpan data ke database
        $userModel = new UserModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($userModel->insert($data)) {
            session()->setFlashdata('success', 'Registrasi berhasil! Silakan login.');
            return redirect()->to('/login');
        } else {
            session()->setFlashdata('error', 'Registrasi gagal. Silakan coba lagi.');
            return redirect()->back()->withInput();
        }
    }
}
