<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\NewsModel;
use App\Models\DashboardContentModel;
use App\Models\LandingContentModel;

class CmsController extends BaseController
{
    protected $menuModel;
    protected $newsModel;
    protected $contentModel;
    protected $landingContentModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
        $this->newsModel = new NewsModel();
        $this->contentModel = new DashboardContentModel();
        $this->landingContentModel = new LandingContentModel();
    }

    // MENU MANAGEMENT
    public function menus()
    {
        $session = session();
        if ($session->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        // Get user data for profile photo
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        $data = [
            'title' => 'Manajemen Menu',
            'page' => 'cms-menus',
            'breadcrumb' => 'Home / Sistem / Manajemen Menu',
            'menus' => $this->menuModel->orderBy('order', 'ASC')->findAll(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('cms/menus/index', $data);
    }

    public function createMenu()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $data = [
            'title' => 'Tambah Menu Baru',
            'parent_menus' => $this->menuModel->where('parent_id', null)->findAll()
        ];

        return view('cms/menus/create', $data);
    }

    public function storeMenu()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $roles = $this->request->getPost('roles') ?: [];

        $data = [
            'title' => $this->request->getPost('title'),
            'url' => $this->request->getPost('url'),
            'icon' => $this->request->getPost('icon'),
            'parent_id' => $this->request->getPost('parent_id') ?: null,
            'order' => $this->request->getPost('order'),
            'is_active' => $this->request->getPost('is_active'),
            'roles' => json_encode($roles),
            'menu_type' => $this->request->getPost('menu_type'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->menuModel->insert($data);

        return redirect()->to('/menus')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function editMenu($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak. Role Anda: ' . session()->get('role'));
        }

        $menu = $this->menuModel->find($id);
        if (!$menu) {
            return redirect()->to('/menus')->with('error', 'Menu dengan ID ' . $id . ' tidak ditemukan.');
        }

        // Get parent menus - exclude current menu to prevent circular reference
        $parent_menus = $this->menuModel
            ->where('id !=', $id)
            ->where('parent_id IS NULL')
            ->findAll();

        $data = [
            'title' => 'Edit Menu',
            'menu' => $menu,
            'parent_menus' => $parent_menus
        ];

        return view('cms/menus/edit', $data);
    }

    public function updateMenu($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $roles = $this->request->getPost('roles') ?: [];

        $data = [
            'title' => $this->request->getPost('title'),
            'url' => $this->request->getPost('url'),
            'icon' => $this->request->getPost('icon'),
            'parent_id' => $this->request->getPost('parent_id') ?: null,
            'order' => $this->request->getPost('order'),
            'is_active' => $this->request->getPost('is_active'),
            'roles' => json_encode($roles),
            'menu_type' => $this->request->getPost('menu_type'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->menuModel->update($id, $data);

        return redirect()->to('/menus')->with('success', 'Menu berhasil diperbarui.');
    }

    public function deleteMenu($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $this->menuModel->delete($id);
        return redirect()->to('/menus')->with('success', 'Menu berhasil dihapus.');
    }

    // NEWS MANAGEMENT
    public function news()
    {
        $session = session();
        if ($session->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        // Get user data for profile photo
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        $data = [
            'title' => 'Manajemen Berita',
            'page' => 'cms-news',
            'breadcrumb' => 'Home / Sistem / Manajemen Berita',
            'news' => $this->newsModel->orderBy('created_at', 'DESC')->findAll(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('cms/news/index', $data);
    }

    public function createNews()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $session = session();

        // Get user data for profile photo
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        $data = [
            'title' => 'Tambah Berita',
            'page' => 'cms-news',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('cms/news/create', $data);
    }

    public function storeNews()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $title = $this->request->getPost('title');
        $slug = url_title($title, '-', true);

        $data = [
            'title' => $title,
            'slug' => $slug,
            'excerpt' => $this->request->getPost('excerpt'),
            'content' => $this->request->getPost('content'),
            'category' => $this->request->getPost('category'),
            'is_published' => $this->request->getPost('is_published'),
            'published_at' => $this->request->getPost('is_published') == 1 ? date('Y-m-d H:i:s') : null,
            'created_by' => session()->get('id'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/news', $newName);
            $data['image'] = $newName;
        }

        $this->newsModel->insert($data);

        return redirect()->to('/news-admin')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function editNews($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $session = session();

        $news = $this->newsModel->find($id);
        if (!$news) {
            return redirect()->to('/news-admin')->with('error', 'Berita tidak ditemukan.');
        }

        // Get user data for profile photo
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        $data = [
            'title' => 'Edit Berita',
            'news' => $news,
            'page' => 'cms-news',
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('cms/news/edit', $data);
    }

    public function updateNews($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $news = $this->newsModel->find($id);
        $title = $this->request->getPost('title');
        $slug = url_title($title, '-', true);

        $data = [
            'title' => $title,
            'slug' => $slug,
            'excerpt' => $this->request->getPost('excerpt'),
            'content' => $this->request->getPost('content'),
            'category' => $this->request->getPost('category'),
            'is_published' => $this->request->getPost('is_published'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($this->request->getPost('is_published') == 1 && $news['is_published'] == 0) {
            $data['published_at'] = date('Y-m-d H:i:s');
        }

        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/news', $newName);
            $data['image'] = $newName;

            if ($news && $news['image']) {
                $oldImagePath = FCPATH . 'uploads/news/' . $news['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }

        $this->newsModel->update($id, $data);

        return redirect()->to('/news-admin')->with('success', 'Berita berhasil diperbarui.');
    }

    public function deleteNews($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $news = $this->newsModel->find($id);
        if ($news && $news['image']) {
            $imagePath = FCPATH . 'uploads/news/' . $news['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $this->newsModel->delete($id);
        return redirect()->to('/news-admin')->with('success', 'Berita berhasil dihapus.');
    }

    // CONTENT MANAGEMENT
    public function contents()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $data = [
            'title' => 'Manajemen Konten Landing Page',
            'contents' => $this->contentModel->findAll()
        ];

        return view('cms/contents/index', $data);
    }

    public function editContent($section, $key)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $content = $this->contentModel->getContentBySectionAndKey($section, $key);

        $data = [
            'title' => 'Edit Konten - ' . ucfirst($section),
            'content' => $content,
            'section' => $section,
            'key' => $key
        ];

        return view('cms/contents/edit', $data);
    }

    public function updateContent($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $data = [
            'value' => $this->request->getPost('value'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->contentModel->update($id, $data);

        return redirect()->to('/contents')->with('success', 'Konten berhasil diperbarui.');
    }

    // LANDING PAGE CONTENT MANAGEMENT
    public function landingContents()
    {
        $session = session();
        if ($session->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        // Get user data for profile photo
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        $data = [
            'title' => 'Konten Landing Page',
            'page' => 'cms-landing',
            'breadcrumb' => 'Home / Sistem / Konten Landing Page',
            'contents' => $this->landingContentModel->orderBy('order', 'ASC')->findAll(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('cms/landing/index', $data);
    }

    public function editLandingContent($section)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        // Special handling for berita section
        if ($section === 'berita') {
            $content = $this->landingContentModel->getBySection($section);

            if (!$content) {
                $content = [
                    'section' => 'berita',
                    'title' => 'Berita Terkini',
                    'subtitle' => 'Update Kampus Berkelanjutan',
                    'content' => '<p>Ikuti perkembangan terbaru program kampus berkelanjutan kami</p>',
                    'button_text' => 'Lihat Semua Berita',
                    'button_url' => '/news-admin',
                    'order' => 3,
                    'is_active' => 1
                ];
            }

            $publishedNews = $this->newsModel
                ->where('is_published', 1)
                ->orderBy('published_at', 'DESC')
                ->findAll();

            return view('cms/landing/edit_berita', [
                'title' => 'Kelola Berita di Landing Page',
                'content' => $content,
                'section' => 'berita',
                'publishedNews' => $publishedNews
            ]);
        }

        // Regular sections (deskripsi, program, informasi)
        $content = $this->landingContentModel->getBySection($section);

        if (!$content) {
            $content = [
                'section' => $section,
                'title' => ucfirst($section),
                'subtitle' => '',
                'content' => '',
                'image' => null,
                'button_text' => '',
                'button_url' => '',
                'order' => 0,
                'is_active' => 1
            ];
        }

        $data = [
            'title' => 'Edit Konten ' . ucfirst($section),
            'content' => $content,
            'section' => $section
        ];

        return view('cms/landing/edit', $data);
    }

    public function updateLandingContent($section)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'content' => $this->request->getPost('content'),
            'button_text' => $this->request->getPost('button_text'),
            'button_url' => $this->request->getPost('button_url'),
            'order' => $this->request->getPost('order') ?? 0,
            'is_active' => $this->request->getPost('is_active') ?? 1,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/landing', $newName);
            $data['image'] = $newName;
        }

        $this->landingContentModel->updateBySection($section, $data);

        return redirect()->to('/landing-contents')->with('success', 'Konten ' . ucfirst($section) . ' berhasil diperbarui.');
    }

    // DASHBOARD CONTENT MANAGEMENT
    public function dashboardContents()
    {
        $session = session();
        if ($session->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        // Get user data for profile photo
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        $data = [
            'title' => 'Konten Dashboard',
            'page' => 'cms-dashboard',
            'breadcrumb' => 'Home / Sistem / Konten Dashboard',
            'contents' => $this->contentModel->orderBy('order', 'ASC')->findAll(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('cms/dashboard/index', $data);
    }

    // DASHBOARD STATISTICS MANAGEMENT
    public function dashboardStatistics()
    {
        $session = session();
        if ($session->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        // Get user data for profile photo
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($session->get('user_id'));

        // Load statistics model
        $statisticModel = new \App\Models\DashboardStatisticModel();

        $data = [
            'title' => 'Statistik Dashboard',
            'page' => 'cms-statistics',
            'breadcrumb' => 'Home / Sistem / Statistik Dashboard',
            'statistics' => $statisticModel->orderBy('order', 'ASC')->findAll(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('cms/statistics/index', $data);
    }

    public function editDashboardStatistic($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $statisticModel = new \App\Models\DashboardStatisticModel();
        $statistic = $statisticModel->find($id);

        if (!$statistic) {
            return redirect()->to('/dashboard-statistics')->with('error', 'Statistik tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Statistik: ' . $statistic['label'],
            'statistic' => $statistic
        ];

        return view('cms/statistics/edit', $data);
    }

    public function updateDashboardStatistic($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $statisticModel = new \App\Models\DashboardStatisticModel();

        $data = [
            'label' => $this->request->getPost('label'),
            'value' => $this->request->getPost('value'),
            'type' => $this->request->getPost('type'),
            'category' => $this->request->getPost('category'),
            'description' => $this->request->getPost('description'),
            'order' => $this->request->getPost('order') ?? 0,
            'is_active' => $this->request->getPost('is_active') ?? 1,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $statisticModel->update($id, $data);

        return redirect()->to('/dashboard-statistics')->with('success', 'Statistik berhasil diperbarui.');
    }

    public function createDashboardStatistic()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $data = [
            'title' => 'Tambah Statistik Baru'
        ];

        return view('cms/statistics/create', $data);
    }

    public function storeDashboardStatistic()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $statisticModel = new \App\Models\DashboardStatisticModel();

        $data = [
            'key' => $this->request->getPost('key'),
            'label' => $this->request->getPost('label'),
            'value' => $this->request->getPost('value'),
            'type' => $this->request->getPost('type'),
            'category' => $this->request->getPost('category'),
            'description' => $this->request->getPost('description'),
            'order' => $this->request->getPost('order') ?? 0,
            'is_active' => $this->request->getPost('is_active') ?? 1
        ];

        $statisticModel->insert($data);

        return redirect()->to('/dashboard-statistics')->with('success', 'Statistik baru berhasil ditambahkan.');
    }

    public function deleteDashboardStatistic($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $statisticModel = new \App\Models\DashboardStatisticModel();
        $statisticModel->delete($id);

        return redirect()->to('/dashboard-statistics')->with('success', 'Statistik berhasil dihapus.');
    }

    public function editDashboardContent($section)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $content = $this->contentModel->getBySection($section);

        if (!$content) {
            $content = [
                'section' => $section,
                'title' => ucfirst(str_replace('_', ' ', $section)),
                'subtitle' => '',
                'content' => '',
                'value' => '',
                'icon' => '',
                'color' => '',
                'trend_text' => '',
                'trend_type' => '',
                'order' => 0,
                'is_active' => 1
            ];
        }

        $data = [
            'title' => 'Edit Konten ' . ucfirst(str_replace('_', ' ', $section)),
            'content' => $content,
            'section' => $section
        ];

        return view('cms/dashboard/edit', $data);
    }

    public function updateDashboardContent($section)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'content' => $this->request->getPost('content'),
            'value' => $this->request->getPost('value'),
            'icon' => $this->request->getPost('icon'),
            'color' => $this->request->getPost('color'),
            'trend_text' => $this->request->getPost('trend_text'),
            'trend_type' => $this->request->getPost('trend_type'),
            'order' => $this->request->getPost('order') ?? 0,
            'is_active' => $this->request->getPost('is_active') ?? 1,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->contentModel->updateBySection($section, $data);

        return redirect()->to('/dashboard-contents')->with('success', 'Konten ' . ucfirst(str_replace('_', ' ', $section)) . ' berhasil diperbarui.');
    }

    // INFORMASI CONTENT MANAGEMENT
    public function informasiContents()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        // Get user data for profile photo
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find(session()->get('user_id'));

        // Get informasi content
        $informasiContent = $this->landingContentModel->getBySection('informasi');

        $data = [
            'title' => 'Kelola Konten Informasi',
            'page' => 'cms-informasi',
            'user_name' => session()->get('name'),
            'user_role' => session()->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null,
            'content' => $informasiContent
        ];

        return view('cms/informasi/index', $data);
    }

    public function updateInformasiContent()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $mapEmbed = $this->request->getPost('map_embed');

        // Debug: Log map embed
        log_message('debug', 'Map Embed Length: ' . strlen($mapEmbed));
        log_message('debug', 'Map Embed Preview: ' . substr($mapEmbed, 0, 100));

        $data = [
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'content' => $this->request->getPost('content'),
            'address' => $this->request->getPost('address'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
            'map_embed' => $mapEmbed,
            'map_latitude' => $this->request->getPost('map_latitude'),
            'map_longitude' => $this->request->getPost('map_longitude'),
            'is_active' => 1,
            'order' => 5
        ];

        $result = $this->landingContentModel->updateBySection('informasi', $data);

        // Debug: Check if update successful
        log_message('debug', 'Update Result: ' . ($result ? 'SUCCESS' : 'FAILED'));

        return redirect()->to('/informasi-contents')->with('success', 'Konten informasi berhasil diperbarui. Map embed length: ' . strlen($mapEmbed));
    }

    // SYNC DASHBOARD TO LANDING PAGE
    public function syncDashboardToLanding()
    {
        if (session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Akses ditolak']);
        }

        try {
            // Get dashboard info_box content
            $dashboardContent = $this->contentModel->getBySection('info_box');

            if ($dashboardContent) {
                // Update landing page informasi section with dashboard content
                $landingData = [
                    'title' => $dashboardContent['title'],
                    'content' => $dashboardContent['content'],
                    'is_active' => 1
                ];

                $this->landingContentModel->updateBySection('informasi', $landingData);

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Konten berhasil disinkronisasi dari dashboard ke landing page'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Konten dashboard tidak ditemukan'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    // LANDING PAGE STATISTICS MANAGEMENT
    public function landingStatistics()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $landingStatModel = new \App\Models\LandingStatisticModel();

        $data = array_merge($this->getSidebarData('landing-statistics'), [
            'title' => 'Kelola Statistik Landing Page',
            'statistics' => $landingStatModel->getAllGrouped()
        ]);

        return view('cms/landing_statistics/index', $data);
    }

    public function updateLandingStatistic()
    {
        if (session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Akses ditolak']);
        }

        $landingStatModel = new \App\Models\LandingStatisticModel();

        $id = $this->request->getPost('id');
        $value = $this->request->getPost('value');

        $result = $landingStatModel->update($id, ['value' => $value]);

        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Statistik berhasil diupdate'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal mengupdate statistik'
            ]);
        }
    }

    // LANDING PAGE CHARTS MANAGEMENT
    public function landingCharts()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $landingChartModel = new \App\Models\LandingChartModel();

        $data = array_merge($this->getSidebarData('landing-charts'), [
            'title' => 'Kelola Grafik Landing Page',
            'charts' => $landingChartModel->getAllGrouped()
        ]);

        return view('cms/landing_charts/index', $data);
    }

    public function updateLandingChart()
    {
        if (session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Akses ditolak']);
        }

        $landingChartModel = new \App\Models\LandingChartModel();

        $id = $this->request->getPost('id');
        $rankValue = $this->request->getPost('rank_value');

        $result = $landingChartModel->update($id, ['rank_value' => $rankValue]);

        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data grafik berhasil diupdate'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal mengupdate data grafik'
            ]);
        }
    }
}
