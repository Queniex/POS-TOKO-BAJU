<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('UserController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->setAutoRoute(true);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'UserController::login', ['filter' => 'guest']);

// Login dan Register
$routes->get('/login', 'UserController::login', ['filter' => 'guest']);
$routes->post('/login', 'UserController::authenticate', ['filter' => 'guest']);
$routes->get('/register', 'UserController::register', ['filter' => 'guest']);
$routes->post('/register/store', 'UserController::store', ['filter' => 'guest']);
$routes->post('/logout', 'UserController::logout', ['filter' => 'auth']);

// Dashboard
$routes->get('/dashboard', 'UserController::index', ['filter' => 'auth']);

// Product
$routes->get('/product', 'ProductController::index', ['filter' => 'auth']);
$routes->get('/product/index', 'ProductController::index', ['filter' => 'auth']);
$routes->get('/product/(:any)', 'ProductController::$1', ['filter' => 'admin']);
$routes->post('/product/(:any)', 'ProductController::$1', ['filter' => 'admin']);

// Employee
$routes->get('/employee', 'EmployeeController::index');
$routes->get('/employee/(:any)', 'EmployeeController::$1', ['filter' => 'admin']);
$routes->post('/employee/(:any)', 'EmployeeController::$1', ['filter' => 'admin']);

// POS
$routes->get('/pos', 'PosController::index');
$routes->get('/pos/(:any)', 'PosController::$1', ['filter' => 'auth']);
$routes->post('/pos/(:any)', 'PosController::$1', ['filter' => 'auth']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
