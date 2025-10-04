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
$routes->get('anggota/edit/(:num)', 'Anggota::edit/$1');
$routes->post('anggota/update/(:num)', 'Anggota::update/$1');
$routes->get('anggota/delete/(:num)', 'Anggota::delete/$1');
$routes->get('anggota/tambahKomponenGaji', 'Anggota::tambahKomponenGaji');
$routes->post('anggota/saveKomponenGaji', 'Anggota::saveKomponenGaji');
$routes->get('anggota/lihatKomponenGaji', 'Anggota::lihatKomponenGaji');
$routes->get('anggota/editKomponenGaji/(:num)', 'Anggota::editKomponenGaji/$1');
$routes->post('anggota/updateKomponenGaji/(:num)', 'Anggota::updateKomponenGaji/$1');
$routes->get('anggota/deleteKomponenGaji/(:num)', 'Anggota::deleteKomponenGaji/$1');
$routes->get('anggota/tambahPenggajian', 'Anggota::tambahPenggajian');
$routes->post('anggota/savePenggajian', 'Anggota::savePenggajian');
