<?php

namespace App\Models;

use CodeIgniter\Model;

class WasteManagementModel extends Model
{
    protected $table            = 'waste_management';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'tahun',
        'total_konsumsi_listrik',
        'konsumsi_energi_terbarukan',
        'persentase_energi_terbarukan',
        'peralatan_hemat_energi',
        'bangunan_cerdas',
        'jumlah_energi_terbarukan',
        'total_listrik_per_orang',
        'rasio_energi_terbarukan',
        'bangunan_ramah_lingkungan',
        'program_pengurangan_emisi',
        'jejak_karbon_per_orang',
        'program_inovatif_energi',
        'program_dampak_iklim',
        'capaian_persen',
        'keterangan',
        'status_verifikasi',
        'catatan_verifikasi',
        'bukti_pendukung',
        'verified_by',
        'verified_at',
        'created_by',
        'updated_by',
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
        'tahun'                      => 'required|integer|is_unique[waste_management.tahun,id,{id}]',
        'total_konsumsi_listrik'     => 'required|decimal|greater_than[0]',
        'konsumsi_energi_terbarukan' => 'required|decimal',
        'peralatan_hemat_energi'     => 'required|integer',
        'bangunan_cerdas'            => 'required|integer',
        'jumlah_energi_terbarukan'   => 'required|integer',
        'total_listrik_per_orang'    => 'required|decimal',
        'bangunan_ramah_lingkungan'  => 'required|integer',
        'jejak_karbon_per_orang'     => 'required|decimal',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['calculatePercentages'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['calculatePercentages'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Auto-calculate percentages before insert/update
     */
    protected function calculatePercentages(array $data)
    {
        if (isset($data['data'])) {
            // Calculate persentase_energi_terbarukan
            if (isset($data['data']['total_konsumsi_listrik']) && isset($data['data']['konsumsi_energi_terbarukan'])) {
                $total = floatval($data['data']['total_konsumsi_listrik']);
                $terbarukan = floatval($data['data']['konsumsi_energi_terbarukan']);
                
                if ($total > 0) {
                    $data['data']['persentase_energi_terbarukan'] = round(($terbarukan / $total) * 100, 2);
                } else {
                    $data['data']['persentase_energi_terbarukan'] = 0;
                }
            }

            // Calculate capaian_persen (weighted)
            $persentase = isset($data['data']['persentase_energi_terbarukan']) ? floatval($data['data']['persentase_energi_terbarukan']) : 0;
            $program_emisi = isset($data['data']['program_pengurangan_emisi']) ? intval($data['data']['program_pengurangan_emisi']) : 0;
            $program_inovatif = isset($data['data']['program_inovatif_energi']) ? intval($data['data']['program_inovatif_energi']) : 0;
            $program_iklim = isset($data['data']['program_dampak_iklim']) ? intval($data['data']['program_dampak_iklim']) : 0;

            $capaian = ($persentase * 0.5) + 
                       ($program_emisi ? 20 : 0) + 
                       ($program_inovatif ? 15 : 0) + 
                       ($program_iklim ? 15 : 0);

            $data['data']['capaian_persen'] = round($capaian, 2);
        }

        return $data;
    }

    /**
     * Get all data with user information
     */
    public function getAllWithUsers()
    {
        return $this->select('waste_management.*, 
                             creator.name as created_by_name,
                             verifier.name as verified_by_name')
                    ->join('users as creator', 'creator.id = waste_management.created_by', 'left')
                    ->join('users as verifier', 'verifier.id = waste_management.verified_by', 'left')
                    ->orderBy('waste_management.tahun', 'DESC')
                    ->findAll();
    }

    /**
     * Get data by ID with user information
     */
    public function getWithUsers($id)
    {
        return $this->select('waste_management.*, 
                             creator.name as created_by_name,
                             verifier.name as verified_by_name')
                    ->join('users as creator', 'creator.id = waste_management.created_by', 'left')
                    ->join('users as verifier', 'verifier.id = waste_management.verified_by', 'left')
                    ->where('waste_management.id', $id)
                    ->first();
    }
}


