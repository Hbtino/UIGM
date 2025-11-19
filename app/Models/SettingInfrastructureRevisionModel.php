<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingInfrastructureRevisionModel extends Model
{
    protected $table = 'setting_infrastructure_revisions';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'setting_infrastructure_id',
        'revision_type',
        'requested_by',
        'alasan_revisi',
        'data_revisi',
        'status',
        'reviewed_by',
        'review_notes',
        'reviewed_at'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    protected $validationRules = [
        'setting_infrastructure_id' => 'required|integer',
        'alasan_revisi' => 'required|min_length[10]'
    ];
    
    protected $validationMessages = [
        'alasan_revisi' => [
            'required' => 'Alasan revisi harus diisi',
            'min_length' => 'Alasan revisi minimal 10 karakter'
        ]
    ];
    
    // Get revisions with user info
    public function getRevisionsWithUsers($settingInfrastructureId = null)
    {
        $builder = $this->db->table($this->table)
            ->select('setting_infrastructure_revisions.*, 
                      requester.name as requester_name,
                      reviewer.name as reviewer_name')
            ->join('users as requester', 'requester.id = setting_infrastructure_revisions.requested_by', 'left')
            ->join('users as reviewer', 'reviewer.id = setting_infrastructure_revisions.reviewed_by', 'left');
        
        if ($settingInfrastructureId) {
            $builder->where('setting_infrastructure_revisions.setting_infrastructure_id', $settingInfrastructureId);
        }
        
        return $builder->orderBy('setting_infrastructure_revisions.created_at', 'DESC')->get()->getResultArray();
    }
    
    // Get pending revisions count
    public function getPendingCount()
    {
        return $this->where('status', 'pending')->countAllResults();
    }
}
