<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->group('task', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Task::index');
    $routes->get('(:num)', 'Task::show/$1');
    $routes->post('/', 'Task::create');
    $routes->put('(:num)', 'Task::update/$1');
    $routes->delete('(:num)', 'Task::delete/$1');
});

// Public auth routes, first check if user is logged in or registered
$routes->post('register', 'Auth::register');
$routes->post('login', 'Auth::login');

//admin login and register

// //if user is authenticated and log in it can get all users
// $routes->get('users', 'User::getAllUsers', ['filter' => 'auth']);
// //if user is authenticated and log in it can get specific users
// $routes->get('users/(:num)', 'User::getUser/$1', ['filter' => 'auth']);

//
$routes->group('users', ['filter' => 'auth'], function($routes){
    $routes->get('/', 'User::getAllUsers');
    $routes->get('(:num)', 'User::getUser/$1');
});

$routes->group('admin', ['filter' => 'JWTAdmin'], function($routes){
    $routes->get('/', 'Admin::getAllUsers');
    $routes->get('(:num)', 'Admin::getUser/$1');
    $routes->delete('(:num)', 'Admin::delete/$1');
    $routes->patch('(:num)', 'Admin::update/$1');
});