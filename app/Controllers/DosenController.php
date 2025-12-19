<?php

namespace App\Controllers;

class DosenController extends BaseController
{
    public function statusPengajuan()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'dosen') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        $data = [
            'title' => 'Status Pengajuan - Dosen',
            'page' => 'status-pengajuan',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_unit' => $user['unit'] ?? null,
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('dosen/status_pengajuan', $data);
    }

    public function riwayatData()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'dosen') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        $data = [
            'title' => 'Riwayat Data - Dosen',
            'page' => 'riwayat-data',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_unit' => $user['unit'] ?? null,
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('dosen/riwayat_data', $data);
    }
}
