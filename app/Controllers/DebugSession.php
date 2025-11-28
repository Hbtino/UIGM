<?php

namespace App\Controllers;

class DebugSession extends BaseController
{
    public function index()
    {
        echo "<h2>Debug Session & Cookies</h2>";
        
        echo "<h3>1. Session Data:</h3>";
        echo "<pre>";
        print_r(session()->get());
        echo "</pre>";
        
        echo "<h3>2. All Cookies:</h3>";
        echo "<pre>";
        print_r($_COOKIE);
        echo "</pre>";
        
        echo "<h3>3. Session Config:</h3>";
        $config = config('Session');
        echo "<pre>";
        echo "Driver: " . $config->driver . "\n";
        echo "Cookie Name: " . $config->cookieName . "\n";
        echo "Expiration: " . $config->expiration . " seconds\n";
        echo "Save Path: " . $config->savePath . "\n";
        echo "</pre>";
        
        echo "<h3>4. PHP Session Info:</h3>";
        echo "<pre>";
        echo "Session ID: " . session_id() . "\n";
        echo "Session Status: " . session_status() . "\n";
        echo "Session Cookie Params:\n";
        print_r(session_get_cookie_params());
        echo "</pre>";
        
        echo "<h3>5. User Info from Database:</h3>";
        if (session()->get('user_id')) {
            $userModel = new \App\Models\UserModel();
            $user = $userModel->find(session()->get('user_id'));
            echo "<pre>";
            echo "User ID: " . $user['id'] . "\n";
            echo "Name: " . $user['name'] . "\n";
            echo "Email: " . $user['email'] . "\n";
            echo "Remember Token: " . ($user['remember_token'] ?? 'NULL') . "\n";
            echo "Token Active: " . ($user['remember_token_active'] ?? 'NULL') . "\n";
            echo "Token Expires: " . ($user['remember_token_expires'] ?? 'NULL') . "\n";
            echo "</pre>";
        } else {
            echo "<p>No user logged in</p>";
        }
        
        echo "<hr>";
        echo "<a href='/logout'>Logout</a> | <a href='/dashboard'>Dashboard</a>";
    }
    
    public function clearAll()
    {
        // Clear all cookies
        foreach ($_COOKIE as $name => $value) {
            setcookie($name, '', time() - 3600, '/');
        }
        
        // Destroy session
        session()->destroy();
        
        echo "<h2>All cookies and session cleared!</h2>";
        echo "<a href='/login'>Go to Login</a>";
    }
}
