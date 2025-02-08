<?php

use App\Controllers\Wonders;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(false);
$routes->get('/', [Wonders::class, 'index']);
$routes->get('frontend/wonder/(:segment)', [Wonders::class, 'show']);



$routes->group("admin", function ($routes) {

});