<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/auth/attemptLogin', 'Auth::attemptLogin');
$routes->get('/logout', 'Auth::logout');
$routes->get('/admin/dashboard', 'Admin\Dashboard::index');
$routes->get('/public/dashboard', 'Public\Dashboard::index');
$routes->get('anggota', 'Anggota::index');
$routes->get('anggota/tambah', 'Anggota::tambah'); 
$routes->post('anggota/save', 'Anggota::save');
$routes->get('data-anggota', 'PublicController::anggota');