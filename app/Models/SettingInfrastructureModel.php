<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingInfrastructureModel extends Model
{
    protected $table = 'setting_infrastructure';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tahun',
        'luas_ruang_terbuka',
        'luas_total',
        'vegetasi_hutan',
        'area_tanaman',
        'area_resapan',
        'persentase_anggaran',
        'persentase_pemeliharaan',
        'fasilitas_disabilitas',
        'fasilitas_keamanan',
        'asuransi_kesehatan',
        'konservasi_flora_fauna',
        'capaian_persen',
        'keterangan',
        'created_by',
        'updated_by'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    protected $validationRules = [
        'tahun' => 'required|integer',
        'capaian_persen' => 'required|decimal'
    ];
}