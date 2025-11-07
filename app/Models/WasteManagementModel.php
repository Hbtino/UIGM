<?php

namespace App\Models;

use CodeIgniter\Model;

class WasteManagementModel extends Model
{
    protected $table = 'waste_management';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tahun',
        'program_3r',
        'pengurangan_kertas_plastik',
        'pengolahan_organik',
        'pengolahan_anorganik',
        'pengolahan_beracun',
        'sistem_pembuangan',
        'volume_limbah_per_orang',
        'persentase_daur_ulang',
        'capaian_persen',
        'keterangan',
        'created_by',
        'updated_by'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}