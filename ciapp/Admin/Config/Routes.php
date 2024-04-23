<?php

namespace Admin\Config;

use Config\Services;

$adminNamespace = [
  'namespace' => 'Admin\Controllers',
  'filter' => 'group:admin' // the session filter comes with the shield extension, don't include flash messages
];

$routes = Services::routes();

$routes->group('admin', $adminNamespace, static function ($routes) {
  $routes->get('users', 'Users::index');
  $routes->get('users/(:num)', 'Users::show/$1');
  $routes->post('users/(:num)/toggle-ban', 'Users::toggleBan/$1');
  $routes->match(['get', 'post'], 'users/(:num)/groups', 'Users::groups/$1');
  $routes->match(['get', 'post'], 'users/(:num)/permissions', 'Users::permissions/$1');
});

// $routes->get('admin/users/(:num)', 'Users::show/$1', $adminNamespace);// when its in different namespace for a couple or more, of routes
