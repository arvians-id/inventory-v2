<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'LoginController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'LoginController/index';
$route['logout'] = 'LoginController/logout';

$route['home'] = 'DashboardController/index';

$route['administrator'] = 'AdministratorController/index';
$route['administrator/create'] = 'AdministratorController/create';
$route['administrator/delete/(:num)'] = 'AdministratorController/delete/$1';

$route['penerima'] = 'PenerimaController/index';
$route['penerima/create'] = 'PenerimaController/create';
$route['penerima/update/(:num)'] = 'PenerimaController/update/$1';
$route['penerima/delete/(:num)'] = 'PenerimaController/delete/$1';

$route['data-barang'] = 'BarangController/index';
$route['data-barang/create'] = 'BarangController/create';
$route['data-barang/update/(:num)'] = 'BarangController/update/$1';
$route['data-barang/delete/(:num)'] = 'BarangController/delete/$1';

$route['barang-masuk'] = 'BarangMasukController/index';
$route['barang-masuk/create'] = 'BarangMasukController/create';
$route['barang-masuk/update/(:any)'] = 'BarangMasukController/update/$1';
$route['barang-masuk/delete/(:any)'] = 'BarangMasukController/delete/$1';

$route['barang-keluar'] = 'BarangKeluarController/index';
$route['barang-keluar/create'] = 'BarangKeluarController/create';
$route['barang-keluar/update/(:any)'] = 'BarangKeluarController/update/$1';
$route['barang-keluar/delete/(:any)'] = 'BarangKeluarController/delete/$1';

$route['laporan'] = 'LaporanController/index';
$route['laporan/print'] = 'LaporanController/print';

$route['profile'] = 'ProfileController/index';
