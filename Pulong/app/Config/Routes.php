<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

$routes->add('homepage','MyIndex::showIndex',['filter'=>'Noauth']);
//$routes->match(['get','post'],'login','Users::index',['filter'=>'Noauth']);
// $routes->add('pupil_login','Student::login');
// $routes->add('teacher_login','Teacher::login');
//$routes->add('admin_login','Admin::login');
$routes->match(['get','post'],'admin_login','Admin::login',['filter'=>'Noauth']);
$routes->match(['get','post'],'teacher_login','Teacher::login',['filter'=>'Noauth']);
$routes->match(['get','post'],'pupil_login','Pupil::login',['filter'=>'Noauth']);




//routes for admin page
$routes->group('admin', ["filter" => 'Auth'], function($routes){
 $routes->add('home','Admin::index');
 // $routes->add('register','Admin::register');
 $routes->match(['get','post'],'register','Admin::register');
  $routes->match(['get','post'],'update','Admin::update');
  $routes->add('viewlessons','Admin::viewlesson');
 $routes->add('viewmodule','Admin::viewmodule');
  $routes->add('viewcontent','Admin::viewcontent');
    $routes->get('logout', 'Admin::logout');
});
$routes->group('teacher', ["filter" => 'Auth'], function($routes){
  $routes->add('home','Teacher::index');
  $routes->add('view','Teacher::view');
 // // $routes->add('register','Admin::register');
 // $routes->match(['get','post'],'register','Admin::register');
 //  $routes->add('viewlessons','Admin::viewlesson');
 // $routes->add('viewmodule','Admin::viewmodule');
 //  $routes->add('viewcontent','Admin::viewcontent');
     $routes->get('logout', 'teacher::logout');
});

$routes->group('pupil', ["filter" => 'Auth'], function($routes){
  $routes->add('home','Pupil::index');
  $routes->add('view','Pupil::view');
 // // $routes->add('register','Admin::register');
 // $routes->match(['get','post'],'register','Admin::register');
 //  $routes->add('viewlessons','Admin::viewlesson');
 // $routes->add('viewmodule','Admin::viewmodule');
 //  $routes->add('viewcontent','Admin::viewcontent');
     $routes->get('logout', 'Pupil::logout');
});



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
