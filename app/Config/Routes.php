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
$routes->group('dashboard', function($routes) {
    
    $routes->get('/', 'Dashboard::index');
    $routes->get('pengaturan-infrastruktur', 'Dashboard::pengaturanInfrastruktur');
    $routes->get('energi-iklim', 'Dashboard::energiIklim');
    $routes->get('limbah', 'Dashboard::limbah');
    $routes->get('air', 'Dashboard::air');
    $routes->get('transportasi', 'Dashboard::transportasi');
    $routes->get('pendidikan-penelitian', 'Dashboard::pendidikanPenelitian');
});

$routes->get('laporan', 'Dashboard::laporan');
$routes->get('pengaturan', 'Dashboard::pengaturan');

$routes->group('setting-infrastructure', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'SettingInfrastructureController::index');
    $routes->get('create', 'SettingInfrastructureController::create');
    $routes->post('store', 'SettingInfrastructureController::store');
    $routes->get('edit/(:num)', 'SettingInfrastructureController::edit/$1');
    $routes->post('update/(:num)', 'SettingInfrastructureController::update/$1');
    $routes->get('delete/(:num)', 'SettingInfrastructureController::delete/$1');
});

// 2. ENERGY & CLIMATE CHANGE
$routes->group('energy-climate', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'EnergyClimateController::index');
    $routes->get('create', 'EnergyClimateController::create');
    $routes->post('store', 'EnergyClimateController::store');
    $routes->get('edit/(:num)', 'EnergyClimateController::edit/$1');
    $routes->post('update/(:num)', 'EnergyClimateController::update/$1');
    $routes->get('delete/(:num)', 'EnergyClimateController::delete/$1');
});

// 3. WASTE MANAGEMENT
$routes->group('waste-management', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'WasteManagementController::index');
    $routes->get('create', 'WasteManagementController::create');
    $routes->post('store', 'WasteManagementController::store');
    $routes->get('edit/(:num)', 'WasteManagementController::edit/$1');
    $routes->post('update/(:num)', 'WasteManagementController::update/$1');
    $routes->get('delete/(:num)', 'WasteManagementController::delete/$1');
});

// 4. WATER MANAGEMENT
$routes->group('water-management', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'WaterManagementController::index');
    $routes->get('create', 'WaterManagementController::create');
    $routes->post('store', 'WaterManagementController::store');
    $routes->get('edit/(:num)', 'WaterManagementController::edit/$1');
    $routes->post('update/(:num)', 'WaterManagementController::update/$1');
    $routes->get('delete/(:num)', 'WaterManagementController::delete/$1');
});

// 5. TRANSPORTATION
$routes->group('transportation', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'TransportationController::index');
    $routes->get('create', 'TransportationController::create');
    $routes->post('store', 'TransportationController::store');
    $routes->get('edit/(:num)', 'TransportationController::edit/$1');
    $routes->post('update/(:num)', 'TransportationController::update/$1');
    $routes->get('delete/(:num)', 'TransportationController::delete/$1');
});

// 6. EDUCATION & RESEARCH
$routes->group('education-research', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'EducationResearchController::index');
    $routes->get('create', 'EducationResearchController::create');
    $routes->post('store', 'EducationResearchController::store');
    $routes->get('edit/(:num)', 'EducationResearchController::edit/$1');
    $routes->post('update/(:num)', 'EducationResearchController::update/$1');
    $routes->get('delete/(:num)', 'EducationResearchController::delete/$1');
});

// ============================================
// USER MANAGEMENT ROUTES (Admin Only)
// ============================================

$routes->group('users', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');
});

// ============================================
// CAPAIAN ROUTES (Dosen/Kaprodi)
// ============================================

$routes->group('capaian', ['filter' => 'auth'], function($routes) {
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

$routes->group('greenmetric', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Greenmetric::index');
});

$routes->group('activity', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Activity::index');
});

$routes->group('performance', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Performance::index');
});

// ============================================
// ADMIN PANEL
// ============================================

$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Admin::index');
});
$routes->get('/users/create', 'UserController::create');
$routes->post('/users/store', 'UserController::store');
