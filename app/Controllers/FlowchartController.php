<?php

namespace App\Controllers;

class FlowchartController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Flowchart Sistem Role Dashboard UIGM - Polban'
        ];

        return view('flowchart', $data);
    }

    public function simple()
    {
        // Redirect to simple HTML version
        return redirect()->to(base_url('public/flowchart-simple.html'));
    }

    public function test()
    {
        // Test page with debug info
        $data = [
            'title' => 'Flowchart Test - Debug Info',
            'mermaid_version' => '10.6.1',
            'bootstrap_version' => '5.3.0'
        ];

        return view('flowchart_test', $data);
    }
}
