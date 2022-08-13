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
  $routes->match(['get','post'],'updateinfo/(:num)','Admin::updateinfo/$1');
  $routes->match(['get','post'],'changesection/(:num)','Admin::changesection/$1');
  $routes->match(['get','post'],'update','Admin::update');
  $routes->add('viewrose','Admin::viewrose');
  $routes->add('viewpupil_rose/(:alpha)','Admin::viewpupil_rose/$1');
  $routes->add('viewsectionperformance/(:alpha)','Admin::viewsectionperformance/$1');
  $routes->add('viewsection','Admin::viewsection');
  $routes->get('viewmoduleperformance/(:alpha)','Admin::viewmoduleperformance/$1');
  $routes->add('viewperformance_section','Admin::viewperformance_section');
  $routes->add('viewgumamela','Admin::viewgumamela');
  $routes->add('viewrosal','Admin::viewrosal');
  $routes->add('viewadelfa','Admin::viewadelfa');
  $routes->add('vieworchid','Admin::vieworchid');
  $routes->add('viewdaisy','Admin::viewdaisy');
  $routes->add('viewlily','Admin::viewlily');
  $routes->add('viewlily','Admin::viewlily');
  $routes->get('multiplechoice/(:num)','Admin::multiplechoice/$1');
  $routes->get('admin_activityperformance/(:num)/(:num)','Admin::admin_activityperformance/$1/$2');
  $routes->get('identification/(:num)','Admin::identification/$1');
  $routes->get('viewperformance_module/(:num)/(:num)','Admin::viewperformance_module/$1/$2');
  $routes->get('view_overallmoduleperformance/(:num)/(:num)','Admin::view_overallmoduleperformance/$1/$2');
  $routes->get('viewmodule/(:num)','Admin::viewmodule/$1');
  $routes->get('view_overallperformance/(:num)','Admin::view_overallperformance/$1');
  $routes->add('viewpupil_section/(:alpha)','Admin::viewpupil_section/$1');
  $routes->add('manage','Admin::manage');
  $routes->add('accountstatus','Admin::accountstatus');
//  $routes->add('viewmodule','Admin::viewmodule');
  $routes->add('viewcontent','Admin::viewcontent');
  $routes->add('view/(:num)','Admin::viewuser/$1');
  $routes->add('viewperformance/(:num)/(:num)','Admin::viewperformance/$1/$2');
  $routes->get('logout', 'Admin::logout');
  $routes->get('viewactivity/(:num)','Admin::viewactivity/$1');
});

$routes->group('teacher', ["filter" => 'Auth'], function($routes){
  $routes->add('home','Teacher::index');
  $routes->add('view','Teacher::view');
  $routes->add('viewpupil_section','Teacher::viewpupil_section');
  $routes->add('viewperformance_module/(:num)','Teacher::viewperformance_module/$1');
  $routes->get('module/(:num)','Teacher::module/$1');
//  $routes->get('viewmodule/(:num)','Teacher::viewmodule/$1');
  $routes->match(['get','post'],'viewmodule/(:num)','Teacher::viewmodule/$1');
  $routes->get('viewactivity/(:num)','Teacher::viewactivity/$1');
  $routes->get('publishactivity/(:num)','Teacher::publishactivity/$1');
  $routes->get('unpublish_multiplechoice/(:num)','Teacher::unpublish_multiplechoice/$1');
  $routes->get('publish_multiplechoice/(:num)','Teacher::publish_multiplechoice/$1');
  $routes->get('publish_identification/(:num)','Teacher::publish_identification/$1');
  $routes->get('unpublish_identification/(:num)','Teacher::unpublish_identification/$1');
  $routes->get('unpublishactivity/(:num)','Teacher::unpublishactivity/$1');
  $routes->get('delete_example/(:num)','Teacher::delete_example/$1');
  $routes->get('update_example/(:num)','Teacher::update_example/$1');
  $routes->add('removemodule','Teacher::removemodule');
  $routes->match(['get','post'],'update','Teacher::update');
  $routes->match(['get','post'],'register','Teacher::register');
 // // $routes->add('register','Admin::register');
 // $routes->match(['get','post'],'register','Admin::register');
   $routes->add('manage','Teacher::managelesson');
    $routes->match(['get','post'],'addexample','Teacher::addexample');
  $routes->add('manageaccount','Teacher::manage');
   $routes->match(['get','post'],'addmodule','Teacher::addmodule');
   $routes->add('viewmoduleperformance/(:num)','Teacher::viewmoduleperformance/$1');
  $routes->add('pupilaccountstatus','Teacher::accountstatus');
   $routes->add('view/(:num)','Teacher::viewuser/$1');
   $routes->add('updatemodule/(:num)','Teacher::updatemodule/$1');
   $routes->add('update_question/(:num)','Teacher::update_question/$1');
   $routes->get('teacher_activityperformance/(:num)/(:num)','Teacher::teacher_activityperformance/$1/$2');
   $routes->get('viewperformance/(:num)/(:num)','Teacher::viewperformance/$1/$2');
   $routes->add('delete/(:num)','Teacher::delete/$1');
   $routes->add('delete_activity/(:num)','Teacher::delete_activity/$1');
   $routes->add('delete_mainactivity/(:num)','Teacher::delete_mainactivity/$1');
   $routes->match(['get','post'],'addactivity/(:num)','Teacher::addactivity/$1');
   $routes->match(['get','post'],'update_identification/(:num)','Teacher::update_identification/$1');
  $routes->match(['get','post'],'addquestion/(:num)','Teacher::addquestion/$1');
    $routes->match(['get','post'],'addquestion_identification/(:num)','Teacher::addquestion_identification/$1');
   $routes->get('multiplechoice/(:num)','Teacher::multiplechoice/$1');
   $routes->get('identification/(:num)','Teacher::identification/$1');
   $routes->get('viewmoduletable/(:num)','Teacher::viewmoduletable/$1');

 // $routes->add('viewmodule','Admin::viewmodule');
 //  $routes->add('viewcontent','Admin::viewcontent');
    $routes->get('logout', 'Teacher::logout');
});

$routes->group('pupil', ["filter" => 'Auth'], function($routes){
  $routes->add('home','Pupil::index');
  $routes->add('view','Pupil::view');
  $routes->get('viewmoduletable/(:num)','Pupil::viewmoduletable/$1');
  $routes->get('viewmoduleactivity/(:num)','Pupil::viewmoduleactivity/$1');
  $routes->get('viewactivity/(:num)','Pupil::viewactivity/$1');
  $routes->get('viewperformance/(:num)','Pupil::viewperformance/$1');
  $routes->get('viewoverallperformance','Pupil::viewoverallperformance');
  $routes->get('viewactivitytable/(:num)','Pupil::viewactivitytable/$1');
  $routes->get('viewmodule/(:num)','Pupil::viewmodule/$1');
  $routes->get('viewactivity/(:num)','Pupil::viewactivity/$1');
  $routes->get('activitytype_checker/(:num)','Pupil::activitytype_checker/$1');
  $routes->get('multiplechoice/(:num)','Pupil::multiplechoice/$1');
  $routes->get('check/(:num)','Pupil::check/$1');
  $routes->get('check_identification/(:num)','Pupil::check_identification/$1');
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
