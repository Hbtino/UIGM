<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanKaprodiModel extends Model
{
    protected $table = 'laporan_kaprodi';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'user_id',
        'user_name',
        'prodi_id',
        'prodi_name',
        'kaprodi_name',
        'jurusan',
        'tanggal_laporan',
        'data_laporan',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getLaporanByUserId($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    public function getLatestLaporanByUserId($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->first();
    }

    public function saveLaporan($data)
    {
        // Always insert new record (no update)
        return $this->insert($data);
    }
}
