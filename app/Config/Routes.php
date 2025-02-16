<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Dashboard\DashboardController::index', ['filter' => 'auth']);

// ADMIN AUTH ROUTE
$routes->group('auth', ['namespace' => 'App\Controllers\Auth'], function ($routes) {
    $routes->get('login', 'AuthController::index');

    $routes->post('login', 'AuthController::login');

    $routes->get('logout', 'AuthController::logout');
});


// USERS MANAGEMENT ROUTES
$routes->group('staff', ['namespace' => 'App\Controllers\Users', 'filter' => 'auth'], function ($routes) {
    $routes->get('/',  'UsersController::index');

    $routes->get('create',  'UsersController::create');

    $routes->post('create', 'UsersController::store');

    $routes->get('edit/(:segment)', 'UsersController::edit/$1');

    $routes->post('update', 'UsersController::update');

    $routes->post('toggle-active', 'UsersController::toggleActive');

    $routes->post('delete', 'UsersController::delete');
});

// SUPPLIER MANAGEMENT ROUTES
$routes->group('supplier', ['namespace' => 'App\Controllers\Supplier', 'filter' => 'auth'], function ($routes) {
    $routes->get('/', 'SupplierController::index');

    $routes->get('create', 'SupplierController::create');

    $routes->post('create', 'SupplierController::store');

    $routes->group('(:segment)', function ($routes) {
        $routes->get('/', 'SupplierController::getSupplier/$1');

        $routes->post('edit', 'SupplierController::update');

        $routes->post('delete', 'SupplierController::delete');
    });
});

// INCOMING GOODS MANAGEMENT ROUTES
$routes->group('incoming-goods', ['namespace' => 'App\Controllers\IncomingGoods', 'filter' => 'auth'], function ($routes) {
    $routes->get('/', 'IncomingGoodsController::index');

    $routes->get('history', 'HistoryPurchasesController::index');

    $routes->group('manage-stock', function ($routes) {
        $routes->get('/', 'ManageStockController::index');

        $routes->get('(:segment)/create', 'ManageStockController::create/$1');

        $routes->post('create', 'ManageStockController::store');
    });
});

// OUTGOING GOODS MANAGEMENT ROUTES
$routes->group('outgoing-goods', ['namespace' => 'App\Controllers\OutgoingGoods', 'filter' => 'auth'], function ($routes) {
    $routes->get('/', 'OutgoingGoodsController::index');

    $routes->get('create', 'OutgoingGoodsController::create');

    $routes->post('create', 'OutgoingGoodsController::store');
});

// PRODUCTS MANAGEMENT ROUTES
$routes->group('products', ['namespace' => 'App\Controllers\Products', 'filter' => 'auth'], function ($routes) {
    $routes->get('/', 'ProductsController::index');

    $routes->get('create', 'ProductsController::create');

    $routes->post('create', 'ProductsController::store');

    $routes->get('edit/(:segment)', 'ProductsController::edit/$1');

    $routes->post('update', 'ProductsController::update');

    $routes->get('(:segment)', 'ProductsController::getProduct/$1');

    $routes->post('toggle-show-on-catalog', 'ProductsController::toggleShowOnCatalog');

    $routes->post('delete', 'ProductsController::delete');
});

// CATEGORY MANAGEMENT ROUTES
$routes->group('categories', ['namespace' => 'App\Controllers\Categories', 'filter' => 'auth'], function ($routes) {
    $routes->get('/', 'CategoriesController::index');

    $routes->post('create', 'CategoriesController::store');

    $routes->get('(:segment)', 'CategoriesController::getCategories/$1');

    $routes->post('update', 'CategoriesController::update');

    $routes->post('delete', 'CategoriesController::delete');
});
