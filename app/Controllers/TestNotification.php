<?php

namespace App\Controllers;

use App\Models\PasswordChangeRequestModel;

class TestNotification extends BaseController
{
    public function testPasswordRequests()
    {
        $model = new PasswordChangeRequestModel();
        $requests = $model->getPendingRequests();
        
        echo "<h1>Test Password Change Requests</h1>";
        echo "<h2>Session Info:</h2>";
        echo "<pre>";
        echo "Logged In: " . (session()->get('logged_in') ? 'YES' : 'NO') . "\n";
        echo "User ID: " . session()->get('user_id') . "\n";
        echo "User Name: " . session()->get('user_name') . "\n";
        echo "User Role: " . session()->get('user_role') . "\n";
        echo "</pre>";
        
        echo "<h2>Pending Requests Count: " . count($requests) . "</h2>";
        echo "<pre>";
        print_r($requests);
        echo "</pre>";
        
        echo "<h2>JSON Response:</h2>";
        echo "<pre>";
        echo json_encode([
            'success' => true,
            'requests' => $requests
        ], JSON_PRETTY_PRINT);
        echo "</pre>";
    }
}
