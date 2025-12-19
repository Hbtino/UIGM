<?php

namespace App\Controllers;

class AdminUnitController extends BaseController
{
    public function uploadBukti()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'admin_unit') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        $data = [
            'title' => 'Upload Bukti - Admin Unit',
            'page' => 'upload-bukti',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_unit' => $user['unit'] ?? null,
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('admin_unit/upload_bukti', $data);
    }

    public function statusData()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'admin_unit') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        $data = [
            'title' => 'Status Data - Admin Unit',
            'page' => 'status-data',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_unit' => $user['unit'] ?? null,
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('admin_unit/status_data', $data);
    }

    public function laporanUnit()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'admin_unit') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        $data = [
            'title' => 'Laporan Unit - Admin Unit',
            'page' => 'laporan-unit',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_unit' => $user['unit'] ?? null,
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('admin_unit/laporan_unit', $data);
    }
}
