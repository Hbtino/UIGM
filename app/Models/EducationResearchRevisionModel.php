<?php

namespace App\Models;

use CodeIgniter\Model;

class EducationResearchRevisionModel extends Model
{
    protected $table            = 'education_research_revisions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'education_research_id',
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
        'education_research_id' => 'required|integer',
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
        return $this->select('education_research_revisions.*, 
                             education_research.tahun,
                             requester.name as requested_by_name,
                             reviewer.name as reviewed_by_name')
                    ->join('education_research', 'education_research.id = education_research_revisions.education_research_id')
                    ->join('users as requester', 'requester.id = education_research_revisions.requested_by', 'left')
                    ->join('users as reviewer', 'reviewer.id = education_research_revisions.reviewed_by', 'left')
                    ->orderBy('education_research_revisions.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get revision by ID with user information
     */
    public function getWithUsers($id)
    {
        return $this->select('education_research_revisions.*, 
                             education_research.tahun,
                             requester.name as requested_by_name,
                             reviewer.name as reviewed_by_name')
                    ->join('education_research', 'education_research.id = education_research_revisions.education_research_id')
                    ->join('users as requester', 'requester.id = education_research_revisions.requested_by', 'left')
                    ->join('users as reviewer', 'reviewer.id = education_research_revisions.reviewed_by', 'left')
                    ->where('education_research_revisions.id', $id)
                    ->first();
    }

    /**
     * Get revisions by user ID
     */
    public function getByUserId($userId)
    {
        return $this->select('education_research_revisions.*, 
                             education_research.tahun,
                             reviewer.name as reviewed_by_name')
                    ->join('education_research', 'education_research.id = education_research_revisions.education_research_id')
                    ->join('users as reviewer', 'reviewer.id = education_research_revisions.reviewed_by', 'left')
                    ->where('education_research_revisions.requested_by', $userId)
                    ->orderBy('education_research_revisions.created_at', 'DESC')
                    ->findAll();
    }
}


