<?php

namespace App\Models;

use CodeIgniter\Model;

class EnergyClimateRevisionModel extends Model
{
    protected $table            = 'energy_climate_revisions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'energy_climate_id',
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
        'energy_climate_id' => 'required|integer',
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
        return $this->select('energy_climate_revisions.*, 
                             energy_climate.tahun,
                             requester.name as requested_by_name,
                             reviewer.name as reviewed_by_name')
                    ->join('energy_climate', 'energy_climate.id = energy_climate_revisions.energy_climate_id')
                    ->join('users as requester', 'requester.id = energy_climate_revisions.requested_by', 'left')
                    ->join('users as reviewer', 'reviewer.id = energy_climate_revisions.reviewed_by', 'left')
                    ->orderBy('energy_climate_revisions.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get revision by ID with user information
     */
    public function getWithUsers($id)
    {
        return $this->select('energy_climate_revisions.*, 
                             energy_climate.tahun,
                             requester.name as requested_by_name,
                             reviewer.name as reviewed_by_name')
                    ->join('energy_climate', 'energy_climate.id = energy_climate_revisions.energy_climate_id')
                    ->join('users as requester', 'requester.id = energy_climate_revisions.requested_by', 'left')
                    ->join('users as reviewer', 'reviewer.id = energy_climate_revisions.reviewed_by', 'left')
                    ->where('energy_climate_revisions.id', $id)
                    ->first();
    }

    /**
     * Get revisions by user ID
     */
    public function getByUserId($userId)
    {
        return $this->select('energy_climate_revisions.*, 
                             energy_climate.tahun,
                             reviewer.name as reviewed_by_name')
                    ->join('energy_climate', 'energy_climate.id = energy_climate_revisions.energy_climate_id')
                    ->join('users as reviewer', 'reviewer.id = energy_climate_revisions.reviewed_by', 'left')
                    ->where('energy_climate_revisions.requested_by', $userId)
                    ->orderBy('energy_climate_revisions.created_at', 'DESC')
                    ->findAll();
    }
}

