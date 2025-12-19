<?php

namespace App\Controllers;

class ApprovalController extends BaseController
{
    public function index()
    {
        // Cek session login
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Only admin can access
        if ($session->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        // Get user data
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        // Get pending approvals from all categories
        $db = \Config\Database::connect();

        $pendingApprovals = [];

        // Categories to check
        $categories = [
            'setting_infrastructure' => 'Setting & Infrastructure',
            'energy_climate' => 'Energy & Climate',
            'water_management' => 'Water Management',
            'waste_management' => 'Waste Management',
            'transportation' => 'Transportation',
            'education_research' => 'Education & Research'
        ];

        foreach ($categories as $table => $label) {
            $query = $db->table($table . ' t')
                ->select('t.*, u.name as user_name')
                ->join('users u', 't.user_id = u.id', 'left')
                ->where('t.status', 'submitted')
                ->orderBy('t.updated_at', 'DESC')
                ->get();

            $results = $query->getResultArray();

            foreach ($results as $result) {
                $result['category'] = $table;
                $result['category_label'] = $label;
                $pendingApprovals[] = $result;
            }
        }

        // Sort by updated_at
        usort($pendingApprovals, function ($a, $b) {
            return strtotime($b['updated_at']) - strtotime($a['updated_at']);
        });

        $data = [
            'title' => 'Approval Final - Kampus Berkelanjutan',
            'page' => 'approval-final',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_unit' => $user['unit'] ?? null,
            'profile_photo' => $user['profile_photo'] ?? null,
            'pendingApprovals' => $pendingApprovals
        ];

        return view('approval/index', $data);
    }

    public function review($category, $id)
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $db = \Config\Database::connect();

        // Get data from specific category
        $data = $db->table($category . ' t')
            ->select('t.*, u.name as user_name, u.email as user_email')
            ->join('users u', 't.user_id = u.id', 'left')
            ->where('t.id', $id)
            ->get()
            ->getRowArray();

        if (!$data) {
            return redirect()->to('/approval-final')->with('error', 'Data tidak ditemukan');
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        $viewData = [
            'title' => 'Review Data - Approval Final',
            'page' => 'approval-final',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'user_unit' => $user['unit'] ?? null,
            'profile_photo' => $user['profile_photo'] ?? null,
            'data' => $data,
            'category' => $category
        ];

        return view('approval/review', $viewData);
    }

    public function approve($category, $id)
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $db = \Config\Database::connect();

        $updateData = [
            'status' => 'approved',
            'approved_by' => $session->get('user_id'),
            'approved_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $db->table($category)->where('id', $id)->update($updateData);

        // Log activity
        helper('permission');
        logUserActivity('approve', $category, $id, 'Approved data in final approval');

        return redirect()->to('/approval-final')->with('success', 'Data berhasil disetujui');
    }

    public function reject($category, $id)
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $reason = $this->request->getPost('reason');
        if (empty($reason)) {
            return redirect()->back()->with('error', 'Alasan penolakan harus diisi');
        }

        $db = \Config\Database::connect();

        $updateData = [
            'status' => 'rejected',
            'approved_by' => $session->get('user_id'),
            'approved_at' => date('Y-m-d H:i:s'),
            'rejection_reason' => $reason,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $db->table($category)->where('id', $id)->update($updateData);

        // Log activity
        helper('permission');
        logUserActivity('reject', $category, $id, 'Rejected data in final approval: ' . $reason);

        return redirect()->to('/approval-final')->with('success', 'Data berhasil ditolak');
    }

    public function finalize($category)
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $db = \Config\Database::connect();

        // Finalize all approved data in category
        $updateData = [
            'status' => 'finalized',
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $affected = $db->table($category)
            ->where('status', 'approved')
            ->update($updateData);

        // Log activity
        helper('permission');
        logUserActivity('finalize', $category, null, "Finalized {$affected} records in {$category}");

        return redirect()->to('/approval-final')->with('success', "Berhasil memfinalisasi {$affected} data di kategori {$category}");
    }
}
