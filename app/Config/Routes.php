<?php

namespace Config;

// Ini sudah ada di file Routes.php
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Router\RouteCollection;

use App\Controllers\{
    DashboardController,
    SettingInfrastructureController,
    EnergyClimateController,
    WasteManagementController,
    WaterManagementController,
    TransportationController,
    EducationResearchController
};

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

// Dashboard
$routes->get('/', [DashboardController::class, 'index']);
$routes->get('/dashboard', [DashboardController::class, 'index']);

// Setting & Infrastructure CRUD
$routes->get('/setting-infrastructure', [SettingInfrastructureController::class, 'index']);
$routes->get('/setting-infrastructure/create', [SettingInfrastructureController::class, 'create']);
$routes->post('/setting-infrastructure/store', [SettingInfrastructureController::class, 'store']);
$routes->get('/setting-infrastructure/edit/{id}', [SettingInfrastructureController::class, 'edit']);
$routes->post('/setting-infrastructure/update/{id}', [SettingInfrastructureController::class, 'update']);
$routes->post('/setting-infrastructure/delete/{id}', [SettingInfrastructureController::class, 'delete']);
$routes->get('/setting-infrastructure/calculate', [SettingInfrastructureController::class, 'calculate']);

// Energy & Climate CRUD
$routes->get('/energy-climate', [EnergyClimateController::class, 'index']);
$routes->get('/energy-climate/create', [EnergyClimateController::class, 'create']);
$routes->post('/energy-climate/store', [EnergyClimateController::class, 'store']);
$routes->get('/energy-climate/edit/{id}', [EnergyClimateController::class, 'edit']);
$routes->post('/energy-climate/update/{id}', [EnergyClimateController::class, 'update']);
$routes->post('/energy-climate/delete/{id}', [EnergyClimateController::class, 'delete']);
$routes->get('/energy-climate/calculate', [EnergyClimateController::class, 'calculate']);

// Waste Management CRUD
$routes->get('/waste-management', [WasteManagementController::class, 'index']);
$routes->get('/waste-management/create', [WasteManagementController::class, 'create']);
$routes->post('/waste-management/store', [WasteManagementController::class, 'store']);
$routes->get('/waste-management/edit/{id}', [WasteManagementController::class, 'edit']);
$routes->post('/waste-management/update/{id}', [WasteManagementController::class, 'update']);
$routes->post('/waste-management/delete/{id}', [WasteManagementController::class, 'delete']);
$routes->get('/waste-management/calculate', [WasteManagementController::class, 'calculate']);

// Water Management CRUD
$routes->get('/water-management', [WaterManagementController::class, 'index']);
$routes->get('/water-management/create', [WaterManagementController::class, 'create']);
$routes->post('/water-management/store', [WaterManagementController::class, 'store']);
$routes->get('/water-management/edit/{id}', [WaterManagementController::class, 'edit']);
$routes->post('/water-management/update/{id}', [WaterManagementController::class, 'update']);
$routes->post('/water-management/delete/{id}', [WaterManagementController::class, 'delete']);
$routes->get('/water-management/calculate', [WaterManagementController::class, 'calculate']);

// Transportation CRUD
$routes->get('/transportation', [TransportationController::class, 'index']);
$routes->get('/transportation/create', [TransportationController::class, 'create']);
$routes->post('/transportation/store', [TransportationController::class, 'store']);
$routes->get('/transportation/edit/{id}', [TransportationController::class, 'edit']);
$routes->post('/transportation/update/{id}', [TransportationController::class, 'update']);
$routes->post('/transportation/delete/{id}', [TransportationController::class, 'delete']);
$routes->get('/transportation/calculate', [TransportationController::class, 'calculate']);

// Education & Research CRUD
$routes->get('/education-research', [EducationResearchController::class, 'index']);
$routes->get('/education-research/create', [EducationResearchController::class, 'create']);
$routes->post('/education-research/store', [EducationResearchController::class, 'store']);
$routes->get('/education-research/edit/{id}', [EducationResearchController::class, 'edit']);
$routes->post('/education-research/update/{id}', [EducationResearchController::class, 'update']);
$routes->post('/education-research/delete/{id}', [EducationResearchController::class, 'delete']);
$routes->get('/education-research/calculate', [EducationResearchController::class, 'calculate']);

// API Endpoints untuk Chart
$routes->get('/api/chart/setting-infrastructure', [SettingInfrastructureController::class, 'chartData']);
$routes->get('/api/chart/energy-climate', [EnergyClimateController::class, 'chartData']);
$routes->get('/api/chart/waste-management', [WasteManagementController::class, 'chartData']);
$routes->get('/api/chart/water-management', [WaterManagementController::class, 'chartData']);
$routes->get('/api/chart/transportation', [TransportationController::class, 'chartData']);
$routes->get('/api/chart/education-research', [EducationResearchController::class, 'chartData']);

?>