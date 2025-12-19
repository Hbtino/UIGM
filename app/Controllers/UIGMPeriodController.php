<?php

namespace App\Controllers;

class UIGMPeriodController extends BaseController
{
    public function index()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        $db = \Config\Database::connect();
        $periods = $db->table('uigm_periods')
            ->orderBy('year', 'DESC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Manajemen Tahun UIGM - Kampus Berkelanjutan',
            'page' => 'uigm-periods',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_unit' => $user['unit'] ?? null,
            'profile_photo' => $user['profile_photo'] ?? null,
            'periods' => $periods
        ];

        return view('uigm_periods/index', $data);
    }

    public function activate($id)
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $db = \Config\Database::connect();

        // Deactivate all periods
        $db->table('uigm_periods')->update(['is_active' => 0]);

        // Activate selected period
        $db->table('uigm_periods')->where('id', $id)->update(['is_active' => 1]);

        return redirect()->to('/uigm-periods')->with('success', 'Periode UIGM berhasil diaktifkan');
    }
}
