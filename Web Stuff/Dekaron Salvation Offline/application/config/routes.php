<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "home";
$route['404_override'] = '';

$route['myaccount'] = 'myaccount/overview';
$route['myaccount/'] = 'myaccount/overview/$1/$2';

$route['community'] = 'community/overview';
$route['community/'] = 'community/$1/$2';

// Profile
$route['community/profile/(:any)'] = 'community/profile/view/$1';

// Character
$route['community/character/(:any)'] = 'community/character/view/$1';

/*
$route['changelog'] = 'changelog/overview';
$route['changelog/'] = 'changelog/overview/$1/$2';


route['news'] = 'news';
$route['news/(:num)'] = "news/$1";
*/