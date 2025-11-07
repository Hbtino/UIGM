<?php

namespace App\Models;

use CodeIgniter\Model;

class CapaianModel extends Model
{
    protected $table = 'capaian_kinerja';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'judul', 'deskripsi', 'tanggal', 'status'];
    protected $useTimestamps = true;
}
