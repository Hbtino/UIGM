<?php

namespace App\Models;

use CodeIgniter\Model;

class TransportationModel extends Model
{
    protected $table = 'transportation';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tahun',
        'total_perjalanan',
        'perjalanan_ramah_lingkungan',
        'jumlah_kendaraan',
        'jumlah_populasi',
        'rasio_kendaraan',
        'layanan_antar_jemput',
        'kebijakan_zev',
        'luas_parkir',
        'program_pembatasan_parkir',
        'inisiatif_pengurangan_kendaraan',
        'jalur_pejalan_kaki',
        'sepeda_kampus',
        'capaian_persen',
        'keterangan',
        'status_verifikasi',
        'catatan_verifikasi',
        'bukti_pendukung',
        'verified_by',
        'verified_at',
        'created_by',
        'updated_by'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    protected $validationRules = [
        'tahun' => 'required|integer',
        'total_perjalanan' => 'required|integer|greater_than[0]',
        'perjalanan_ramah_lingkungan' => 'required|integer|less_than_equal_to[total_perjalanan]'
    ];
    
    protected $validationMessages = [
        'perjalanan_ramah_lingkungan' => [
            'less_than_equal_to' => 'Perjalanan ramah lingkungan tidak boleh melebihi total perjalanan'
        ]
    ];
    
    // Auto-calculate percentage before insert/update
    protected $beforeInsert = ['calculatePercentage'];
    protected $beforeUpdate = ['calculatePercentage'];
    
    protected function calculatePercentage(array $data)
    {
        if (isset($data['data']['total_perjalanan']) && isset($data['data']['perjalanan_ramah_lingkungan'])) {
            $total = $data['data']['total_perjalanan'];
            $ramah = $data['data']['perjalanan_ramah_lingkungan'];
            
            if ($total > 0) {
                $data['data']['capaian_persen'] = round(($ramah / $total) * 100, 2);
            }
        }
        
        return $data;
    }
}