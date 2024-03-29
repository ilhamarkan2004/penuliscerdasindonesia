<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'pci';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['form'] = 'pci/form';
$route['terbit'] = 'pci/terbit';

// Katalog
$route['katalog'] = 'pci/katalog';

// baca detail buku
$route['baca'] = 'pci/baca';

// create buku
$route['addkatalog'] = 'auth/create';
$route['addkontributor'] = 'auth/addkontributor';

$route['daftarbuku'] = 'auth/daftarbuku';

$route['delete'] = 'auth/delete';

$route['edit/(:num)'] = 'auth/edit/$1';

$route['view/(:num)'] = 'auth/view/$1';

$route['editcontributor/(:num)'] = 'auth/editcontributor/$1';

$route['auth/deletecontributor/(:any)'] = 'auth/deletecontributor/$1';




// $route['viewer'] = 'viewer/view_file';


//API
$route['api/login'] = 'Api/auth/login'; // POST
$route['api/register'] = 'Api/auth/regist'; // POST
$route['api/logout'] = 'Api/auth/logout'; // POST

$route['api/book/(:any)'] = 'Api/book/index/$1'; // GET
$route['api/listbook'] = 'Api/book/listBookBuy'; // GET
$route['api/viewbook/(:any)/(:any)'] = 'Api/book/viewBook/$1/$2'; // GET
$route['api/getcomment/(:any)'] = 'Api/book/getcomment/$1'; //GET
$route['api/postcomment'] = 'Api/book/postcomment'; //POST 

$route['api/transaksi'] = 'Api/transaksi/index'; // GET
$route['api/buybook/(:any)'] = 'Api/transaksi/buyBooks/$1'; // GET

$route['api/purchase'] = 'Api/buy/index'; // POST
