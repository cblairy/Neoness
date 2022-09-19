<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Users::home');
$routes->get('news/(:segment)', 'News::view/$1');
$routes->get('news', 'News::index');

// home
$routes->get('home', 'Users::home');
$routes->get('home/disconnect', 'Users::home');
$routes->match(['get', 'post'], 'home', 'Users::login');
$routes->match(['get', 'post'],'home/registered', 'Users::registered');
$routes->get('sign_out', 'Users::signOut');
$routes->get('dashboard', 'Dashboard::Weekly');


// Registration
$routes->post('signUp', 'Users::signUp');
$routes->get('signUp', 'Users::signUp');
//$routes->post('home/registered', 'Users::registered');

// activities
$routes->post('create/(.+)', 'Users::create');
$routes->get('create', 'Users::create');
//$routes->post('myActivities', 'Users::activities');
$routes->post('detail', 'Activities::save');
$routes->post('create/save', 'Activities::save');

//profil
$routes->get('profil', 'Users::profil');
$routes->get('delete_account', 'Users::delete');


// graph
$routes->get('graph', 'GoogleCharts::index');

$routes->post('home/(.+)', 'Users::registered/$1');
// $routes->match(['get', 'post'], 'login', 'Users::login');


$routes->get('pages', 'Pages::index');
$routes->get('(:any)', 'Pages::view/$1');


// $routes->group('admin', static function ($routes) {
//     $routes->get('users', 'Admin\Users::index');
//     $routes->get('blog', 'Admin\Blog::index');
// });
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
