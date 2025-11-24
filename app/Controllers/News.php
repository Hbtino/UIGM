<?php

namespace App\Controllers;

use App\Models\NewsModel;

class News extends BaseController
{
    protected $newsModel;

    public function __construct()
    {
        $this->newsModel = new NewsModel();
    }

    // List all published news (public access - no auth required)
    public function index()
    {
        $news = $this->newsModel
            ->where('is_published', 1)
            ->orderBy('published_at', 'DESC')
            ->paginate(9);

        $data = [
            'title' => 'Berita Terkini',
            'news' => $news,
            'pager' => $this->newsModel->pager
        ];

        return view('news/index', $data);
    }

    // Show single news detail (public access - no auth required)
    public function detail($slug)
    {
        $news = $this->newsModel
            ->where('slug', $slug)
            ->where('is_published', 1)
            ->first();

        if (!$news) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Berita tidak ditemukan');
        }

        // Increment views
        $this->newsModel->update($news['id'], [
            'views' => $news['views'] + 1
        ]);

        // Get related news (same category, limit 3)
        $relatedNews = $this->newsModel
            ->where('category', $news['category'])
            ->where('id !=', $news['id'])
            ->where('is_published', 1)
            ->orderBy('published_at', 'DESC')
            ->limit(3)
            ->findAll();

        $data = [
            'title' => $news['title'],
            'news' => $news,
            'relatedNews' => $relatedNews
        ];

        return view('news/detail_simple', $data);
    }
}
