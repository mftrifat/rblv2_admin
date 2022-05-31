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
$route['default_controller'] = 'Home';
$route['404_override'] = 'Home/custom_404';
$route['translate_uri_dashes'] = FALSE;

$route['Accounts/(:any)'] = 'Home';
$route['BasicController/(:any)'] = 'Home';
$route['Category/(:any)'] = 'Home';
$route['Home/(:any)'] = 'Home';
$route['Users/(:any)'] = 'Home';
$route['VerifyLogin/(:any)'] = 'Home';
$route['ExcelFileController/(:any)'] = 'Home';
$route['DownUp/(:any)'] = 'Home';
$route['Payments/(:any)'] = 'Home';

$route['login'] = 'VerifyLogin';
$route['logout'] = 'VerifyLogin/logout';
$route['resetpassword'] = 'VerifyLogin/reset_password';
$route['setnewpassword'] = 'VerifyLogin/setnewpassword';

$route['dashboard'] = 'Home/dashboard';
$route['changepassword'] = 'VerifyLogin/change_password';
$route['userprofile'] = 'VerifyLogin/user_profile_update';
$route['userprofilepic'] = 'VerifyLogin/user_profile_picture_update';

$route['all_account'] = 'Accounts/all_account';
$route['locked_account'] = 'Accounts/locked_account';
$route['unlock_account'] = 'Accounts/unlock_account';
$route['single_account'] = 'Accounts/single_account';
$route['used_account'] = 'Accounts/used_account';
$route['rejected_account'] = 'Accounts/rejected_account';

$route['download_account'] = 'DownUp/download_account';
$route['create_download_batch'] = 'DownUp/create_download_batch';
$route['mark_download'] = 'DownUp/mark_download';
$route['manage_downloads'] = 'DownUp/manage_downloads';
$route['download_mark_complete'] = 'DownUp/download_mark_complete';
$route['reset_reject'] = 'DownUp/reset_reject';
$route['upload_account'] = 'DownUp/upload_account';
$route['upload_email'] = 'DownUp/upload_email';
$route['locked_email'] = 'DownUp/locked_email';
$route['unlock_email'] = 'DownUp/unlock_email';

$route['add_category'] = 'Category/add_category';
$route['manage_category'] = 'Category/manage_category';
$route['edit_category'] = 'Category/edit_category';
$route['add_sub_category'] = 'Category/add_sub_category';
$route['manage_sub_category'] = 'Category/manage_sub_category';
$route['edit_sub_category'] = 'Category/edit_sub_category';

$route['add_user'] = 'Users/add_user';
$route['manage_user'] = 'Users/manage_user';
$route['edit_user'] = 'Users/edit_user';
$route['unlock_user'] = 'Users/unlock_user';
$route['edit_user_rate'] = 'Users/edit_user_rate';
$route['delete_rate'] = 'Users/delete_rate';

$route['pending_payment'] = 'Payments/pending_payment';
$route['confirm_payment'] = 'Payments/confirm_payment';
$route['all_payment'] = 'Payments/all_payment';

$route['ajax-get-sub-category/(:any)'] = 'BasicController/ajaxRequestGetSubCategory/$1';
$route['ajax-get-template-info/(:any)'] = 'BasicController/ajaxRequestGetTemplateInfo/$1';
$route['ajax-get-field-info/(:any)'] = 'BasicController/ajaxRequestGetFieldInfo/$1';