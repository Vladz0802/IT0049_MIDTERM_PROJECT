<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Public pages
$routes->get('/', 'Pages::index');
$routes->get('about', 'Pages::about');

// Authentication
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attempt');
$routes->post('logout', 'Auth::logout');

// Everything below requires a logged-in staff member (see App\Filters\AuthFilter).
// Literal paths like "new" come before the (:num) routes.
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    // Products
    $routes->get('products', 'Products::index');
    $routes->get('products/new', 'Products::new');
    $routes->post('products', 'Products::create');
    $routes->get('products/(:num)/edit', 'Products::edit/$1');
    $routes->post('products/(:num)', 'Products::update/$1');
    $routes->post('products/(:num)/delete', 'Products::delete/$1');

    // Customers
    $routes->get('customers', 'Customers::index');
    $routes->get('customers/new', 'Customers::new');
    $routes->post('customers', 'Customers::create');
    $routes->get('customers/(:num)/edit', 'Customers::edit/$1');
    $routes->post('customers/(:num)', 'Customers::update/$1');
    $routes->post('customers/(:num)/delete', 'Customers::delete/$1');

    // Staff
    $routes->get('users', 'Users::index');
    $routes->get('users/new', 'Users::new');
    $routes->post('users', 'Users::create');
    $routes->get('users/(:num)/edit', 'Users::edit/$1');
    $routes->post('users/(:num)', 'Users::update/$1');
    $routes->post('users/(:num)/delete', 'Users::delete/$1');

    // Sales
    $routes->get('sales', 'Sales::index');
    $routes->get('sales/new', 'Sales::new');
    $routes->post('sales', 'Sales::create');
});
