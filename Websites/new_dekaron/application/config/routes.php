<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$route['default_controller'] = "home";
$route['404_override'] = '';

$route['myaccount'] = 'myaccount/overview';
$route['myaccount/'] = 'myaccount/overview/$1/$2';

$route['community'] = 'community/overview';
$route['community/'] = 'community/overview/$1/$2';