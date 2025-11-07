<?php

namespace App\Models;

use CodeIgniter\Model;

class EducationResearchModel extends Model
{
    protected $table = 'education_research';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tahun',
        'jumlah_mk_keberlanjutan',
        'total_mk',
        'rasio_mk_keberlanjutan',
        'pendanaan_penelitian_berkelanjutan',
        'total_pendanaan_penelitian',
        'rasio_pendanaan',
        'jumlah_publikasi',
        'jumlah_kegiatan_berkelanjutan',
        'kegiatan_mahasiswa',
        'website_berkelanjutan',
        'laporan_berkelanjutan',
        'kegiatan_budaya',
        'kerjasama_internasional',
        'pengabdian_masyarakat',
        'startup_berkelanjutan',
        'capaian_persen',
        'keterangan',
        'created_by',
        'updated_by'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}