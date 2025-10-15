<?php

use CodeIgniter\Router\RouteCollection;

// Public routes **********************************************
$routes->post('/set-language', 'Language::setLanguage');

$routes->get('/', 'Home::index');

$routes->get('/sign-in', 'Auth::signInView');
$routes->post('/sign-in', 'Auth::signIn');

$routes->get('/sign-up', 'Auth::signUpView');
$routes->post('/sign-up', 'Auth::signUp');
$routes->get('activate/(:segment)', 'Auth::activateAccount/$1');
$routes->post('/sign-out', 'Auth::signOut');

$routes->get('/forgot-password', 'Auth::forgotPwdView');
$routes->post('forgot-password', 'Auth::sendResetLink');
$routes->get('/reset-password/(:segment)', 'Auth::resetPwdView/$1');
$routes->post('/reset-password/(:segment)', 'Auth::resetPassword/$1');

// Private routes *********************************************
$routes->group('', ['filter' => 'auth'], function($routes) {
  $routes->get('/dashboard', 'Dashboard::index');
});
