<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// ADMIN AUTH ROUTE
$routes->group('admin/auth', ['namespace' => 'App\Controllers\Auth\Admin'], function ($routes) {
    $routes->get('login', 'AuthController::index');

    $routes->post('login', 'AuthController::login');

    $routes->get('logout', 'AuthController::logout');
});

// ADMIN PROTECTED ROUTE
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'auth'], function ($routes) {
    $routes->get('/', 'AdminController::index');

    $routes->get('list-employee', 'ListEmployeeController::index');

    $routes->post('list-employee/delete', 'ListEmployeeController::delete');

    $routes->get('create-employee', 'CreateEmployeeController::create');

    $routes->post('create-employee', 'CreateEmployeeController::store');
});