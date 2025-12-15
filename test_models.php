<?php

/**
 * Simple test untuk check apakah models bisa diakses
 */

// Load CodeIgniter bootstrap
require_once 'vendor/autoload.php';

// Initialize CodeIgniter
$app = \Config\Services::codeigniter();
$app->initialize();

echo "=== TESTING MODELS ===\n\n";

try {
    // Test database connection
    $db = \Config\Database::connect();
    echo "✅ Database connection: OK\n";

    // Test tables exist
    $tables = ['charts_indicators', 'landing_statistics', 'dashboard_statistics'];
    foreach ($tables as $table) {
        if ($db->tableExists($table)) {
            echo "✅ Table '$table': EXISTS\n";
        } else {
            echo "❌ Table '$table': NOT FOUND\n";
        }
    }

    echo "\n=== TESTING MODELS ===\n";

    // Test ChartIndicatorModel
    try {
        $chartModel = new \App\Models\ChartIndicatorModel();
        $charts = $chartModel->findAll();
        echo "✅ ChartIndicatorModel: OK (" . count($charts) . " records)\n";
    } catch (Exception $e) {
        echo "❌ ChartIndicatorModel: ERROR - " . $e->getMessage() . "\n";
    }

    // Test LandingStatisticModel
    try {
        $landingModel = new \App\Models\LandingStatisticModel();
        $stats = $landingModel->findAll();
        echo "✅ LandingStatisticModel: OK (" . count($stats) . " records)\n";
    } catch (Exception $e) {
        echo "❌ LandingStatisticModel: ERROR - " . $e->getMessage() . "\n";
    }

    // Test DashboardStatisticModel
    try {
        $dashboardModel = new \App\Models\DashboardStatisticModel();
        $stats = $dashboardModel->findAll();
        echo "✅ DashboardStatisticModel: OK (" . count($stats) . " records)\n";
    } catch (Exception $e) {
        echo "❌ DashboardStatisticModel: ERROR - " . $e->getMessage() . "\n";
    }

    echo "\n=== TESTING HELPER ===\n";

    // Test helper
    try {
        helper('statistics');
        echo "✅ Statistics helper: LOADED\n";

        if (function_exists('get_real_time_statistics')) {
            echo "✅ Function get_real_time_statistics: EXISTS\n";
        } else {
            echo "❌ Function get_real_time_statistics: NOT FOUND\n";
        }
    } catch (Exception $e) {
        echo "❌ Statistics helper: ERROR - " . $e->getMessage() . "\n";
    }

    echo "\n=== TEST COMPLETED ===\n";
} catch (Exception $e) {
    echo "❌ FATAL ERROR: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
