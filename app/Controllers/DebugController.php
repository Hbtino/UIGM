<?php

namespace App\Controllers;

class DebugController extends BaseController
{
    public function testDatabase()
    {
        try {
            echo "<h2>Database Connection Test</h2>";

            $db = \Config\Database::connect();
            echo "✅ Database connected<br>";

            // Test landing_statistics table
            $query = $db->query("SELECT COUNT(*) as count FROM landing_statistics");
            $result = $query->getRowArray();
            echo "✅ landing_statistics table accessible<br>";
            echo "Records count: " . $result['count'] . "<br>";

            // Test model
            $landingModel = new \App\Models\LandingStatisticModel();
            $stats = $landingModel->findAll();
            echo "✅ LandingStatisticModel working<br>";
            echo "Records via model: " . count($stats) . "<br>";

            // Test grouped data
            $grouped = $landingModel->getAllGrouped();
            echo "✅ getAllGrouped() working<br>";
            echo "Sections: " . count($grouped) . "<br>";

            foreach ($grouped as $section => $sectionStats) {
                echo "- $section: " . count($sectionStats) . " items<br>";
            }
        } catch (\Exception $e) {
            echo "❌ ERROR: " . $e->getMessage() . "<br>";
            echo "File: " . $e->getFile() . "<br>";
            echo "Line: " . $e->getLine() . "<br>";
        }
    }

    public function testSession()
    {
        echo "<h2>Session Test</h2>";

        $session = \Config\Services::session();

        echo "Session ID: " . $session->session_id . "<br>";
        echo "Session data:<br>";
        echo "<pre>";
        print_r($_SESSION ?? []);
        echo "</pre>";

        // Simulate admin session
        $session->set([
            'isLoggedIn' => true,
            'logged_in' => true,
            'role' => 'admin',
            'user_id' => 1,
            'username' => 'admin'
        ]);

        echo "✅ Admin session set<br>";
        echo "isLoggedIn: " . ($session->get('isLoggedIn') ? 'true' : 'false') . "<br>";
        echo "role: " . $session->get('role') . "<br>";
    }

    public function testStatisticsController()
    {
        try {
            echo "<h2>Statistics Controller Test</h2>";

            // Set admin session
            $session = \Config\Services::session();
            $session->set([
                'isLoggedIn' => true,
                'logged_in' => true,
                'role' => 'admin',
                'user_id' => 1
            ]);

            // Test controller
            $controller = new \App\Controllers\StatisticsController();

            echo "✅ StatisticsController created<br>";

            // Test landingStats method
            ob_start();
            $result = $controller->landingStats();
            $output = ob_get_clean();

            if ($result) {
                echo "✅ landingStats() method executed<br>";
            } else {
                echo "❌ landingStats() method failed<br>";
            }
        } catch (\Exception $e) {
            echo "❌ ERROR: " . $e->getMessage() . "<br>";
            echo "File: " . $e->getFile() . "<br>";
            echo "Line: " . $e->getLine() . "<br>";
        }
    }

    public function testJavaScript()
    {
        echo '<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaScript Debug Test</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .test-box { border: 1px solid #ccc; padding: 15px; margin: 10px 0; }
        .success { background: #d4edda; border-color: #c3e6cb; }
        .error { background: #f8d7da; border-color: #f5c6cb; }
    </style>
</head>
<body>
    <h1>🔍 JavaScript Debug Test</h1>
    
    <div class="test-box">
        <h3>Test 1: Basic JavaScript</h3>
        <button onclick="test1()">Test Console Log</button>
        <div id="result1"></div>
    </div>
    
    <div class="test-box">
        <h3>Test 2: DOM Manipulation</h3>
        <button onclick="test2()">Test DOM</button>
        <div id="result2"></div>
    </div>
    
    <div class="test-box">
        <h3>Test 3: AJAX Request</h3>
        <button onclick="test3()">Test AJAX</button>
        <div id="result3"></div>
    </div>
    
    <div class="test-box">
        <h3>Console Output</h3>
        <p>Buka F12 Console untuk melihat output detail</p>
    </div>
    
    <script>
        console.log("🚀 JavaScript Debug Test Page Loaded!");
        console.log("📍 URL:", window.location.href);
        console.log("🕐 Time:", new Date().toISOString());
        
        function test1() {
            console.log("✅ Test 1: Console log working");
            document.getElementById("result1").innerHTML = "<span style=\\"color: green;\\">✅ Console log working - check F12 console</span>";
        }
        
        function test2() {
            console.log("✅ Test 2: DOM manipulation working");
            const element = document.getElementById("result2");
            element.innerHTML = "<span style=\\"color: green;\\">✅ DOM manipulation working</span>";
            element.style.background = "#d4edda";
        }
        
        function test3() {
            console.log("🔄 Test 3: Testing AJAX request");
            
            fetch("' . base_url('statistics/get-all-landing-stats') . '")
                .then(response => {
                    console.log("📡 AJAX Response status:", response.status);
                    return response.json();
                })
                .then(data => {
                    console.log("📊 AJAX Response data:", data);
                    document.getElementById("result3").innerHTML = 
                        "<span style=\\"color: green;\\">✅ AJAX working - Response: " + JSON.stringify(data).substring(0, 100) + "...</span>";
                })
                .catch(error => {
                    console.error("❌ AJAX Error:", error);
                    document.getElementById("result3").innerHTML = 
                        "<span style=\\"color: red;\\">❌ AJAX Error: " + error.message + "</span>";
                });
        }
        
        // Auto test console
        setTimeout(() => {
            console.log("⏰ Auto test: JavaScript is working after 2 seconds");
        }, 2000);
    </script>
</body>
</html>';
    }
}
