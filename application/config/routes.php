<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/


$route['default_controller'] = 'mailer';
// $route['default_controller'] = 'Register_controller/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// login and register
$route['crud_demo/registerForm'] = 'Register_controller/registerForm';
$route['crud_demo/login'] = 'Login_controller/login';
$route['crud_demo/logout'] ='Login_controller/logout';
$route['crud_demo/book/changePass'] = 'Login_controller/changePassword';

// codelgniter route
$route['crud_demo/dashboard'] = 'Book_controller/get_books';
$route['crud_demo/dashboard/(:any)'] = 'Book_controller/get_books/$1';
$route['crud_demo/book/store'] = 'Book_controller/store';
$route['crud_demo/book/delete/(:any)'] = 'Book_controller/delete/$1';
$route['crud_demo/book/edit/(:any)'] = 'Book_controller/edit/$1';
$route['crud_demo/book/update/(:any)'] = "Book_controller/update/$1";
$route['crud_demo/book/updatestatus/(:any)/(:any)'] = "Book_controller/updateStatus/$1/$2";

// serverside route
$route['crud_demo/display'] = 'Serverside_controller/index';
$route['crud_demo/display/get'] = 'Serverside_controller/get_data';
$route['crud_demo/display/insert'] = 'Serverside_controller/insert';
$route['crud_demo/display/delete/(:any)'] = 'Serverside_controller/delete/$1';
$route['crud_demo/display/edit/(:any)'] = 'Serverside_controller/edit/$1';
$route['crud_demo/display/update/(:any)'] = "Serverside_controller/update/$1";
$route['crud_demo/display/updateStatus/(:any)/(:any)'] = "Serverside_controller/updateStatus/$1/$2";

$route['lang'] = "Lang_controller";
$route['function'] = "Fun_controller/fun1";

$route['google_login/login'] = 'Google_login/login';


// crul demo:
$route['api'] = 'Curl_demo/index';
$route['api/register'] = 'Curl_demo/register';
$route['api/login'] = 'Curl_demo/loginView';
$route['api/loginuser'] = 'Curl_demo/login';

$route['api/dashboard'] = 'CurlBook_demo/getdata';

$route['api/book'] = 'CurlBook_demo/index';
$route['api/book/add'] = 'CurlBook_demo/store';

$route['api/book/delete'] = 'CurlBook_demo/delete';

$route['api/book/edit'] = 'CurlBook_demo/edit';
$route['api/book/update'] = 'CurlBook_demo/update';


$route['customer'] = 'Customer_controller/index';
$route['customer/csv_export'] = 'Customer_controller/exportCSV';
$route['customer/excel_export'] = 'Customer_controller/createExcel';

$route['import'] = 'Import_controller/index';
$route['import/csv_import'] = 'Import_controller/importCSV';
$route['import/excel_import'] = 'Import_controller/importExcel';






