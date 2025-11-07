<?php

namespace App\Models;

use CodeIgniter\Model;

class WaterManagementModel extends Model
{
    protected $table = 'water_management';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tahun',
        'program_daur_ulang_air',
        'peralatan_hemat_air',
        'konsumsi_air_diolah',
        'pengendalian_pencemaran',
        'volume_air_per_orang',
        'persentase_air_daur_ulang',
        'kualitas_air',
        'capaian_persen',
        'keterangan',
        'created_by',
        'updated_by'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}