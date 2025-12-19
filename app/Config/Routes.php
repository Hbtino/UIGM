<?php

namespace Config;

// Ini sudah ada di file Routes.php
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Router\RouteCollection;




/**
 * @var RouteCollection $routes
 */

// Baris ini sudah ada (JANGAN DIHAPUS)
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::login');
$routes->post('/login/process', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/admin-unit', 'AdminUnitDashboardController::index', ['filter' => 'auth']);
$routes->get('/dashboard/user/info-sdgs', 'Dashboard::userInfoSdgs', ['filter' => 'auth']);
$routes->get('/dashboard/user/kriteria', 'Dashboard::userKriteria', ['filter' => 'auth']);
// Registration routes removed
$routes->get('/users', 'UserController::index', ['filter' => 'admin']);
$routes->get('/users/delete/(:num)', 'UserController::delete/$1', ['filter' => 'admin']);
$routes->get('/users/edit/(:num)', 'UserController::edit/$1', ['filter' => 'admin']);
$routes->post('/users/update/(:num)', 'UserController::update/$1', ['filter' => 'admin']);
// ============================================
// TAMBAHKAN KODE INI DI BAWAH BARIS DI ATAS
// ============================================

// Dashboard Routes - Kampus Berkelanjutan
$routes->group('dashboard', function ($routes) {

    $routes->get('/', 'Dashboard::index');
    $routes->get('pengaturan-infrastruktur', 'Dashboard::pengaturanInfrastruktur');
    $routes->get('energi-iklim', 'Dashboard::energiIklim');
    $routes->get('limbah', 'Dashboard::limbah');
    $routes->get('air', 'Dashboard::air');
    $routes->get('transportasi', 'Dashboard::transportasi');
    $routes->get('pendidikan-penelitian', 'Dashboard::pendidikanPenelitian');
});

$routes->get('laporan', 'LaporanController::index', ['filter' => 'auth']);
$routes->get('dashboard/laporan', 'LaporanController::index', ['filter' => 'auth']);
$routes->get('laporan/kaprodi', 'LaporanController::kaprodi', ['filter' => 'auth']);
$routes->get('dashboard/laporan/kaprodi', 'LaporanController::kaprodi', ['filter' => 'auth']);
// Edit & Delete routes (must be before other laporan routes)
$routes->get('laporan/edit-dosen/(:num)', 'LaporanController::editDosen/$1', ['filter' => 'auth']);

// Admin Unit Dashboard Routes - UIGM
$routes->group('admin-unit-dashboard', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'AdminUnitDashboardController::index');
    $routes->get('waste-management', 'AdminUnitDashboardController::wasteManagement');
    $routes->post('store-waste-data', 'AdminUnitDashboardController::storeWasteData');
    $routes->get('settings', 'AdminUnitDashboardController::settings');
    $routes->get('logout', 'AdminUnitDashboardController::logout');
});

// User Dashboard Routes - UIGM
$routes->group('user-dashboard', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'UserDashboardController::index');
    $routes->get('waste-management', 'UserDashboardController::wasteManagement');
    $routes->post('store-waste-data', 'UserDashboardController::storeWasteData');
    $routes->get('settings', 'UserDashboardController::settings');
    $routes->get('logout', 'UserDashboardController::logout');
});

// Unit Routes - untuk fitur unit lainnya
$routes->group('unit', ['filter' => 'auth'], function ($routes) {
    $routes->get('evidence-upload', 'UnitController::evidenceUpload');
    $routes->post('evidence-upload', 'UnitController::storeEvidence');
    $routes->get('add-data', 'UnitController::addData');
    $routes->post('add-data', 'UnitController::storeData');
    $routes->get('data-list', 'UnitController::dataList');
    $routes->get('reports', 'UnitController::reports');
});
$routes->post('laporan/delete-dosen/(:num)', 'LaporanController::deleteDosen/$1', ['filter' => 'auth']);
$routes->get('laporan/edit-kaprodi/(:num)', 'LaporanController::editKaprodi/$1', ['filter' => 'auth']);
$routes->post('laporan/delete-kaprodi/(:num)', 'LaporanController::deleteKaprodi/$1', ['filter' => 'auth']);

// Riwayat & Export routes
$routes->get('laporan/debug-kaprodi', 'LaporanController::debugKaprodi'); // Debug route - no auth for testing
$routes->get('laporan/riwayat-dosen', 'LaporanController::riwayatDosen', ['filter' => 'auth']);
$routes->get('laporan/riwayat-kaprodi', 'LaporanController::riwayatKaprodi', ['filter' => 'auth']);
$routes->get('laporan/export-dosen-pdf', 'LaporanController::exportDosenPdf', ['filter' => 'auth']);
$routes->get('laporan/export-dosen-pdf/(:num)', 'LaporanController::exportDosenPdf/$1', ['filter' => 'auth']);
$routes->get('laporan/export-kaprodi-pdf', 'LaporanController::exportKaprodiPdf', ['filter' => 'auth']);
$routes->get('laporan/export-kaprodi-pdf/(:num)', 'LaporanController::exportKaprodiPdf/$1', ['filter' => 'auth']);

// Save routes
$routes->post('laporan/save-dosen', 'LaporanController::saveDosen', ['filter' => 'auth']);
$routes->post('laporan/save-kaprodi', 'LaporanController::saveKaprodi', ['filter' => 'auth']);
$routes->get('pengaturan', 'Dashboard::pengaturan');

$routes->group('setting-infrastructure', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'SettingInfrastructureController::index');
    $routes->get('data', 'SettingInfrastructureController::dataManagement');
    $routes->get('create', 'SettingInfrastructureController::create');
    $routes->post('store', 'SettingInfrastructureController::store');
    $routes->get('edit/(:num)', 'SettingInfrastructureController::edit/$1');
    $routes->post('update/(:num)', 'SettingInfrastructureController::update/$1');
    $routes->get('delete/(:num)', 'SettingInfrastructureController::delete/$1');
    $routes->get('verify/(:num)', 'SettingInfrastructureController::verify/$1');
    $routes->post('process-verification/(:num)', 'SettingInfrastructureController::processVerification/$1');
    $routes->get('download/(:num)', 'SettingInfrastructureController::download/$1');

    // Revision Request Routes
    $routes->get('request-revision/(:num)', 'SettingInfrastructureController::requestRevision/$1');
    $routes->post('submit-revision-request/(:num)', 'SettingInfrastructureController::submitRevisionRequest/$1');
    $routes->get('revisions', 'SettingInfrastructureController::revisionList');
    $routes->get('review-revision/(:num)', 'SettingInfrastructureController::reviewRevision/$1');
    $routes->post('process-revision-review/(:num)', 'SettingInfrastructureController::processRevisionReview/$1');
    $routes->get('my-revisions', 'SettingInfrastructureController::myRevisions');
});

// 2. ENERGY & CLIMATE CHANGE
$routes->group('energy-climate', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'EnergyClimateController::index');
    $routes->get('data', 'EnergyClimateController::dataManagement');
    $routes->get('create', 'EnergyClimateController::create');
    $routes->post('store', 'EnergyClimateController::store');
    $routes->get('edit/(:num)', 'EnergyClimateController::edit/$1');
    $routes->post('update/(:num)', 'EnergyClimateController::update/$1');
    $routes->get('delete/(:num)', 'EnergyClimateController::delete/$1');
    $routes->get('verify/(:num)', 'EnergyClimateController::verify/$1');
    $routes->post('process-verification/(:num)', 'EnergyClimateController::processVerification/$1');
    $routes->get('download/(:num)', 'EnergyClimateController::download/$1');

    // Revision Request Routes
    $routes->get('request-revision/(:num)', 'EnergyClimateController::requestRevision/$1');
    $routes->post('submit-revision-request/(:num)', 'EnergyClimateController::submitRevisionRequest/$1');
    $routes->get('revisions', 'EnergyClimateController::revisionList');
    $routes->get('review-revision/(:num)', 'EnergyClimateController::reviewRevision/$1');
    $routes->post('process-revision-review/(:num)', 'EnergyClimateController::processRevisionReview/$1');
    $routes->get('my-revisions', 'EnergyClimateController::myRevisions');
});

// 3. WATER MANAGEMENT
$routes->group('water-management', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'WaterManagementController::index');
    $routes->get('data', 'WaterManagementController::dataManagement');
    $routes->get('create', 'WaterManagementController::create');
    $routes->post('store', 'WaterManagementController::store');
    $routes->get('edit/(:num)', 'WaterManagementController::edit/$1');
    $routes->post('update/(:num)', 'WaterManagementController::update/$1');
    $routes->get('delete/(:num)', 'WaterManagementController::delete/$1');
    $routes->get('verify/(:num)', 'WaterManagementController::verify/$1');
    $routes->post('process-verification/(:num)', 'WaterManagementController::processVerification/$1');
    $routes->get('download/(:num)', 'WaterManagementController::download/$1');

    // Revision Request Routes
    $routes->get('request-revision/(:num)', 'WaterManagementController::requestRevision/$1');
    $routes->post('submit-revision-request/(:num)', 'WaterManagementController::submitRevisionRequest/$1');
    $routes->get('revisions', 'WaterManagementController::revisionList');
    $routes->get('review-revision/(:num)', 'WaterManagementController::reviewRevision/$1');
    $routes->post('process-revision-review/(:num)', 'WaterManagementController::processRevisionReview/$1');
    $routes->get('my-revisions', 'WaterManagementController::myRevisions');
});

// 4. WASTE MANAGEMENT
$routes->group('waste-management', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'WasteManagementController::index');
    $routes->get('data', 'WasteManagementController::dataManagement');
    $routes->get('create', 'WasteManagementController::create');
    $routes->post('store', 'WasteManagementController::store');
    $routes->get('edit/(:num)', 'WasteManagementController::edit/$1');
    $routes->post('update/(:num)', 'WasteManagementController::update/$1');
    $routes->get('delete/(:num)', 'WasteManagementController::delete/$1');
    $routes->get('verify/(:num)', 'WasteManagementController::verify/$1');
    $routes->post('process-verification/(:num)', 'WasteManagementController::processVerification/$1');
    $routes->get('download/(:num)', 'WasteManagementController::download/$1');

    // Revision Request Routes
    $routes->get('request-revision/(:num)', 'WasteManagementController::requestRevision/$1');
    $routes->post('submit-revision-request/(:num)', 'WasteManagementController::submitRevisionRequest/$1');
    $routes->get('revisions', 'WasteManagementController::revisionList');
    $routes->get('review-revision/(:num)', 'WasteManagementController::reviewRevision/$1');
    $routes->post('process-revision-review/(:num)', 'WasteManagementController::processRevisionReview/$1');
    $routes->get('my-revisions', 'WasteManagementController::myRevisions');
});



// 5. TRANSPORTATION
$routes->group('transportation', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'TransportationController::index');
    $routes->get('data', 'TransportationController::dataManagement');
    $routes->get('create', 'TransportationController::create');
    $routes->post('store', 'TransportationController::store');
    $routes->get('edit/(:num)', 'TransportationController::edit/$1');
    $routes->post('update/(:num)', 'TransportationController::update/$1');
    $routes->get('delete/(:num)', 'TransportationController::delete/$1');
    $routes->get('verify/(:num)', 'TransportationController::verify/$1');
    $routes->post('process-verification/(:num)', 'TransportationController::processVerification/$1');
    $routes->get('download/(:num)', 'TransportationController::download/$1');

    // Revision Request Routes
    $routes->get('request-revision/(:num)', 'TransportationController::requestRevision/$1');
    $routes->post('submit-revision-request/(:num)', 'TransportationController::submitRevisionRequest/$1');
    $routes->get('revisions', 'TransportationController::revisionList');
    $routes->get('review-revision/(:num)', 'TransportationController::reviewRevision/$1');
    $routes->post('process-revision-review/(:num)', 'TransportationController::processRevisionReview/$1');
    $routes->get('my-revisions', 'TransportationController::myRevisions');
});

// 5. EDUCATION & RESEARCH
$routes->group('education-research', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'EducationResearchController::index');
    $routes->get('data', 'EducationResearchController::dataManagement');
    $routes->get('create', 'EducationResearchController::create');
    $routes->post('store', 'EducationResearchController::store');
    $routes->get('edit/(:num)', 'EducationResearchController::edit/$1');
    $routes->post('update/(:num)', 'EducationResearchController::update/$1');
    $routes->get('delete/(:num)', 'EducationResearchController::delete/$1');
    $routes->get('verify/(:num)', 'EducationResearchController::verify/$1');
    $routes->post('process-verification/(:num)', 'EducationResearchController::processVerification/$1');
    $routes->get('download/(:num)', 'EducationResearchController::download/$1');

    // Revision Request Routes
    $routes->get('request-revision/(:num)', 'EducationResearchController::requestRevision/$1');
    $routes->post('submit-revision-request/(:num)', 'EducationResearchController::submitRevisionRequest/$1');
    $routes->get('revisions', 'EducationResearchController::revisionList');
    $routes->get('review-revision/(:num)', 'EducationResearchController::reviewRevision/$1');
    $routes->post('process-revision-review/(:num)', 'EducationResearchController::processRevisionReview/$1');
    $routes->get('my-revisions', 'EducationResearchController::myRevisions');
});

// ============================================
// USER MANAGEMENT ROUTES (Admin Only)
// ============================================

$routes->group('users', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');
    // Routes approval dihapus - tidak ada sistem registrasi
});

// ============================================
// CAPAIAN ROUTES (Dosen/Kaprodi)
// ============================================

$routes->group('capaian', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'CapaianController::index');
    $routes->get('create', 'CapaianController::create');
    $routes->post('store', 'CapaianController::store');
    $routes->get('edit/(:num)', 'CapaianController::edit/$1');
    $routes->post('update/(:num)', 'CapaianController::update/$1');
    $routes->get('delete/(:num)', 'CapaianController::delete/$1');
});

// ============================================
// GREENMETRIC & OTHER MODULES
// ============================================

$routes->group('greenmetric', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Greenmetric::index');
});

$routes->group('activity', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Activity::index');
});

$routes->group('performance', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Performance::index');
});

// ============================================
// ADMIN PANEL
// ============================================

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Admin::index');
});
$routes->get('/users/create', 'UserController::create');
$routes->post('/users/store', 'UserController::store');

// ============================================
// TEST ROUTES (Remove in production)
// ============================================
$routes->get('test/notifications', 'TestNotification::testPasswordRequests');
$routes->get('test-menu', 'TestMenu::index');
$routes->get('fix-duplicate-menus', 'FixDuplicateMenus::index');
$routes->get('fix-duplicate-menus/delete/(:num)', 'FixDuplicateMenus::delete/$1');
$routes->get('fix-duplicate-menus/auto-fix', 'FixDuplicateMenus::autoFix');
$routes->get('debug-session', 'DebugSession::index');
$routes->get('debug-session/clear', 'DebugSession::clearAll');

// ============================================
// CMS ROUTES (Admin Only)
// ============================================

// Menu Management - URL Pendek
$routes->get('menus', 'CmsController::menus', ['filter' => 'auth']);
$routes->get('menus/create', 'CmsController::createMenu', ['filter' => 'auth']);
$routes->post('menus/store', 'CmsController::storeMenu', ['filter' => 'auth']);
$routes->get('menus/edit/(:num)', 'CmsController::editMenu/$1', ['filter' => 'auth']);
$routes->post('menus/update/(:num)', 'CmsController::updateMenu/$1', ['filter' => 'auth']);
$routes->get('menus/delete/(:num)', 'CmsController::deleteMenu/$1', ['filter' => 'auth']);

// News Management - URL Pendek
$routes->get('news-admin', 'CmsController::news', ['filter' => 'auth']);
$routes->get('news-admin/create', 'CmsController::createNews', ['filter' => 'auth']);
$routes->post('news-admin/store', 'CmsController::storeNews', ['filter' => 'auth']);
$routes->get('news-admin/edit/(:num)', 'CmsController::editNews/$1', ['filter' => 'auth']);
$routes->post('news-admin/update/(:num)', 'CmsController::updateNews/$1', ['filter' => 'auth']);
$routes->get('news-admin/delete/(:num)', 'CmsController::deleteNews/$1', ['filter' => 'auth']);

// Content Management - URL Pendek
$routes->get('contents', 'CmsController::contents', ['filter' => 'auth']);
$routes->get('contents/edit/(:segment)/(:segment)', 'CmsController::editContent/$1/$2', ['filter' => 'auth']);
$routes->post('contents/update/(:num)', 'CmsController::updateContent/$1', ['filter' => 'auth']);

// Landing Page Content Management
$routes->get('landing-contents', 'CmsController::landingContents', ['filter' => 'auth']);
$routes->get('landing-contents/edit/(:segment)', 'CmsController::editLandingContent/$1', ['filter' => 'auth']);
$routes->post('landing-contents/update/(:segment)', 'CmsController::updateLandingContent/$1', ['filter' => 'auth']);

// Informasi Content Management
$routes->get('informasi-contents', 'CmsController::informasiContents', ['filter' => 'auth']);
$routes->post('informasi-contents/update', 'CmsController::updateInformasiContent', ['filter' => 'auth']);
$routes->post('cms/sync-dashboard-to-landing', 'CmsController::syncDashboardToLanding', ['filter' => 'auth']);

// Dashboard Content Management
$routes->get('dashboard-contents', 'CmsController::dashboardContents', ['filter' => 'auth']);
$routes->get('dashboard-contents/edit/(:segment)', 'CmsController::editDashboardContent/$1', ['filter' => 'auth']);
$routes->post('dashboard-contents/update/(:segment)', 'CmsController::updateDashboardContent/$1', ['filter' => 'auth']);

// Dashboard Statistics Management
$routes->get('dashboard-statistics', 'CmsController::dashboardStatistics', ['filter' => 'auth']);
$routes->get('dashboard-statistics/create', 'CmsController::createDashboardStatistic', ['filter' => 'auth']);
$routes->post('dashboard-statistics/store', 'CmsController::storeDashboardStatistic', ['filter' => 'auth']);
$routes->get('dashboard-statistics/edit/(:num)', 'CmsController::editDashboardStatistic/$1', ['filter' => 'auth']);
$routes->post('dashboard-statistics/update/(:num)', 'CmsController::updateDashboardStatistic/$1', ['filter' => 'auth']);
$routes->get('dashboard-statistics/delete/(:num)', 'CmsController::deleteDashboardStatistic/$1', ['filter' => 'auth']);

// Landing Page Statistics Management (Updated to use StatisticsController)
$routes->get('landing-statistics', 'StatisticsController::landingStats', ['filter' => 'auth']);

// Temporary fixed version
$routes->get('landing-statistics-fixed', 'StatisticsController::landingStatsFixed', ['filter' => 'auth']);

// DEBUG routes for JavaScript testing
$routes->get('debug-js', 'DebugController::testJavaScript');
$routes->post('cms/update-landing-statistic', 'CmsController::updateLandingStatistic', ['filter' => 'auth']);

// Landing Page Charts Management
$routes->get('landing-charts', 'CmsController::landingCharts', ['filter' => 'auth']);
$routes->post('cms/update-landing-chart', 'CmsController::updateLandingChart', ['filter' => 'auth']);

// ============================================
// TEST ROUTE (Remove after testing)
// ============================================
$routes->get('test-statistics', 'TestStatistics::index');
$routes->get('debug-session', 'DebugSession::index');
$routes->get('debug-landing-stats', function () {
    $landingStatModel = new \App\Models\LandingStatisticModel();
    $landingStats = $landingStatModel->getAllGrouped();

    echo '<h3>Landing Stats Debug:</h3>';
    echo '<pre>' . print_r($landingStats, true) . '</pre>';

    // Transform ranking data
    if (isset($landingStats['ranking_dunia'])) {
        $rankingDunia = [];
        foreach ($landingStats['ranking_dunia'] as $stat) {
            if (!str_contains($stat['key_name'], '_progress')) {
                $rankingDunia[] = [
                    'year' => $stat['label'],
                    'rank_value' => $stat['value']
                ];
            }
        }
        echo '<h3>Transformed Ranking Dunia:</h3>';
        echo '<pre>' . print_r($rankingDunia, true) . '</pre>';
    }
});


$routes->get('debug-sections', function () {
    $landingStatModel = new \App\Models\LandingStatisticModel();
    $landingStats = $landingStatModel->getAllGrouped();

    echo '<h3>Available Sections:</h3>';
    echo '<ul>';
    foreach (array_keys($landingStats) as $section) {
        echo '<li><strong>' . $section . '</strong> (' . count($landingStats[$section]) . ' items)</li>';
    }
    echo '</ul>';

    // Check specific sections needed by view
    $requiredSections = ['info_box', 'profil_kampus', 'fasilitas', 'ranking_dunia', 'ranking_indonesia'];
    echo '<h3>Required Sections Status:</h3>';
    echo '<ul>';
    foreach ($requiredSections as $section) {
        $status = isset($landingStats[$section]) ? '✅ EXISTS' : '❌ MISSING';
        echo '<li>' . $section . ': ' . $status . '</li>';
    }
    echo '</ul>';
});

// ============================================
// STATISTICS & CHARTS MANAGEMENT (New CRUD System)
// ============================================

$routes->group('statistics', ['filter' => 'auth'], function ($routes) {
    // Main statistics management page
    $routes->get('/', 'StatisticsController::index');

    // Landing page statistics CRUD
    $routes->get('landing', 'StatisticsController::landingStats');
    $routes->get('get-all-landing-stats', 'StatisticsController::getAllLandingStats');
    $routes->get('get-landing-stat/(:num)', 'StatisticsController::getLandingStat/$1');
    $routes->post('update-landing-stat', 'StatisticsController::updateLandingStat');
    $routes->post('update-landing-stat/(:num)', 'StatisticsController::updateLandingStatById/$1');
    $routes->post('create-landing-stat', 'StatisticsController::createLandingStat');
    $routes->post('delete-landing-stat', 'StatisticsController::deleteLandingStat');

    // Dashboard statistics CRUD
    $routes->get('dashboard', 'StatisticsController::dashboardStats');
    $routes->post('update-dashboard-stat', 'StatisticsController::updateDashboardStat');

    // Charts & indicators CRUD
    $routes->get('charts', 'StatisticsController::charts');
    $routes->get('get-landing-charts', 'StatisticsController::getLandingCharts');
    $routes->get('get-chart/(:num)', 'StatisticsController::getChart/$1');
    $routes->post('create-chart', 'StatisticsController::createChart');
    $routes->post('update-chart/(:num)', 'StatisticsController::updateChart/$1');
    $routes->delete('delete-chart/(:num)', 'StatisticsController::deleteChart/$1');

    // Chart data management
    $routes->post('update-chart-data', 'StatisticsController::updateChartData');
    $routes->post('sync-all', 'StatisticsController::syncAll');

    // Synchronization
    $routes->post('sync-statistics-to-charts', 'StatisticsController::syncStatisticsToCharts');
    $routes->post('bulk-sync', 'StatisticsController::bulkSync');

    // API endpoints
    $routes->get('api/chart-data/(:segment)', 'StatisticsController::getChartData/$1');
});

// ============================================
// PUBLIC FLOWCHART ROUTES (No Auth Required)
// ============================================
$routes->get('flowchart', 'FlowchartController::index');
$routes->get('flowchart-test', 'FlowchartController::test');
$routes->get('flowchart-simple', 'FlowchartController::simple');

// ============================================
// PUBLIC NEWS ROUTES (No Auth Required)
// ============================================
$routes->get('news', 'News::index');
$routes->get('news/(:segment)', 'News::detail/$1');

// PUBLIC PROGRAM ROUTES (No Auth Required)
// ============================================
$routes->get('program', 'Program::index');

// ============================================
// PERMISSION SYSTEM ROUTES (Admin Only)
// ============================================

// UIGM Period Management
$routes->get('uigm-periods', 'UIGMPeriodController::index', ['filter' => 'admin']);
$routes->get('uigm-periods/create', 'UIGMPeriodController::create', ['filter' => 'admin']);
$routes->post('uigm-periods/store', 'UIGMPeriodController::store', ['filter' => 'admin']);
$routes->get('uigm-periods/edit/(:num)', 'UIGMPeriodController::edit/$1', ['filter' => 'admin']);
$routes->post('uigm-periods/update/(:num)', 'UIGMPeriodController::update/$1', ['filter' => 'admin']);
$routes->get('uigm-periods/activate/(:num)', 'UIGMPeriodController::activate/$1', ['filter' => 'admin']);

// Approval Final
$routes->get('approval-final', 'ApprovalController::index', ['filter' => 'admin']);
$routes->get('approval-final/review/(:segment)/(:num)', 'ApprovalController::review/$1/$2', ['filter' => 'admin']);
$routes->post('approval-final/approve/(:segment)/(:num)', 'ApprovalController::approve/$1/$2', ['filter' => 'admin']);
$routes->post('approval-final/reject/(:segment)/(:num)', 'ApprovalController::reject/$1/$2', ['filter' => 'admin']);
$routes->post('approval-final/finalize/(:segment)', 'ApprovalController::finalize/$1', ['filter' => 'admin']);

// Admin Unit Routes
$routes->get('upload-bukti', 'AdminUnitController::uploadBukti', ['filter' => 'auth']);
$routes->post('upload-bukti/store', 'AdminUnitController::storeUploadBukti', ['filter' => 'auth']);
$routes->get('status-data', 'AdminUnitController::statusData', ['filter' => 'auth']);
$routes->get('laporan/unit', 'AdminUnitController::laporanUnit', ['filter' => 'auth']);

// Kaprodi Routes
$routes->get('review-dosen', 'KaprodiController::reviewDosen', ['filter' => 'auth']);
$routes->post('review-dosen/approve/(:num)', 'KaprodiController::approveDosen/$1', ['filter' => 'auth']);
$routes->get('statistik-prodi', 'KaprodiController::statistikProdi', ['filter' => 'auth']);

// Dosen Routes
$routes->get('status-pengajuan', 'DosenController::statusPengajuan', ['filter' => 'auth']);
$routes->get('riwayat-data', 'DosenController::riwayatData', ['filter' => 'auth']);

// ============================================
// SETTINGS ROUTES
// ============================================

$routes->group('settings', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'SettingsController::index');
    $routes->post('update-profile', 'SettingsController::updateProfile');
    $routes->post('upload-photo', 'SettingsController::uploadPhoto');
    $routes->post('delete-photo', 'SettingsController::deletePhoto');
    $routes->post('request-password-change', 'SettingsController::requestPasswordChange');
    $routes->get('pending-password-requests', 'SettingsController::getPendingPasswordRequests');
    $routes->get('password-requests', 'SettingsController::passwordRequests');
    $routes->post('process-password-request/(:num)', 'SettingsController::processPasswordRequest/$1');
    $routes->get('check-password-change-status', 'SettingsController::checkPasswordChangeStatus');
});

// ============================================
// CRITERIA ROUTES (Public - No Auth Required)
// ============================================

$routes->group('kriteria', function ($routes) {
    $routes->get('setting-infrastructure', 'CriteriaController::settingInfrastructure');
    $routes->get('energy-climate', 'CriteriaController::energyClimate');
    $routes->get('waste', 'CriteriaController::wasteManagement');
    $routes->get('water', 'CriteriaController::waterManagement');
    $routes->get('transportation', 'CriteriaController::transportation');
    $routes->get('education-research', 'CriteriaController::educationResearch');
});

// ============================================
// AJAX ROUTES FOR STATISTICS MANAGEMENT
// ============================================

// Landing Page Statistics AJAX
$routes->post('ajax/statistics-by-year', 'Home::getStatisticsByYear');
$routes->get('ajax/statistics-by-year', 'Home::getStatisticsByYear');

// Dashboard Statistics AJAX
$routes->get('ajax/dashboard-statistics', 'StatisticsController::getDashboardStatistics');
$routes->post('ajax/update-dashboard-stat', 'StatisticsController::updateDashboardStat');
$routes->post('ajax/delete-dashboard-stat', 'StatisticsController::deleteDashboardStat');

// Charts & Indicators AJAX
$routes->get('ajax/charts-indicators', 'StatisticsController::getChartsIndicators');
$routes->post('ajax/update-chart', 'StatisticsController::updateChart');
$routes->post('ajax/delete-chart', 'StatisticsController::deleteChart');
$routes->post('ajax/sync-charts', 'StatisticsController::syncCharts');
