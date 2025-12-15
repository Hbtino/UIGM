<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = service('session');

        // Auto-login from remember me cookie
        $this->checkRememberMe();
    }

    /**
     * Check and auto-login from remember me cookie
     */
    protected function checkRememberMe()
    {
        // Skip if already logged in
        if (session()->get('logged_in')) {
            return;
        }

        // Check for remember me cookie
        if (isset($_COOKIE['remember_token']) && isset($_COOKIE['user_id'])) {
            $userModel = new \App\Models\UserModel();
            $userId = $_COOKIE['user_id'];
            $token = $_COOKIE['remember_token'];

            $user = $userModel->find($userId);

            // Validate: user exists, has token, token matches, token is not empty, and token is active
            if (
                $user &&
                !empty($user['remember_token']) &&
                $user['remember_token'] === $token &&
                isset($user['remember_token_active']) &&
                $user['remember_token_active'] == 1
            ) {
                // Check if token is not expired
                if (
                    isset($user['remember_token_expires']) &&
                    !empty($user['remember_token_expires']) &&
                    strtotime($user['remember_token_expires']) > time()
                ) {
                    // All checks passed, set session
                    $sessionData = [
                        'user_id' => $user['id'],
                        'user_name' => $user['name'],
                        'name'    => $user['name'],
                        'email'   => $user['email'],
                        'user_role' => $user['role'],
                        'role'    => $user['role'],
                        'logged_in' => true
                    ];
                    session()->set($sessionData);
                } else {
                    // Token expired or not set, clear cookies and deactivate token
                    $this->clearRememberCookies();
                    $this->deactivateRememberToken($userId);
                }
            } else {
                // Invalid token, token is NULL, or token is inactive - clear cookies
                $this->clearRememberCookies();
                if ($user && $userId) {
                    $this->deactivateRememberToken($userId);
                }
            }
        }
    }

    /**
     * Clear remember me cookies
     */
    protected function clearRememberCookies()
    {
        // Method 1: Using setcookie with past expiration
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/');
            unset($_COOKIE['remember_token']);
        }
        if (isset($_COOKIE['user_id'])) {
            setcookie('user_id', '', time() - 3600, '/');
            unset($_COOKIE['user_id']);
        }

        // Method 2: Using CodeIgniter helper as backup
        helper('cookie');
        delete_cookie('remember_token');
        delete_cookie('user_id');
    }

    /**
     * Deactivate remember token in database
     */
    protected function deactivateRememberToken($userId)
    {
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
    }

    /**
     * Get standardized sidebar data for all controllers
     * This ensures consistent variable names across all views
     */
    protected function getSidebarData($page = '')
    {
        $session = session();
        $userModel = new \App\Models\UserModel();

        // Get current user data
        $user = null;
        if ($session->get('user_id')) {
            $user = $userModel->find($session->get('user_id'));
        }

        return [
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'), // Standardized to 'role'
            'user_email' => $session->get('email'),
            'profile_photo' => $user['profile_photo'] ?? null,
            'page' => $page
        ];
    }

    /**
     * Get consistent user data for all views
     */
    protected function getUserData($page = '')
    {
        $session = session();
        $userModel = new \App\Models\UserModel();

        // Get current user data
        $user = null;
        if ($session->get('user_id')) {
            $user = $userModel->find($session->get('user_id'));
        }

        return [
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_email' => $session->get('email'),
            'profile_photo' => $user['profile_photo'] ?? null,
            'page' => $page
        ];
    }
}
