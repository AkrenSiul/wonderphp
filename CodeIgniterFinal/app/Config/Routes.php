<?php

use App\Controllers\Users;
use App\Controllers\Wonders;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(false);
$routes->get('/', [Wonders::class, 'index']);
// Insertar formulario Wonder
$routes->get('frontend/new', [Wonders::class, 'new']);
// Crear nuevo Wonder
$routes->post('wonders/create', [Wonders::class, 'create']);
// Eliminar Wonder
$routes->get('wonders/del/(:segment)', [Wonders::class, 'delete']);
$routes->get('frontend/wonder/(:segment)', [Wonders::class, 'show']);



$routes->group("admin", function ($routes) {
    $routes->get('loginForm', [Users::class, 'loginForm']);
    $routes->get('registerForm', [Users::class, 'new']);
    $routes->post('create', [Users::class, 'create']);
    $routes->post('login', [Users::class, 'checkUser']);
    $routes->get('session', [Users::class, 'closeSession']);
});