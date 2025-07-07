<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
$routes->get('/tos', 'Page::tos');

$routes->get('/artikel', 'Artikel::index');
$routes->get('/artikel/(:any)', 'Artikel::view/$1');

// API & AJAX
$routes->resource('post'); // REST API Praktikum 10
$routes->get('ajax/getData', 'AjaxController::getData');
$routes->delete('artikel/delete/(:num)', 'AjaxController::delete/$1');

// Admin Panel
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('artikel', 'Artikel::admin_index');       // AJAX table view
    $routes->add('artikel/add', 'Artikel::add');           // Form tambah
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1'); // Edit form
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1'); // Delete via GET (bisa kamu ubah ke delete)
});

// User Login
$routes->get('user/login', 'User::login');
$routes->post('user/login', 'User::login');


$routes->resource('post');