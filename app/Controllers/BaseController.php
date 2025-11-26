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
            
            if ($user && isset($user['remember_token']) && $user['remember_token'] === $token) {
                // Check if token is active
                if (!isset($user['remember_token_active']) || $user['remember_token_active'] != 1) {
                    // Token is inactive, clear cookies
                    $this->clearRememberCookies();
                    return;
                }
                
                // Check if token is not expired
                if (isset($user['remember_token_expires']) && strtotime($user['remember_token_expires']) > time()) {
                    // Set session
                    $sessionData = [
                        'user_id' => $user['id'],
                        'name'    => $user['name'],
                        'email'   => $user['email'],
                        'role'    => $user['role'],
                        'logged_in' => true
                    ];
                    session()->set($sessionData);
                } else {
                    // Token expired, clear cookies
                    $this->clearRememberCookies();
                }
            } else {
                // Invalid token, clear cookies
                $this->clearRememberCookies();
            }
        }
    }
    
    /**
     * Clear remember me cookies
     */
    protected function clearRememberCookies()
    {
        helper('cookie');
        delete_cookie('remember_token');
        delete_cookie('user_id');
    }
}
