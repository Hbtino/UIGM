<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        // Check if user is already logged in via session
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        
        // Check for remember me cookie
        if (isset($_COOKIE['remember_token']) && isset($_COOKIE['user_id'])) {
            $this->autoLogin();
        }
        
        return view('login');
    }
    
    private function autoLogin()
    {
        $userModel = new UserModel();
        $userId = $_COOKIE['user_id'];
        $token = $_COOKIE['remember_token'];
        
        $user = $userModel->find($userId);
        
        if ($user && $user['remember_token'] === $token) {
            // Check if token is active
            if (!isset($user['remember_token_active']) || $user['remember_token_active'] != 1) {
                // Token is inactive, clear cookies
                $this->clearRememberCookies();
                return;
            }
            
            // Check if token is not expired
            if (strtotime($user['remember_token_expires']) > time()) {
                // Set session
                $sessionData = [
                    'user_id' => $user['id'],
                    'name'    => $user['name'],
                    'email'   => $user['email'],
                    'role'    => $user['role'],
                    'logged_in' => true
                ];
                session()->set($sessionData);
                
                // Redirect to dashboard
                return redirect()->to('/dashboard');
            } else {
                // Token expired, clear cookies
                $this->clearRememberCookies();
            }
        } else {
            // Invalid token, clear cookies
            $this->clearRememberCookies();
        }
    }
    
    private function clearRememberCookies()
    {
        helper('cookie');
        delete_cookie('remember_token');
        delete_cookie('user_id');
    }

    public function process()
    {
        $session = session();
        $userModel = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $remember = $this->request->getVar('remember'); // Get remember me checkbox

        $user = $userModel->where('email', $email)->first();

        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                $sessionData = [
                    'user_id' => $user['id'],
                    'name'    => $user['name'],
                    'email'   => $user['email'],
                    'role'    => $user['role'],
                    'logged_in' => true
                ];
                $session->set($sessionData);

                // Handle Remember Me
                if ($remember) {
                    $db = \Config\Database::connect();
                    
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
                }

                // Redirect sesuai role
                if ($user['role'] == 'admin') {
                    return redirect()->to('/dashboard/admin');
                } elseif ($user['role'] == 'reviewer') {
                    return redirect()->to('/dashboard/reviewer');
                } else {
                    return redirect()->to('/dashboard/staff');
                }

            } else {
                return redirect()->back()->with('error', 'Password salah!');
            }
        } else {
            return redirect()->back()->with('error', 'Email tidak ditemukan!');
        }
    }


}
