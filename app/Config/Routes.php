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
$routes->get('/register', 'Auth::register');
$routes->post('/register/process', 'Auth::registerProcess');
$routes->get('/users', 'UserController::index', ['filter' => 'admin']);
$routes->get('/users/delete/(:num)', 'UserController::delete/$1', ['filter' => 'admin']);
$routes->get('/users/edit/(:num)', 'UserController::edit/$1', ['filter' => 'admin']);
$routes->post('/users/update/(:num)', 'UserController::update/$1', ['filter' => 'admin']);
$routes->get('/dashboard', 'DashboardController::index');
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
$routes->post('laporan/delete-dosen/(:num)', 'LaporanController::deleteDosen/$1', ['filter' => 'auth']);
$routes->get('laporan/edit-kaprodi/(:num)', 'LaporanController::editKaprodi/$1', ['filter' => 'auth']);
$routes->post('laporan/delete-kaprodi/(:num)', 'LaporanController::deleteKaprodi/$1', ['filter' => 'auth']);

// Riwayat & Export routes
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
    $routes->get('pending-approvals', 'UserController::pendingApprovals');
    $routes->get('approve/(:num)', 'UserController::approve/$1');
    $routes->post('reject/(:num)', 'UserController::reject/$1');
    $routes->get('pending-count', 'UserController::getPendingCount');
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

// ============================================
// PUBLIC NEWS ROUTES (No Auth Required)
// ============================================
$routes->get('news', 'News::index');
$routes->get('news/(:segment)', 'News::detail/$1');

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
