<?php

namespace App\Controllers;

class DebugSession extends BaseController
{
    public function index()
    {
        $session = session();

        $result = "=== SESSION DEBUG ===\n\n";
        $result .= "Session ID: " . $session->session_id . "\n";
        $result .= "Is Logged In: " . ($session->get('isLoggedIn') ? 'YES' : 'NO') . "\n";
        $result .= "Logged In: " . ($session->get('logged_in') ? 'YES' : 'NO') . "\n";
        $result .= "User ID: " . ($session->get('user_id') ?? 'NULL') . "\n";
        $result .= "Role: " . ($session->get('role') ?? 'NULL') . "\n";
        $result .= "Name: " . ($session->get('name') ?? 'NULL') . "\n";
        $result .= "Email: " . ($session->get('email') ?? 'NULL') . "\n";

        $result .= "\n=== ALL SESSION DATA ===\n";
        $result .= print_r($session->get(), true);

        return '<pre>' . $result . '</pre>';
    }
}
