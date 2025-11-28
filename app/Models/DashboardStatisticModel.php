<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardStatisticModel extends Model
{
    protected $table = 'dashboard_statistics';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'key',
        'label',
        'value',
        'type',
        'category',
        'description',
        'is_active',
        'order',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Get statistic by key
     */
    public function getByKey($key)
    {
        return $this->where('key', $key)
            ->where('is_active', 1)
            ->first();
    }

    /**
     * Get all active statistics
     */
    public function getAllActive()
    {
        return $this->where('is_active', 1)
            ->orderBy('order', 'ASC')
            ->findAll();
    }

    /**
     * Get statistics by category
     */
    public function getByCategory($category)
    {
        return $this->where('category', $category)
            ->where('is_active', 1)
            ->orderBy('order', 'ASC')
            ->findAll();
    }

    /**
     * Update statistic by key
     */
    public function updateByKey($key, $data)
    {
        $existing = $this->where('key', $key)->first();

        if ($existing) {
            return $this->update($existing['id'], $data);
        } else {
            $data['key'] = $key;
            return $this->insert($data);
        }
    }

    /**
     * Get statistics as key-value array
     */
    public function getAsArray()
    {
        $stats = $this->getAllActive();
        $result = [];

        foreach ($stats as $stat) {
            $result[$stat['key']] = $stat['value'];
        }

        return $result;
    }

    /**
     * Get statistics grouped by category
     */
    public function getGroupedByCategory()
    {
        $stats = $this->getAllActive();
        $result = [];

        foreach ($stats as $stat) {
            $category = $stat['category'] ?? 'other';
            if (!isset($result[$category])) {
                $result[$category] = [];
            }
            $result[$category][] = $stat;
        }

        return $result;
    }
}
