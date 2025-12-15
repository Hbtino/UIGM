<?php

namespace App\Models;

use CodeIgniter\Model;

class ChartIndicatorModel extends Model
{
    protected $table = 'charts_indicators';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'chart_type',
        'title',
        'description',
        'data_source',
        'chart_data',
        'chart_config',
        'display_location',
        'section',
        'order_position',
        'is_active',
        'sync_with_statistics'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Get charts by display location
     */
    public function getByLocation($location)
    {
        return $this->whereIn('display_location', [$location, 'both'])
            ->where('is_active', 1)
            ->orderBy('section', 'ASC')
            ->orderBy('order_position', 'ASC')
            ->findAll();
    }

    /**
     * Get charts by section
     */
    public function getBySection($section, $location = null)
    {
        $builder = $this->where('section', $section)
            ->where('is_active', 1);

        if ($location) {
            $builder->whereIn('display_location', [$location, 'both']);
        }

        return $builder->orderBy('order_position', 'ASC')->findAll();
    }

    /**
     * Get all charts grouped by location and section
     */
    public function getAllGrouped()
    {
        $charts = $this->where('is_active', 1)
            ->orderBy('display_location', 'ASC')
            ->orderBy('section', 'ASC')
            ->orderBy('order_position', 'ASC')
            ->findAll();

        $grouped = [];
        foreach ($charts as $chart) {
            $location = $chart['display_location'];
            $section = $chart['section'] ?? 'default';

            if (!isset($grouped[$location])) {
                $grouped[$location] = [];
            }
            if (!isset($grouped[$location][$section])) {
                $grouped[$location][$section] = [];
            }

            $grouped[$location][$section][] = $chart;
        }

        return $grouped;
    }

    /**
     * Update chart data
     */
    public function updateChartData($id, $chartData)
    {
        return $this->update($id, [
            'chart_data' => is_array($chartData) ? json_encode($chartData) : $chartData
        ]);
    }

    /**
     * Sync chart data with statistics (for charts that have sync enabled)
     */
    public function syncWithStatistics()
    {
        $chartsToSync = $this->where('sync_with_statistics', 1)
            ->where('is_active', 1)
            ->findAll();

        $db = \Config\Database::connect();

        foreach ($chartsToSync as $chart) {
            $newData = null;

            // Sync berdasarkan chart type dan data source
            switch ($chart['title']) {
                case 'Data per Kriteria SDGs':
                    $newData = $this->getSdgsCriteriaData($db);
                    break;

                case 'Status Verifikasi Data':
                    $newData = $this->getVerificationStatusData($db);
                    break;

                case 'Progress Ranking Dunia':
                    $newData = $this->getRankingProgressData($db, 'dunia');
                    break;

                case 'Progress Ranking Indonesia':
                    $newData = $this->getRankingProgressData($db, 'indonesia');
                    break;
            }

            if ($newData) {
                $this->updateChartData($chart['id'], $newData);
            }
        }
    }

    /**
     * Get SDGs criteria data from database
     */
    private function getSdgsCriteriaData($db)
    {
        $tables = [
            'setting_infrastructure',
            'energy_climate',
            'water_management',
            'waste_management',
            'transportation',
            'education_research'
        ];

        $data = [];
        foreach ($tables as $table) {
            if ($db->tableExists($table)) {
                $count = $db->table($table)->countAllResults();
                $data[] = $count;
            } else {
                $data[] = 0;
            }
        }

        return [
            'labels' => [
                'Setting & Infrastructure',
                'Energy & Climate',
                'Water Management',
                'Waste Management',
                'Transportation',
                'Education & Research'
            ],
            'datasets' => [[
                'label' => 'Total Data',
                'data' => $data,
                'backgroundColor' => [
                    '#6366f1',
                    '#10b981',
                    '#06b6d4',
                    '#ec4899',
                    '#f59e0b',
                    '#8b5cf6'
                ]
            ]]
        ];
    }

    /**
     * Get verification status data
     */
    private function getVerificationStatusData($db)
    {
        $tables = [
            'setting_infrastructure',
            'energy_climate',
            'water_management',
            'waste_management',
            'transportation',
            'education_research'
        ];

        $approved = 0;
        $pending = 0;
        $rejected = 0;

        foreach ($tables as $table) {
            if ($db->tableExists($table)) {
                $approved += $db->table($table)->where('status_verifikasi', 'approved')->countAllResults();
                $pending += $db->table($table)->where('status_verifikasi', 'pending')->countAllResults();
                $rejected += $db->table($table)->where('status_verifikasi', 'rejected')->countAllResults();
            }
        }

        return [
            'labels' => ['Approved', 'Pending', 'Rejected'],
            'datasets' => [[
                'data' => [$approved, $pending, $rejected],
                'backgroundColor' => ['#10b981', '#f59e0b', '#ef4444']
            ]]
        ];
    }

    /**
     * Get ranking progress data from statistics
     */
    private function getRankingProgressData($db, $type)
    {
        $section = 'ranking_' . $type;

        if ($db->tableExists('landing_statistics')) {
            // Use simple query to avoid whereNotLike issue
            $query = "SELECT * FROM landing_statistics 
                      WHERE section = ? 
                      AND key_name NOT LIKE '%_progress' 
                      ORDER BY order_position ASC";

            $stats = $db->query($query, [$section])->getResultArray();

            $labels = [];
            $data = [];

            foreach ($stats as $stat) {
                $labels[] = $stat['label'];
                $data[] = (int)$stat['value'];
            }

            $color = $type === 'dunia' ? '#10b981' : '#ec4899';

            return [
                'labels' => $labels,
                'datasets' => [[
                    'label' => 'Ranking ' . ucfirst($type),
                    'data' => $data,
                    'borderColor' => $color,
                    'backgroundColor' => $color . '20',
                    'tension' => 0.4
                ]]
            ];
        }

        return null;
    }
}
