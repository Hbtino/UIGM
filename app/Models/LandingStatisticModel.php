<?php

namespace App\Models;

use CodeIgniter\Model;

class LandingStatisticModel extends Model
{
    protected $table = 'landing_statistics';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'section',
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
     * Get statistics by section
     */
    public function getBySection($section)
    {
        return $this->where('section', $section)
            ->where('is_active', 1)
            ->orderBy('order_position', 'ASC')
            ->findAll();
    }

    /**
     * Get specific statistic by section and key
     */
    public function getBySectionKey($section, $key)
    {
        return $this->where('section', $section)
            ->where('key_name', $key)
            ->first();
    }

    /**
     * Get all sections grouped
     */
    public function getAllGrouped()
    {
        $stats = $this->orderBy('section', 'ASC')
            ->orderBy('order_position', 'ASC')
            ->findAll();

        $grouped = [];
        foreach ($stats as $stat) {
            $grouped[$stat['section']][] = $stat;
        }

        return $grouped;
    }

    /**
     * Update statistic value
     */
    public function updateValue($section, $key, $value)
    {
        $result = $this->where('section', $section)
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
     * Clear landing statistics cache
     */
    private function clearCache()
    {
        // Clear multiple cache keys that might be related
        cache()->delete('landing_statistics');
        cache()->delete('landing_stats_grouped');
        cache()->delete('home_page_data');

        // Log cache clearing for debugging
        log_message('info', 'Landing statistics cache cleared due to data update');
    }
}
