<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Default route
$routes->get('/', 'Auth::index');

// Auth routes
$routes->group('auth', ['namespace' => 'App\Controllers'], function ($routes) {
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
