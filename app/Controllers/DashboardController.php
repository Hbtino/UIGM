<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $role = $session->get('role');

        if ($role == 'admin') {
            return view('dashboard/admin');
        } elseif ($role == 'kaprodi') {
            return view('dashboard/kaprodi');
        } elseif ($role == 'dosen') {
            return view('dashboard/dosen');
        } else {
            return redirect()->to('/logout');
        }
    }
}
