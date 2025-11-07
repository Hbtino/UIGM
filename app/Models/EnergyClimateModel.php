<?php

namespace App\Models;

use CodeIgniter\Model;

class EnergyClimateModel extends Model
{
    protected $table = 'energy_climate';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tahun',
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
        'created_by',
        'updated_by'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}