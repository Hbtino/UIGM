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
        'persentase_area_hijau',
        'vegetasi_hutan',
        'area_tanaman',
        'area_resapan',
        'persentase_anggaran',
        'persentase_pemeliharaan',
        'fasilitas_disabilitas',
        'fasilitas_energi_terbarukan',
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
        'luas_ruang_terbuka' => 'required|decimal',
        'luas_total' => 'required|decimal|greater_than[0]'
    ];
    
    protected $validationMessages = [
        'luas_total' => [
            'greater_than' => 'Luas total harus lebih besar dari 0'
        ]
    ];
    
    // Auto-calculate percentages before insert/update
    protected $beforeInsert = ['calculatePercentages'];
    protected $beforeUpdate = ['calculatePercentages'];
    
    protected function calculatePercentages(array $data)
    {
        if (isset($data['data']['luas_ruang_terbuka']) && isset($data['data']['luas_total'])) {
            $luasRuangTerbuka = $data['data']['luas_ruang_terbuka'];
            $luasTotal = $data['data']['luas_total'];
            
            // Calculate persentase area hijau
            if ($luasTotal > 0) {
                $data['data']['persentase_area_hijau'] = round(($luasRuangTerbuka / $luasTotal) * 100, 2);
            }
            
            // Calculate capaian persen (weighted average)
            $persentaseAreaHijau = $data['data']['persentase_area_hijau'] ?? 0;
            $persentaseAnggaran = $data['data']['persentase_anggaran'] ?? 0;
            $persentasePemeliharaan = $data['data']['persentase_pemeliharaan'] ?? 0;
            
            $data['data']['capaian_persen'] = round(
                ($persentaseAreaHijau * 0.4) +
                ($persentaseAnggaran * 0.3) +
                ($persentasePemeliharaan * 0.3),
                2
            );
        }
        
        return $data;
    }
}