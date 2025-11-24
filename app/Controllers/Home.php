<?php

namespace App\Controllers;

use App\Models\NewsModel;
use App\Models\LandingContentModel;

class Home extends BaseController
{
    public function index(): string
    {
        $newsModel = new NewsModel();
        $landingContentModel = new LandingContentModel();

        // Get 3 latest published news
        $news = $newsModel
            ->where('is_published', 1)
            ->orderBy('published_at', 'DESC')
            ->limit(3)
            ->findAll();

        // Get landing page contents
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
            'news' => $news,
            'contents' => $contentsBySection
        ];

        return view('home', $data);
    }
}
