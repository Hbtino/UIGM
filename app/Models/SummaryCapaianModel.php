<?php

namespace App\Models;

use CodeIgniter\Model;

class SummaryCapaianModel extends Model
{
    protected $table = 'summary_capaian';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tahun',
        'si_persen',
        'ec_persen',
        'ws_persen',
        'wr_persen',
        'tr_persen',
        'ed_persen',
        'total_skor',
        'world_rank',
        'indonesia_rank',
        'medium_campus_rank',
        'keterangan'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    /**
     * Get data for chart in Dashboard
     */
    public function getChartData()
    {
        $data = $this->orderBy('tahun', 'ASC')->findAll();
        
        $result = [
            'labels' => [],
            'datasets' => [
                [
                    'label' => 'Setting & Infrastructure (SI)',
                    'data' => [],
                    'backgroundColor' => 'rgba(54, 162, 235, 0.8)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 2,
                    'borderRadius' => 6
                ],
                [
                    'label' => 'Energy & Climate Change (EC)',
                    'data' => [],
                    'backgroundColor' => 'rgba(255, 206, 86, 0.8)',
                    'borderColor' => 'rgba(255, 206, 86, 1)',
                    'borderWidth' => 2,
                    'borderRadius' => 6
                ],
                [
                    'label' => 'Waste (WS)',
                    'data' => [],
                    'backgroundColor' => 'rgba(75, 192, 192, 0.8)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 2,
                    'borderRadius' => 6
                ],
                [
                    'label' => 'Water (WR)',
                    'data' => [],
                    'backgroundColor' => 'rgba(153, 102, 255, 0.8)',
                    'borderColor' => 'rgba(153, 102, 255, 1)',
                    'borderWidth' => 2,
                    'borderRadius' => 6
                ],
                [
                    'label' => 'Transportation (TR)',
                    'data' => [],
                    'backgroundColor' => 'rgba(255, 99, 132, 0.8)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 2,
                    'borderRadius' => 6
                ],
                [
                    'label' => 'Education & Research (ED)',
                    'data' => [],
                    'backgroundColor' => 'rgba(255, 159, 64, 0.8)',
                    'borderColor' => 'rgba(255, 159, 64, 1)',
                    'borderWidth' => 2,
                    'borderRadius' => 6
                ]
            ],
            'totalScore' => [],
            'worldRank' => [],
            'indonesiaRank' => []
        ];
        
        foreach ($data as $row) {
            $result['labels'][] = $row['tahun'];
            $result['datasets'][0]['data'][] = $row['si_persen'];
            $result['datasets'][1]['data'][] = $row['ec_persen'];
            $result['datasets'][2]['data'][] = $row['ws_persen'];
            $result['datasets'][3]['data'][] = $row['wr_persen'];
            $result['datasets'][4]['data'][] = $row['tr_persen'];
            $result['datasets'][5]['data'][] = $row['ed_persen'];
            $result['totalScore'][] = $row['total_skor'];
            $result['worldRank'][] = $row['world_rank'];
            $result['indonesiaRank'][] = $row['indonesia_rank'];
        }
        
        return $result;
    }
}