<?php

use App\Controllers\FactsController;
use App\Controllers\Users;
use App\Controllers\Wonders;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(false);
$routes->get('/', [Wonders::class, 'index/frontend']);
$routes->get('wonder/(:segment)', [Wonders::class, 'show/frontend']);
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


    // FACTS
    $routes->get('facts', [FactsController::class, 'index']);
    $routes->get('createFactForm', [FactsController::class, 'createForm']);
    $routes->post('createFact', [FactsController::class, 'createFact']);
    $routes->get('deleteFact/(:segment)', [FactsController::class, 'delete']);
    $routes->get('updateFactForm/(:segment)', [FactsController::class, 'updateForm']);
    $routes->post('updateFact/(:segment)', [FactsController::class, 'updateFact']);

    // WONDERS BACKEND

    $routes->get('wonders', [Wonders::class, 'index/backend']);
    $routes->get('wonder/(:segment)', [Wonders::class, 'show/backend']);
    $routes->get('deleteWonder/(:segment)', [Wonders::class, 'delete']);
    // Insertar formulario Wonder
    $routes->get('createWonderForm', [Wonders::class, 'createForm']);
    // Crear nuevo Wonder
    $routes->post('createWonder', [Wonders::class, 'createWonder']);
    $routes->get('updateWonderForm/(:segment)', [Wonders::class, 'updateForm']);
    $routes->post('updateWonder/(:segment)', [Wonders::class, 'updateWonder']);
});

