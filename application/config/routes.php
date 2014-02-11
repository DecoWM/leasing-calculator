<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "front/index_front/home";
$route['404_override'] = '';

/** Admin routes **/
$route['admin'] = "admin/index_back/home";
$route['admin/([a-z\_]+)'] = "admin/$1_back/index";
$route['admin/([a-z\_]+)/(:any)'] = "admin/$1_back/$2";

/** Front routes **/
$route['home'] = "front/index_front/home";
$route['season'] = "front/index_front/season";
$route['forecast'] = "front/forecast_front/view";
$route['forecast/(:any)'] = "front/forecast_front/$1";
$route['([a-z\_]+)/(:any)'] = "front/$1_front/$2";

/* End of file routes.php */
/* Location: ./application/config/routes.php */