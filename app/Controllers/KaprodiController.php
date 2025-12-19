<?php

namespace App\Controllers;

class KaprodiController extends BaseController
{
    public function reviewDosen()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'kaprodi') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        $data = [
            'title' => 'Review Data Dosen - Kaprodi',
            'page' => 'review-dosen',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_unit' => $user['unit'] ?? null,
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('kaprodi/review_dosen', $data);
    }

    public function statistikProdi()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'kaprodi') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        $data = [
            'title' => 'Statistik Prodi - Kaprodi',
            'page' => 'statistik-prodi',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_unit' => $user['unit'] ?? null,
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('kaprodi/statistik_prodi', $data);
    }
}
