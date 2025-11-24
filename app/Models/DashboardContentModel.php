<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardContentModel extends Model
{
    protected $table = 'dashboard_content';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'section',
        'key',
        'value',
        'type',
        'description',
        'is_active',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = false;

    public function getContentBySection($section)
    {
        return $this->where('section', $section)
                    ->where('is_active', 1)
                    ->findAll();
    }

    public function getContentBySectionAndKey($section, $key)
    {
        return $this->where('section', $section)
                    ->where('key', $key)
                    ->first();
    }
}
