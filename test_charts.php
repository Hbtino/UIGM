<?php
// Test file untuk cek data landing_charts

require_once 'vendor/autoload.php';

// Load CodeIgniter
$app = require_once FCPATH . '../app/Config/Boot/production.php';

use App\Models\LandingChartModel;

$chartModel = new LandingChartModel();

echo "<h1>Test Landing Charts</h1>";

// Test 1: Get all data
echo "<h2>Test 1: Get All Data</h2>";
$allCharts = $chartModel->findAll();
echo "<pre>";
print_r($allCharts);
echo "</pre>";
echo "<p>Total records: " . count($allCharts) . "</p>";

// Test 2: Get grouped data
echo "<h2>Test 2: Get Grouped Data</h2>";
$grouped = $chartModel->getAllGrouped();
echo "<pre>";
print_r($grouped);
echo "</pre>";

// Test 3: Check table exists
echo "<h2>Test 3: Check Table</h2>";
$db = \Config\Database::connect();
$query = $db->query("SHOW TABLES LIKE 'landing_charts'");
$result = $query->getResult();
if (count($result) > 0) {
    echo "<p style='color: green;'>✓ Table 'landing_charts' EXISTS</p>";

    // Count records
    $query2 = $db->query("SELECT COUNT(*) as total FROM landing_charts");
    $result2 = $query2->getRow();
    echo "<p>Total records in table: " . $result2->total . "</p>";

    // Show sample data
    $query3 = $db->query("SELECT * FROM landing_charts LIMIT 5");
    $result3 = $query3->getResult();
    echo "<h3>Sample Data (first 5 rows):</h3>";
    echo "<pre>";
    print_r($result3);
    echo "</pre>";
} else {
    echo "<p style='color: red;'>✗ Table 'landing_charts' DOES NOT EXIST</p>";
    echo "<p>Please run CREATE_LANDING_CHARTS_TABLE.sql first!</p>";
}
