<?php

namespace App\Models;

use CodeIgniter\Model;

class WaterManagementRevisionModel extends Model
{
    protected $table            = 'water_management_revisions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'water_management_id',
        'revision_type',
        'requested_by',
        'alasan_revisi',
        'data_revisi',
        'status',
        'reviewed_by',
        'review_notes',
        'reviewed_at',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'water_management_id' => 'required|integer',
        'requested_by'      => 'required|integer',
        'alasan_revisi'     => 'required|min_length[10]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get all revisions with user information
     */
    public function getAllWithUsers()
    {
        return $this->select('water_management_revisions.*, 
                             water_management.tahun,
                             requester.name as requested_by_name,
                             reviewer.name as reviewed_by_name')
                    ->join('water_management', 'water_management.id = water_management_revisions.water_management_id')
                    ->join('users as requester', 'requester.id = water_management_revisions.requested_by', 'left')
                    ->join('users as reviewer', 'reviewer.id = water_management_revisions.reviewed_by', 'left')
                    ->orderBy('water_management_revisions.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get revision by ID with user information
     */
    public function getWithUsers($id)
    {
        return $this->select('water_management_revisions.*, 
                             water_management.tahun,
                             requester.name as requested_by_name,
                             reviewer.name as reviewed_by_name')
                    ->join('water_management', 'water_management.id = water_management_revisions.water_management_id')
                    ->join('users as requester', 'requester.id = water_management_revisions.requested_by', 'left')
                    ->join('users as reviewer', 'reviewer.id = water_management_revisions.reviewed_by', 'left')
                    ->where('water_management_revisions.id', $id)
                    ->first();
    }

    /**
     * Get revisions by user ID
     */
    public function getByUserId($userId)
    {
        return $this->select('water_management_revisions.*, 
                             water_management.tahun,
                             reviewer.name as reviewed_by_name')
                    ->join('water_management', 'water_management.id = water_management_revisions.water_management_id')
                    ->join('users as reviewer', 'reviewer.id = water_management_revisions.reviewed_by', 'left')
                    ->where('water_management_revisions.requested_by', $userId)
                    ->orderBy('water_management_revisions.created_at', 'DESC')
                    ->findAll();
    }
}


