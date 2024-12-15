<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// ADMIN AUTH ROUTE
$routes->group('admin', ['filter' => 'auth', 'namespace' => 'App\Controllers\Auth\Admin'], function ($routes) {

    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::login');
    $routes->get('logout', 'AuthController::logout');
});

// ADMIN PROTECTED ROUTE
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {

    $routes->get('/', 'DashboardController::index');
});