<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PasswordChangeRequestModel;

class SettingsController extends BaseController
{
    protected $userModel;
    protected $passwordRequestModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->passwordRequestModel = new PasswordChangeRequestModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);
        $userRole = session()->get('role');

        // DEBUG: Log session values
        log_message('debug', 'Settings - Session role: ' . ($userRole ?? 'NULL'));

        // Get user's password change requests
        $requests = $this->passwordRequestModel->getUserRequests($userId);

        $data = array_merge($this->getSidebarData('settings'), [
            'title' => 'Pengaturan',
            'user' => $user,
            'requests' => $requests
        ]);

        // Check if user is regular user (not admin/dosen/kaprodi/reviewer)
        $isRegularUser = in_array($userRole, ['user', 'staff']);

        if ($isRegularUser) {
            // User biasa - tampilkan view sederhana
            return view('settings/user', $data);
        }

        // Admin/Dosen/Kaprodi/Reviewer - tampilkan view lengkap
        return view('settings/index', $data);
    }

    public function updateProfile()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $userId = session()->get('user_id');
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');

        // Check if email already exists for other users
        $existingUser = $this->userModel->where('email', $email)
            ->where('id !=', $userId)
            ->first();

        if ($existingUser) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Email sudah digunakan oleh user lain'
            ]);
        }

        // Update user data
        $data = [
            'name' => $name,
            'email' => $email
        ];

        if ($this->userModel->update($userId, $data)) {
            // Update session
            session()->set([
                'user_name' => $name,
                'name' => $name,
                'email' => $email
            ]);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Profil berhasil diperbarui'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal memperbarui profil'
        ]);
    }

    public function uploadPhoto()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $file = $this->request->getFile('profile_photo');

        if (!$file->isValid()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'File tidak valid'
            ]);
        }

        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Format file tidak didukung. Gunakan JPG atau PNG'
            ]);
        }

        // Validate file size (max 10MB)
        if ($file->getSize() > 10 * 1024 * 1024) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Ukuran file terlalu besar. Maksimal 10MB'
            ]);
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        // Delete old photo if exists
        if (!empty($user['profile_photo'])) {
            $oldPhotoPath = FCPATH . 'uploads/profiles/' . $user['profile_photo'];
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }

        // Create uploads directory if not exists
        $uploadPath = FCPATH . 'uploads/profiles/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Generate unique filename
        $newName = 'profile_' . $userId . '_' . time() . '.' . $file->getExtension();

        // Move file
        if ($file->move($uploadPath, $newName)) {
            // Update database
            $this->userModel->update($userId, ['profile_photo' => $newName]);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Foto profil berhasil diupload'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal mengupload foto'
        ]);
    }

    public function deletePhoto()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!empty($user['profile_photo'])) {
            $photoPath = FCPATH . 'uploads/profiles/' . $user['profile_photo'];
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }

            // Update database
            $this->userModel->update($userId, ['profile_photo' => null]);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Foto profil berhasil dihapus'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Tidak ada foto untuk dihapus'
        ]);
    }

    public function requestPasswordChange()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $userRole = session()->get('role');
        if ($userRole === 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Admin tidak perlu request ganti password']);
        }

        $rules = [
            'new_password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[new_password]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $userId = session()->get('user_id');
        $newPassword = $this->request->getPost('new_password');

        // Check if there's already a pending request
        $pendingRequest = $this->passwordRequestModel
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->first();

        if ($pendingRequest) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Anda masih memiliki request yang belum diproses'
            ]);
        }

        // Create new request
        $data = [
            'user_id' => $userId,
            'new_password' => password_hash($newPassword, PASSWORD_DEFAULT),
            'status' => 'pending',
            'requested_at' => date('Y-m-d H:i:s')
        ];

        if ($this->passwordRequestModel->insert($data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Request ganti password berhasil dikirim. Menunggu persetujuan admin.'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal mengirim request'
        ]);
    }

    public function getPendingPasswordRequests()
    {
        // Debug logging
        log_message('debug', 'getPendingPasswordRequests called');
        log_message('debug', 'Session logged_in: ' . (session()->get('logged_in') ? 'true' : 'false'));
        log_message('debug', 'Session user_role: ' . session()->get('role'));

        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            log_message('debug', 'Unauthorized access attempt');
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $requests = $this->passwordRequestModel->getPendingRequests();
        log_message('debug', 'Pending password requests count: ' . count($requests));
        log_message('debug', 'Requests data: ' . json_encode($requests));

        $response = [
            'success' => true,
            'requests' => $requests,
            'count' => count($requests)
        ];

        log_message('debug', 'Response: ' . json_encode($response));

        return $this->response->setJSON($response);
    }

    public function passwordRequests()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $requests = $this->passwordRequestModel->getPendingRequests();

        // Get user data for profile photo
        $user = $this->userModel->find(session()->get('user_id'));

        $data = array_merge([
            'title' => 'Password Change Requests',
            'requests' => $requests
        ], $this->getSidebarData('password-requests'));

        return view('settings/password_requests', $data);
    }

    public function processPasswordRequest($requestId)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $action = $this->request->getPost('action'); // 'approve' or 'reject'
        $notes = $this->request->getPost('notes');

        $request = $this->passwordRequestModel->find($requestId);
        if (!$request) {
            return $this->response->setJSON(['success' => false, 'message' => 'Request tidak ditemukan']);
        }

        if ($action === 'approve') {
            // Update user password
            $this->userModel->update($request['user_id'], [
                'password' => $request['new_password']
            ]);

            $status = 'approved';
            $message = 'Password berhasil diubah';
        } else {
            $status = 'rejected';
            $message = 'Request ditolak';
        }

        // Update request status
        $this->passwordRequestModel->update($requestId, [
            'status' => $status,
            'processed_at' => date('Y-m-d H:i:s'),
            'processed_by' => session()->get('user_id'),
            'notes' => $notes
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => $message
        ]);
    }

    public function checkPasswordChangeStatus()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $userId = session()->get('user_id');

        // Check for recently approved requests (within last 24 hours)
        $recentApproved = $this->passwordRequestModel
            ->where('user_id', $userId)
            ->where('status', 'approved')
            ->where('processed_at >=', date('Y-m-d H:i:s', strtotime('-24 hours')))
            ->orderBy('processed_at', 'DESC')
            ->first();

        if ($recentApproved) {
            return $this->response->setJSON([
                'success' => true,
                'has_notification' => true,
                'message' => 'Password Anda telah berhasil diubah oleh admin',
                'processed_at' => $recentApproved['processed_at']
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'has_notification' => false
        ]);
    }
}
