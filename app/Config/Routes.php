<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home
$routes->get('/', 'HomeController::index');

// Projects
$routes->get('projects', 'ProjectController::index');
$routes->get('projects/(:segment)', 'ProjectController::show/$1');

// Comments (AJAX)
$routes->post('comments', 'CommentController::store');
