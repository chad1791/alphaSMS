<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//$route['admin'] = 'admins/page/$1';
/*$route['admin/messages/(:any)'] = 'pages_admin/messages/$1';
$route['admin/(:any)'] = 'pages_admin/page/$1';*/
//$route['(:any)'] = 'pages_users/$1';


//admin page routes

$route['(:any)'] = 'pages_admin/page/$1';
$route['student/(:any)'] = 'pages_admin/student/$1';
$route['class/(:any)'] = 'pages_admin/class/$1';

//teachers page routes
$route['teachers/(:any)'] = 'pages_users/page/$1';
$route['teachers/classes/grades/(:any)'] = 'pages_users/grades/$1';
$route['teachers/classes/attendance/(:any)'] = 'pages_users/attendance/$1';

//teachers page routes
$route['students/(:any)'] = 'pages_students/page/$1';

//$route['table/(:any)'] = 'pages_users/table/$1';

//dafault routes

$route['default_controller'] = 'pages_admin/page';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

