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

// Opsional: Redirect root ke dashboard
// $routes->get('/', 'Dashboard::index');