<?php

namespace App\Models;

use CodeIgniter\Model;

class TransportationModel extends Model
{
    protected $table = 'transportation';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tahun',
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
        'created_by',
        'updated_by'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}