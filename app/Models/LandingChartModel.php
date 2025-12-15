<?php

namespace App\Models;

use CodeIgniter\Model;

class LandingChartModel extends Model
{
    protected $table = 'landing_charts';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'chart_type',
        'year',
        'rank_value',
        'order_position',
        'is_active'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Get charts by type
     */
    public function getByType($chartType)
    {
        return $this->where('chart_type', $chartType)
            ->where('is_active', 1)
            ->orderBy('order_position', 'ASC')
            ->findAll();
    }

    /**
     * Get all charts grouped by type
     */
    public function getAllGrouped()
    {
        $charts = $this->where('is_active', 1)
            ->orderBy('chart_type', 'ASC')
            ->orderBy('order_position', 'ASC')
            ->findAll();

        $grouped = [];
        foreach ($charts as $chart) {
            $grouped[$chart['chart_type']][] = $chart;
        }

        return $grouped;
    }

    /**
     * Update chart value
     */
    public function updateValue($chartType, $year, $rankValue)
    {
        return $this->where('chart_type', $chartType)
            ->where('year', $year)
            ->set('rank_value', $rankValue)
            ->update();
    }
}
