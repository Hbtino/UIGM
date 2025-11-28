<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardContentModel extends Model
{
    protected $table = 'dashboard_contents';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'section',
        'title',
        'subtitle',
        'content',
        'value',
        'icon',
        'color',
        'trend_text',
        'trend_type',
        'order',
        'is_active',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Get content by section
     */
    public function getBySection($section)
    {
        return $this->where('section', $section)
            ->where('is_active', 1)
            ->first();
    }

    /**
     * Get all active contents ordered
     */
    public function getAllActive()
    {
        return $this->where('is_active', 1)
            ->orderBy('order', 'ASC')
            ->findAll();
    }

    /**
     * Get all stat cards
     */
    public function getStatCards()
    {
        return $this->like('section', 'stat_card_', 'after')
            ->where('is_active', 1)
            ->orderBy('order', 'ASC')
            ->findAll();
    }

    /**
     * Update content by section
     */
    public function updateBySection($section, $data)
    {
        $existing = $this->where('section', $section)->first();

        if ($existing) {
            return $this->update($existing['id'], $data);
        } else {
            $data['section'] = $section;
            return $this->insert($data);
        }
    }

    /**
     * Get dashboard data formatted for view
     */
    public function getDashboardData()
    {
        $contents = $this->getAllActive();
        $data = [];

        foreach ($contents as $content) {
            $data[$content['section']] = $content;
        }

        return $data;
    }
}
