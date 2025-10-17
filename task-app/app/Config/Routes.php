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
// Configure alias 'auth' for AuthFilter in app/Config/Filters.php
$routes->group('', ['filter' => 'auth'], function($routes) {
  $routes->get('/dashboard', 'Dashboard::index');
  $routes->get('/profile', 'UserProfile::profileView');
  $routes->get('/profile/edit', 'UserProfile::editProfileView');
  $routes->post('/profile/edit', 'UserProfile::updateProfile');
  $routes->get('/profile/change-password', 'UserProfile::changePasswordView');
  $routes->post('/profile/change-password', 'UserProfile::changePassword');

  $routes->get('/tasks', 'Task::tasksView');
  $routes->get('/tasks/new', 'Task::taskFormView');
  $routes->post('/tasks/new', 'Task::createTask');
  $routes->get('/tasks/(:segment)', 'Task::taskInfo/$1');
  $routes->post('/tasks/delete/(:segment)', 'Task::deleteTask/$1');
  $routes->get('/tasks/edit/(:segment)', 'Task::editTaskView/$1');
  $routes->post('/tasks/edit/(:segment)', 'Task::updateTask/$1');
});

// Configure alias 'isAdmin' for IsAdminFilter in app/Config/Filters.php
$routes->group('', ['filter' => 'isAdmin'], function($routes) {
  $routes->get('/users', 'User::usersView');
  $routes->get('/users/new', 'User::newUserView');
  $routes->post('/users/new', 'User::registerUser');
  $routes->get('/users/(:segment)', 'User::userInfo/$1');
  $routes->get('/users/edit/(:segment)', 'User::editUserView/$1');
  $routes->post('/users/edit/(:segment)', 'User::updateUser/$1');
  $routes->post('/users/delete/(:segment)', 'User::deleteUser/$1');
});
