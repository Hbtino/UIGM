<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginProcess()
    {
        $session = session();
        $userModel = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $userModel->where('email', $email)->first();

        if ($user) {
            // Admin and Reviewer can ALWAYS login (bypass approval check)
            $bypassRoles = ['admin', 'reviewer'];
            
            // Check approval status ONLY for non-admin/reviewer users
            if (!in_array($user['role'], $bypassRoles)) {
                if (isset($user['approval_status'])) {
                    if ($user['approval_status'] == 'pending') {
                        $session->setFlashdata('warning', 'Akun Anda masih menunggu persetujuan admin. Silakan hubungi administrator.');
                        return redirect()->to('/login');
                    }
                    
                    if ($user['approval_status'] == 'rejected') {
                        $reason = $user['rejection_reason'] ? ': ' . $user['rejection_reason'] : '';
                        $session->setFlashdata('error', 'Akun Anda ditolak oleh admin' . $reason);
                        return redirect()->to('/login');
                    }
                }
            }
            
            if (password_verify($password, $user['password'])) {
                $sessionData = [
                    'user_id' => $user['id'],
                    'user_name' => $user['name'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'user_role' => $user['role'],
                    'role' => $user['role'],
                    'logged_in' => true
                ];
                $session->set($sessionData);
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('error', 'Password salah');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'Email tidak ditemukan');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
    public function register()
    {
        helper(['form']);

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'name' => 'required|min_length[3]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'role' => 'required'
            ];

            if (!$this->validate($rules)) {
                return view('auth/register', [
                    "validation" => $this->validator
                ]);
            }

            $userModel = new \App\Models\UserModel();
            $userModel->save([
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getVar('role'),
                'approval_status' => 'pending' // Set as pending by default
            ]);

            return redirect()->to('/login')->with('info', 'Registrasi berhasil! Akun Anda menunggu persetujuan admin. Anda akan dapat login setelah admin menyetujui akun Anda.');
        }

        return view('auth/register');
    }


    public function registerProcess()
    {
        $userModel = new UserModel();

        // Validasi password confirmation
        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');

        if ($password !== $passwordConfirm) {
            return redirect()->back()->withInput()->with('error', 'Password dan konfirmasi password tidak cocok!');
        }

        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => 'mahasiswa', // Default role untuk registrasi baru
            'approval_status' => 'pending'
        ];

        $userModel->save($data);

        return redirect()->to('/login')->with('info', 'Registrasi berhasil! Akun Anda menunggu persetujuan admin.');
    }

}
