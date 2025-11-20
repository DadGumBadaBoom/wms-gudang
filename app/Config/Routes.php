<?php

use CodeIgniter\Router\RouteCollection;

/**
 * File konfigurasi routing aplikasi
 * 
 * @var RouteCollection $routes
 */

// Default route - redirect ke login
$routes->get('/', 'Auth::index');

// Auth routes - Rate limiting: 5 percobaan per 5 menit per IP
$routes->group('auth', ['namespace' => 'App\Controllers', 'filter' => 'ratelimit'], function ($routes) {
    $routes->get('/', 'Auth::index');
    $routes->post('login', 'Auth::login');
    $routes->get('logout', 'Auth::logout');
});

// Dashboard
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);

// Barang (Aset Gudang)
$routes->group('barang', ['namespace' => 'App\Controllers', 'filter' => 'auth'], function ($routes) {
    $routes->get('/', 'BarangController::index');
    $routes->post('get-by-kode', 'BarangController::getByKode');
});

// Penerimaan
$routes->group('penerimaan', ['namespace' => 'App\Controllers', 'filter' => 'auth'], function ($routes) {
    $routes->get('/', 'PenerimaanController::index');
    $routes->post('store', 'PenerimaanController::store');
    $routes->post('get-by-po', 'PenerimaanController::getByPo');
});

// Pengeluaran
$routes->group('pengeluaran', ['namespace' => 'App\Controllers', 'filter' => 'auth'], function ($routes) {
    $routes->get('/', 'PengeluaranController::index');
    $routes->post('store', 'PengeluaranController::store');
});

// User Management (Admin Panel) - Memerlukan secret key
// Setup: Tambahkan user.admin.secret ke .env
// Akses: /user/admin?key=your_secret_key
$routes->group('user', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('index', 'UserController::index');
    $routes->get('admin', 'UserController::admin');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');
    $routes->get('change-password', 'UserController::changePassword');
    $routes->post('update-password', 'UserController::updatePassword');
});