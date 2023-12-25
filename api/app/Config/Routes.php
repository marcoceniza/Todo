<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Todo::index');
$routes->post('add', 'Todo::addTodoHandler');
$routes->post('delete', 'Todo::deleteTodoHandler');
$routes->post('important', 'Todo::setToImportantHandler');
$routes->post('completed', 'Todo::setToCompletedHandler');