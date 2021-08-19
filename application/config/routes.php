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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['about-us'] = 'welcome/about_us';
$route['admin/login'] = 'admin/login';
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/leave-dashboard'] = 'admin/leave_dashboard';
$route['admin/add-department'] = 'Admin/add_department';
$route['admin/add-permissions'] = 'Admin/add_permissions';
$route['admin/department-master'] = 'Admin/department_master';
$route['admin/leave-details-master'] = 'Admin/leave_details_master';
$route['admin/leave-status-master'] = 'Admin/leave_status_master';
$route['admin/addleave-details-master'] = 'Admin/addleave_details_master';
$route['admin/leave-type-master'] = 'Admin/leavetype_master';
$route['admin/edit-department-master/(:any)'] = 'Admin/edit_department_master/$1';
$route['admin/edit-user-master/(:any)'] = 'Admin/edit_user_master/$1';
$route['admin/add-leavetype'] = 'Admin/add_leavetype';
$route['admin/edit-leavetype-master/(:any)'] = 'Admin/edit_leavetype_master/$1';
$route['admin/delete-department-master/(:any)'] = 'Admin/delete_department_master/$1';
$route['admin/delete-leavetype-master/(:any)'] = 'admin/delete_leavetype_master/$1';
$route['admin/delete-leave-status-master/(:any)'] = 'admin/delete_leave_status_master/$1';
$route['admin/delete-user-master/(:any)'] = 'admin/delete_user_master/$1';
$route['admin/adduser-master'] = 'Admin/adduser_master';
$route['admin/addusersalarydetails-master'] = 'Admin/addusersalarydetails_master';
$route['admin/leave-request-action'] = 'Admin/leave_request_action';
$route['admin/view-master-profile/(:any)'] = 'Admin/view_master_profile/$1';
$route['admin/alluser-master'] = 'Admin/alluser_master';
$route['admin/userpayslip-master'] = 'Admin/userpayslip_master';
$route['admin/login-master'] = 'Admin/login_master';
$route['admin/google-login'] = 'Admin/google_login';
$route['admin/invoice-print-master/(:any)'] = 'Admin/invoice_print_master/$1';
$route['admin/logout'] = 'Admin/logout';
$route['admin/google-logout'] = 'Admin/google_logout';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
