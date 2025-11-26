<?php

namespace App\Controllers;

use App\Models\NewsModel;
use App\Models\LandingContentModel;

class Home extends BaseController
{
    public function index()
    {
        // Check if user is already logged in (via session or remember me cookie)
        if (session()->get('logged_in')) {
            // Redirect to dashboard based on role
            $role = session()->get('role');
            
            if ($role == 'admin') {
                return redirect()->to('/dashboard');
            } elseif ($role == 'dosen') {
                return redirect()->to('/dashboard');
            } elseif ($role == 'kaprodi') {
                return redirect()->to('/dashboard');
            } elseif ($role == 'mahasiswa') {
                return redirect()->to('/dashboard');
            } else {
                return redirect()->to('/dashboard');
            }
        }
        
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
