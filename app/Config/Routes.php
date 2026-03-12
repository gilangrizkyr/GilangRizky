<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home
$routes->get('/', 'HomeController::index');
$routes->get('og-image', 'HomeController::ogImage');

// Projects
$routes->get('projects', 'ProjectController::index');
$routes->get('projects/(:segment)', 'ProjectController::show/$1');

// Comments (AJAX)
$routes->post('comments', 'CommentController::store');

// Auth
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::auth');
$routes->get('logout', 'AuthController::logout');

// Admin Group
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Admin\Dashboard::index');

    // Bio
    $routes->get('bio', 'Admin\Bio::index');
    $routes->post('bio/update', 'Admin\Bio::update');

    // Skills
    $routes->get('skills', 'Admin\Skills::index');
    $routes->get('skills/new', 'Admin\Skills::new');
    $routes->post('skills/create', 'Admin\Skills::create');
    $routes->get('skills/edit/(:num)', 'Admin\Skills::edit/$1');
    $routes->post('skills/update/(:num)', 'Admin\Skills::update/$1');
    $routes->get('skills/delete/(:num)', 'Admin\Skills::delete/$1');

    // Projects
    $routes->get('projects', 'Admin\Projects::index');
    $routes->get('projects/new', 'Admin\Projects::new');
    $routes->post('projects/create', 'Admin\Projects::create');
    $routes->get('projects/edit/(:num)', 'Admin\Projects::edit/$1');
    $routes->post('projects/update/(:num)', 'Admin\Projects::update/$1');
    $routes->get('projects/delete/(:num)', 'Admin\Projects::delete/$1');

    // Comments
    $routes->get('comments', 'Admin\Comments::index');
    $routes->get('comments/approve/(:num)', 'Admin\Comments::approve/$1');
    $routes->get('comments/deactivate/(:num)', 'Admin\Comments::deactivate/$1');
    $routes->get('comments/delete/(:num)', 'Admin\Comments::delete/$1');
});