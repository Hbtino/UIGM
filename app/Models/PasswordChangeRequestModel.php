<?php

namespace App\Models;

use CodeIgniter\Model;

class PasswordChangeRequestModel extends Model
{
    protected $table = 'password_change_requests';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'new_password',
        'status',
        'requested_at',
        'processed_at',
        'processed_by',
        'notes'
    ];
    protected $useTimestamps = false;
    
    public function getPendingRequests()
    {
        return $this->select('password_change_requests.*, users.name, users.email, users.role')
                    ->join('users', 'users.id = password_change_requests.user_id')
                    ->where('password_change_requests.status', 'pending')
                    ->orderBy('password_change_requests.requested_at', 'DESC')
                    ->findAll();
    }
    
    public function getPendingCount()
    {
        return $this->where('status', 'pending')->countAllResults();
    }
    
    public function getUserRequests($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('requested_at', 'DESC')
                    ->findAll();
    }
}
