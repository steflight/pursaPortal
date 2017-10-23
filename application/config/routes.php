<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['confirmation/codex'] = 'confirmation/codex';
$route['confirmation/create_password'] = 'confirmation/create_password';
$route['confirmation/(:any)'] = 'confirmation/index/$1';
// $route['users/code/(:any)'] = 'investments/investment/$1';
$route['users'] = 'users/create_user';
$route['users/create'] = 'users/create_user';
$route['users/send'] = 'users/send_mail';
$route['users/edit'] = 'users/edit';
$route['investments'] = 'investments/investment';
$route['investments/topup'] = 'investments/edit_investment';
$route['investments/topup/(:any)'] = 'investments/edit_investment/$1';
$route['investments/new/(:any)'] = 'investments/new_investment/$1';
$route['displays/details'] = 'displays/user_details';
$route['displays'] = 'displays/contract_details';
$route['displays/contract_details'] = 'displays/contract_details';



$route['default_controller'] = 'users/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
