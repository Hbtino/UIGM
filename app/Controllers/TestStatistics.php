<?php

namespace App\Controllers;

class TestStatistics extends BaseController
{
    public function index()
    {
        try {
            $db = \Config\Database::connect();
            $tables = ['charts_indicators', 'landing_statistics', 'dashboard_statistics'];
            $result = "=== DATABASE TEST ===\n\n";

            foreach ($tables as $table) {
                if ($db->tableExists($table)) {
                    $count = $db->table($table)->countAllResults();
                    $result .= "✅ Table '$table': $count records\n";
                } else {
                    $result .= "❌ Table '$table': NOT FOUND\n";
                }
            }

            $result .= "\n=== MODEL TEST ===\n\n";

            // Test ChartIndicatorModel
            try {
                $chartModel = new \App\Models\ChartIndicatorModel();
                $charts = $chartModel->findAll();
                $result .= "✅ ChartIndicatorModel: OK (" . count($charts) . " records)\n";
            } catch (\Exception $e) {
                $result .= "❌ ChartIndicatorModel: ERROR - " . $e->getMessage() . "\n";
            }

            // Test LandingStatisticModel
            try {
                $landingModel = new \App\Models\LandingStatisticModel();
                $stats = $landingModel->findAll();
                $result .= "✅ LandingStatisticModel: OK (" . count($stats) . " records)\n";
            } catch (\Exception $e) {
                $result .= "❌ LandingStatisticModel: ERROR - " . $e->getMessage() . "\n";
            }

            // Test DashboardStatisticModel
            try {
                $dashboardModel = new \App\Models\DashboardStatisticModel();
                $stats = $dashboardModel->findAll();
                $result .= "✅ DashboardStatisticModel: OK (" . count($stats) . " records)\n";
            } catch (\Exception $e) {
                $result .= "❌ DashboardStatisticModel: ERROR - " . $e->getMessage() . "\n";
            }

            $result .= "\n=== HELPER TEST ===\n\n";

            // Test helper
            try {
                helper('statistics');
                $result .= "✅ Statistics helper: LOADED\n";

                if (function_exists('get_real_time_statistics')) {
                    $result .= "✅ Function get_real_time_statistics: EXISTS\n";
                } else {
                    $result .= "❌ Function get_real_time_statistics: NOT FOUND\n";
                }
            } catch (\Exception $e) {
                $result .= "❌ Statistics helper: ERROR - " . $e->getMessage() . "\n";
            }

            $result .= "\n=== TEST COMPLETED ===\n";

            return '<pre>' . $result . '</pre>';
        } catch (\Exception $e) {
            return '<pre>❌ FATAL ERROR: ' . $e->getMessage() . "\n" . $e->getTraceAsString() . '</pre>';
        }
    }
}
