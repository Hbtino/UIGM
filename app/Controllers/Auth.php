<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        // Check if user is already logged in via session
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

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
                $db = \Config\Database::connect();

                // Handle Remember Me
                $remember = $this->request->getVar('remember');

                // Regenerate session ID for security
                $session->regenerate();

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

                if ($remember) {
                    // Check if user already has a token
                    if (!empty($user['remember_token'])) {
                        // Reactivate existing token
                        $token = $user['remember_token'];
                        $db->table('users')
                            ->where('id', $user['id'])
                            ->update([
                                'remember_token_active' => 1,
                                'remember_token_expires' => date('Y-m-d H:i:s', strtotime('+30 days'))
                            ]);
                    } else {
                        // Generate a new unique token
                        $token = bin2hex(random_bytes(32));

                        // Store token in database with active flag
                        $db->table('users')
                            ->where('id', $user['id'])
                            ->update([
                                'remember_token' => $token,
                                'remember_token_active' => 1,
                                'remember_token_expires' => date('Y-m-d H:i:s', strtotime('+30 days'))
                            ]);
                    }

                    // Set cookie for 30 days with httpOnly and secure flags
                    setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/', '', false, true);
                    setcookie('user_id', $user['id'], time() + (30 * 24 * 60 * 60), '/', '', false, true);
                } else {
                    // User did NOT check remember me - deactivate any existing remember token and clear cookies
                    $db->table('users')
                        ->where('id', $user['id'])
                        ->update(['remember_token_active' => 0]);

                    // Clear any existing remember me cookies
                    if (isset($_COOKIE['remember_token'])) {
                        setcookie('remember_token', '', time() - 3600, '/');
                        unset($_COOKIE['remember_token']);
                    }
                    if (isset($_COOKIE['user_id'])) {
                        setcookie('user_id', '', time() - 3600, '/');
                        unset($_COOKIE['user_id']);
                    }

                    // Also use CodeIgniter helper as backup
                    helper('cookie');
                    delete_cookie('remember_token');
                    delete_cookie('user_id');
                }

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
        $userId = session()->get('user_id');

        // Deactivate remember token (set active flag to 0) and clear token
        if ($userId) {
            $db = \Config\Database::connect();
            $db->table('users')
                ->where('id', $userId)
                ->update([
                    'remember_token_active' => 0,
                    'remember_token' => null,
                    'remember_token_expires' => null
                ]);
        }

        // Clear cookies - Method 1: Using setcookie with past expiration
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/');
            unset($_COOKIE['remember_token']);
        }
        if (isset($_COOKIE['user_id'])) {
            setcookie('user_id', '', time() - 3600, '/');
            unset($_COOKIE['user_id']);
        }

        // Clear cookies - Method 2: Using CodeIgniter helper as backup
        helper('cookie');
        delete_cookie('remember_token');
        delete_cookie('user_id');

        // Destroy session completely
        session()->destroy();

        // Start new session for flash message
        session()->start();
        session()->setFlashdata('success', 'Berhasil logout.');

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
