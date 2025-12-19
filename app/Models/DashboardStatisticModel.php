<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardStatisticModel extends Model
{
    protected $table = 'dashboard_statistics';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'category',
        'key_name',
        'label',
        'value',
        'icon',
        'color',
        'order_position',
        'is_active'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Get statistics by category
     */
    public function getByCategory($category)
    {
        return $this->where('category', $category)
            ->where('is_active', 1)
            ->orderBy('order_position', 'ASC')
            ->findAll();
    }

    /**
     * Get specific statistic by category and key
     */
    public function getByCategoryKey($category, $key)
    {
        return $this->where('category', $category)
            ->where('key_name', $key)
            ->first();
    }

    /**
     * Get all categories grouped
     */
    public function getGroupedByCategory()
    {
        $stats = $this->orderBy('category', 'ASC')
            ->orderBy('order_position', 'ASC')
            ->findAll();

        $grouped = [];
        foreach ($stats as $stat) {
            $grouped[$stat['category']][] = $stat;
        }

        return $grouped;
    }

    /**
     * Update statistic value
     */
    public function updateValue($category, $key, $value)
    {
        $result = $this->where('category', $category)
            ->where('key_name', $key)
            ->set('value', $value)
            ->update();

        // Clear cache when data is updated
        if ($result) {
            $this->clearCache();
        }

        return $result;
    }

    /**
     * Get available categories
     */
    public function getAvailableCategories()
    {
        return $this->select('category')
            ->distinct()
            ->where('is_active', 1)
            ->orderBy('category', 'ASC')
            ->findColumn('category');
    }

    /**
     * Override insert to clear cache
     */
    public function insert($data = null, bool $returnID = true)
    {
        $result = parent::insert($data, $returnID);

        if ($result) {
            $this->clearCache();
        }

        return $result;
    }

    /**
     * Override update to clear cache
     */
    public function update($id = null, $data = null): bool
    {
        $result = parent::update($id, $data);

        if ($result) {
            $this->clearCache();
        }

        return $result;
    }

    /**
     * Override delete to clear cache
     */
    public function delete($id = null, bool $purge = false)
    {
        $result = parent::delete($id, $purge);

        if ($result) {
            $this->clearCache();
        }

        return $result;
    }

    /**
     * Clear dashboard statistics cache
     */
    private function clearCache()
    {
        // Clear multiple cache keys that might be related
        cache()->delete('dashboard_statistics');
        cache()->delete('dashboard_stats_grouped');
        cache()->delete('dashboard_page_data');

        // Log cache clearing for debugging
        log_message('info', 'Dashboard statistics cache cleared due to data update');
    }
}
