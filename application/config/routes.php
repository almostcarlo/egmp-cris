<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';

$route['dashboard'] = 'home/dashboard';
$route['applicant'] = 'applicant/search';
$route['applicant/create'] = 'applicant/create_applicant';
$route['applicant/facebox/(:any)/(:num)'] = 'applicant/facebox/$1/$2';              /* CREATE FORM */
$route['applicant/facebox/(:any)/(:num)/(:num)'] = 'applicant/facebox/$1/$2/$3';    /* EDIT FORM */
$route['applicant/save_profile/(:any)'] = 'applicant/ajax_save_profile/$1';
$route['applicant/save_advisory/(:any)'] = 'applicant/ajax_save_adv/$1';
$route['applicant/delete/(:any)/(:num)'] = 'applicant/delete/$1/$2';
$route['applicant/upload/(:any)'] = 'applicant/upload/$1';
$route['accounts_card/(:any)'] = 'applicant/print_accounts_card/$1';
$route['download-file/(:any)'] = 'applicant/download_file/$1';

$route['pqd/(:any)/(:num)'] = 'applicant/pqd/$1/$2';
$route['pqd/(:any)'] = 'applicant/search';
$route['pqd'] = 'applicant/search';

$route['profile'] = 'applicant/search';
$route['profile/(:num)'] = 'applicant/profile/$1';
$route['profile/(:num)/(:any)'] = 'applicant/profile/$1/$2';

$route['settings/user'] = 'settings/search_user';
$route['settings/user/(:num)'] = 'settings/edit_user/$1';

/* SETTINGS EDIT-COMMON */ 
$route['settings/menu/(:num)'] = 'settings/edit/menu/$1';
$route['settings/clinic/(:num)'] = 'settings/edit/clinic/$1';

$route['settings/position'] = 'settings/search_position';
$route['settings/position/(:num)'] = 'settings/edit_position/$1';
$route['settings/principal'] = 'settings/search_principal';
$route['settings/principal/(:num)'] = 'settings/view_principal/$1';
$route['settings/principal/edit/(:num)'] = 'settings/edit_principal/$1';
$route['settings/company'] = 'settings/search_company';
$route['settings/company/edit/(:num)'] = 'settings/edit_company/$1';
$route['settings/files/(:any)/(:num)'] = 'settings/files/$1/$2';
$route['settings/save/(:any)'] = 'settings/save/$1';
$route['settings/delete/(:any)/(:num)'] = 'settings/delete/$1/$2';
$route['settings/delete/(:any)/(:num)/(:num)'] = 'settings/delete/$1/$2/$3';
$route['settings/delete_file/(:any)/(:num)'] = 'settings/delete_file/$1/$2';
$route['settings/facebox/(:any)'] = 'settings/facebox/$1';
$route['settings/facebox/(:any)/(:num)'] = 'settings/facebox/$1/$2';

$route['announcement'] = 'announcement';
$route['announcement/edit/(:num)'] = 'announcement/edit/$1';
$route['announcement/delete/(:num)'] = 'announcement/delete/$1';

$route['jobs/facebox'] = 'jobs/facebox';
$route['jobs/facebox/(:num)'] = 'jobs/facebox/$1';
$route['jobs/delete/(:num)'] = 'jobs/delete/$1';
$route['jobs/delete'] = 'jobs';

$route['reports/recruitment/(:any)'] = 'reports_recruitment/index/$1';
$route['reports/recruitment/forms/(:any)'] = 'reports_recruitment/forms/$1';
$route['print/reports/recruitment/(:any)'] = 'reports_recruitment/print_report/$1';

$route['reports/operations/(:any)'] = 'reports_operations/index/$1';
$route['reports/operations/forms/(:any)'] = 'reports_operations/forms/$1';
$route['print/reports/operations/(:any)'] = 'reports_operations/print_report/$1';

$route['reports/medical'] = 'reports_medical/index';

$route['login'] = 'home';
$route['change-password'] = 'home/change_pass_form';
$route['change-photo'] = 'home/change_pass_form';
$route['logout'] = 'home/logout';

$route['migration'] = 'migration/start';

$route['404_override'] = 'applicant/search';

$route['translate_uri_dashes'] = FALSE;