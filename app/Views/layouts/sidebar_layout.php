<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'POLBAN - Kampus Berkelanjutan' ?></title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            overflow-x: hidden;
        }

        /* Sidebar Styles - Warna Hijau POLBAN */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);
            color: white;
            overflow: hidden;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar-header {
            position: sticky;
            top: 0;
            z-index: 10;
            padding: 25px 20px;
            background: rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 10px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .sidebar-header .logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .sidebar-header .logo i {
            font-size: 32px;
            color: #4CAF50;
        }

        .sidebar-header h2 {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            color: white;
            letter-spacing: 0.5px;
        }

        .sidebar-header p {
            font-size: 13px;
            margin: 5px 0 0;
            color: rgba(255, 255, 255, 0.7);
        }

        .sidebar-menu {
            padding: 0;
            flex: 1;
            overflow-y: auto;
        }

        .menu-section {
            margin-bottom: 5px;
        }

        .menu-section-title {
            padding: 15px 20px 8px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.5);
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            border-left: 3px solid transparent;
            cursor: pointer;
            pointer-events: auto;
        }

        /* Ensure menu items are clickable */
        .menu-item:not(.has-submenu) {
            pointer-events: auto !important;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: #4CAF50;
            padding-left: 25px;
        }

        .menu-item.active {
            background: rgba(76, 175, 80, 0.2) !important;
            color: white !important;
            border-left-color: #4CAF50 !important;
            font-weight: 600 !important;
        }

        /* Ensure active state is not overridden by JavaScript */
        .menu-item.active:hover {
            background: rgba(76, 175, 80, 0.3) !important;
        }

        .menu-item.active::before {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #4CAF50;
        }

        .menu-item i {
            width: 24px;
            font-size: 18px;
            margin-right: 12px;
            text-align: center;
        }

        .menu-item span {
            flex: 1;
            font-size: 14px;
        }

        .menu-item .badge {
            background: #dc3545;
            color: white;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 600;
        }

        .menu-item .dropdown-icon {
            transition: transform 0.3s ease;
        }

        .menu-item.has-submenu.open .dropdown-icon {
            transform: rotate(180deg);
        }

        .submenu {
            display: none;
            background: rgba(0, 0, 0, 0.2);
            padding: 5px 0;
        }

        .submenu.show {
            display: block;
        }

        .submenu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px 12px 15px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .submenu-item i {
            width: 16px;
            font-size: 12px;
            margin-right: 8px;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
        }

        .submenu-item:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
            padding-left: 20px;
        }

        .submenu-item:hover i {
            color: white;
        }

        .submenu-item.active {
            color: white !important;
            background: rgba(76, 175, 80, 0.15) !important;
            font-weight: 600 !important;
        }

        .submenu-item.active i {
            color: #4CAF50 !important;
        }

        /* Ensure submenu active state is stable */
        .submenu-item.active:hover {
            background: rgba(76, 175, 80, 0.25) !important;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Topbar */
        .topbar {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .sidebar-toggle-btn {
            background: #149823ff;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 12px;
            margin-right: 15px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-toggle-btn:hover {
            background: #0b5804ff;
            transform: scale(1.05);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            flex-direction: row;
        }

        .topbar-left h1 {
            margin: 0;
            color: #1e3c72;
            font-size: 26px;
            font-weight: 700;
        }

        .topbar-left .breadcrumb {
            margin: 5px 0 0;
            color: #666;
            font-size: 14px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 15px;
            background: #f8f9fa;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-info:hover {
            background: #e9ecef;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #149823;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-details {
            text-align: left;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
            display: block;
        }

        .user-role {
            font-size: 12px;
            color: #7f8c8d;
        }

        /* Content Area */
        .content-area {
            padding: 30px;
        }

        /* Mobile Toggle */
        .mobile-toggle {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background: #149823;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            z-index: 1001;
        }

        /* Collapsed Sidebar Styles */
        .sidebar.collapsed {
            width: 70px;
            transition: width 0.3s ease;
        }

        /* Prevent layout shift during transitions */
        .sidebar {
            transition: width 0.3s ease;
        }

        .main-content {
            transition: margin-left 0.3s ease;
        }

        .sidebar.collapsed .sidebar-header h2,
        .sidebar.collapsed .sidebar-header p,
        .sidebar.collapsed .menu-section-title,
        .sidebar.collapsed .menu-item span,
        .sidebar.collapsed .submenu {
            display: none;
        }

        .sidebar.collapsed .menu-item {
            justify-content: center;
            padding: 15px;
        }

        .sidebar.collapsed .menu-item i {
            margin-right: 0;
        }

        .sidebar.collapsed .menu-item.has-submenu::after {
            display: none;
        }

        /* Adjust main content when sidebar is collapsed */
        .sidebar-collapsed .main-content {
            margin-left: 70px;
        }

        /* Tooltip for collapsed sidebar */
        .sidebar.collapsed .menu-item {
            position: relative;
        }

        .sidebar.collapsed .menu-item:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            left: 70px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            z-index: 1000;
            pointer-events: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                left: -280px;
            }

            .sidebar.show {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block;
            }

            .topbar {
                padding: 15px 20px;
            }

            .topbar-left h1 {
                font-size: 20px;
            }

            .content-area {
                padding: 20px;
            }
        }

        /* Additional Styles */
        <?= $this->renderSection('styles') ?>
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-leaf"></i>
                <div>
                    <h2>POLBAN</h2>
                    <p>Kampus Berkelanjutan</p>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <!-- Menu Utama -->
            <div class="menu-section">
                <div class="menu-section-title">Menu Utama</div>
                <a href="<?= base_url('dashboard') ?>" class="menu-item <?= ($page ?? '') == 'dashboard' ? 'active' : '' ?>" data-tooltip="Dashboard" onclick="console.log('Dashboard clicked, navigating to:', this.href);">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <!-- Kriteria SDGs -->
            <div class="menu-section">
                <div class="menu-section-title">Kriteria SDGs</div>
                <a href="<?= base_url('setting-infrastructure') ?>" class="menu-item <?= ($page ?? '') == 'setting-infrastructure' ? 'active' : '' ?>">
                    <i class="fas fa-building"></i>
                    <span>Pengaturan & Infrastruktur</span>
                </a>
                <a href="<?= base_url('energy-climate') ?>" class="menu-item <?= ($page ?? '') == 'energy-climate' ? 'active' : '' ?>">
                    <i class="fas fa-bolt"></i>
                    <span>Energi & Perubahan Iklim</span>
                </a>
                <a href="<?= base_url('water-management') ?>" class="menu-item <?= ($page ?? '') == 'water-management' ? 'active' : '' ?>">
                    <i class="fas fa-tint"></i>
                    <span>Pengelolaan Air</span>
                </a>
                <a href="<?= base_url('waste-management') ?>" class="menu-item <?= ($page ?? '') == 'waste-management' ? 'active' : '' ?>">
                    <i class="fas fa-recycle"></i>
                    <span>Pengelolaan Limbah</span>
                </a>
                <a href="<?= base_url('transportation') ?>" class="menu-item <?= ($page ?? '') == 'transportation' ? 'active' : '' ?>">
                    <i class="fas fa-bus"></i>
                    <span>Transportasi</span>
                </a>
                <a href="<?= base_url('education-research') ?>" class="menu-item <?= ($page ?? '') == 'education-research' ? 'active' : '' ?>">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Pendidikan & Penelitian</span>
                </a>
            </div>

            <!-- Sistem -->
            <div class="menu-section">
                <div class="menu-section-title">Sistem</div>

                <?php if (($user_role ?? '') === 'admin'): ?>
                    <a href="<?= base_url('users') ?>" class="menu-item <?= ($page ?? '') == 'users' ? 'active' : '' ?>" data-tooltip="Manajemen User">
                        <i class="fas fa-users"></i>
                        <span>Manajemen User</span>
                        <!-- Badge pending users dihapus -->
                    </a>

                    <a href="<?= base_url('menus') ?>" class="menu-item <?= ($page ?? '') == 'cms-menus' ? 'active' : '' ?>">
                        <i class="fas fa-bars"></i>
                        <span>Manajemen Menu</span>
                    </a>

                    <a href="<?= base_url('news-admin') ?>" class="menu-item <?= ($page ?? '') == 'cms-news' ? 'active' : '' ?>">
                        <i class="fas fa-newspaper"></i>
                        <span>Manajemen Berita</span>
                    </a>

                    <a href="<?= base_url('landing-contents') ?>" class="menu-item <?= ($page ?? '') == 'cms-landing' ? 'active' : '' ?>">
                        <i class="fas fa-file-alt"></i>
                        <span>Konten Landing Page</span>
                    </a>

                    <a href="<?= base_url('informasi-contents') ?>" class="menu-item <?= ($page ?? '') == 'cms-informasi' ? 'active' : '' ?>">
                        <i class="fas fa-info-circle"></i>
                        <span>Kelola Informasi</span>
                    </a>

                    <a href="<?= base_url('dashboard-contents') ?>" class="menu-item <?= ($page ?? '') == 'cms-dashboard' ? 'active' : '' ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Konten Dashboard</span>
                    </a>

                    <a href="<?= base_url('dashboard-statistics') ?>" class="menu-item <?= ($page ?? '') == 'cms-statistics' ? 'active' : '' ?>">
                        <i class="fas fa-chart-line"></i>
                        <span>Statistik Dashboard</span>
                    </a>

                    <!-- New Statistics & Charts Management Menu -->
                    <a href="<?= base_url('statistics') ?>" class="menu-item <?= ($page ?? '') == 'statistics' ? 'active' : '' ?>" data-tooltip="Manajemen Statistik & Chart">
                        <i class="fas fa-chart-line"></i>
                        <span>Manajemen Statistik & Chart</span>
                    </a>
                <?php endif; ?>

                <!-- Laporan Menu with Dropdown - No Separate Riwayat Items -->
                <a href="#" class="menu-item has-submenu <?= in_array(($page ?? ''), ['laporan', 'laporan_kaprodi', 'riwayat_laporan', 'riwayat_kaprodi', 'riwayat_laporan_kaprodi']) ? 'active open' : '' ?>" data-menu-id="laporan-menu">
                    <i class="fas fa-file-alt"></i>
                    <span>Laporan</span>
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </a>
                <div class="submenu <?= in_array(($page ?? ''), ['laporan', 'laporan_kaprodi', 'riwayat_laporan', 'riwayat_kaprodi', 'riwayat_laporan_kaprodi']) ? 'show' : '' ?>">
                    <?php if (($user_role ?? '') === 'admin'): ?>
                        <!-- Admin melihat kedua opsi laporan -->
                        <a href="<?= base_url('laporan') ?>" class="submenu-item <?= ($page ?? '') == 'laporan' ? 'active' : '' ?>">
                            <i class="fas fa-user-tie"></i> Laporan Dosen
                        </a>
                        <a href="<?= base_url('laporan/kaprodi') ?>" class="submenu-item <?= ($page ?? '') == 'laporan_kaprodi' ? 'active' : '' ?>">
                            <i class="fas fa-graduation-cap"></i> Laporan Kaprodi
                        </a>
                    <?php elseif (($user_role ?? '') === 'dosen'): ?>
                        <!-- Dosen hanya melihat laporan dosen -->
                        <a href="<?= base_url('laporan') ?>" class="submenu-item <?= ($page ?? '') == 'laporan' ? 'active' : '' ?>">
                            <i class="fas fa-user-tie"></i> Laporan Dosen
                        </a>
                    <?php elseif (($user_role ?? '') === 'kaprodi'): ?>
                        <!-- Kaprodi hanya melihat laporan kaprodi -->
                        <a href="<?= base_url('laporan/kaprodi') ?>" class="submenu-item <?= ($page ?? '') == 'laporan_kaprodi' ? 'active' : '' ?>">
                            <i class="fas fa-graduation-cap"></i> Laporan Kaprodi
                        </a>
                    <?php endif; ?>
                </div>

                <a href="<?= base_url('settings') ?>" class="menu-item <?= ($page ?? '') == 'settings' ? 'active' : '' ?>">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </a>

                <a href="<?= base_url('logout') ?>" class="menu-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="topbar-left">
                <button class="sidebar-toggle-btn" onclick="toggleSidebar()" title="Toggle Sidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <h1>Dashboard Kampus Berkelanjutan</h1>
                <div class="breadcrumb">
                    UI GreenMetric
                </div>
            </div>
            <div class="topbar-right">
                <div class="user-info">
                    <div class="user-avatar">
                        <?php if (!empty($profile_photo) && file_exists(FCPATH . 'uploads/profiles/' . $profile_photo)): ?>
                            <img src="<?= base_url('uploads/profiles/' . $profile_photo) ?>" alt="Profile">
                        <?php else: ?>
                            <?= isset($user_name) ? strtoupper(substr($user_name, 0, 1)) : 'U' ?>
                        <?php endif; ?>
                    </div>
                    <div class="user-details">
                        <span class="user-name"><?= $user_name ?? 'User' ?></span>
                        <span class="user-role"><?= ucfirst($user_role ?? 'user') ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <!-- Mobile Toggle Button -->
    <button class="mobile-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js for statistics and charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- jQuery for AJAX operations -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr for notifications -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // Persistent Sidebar State Management
        const SIDEBAR_STATE_KEY = 'polban_sidebar_state';
        const SUBMENU_STATE_KEY = 'polban_submenu_states';

        // Toggle Sidebar (Mobile & Desktop)
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const isOpen = sidebar.classList.contains('show') || window.innerWidth > 768;

            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('show');
            } else {
                // Desktop: Toggle collapsed state
                sidebar.classList.toggle('collapsed');
                document.body.classList.toggle('sidebar-collapsed');

                // Save state
                localStorage.setItem(SIDEBAR_STATE_KEY, sidebar.classList.contains('collapsed') ? 'collapsed' : 'expanded');
            }
        }

        // Toggle Submenu with persistence - FIXED VERSION
        function toggleSubmenu(event, element) {
            // Only prevent default for submenu toggle, not regular navigation
            if (element.classList.contains('has-submenu')) {
                event.preventDefault();
                event.stopPropagation();

                const isOpen = element.classList.contains('open');
                element.classList.toggle('open');

                const submenu = element.nextElementSibling;
                if (submenu && submenu.classList.contains('submenu')) {
                    submenu.classList.toggle('show');
                }

                // Save submenu state
                const menuId = element.getAttribute('data-menu-id') || element.textContent.trim();
                saveSubmenuState(menuId, !isOpen);
            }
        }

        // Save submenu state to localStorage
        function saveSubmenuState(menuId, isOpen) {
            let submenuStates = JSON.parse(localStorage.getItem(SUBMENU_STATE_KEY) || '{}');
            submenuStates[menuId] = isOpen;
            localStorage.setItem(SUBMENU_STATE_KEY, JSON.stringify(submenuStates));
        }

        // Restore submenu states
        function restoreSubmenuStates() {
            const submenuStates = JSON.parse(localStorage.getItem(SUBMENU_STATE_KEY) || '{}');

            document.querySelectorAll('.menu-item.has-submenu').forEach(function(menuItem) {
                const menuId = menuItem.getAttribute('data-menu-id') || menuItem.textContent.trim();
                const isOpen = submenuStates[menuId];

                if (isOpen) {
                    menuItem.classList.add('open');
                    const submenu = menuItem.nextElementSibling;
                    if (submenu && submenu.classList.contains('submenu')) {
                        submenu.classList.add('show');
                    }
                }
            });
        }

        // Restore sidebar state
        function restoreSidebarState() {
            const sidebarState = localStorage.getItem(SIDEBAR_STATE_KEY);
            const sidebar = document.getElementById('sidebar');

            if (window.innerWidth > 768 && sidebarState === 'collapsed') {
                sidebar.classList.add('collapsed');
                document.body.classList.add('sidebar-collapsed');
            }
        }

        // Handle menu clicks properly - SIMPLIFIED VERSION
        document.addEventListener('DOMContentLoaded', function() {
            // Restore sidebar state only
            restoreSidebarState();
            restoreSubmenuStates();

            // Add data-menu-id to submenu items for persistence
            document.querySelectorAll('.menu-item.has-submenu').forEach(function(item, index) {
                if (!item.getAttribute('data-menu-id')) {
                    item.setAttribute('data-menu-id', 'menu-' + index);
                }
            });

            // FIXED: Only handle submenu items, let regular menu items navigate normally
            const submenuItems = document.querySelectorAll('.menu-item.has-submenu');
            submenuItems.forEach(function(item) {
                item.addEventListener('click', function(e) {
                    // Only prevent default for submenu toggle
                    e.preventDefault();
                    e.stopPropagation();
                    toggleSubmenu(e, this);
                });
            });

            // Don't add any event listeners to regular menu items
            // Let them navigate normally with their href attributes

            // DEBUG: Add console log to see if regular menu items are being clicked
            const regularMenuItems = document.querySelectorAll('.menu-item:not(.has-submenu)');
            regularMenuItems.forEach(function(item) {
                item.addEventListener('click', function(e) {
                    console.log('Regular menu item clicked:', this.href);
                    // Don't prevent default - let navigation happen
                });
            });

            // Don't try to set active menu from localStorage - let PHP handle it
            // This prevents conflicts between JavaScript and PHP active states
        });

        // Close sidebar when clicking outside (mobile only)
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.querySelector('.mobile-toggle');

            // DEBUG: Log all clicks
            console.log('Document click detected:', event.target);

            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');

            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
                restoreSidebarState();
            } else {
                sidebar.classList.remove('collapsed');
                document.body.classList.remove('sidebar-collapsed');
            }
        });
    </script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>