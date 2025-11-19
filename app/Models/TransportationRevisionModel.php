<?php

namespace App\Models;

use CodeIgniter\Model;

class TransportationRevisionModel extends Model
{
    protected $table = 'transportation_revisions';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'transportation_id',
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
        'transportation_id' => 'required|integer',
        'alasan_revisi' => 'required|min_length[10]'
    ];
    
    protected $validationMessages = [
        'alasan_revisi' => [
            'required' => 'Alasan revisi harus diisi',
            'min_length' => 'Alasan revisi minimal 10 karakter'
        ]
    ];
    
    // Get revisions with user info
    public function getRevisionsWithUsers($transportationId = null)
    {
        $builder = $this->db->table($this->table)
            ->select('transportation_revisions.*, 
                      requester.name as requester_name,
                      reviewer.name as reviewer_name')
            ->join('users as requester', 'requester.id = transportation_revisions.requested_by', 'left')
            ->join('users as reviewer', 'reviewer.id = transportation_revisions.reviewed_by', 'left');
        
        if ($transportationId) {
            $builder->where('transportation_revisions.transportation_id', $transportationId);
        }
        
        return $builder->orderBy('transportation_revisions.created_at', 'DESC')->get()->getResultArray();
    }
    
    // Get pending revisions count
    public function getPendingCount()
    {
        return $this->where('status', 'pending')->countAllResults();
    }
}
