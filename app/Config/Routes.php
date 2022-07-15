<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//---------------------------- Pruebas --------------------------------

//------------------------------------------------------------
$routes->get('/image', 'Home::image');
$routes->get('/prueba', 'prueba::index');

$routes->get('/image/(:num)/(:any)', 'Home::image/$1/$2', ['as' => 'get_image']);
$routes->get('/movie/image/(:num)', 'Movie::delete_image/$1', ['as' => 'image_delete']);


//$routes->get('/contacto', 'Home::contacto');
$routes->get('/contacto/(:any)', 'Home::contacto/$1', ['as' => 'contacto']);
//group ->Agrupar rutas de navegacion
$routes->group('dashboard', function ($routes) {

	//$routes->get('movie', 'dashboard/MovieController::index');
	//$routes->get('movie/test/(:any)', 'dashboard/MovieController::test/$1');
	//$routes->get('movie/show/', 'dashboard/MovieController::show/');
});

$routes->resource('movie');
$routes->resource('category', ['except' => ['show']]);
$routes->resource('client', ['except' => ['show']]);


$routes->get('/login', 'web/User::login', ['as' => 'user_login_get']); //
$routes->post('/login_post', 'web/User::login_post', ['as' => 'user_login_post']);
$routes->post('/logout', 'web/User::logout', ['as' => 'user_logout']);


$routes->get('/im/image_fit', 'ImageManipulation::image_fit');
$routes->get('/im/image_crop', 'ImageManipulation::image_crop');
$routes->get('/im/image_quality', 'ImageManipulation::image_quality');
$routes->get('/im/image_rotate', 'ImageManipulation::image_rotate');
$routes->get('/im/image_resize', 'ImageManipulation::image_resize');
$routes->get('/im/image_multiple', 'ImageManipulation::image_multiple');

$routes->get('/my_request', 'Home::my_request');
$routes->get('/my_transaction', 'Home::my_transaction');
$routes->get('/my_database', 'Home::my_database');

//libraries
$routes->get('/lib/curl_get', 'MyLibraries::curl_get');
$routes->get('lib/agent', 'MyLibraries::agent');
$routes->get('lib/email', 'MyLibraries::email');
$routes->get('lib/encrypter', 'MyLibraries::encrypter');
$routes->get('lib/time', 'MyLibraries::time');
$routes->get('lib/uri', 'MyLibraries::uri');
$routes->get('lib/file', 'MyLibraries::file');

//Helpers
$routes->get('helper/array', 'MyHelper::array');
$routes->get('helper/filesystem', 'MyHelper::filesystem');
$routes->get('helper/number', 'MyHelper::number');
$routes->get('helper/text', 'MyHelper::text');
$routes->get('helper/url', 'MyHelper::url');
/***** Store ******/
$routes->get('/', 'Store/Movie::index', ['as' => 'store_movie_index']);
$routes->get('/store/(:num)', 'Store\Movie::show/$1', ['as' => 'store_movie_show']);
$routes->get('/store/movie/buy/(:num)', 'Store\Movie::buy/$1', ['as' => 'store_movie_buy']);
$routes->get('/store/movie/buy_success/(:num)', 'Store\Movie::buy_success/$1', ['as' => 'store_movie_buy_success']);
$routes->get('/store/movie/buy_cancel/(:num)', 'Store\Movie::buy_cancel/$1', ['as' => 'store_movie_buy_cancel']);
/*** Buyed***/
$routes->get('/store/buyed', 'Store\Buyed::index', ['as' => 'store_buyed_index']);


























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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
