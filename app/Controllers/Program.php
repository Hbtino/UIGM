<?php

namespace App\Controllers;

use App\Models\LandingContentModel;

class Program extends BaseController
{
    public function index()
    {
        $landingContentModel = new LandingContentModel();

        // Get program content from landing_contents
        $programContent = $landingContentModel->getBySection('program');

        // Get all landing page contents for navigation
        $contents = $landingContentModel
            ->where('is_active', 1)
            ->orderBy('order', 'ASC')
            ->findAll();

        // Convert to associative array by section
        $contentsBySection = [];
        foreach ($contents as $content) {
            $contentsBySection[$content['section']] = $content;
        }

        $data = [
            'title' => 'Program Kampus Berkelanjutan - POLBAN',
            'programContent' => $programContent,
            'contents' => $contentsBySection
        ];

        return view('program/index', $data);
    }
}
