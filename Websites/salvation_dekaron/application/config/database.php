<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active_group = 'account';
$active_record = TRUE;
$db['account']['hostname'] = '127.0.0.1';
$db['account']['username'] = 'sa';
$db['account']['password'] = 'uber';
$db['account']['database'] = 'account';
$db['account']['dbdriver'] = 'sqlsrv';
$db['account']['dbprefix'] = '';
$db['account']['pconnect'] = TRUE;
$db['account']['db_debug'] = TRUE;
$db['account']['cache_on'] = FALSE;
$db['account']['cachedir'] = '';
$db['account']['char_set'] = 'utf8';
$db['account']['dbcollat'] = 'utf8_general_ci';
$db['account']['swap_pre'] = '';
$db['account']['autoinit'] = TRUE;
$db['account']['stricton'] = FALSE;
$db['account']['port'] = 1433;

$active_group = 'billing';
$active_record = TRUE;
$db['billing']['hostname'] = '127.0.0.1';
$db['billing']['username'] = 'sa';
$db['billing']['password'] = 'uber';
$db['billing']['database'] = 'billing';
$db['billing']['dbdriver'] = 'sqlsrv';
$db['billing']['dbprefix'] = '';
$db['billing']['pconnect'] = TRUE;
$db['billing']['db_debug'] = TRUE;
$db['billing']['cache_on'] = FALSE;
$db['billing']['cachedir'] = '';
$db['billing']['char_set'] = 'utf8';
$db['billing']['dbcollat'] = 'utf8_general_ci';
$db['billing']['swap_pre'] = '';
$db['billing']['autoinit'] = TRUE;
$db['billing']['stricton'] = FALSE;
$db['billing']['port'] = 1433;


$active_group = 'cash';
$active_record = TRUE;
$db['cash']['hostname'] = '127.0.0.1';
$db['cash']['username'] = 'sa';
$db['cash']['password'] = 'uber';
$db['cash']['database'] = 'cash';
$db['cash']['dbdriver'] = 'sqlsrv';
$db['cash']['dbprefix'] = '';
$db['cash']['pconnect'] = TRUE;
$db['cash']['db_debug'] = TRUE;
$db['cash']['cache_on'] = FALSE;
$db['cash']['cachedir'] = '';
$db['cash']['char_set'] = 'utf8';
$db['cash']['dbcollat'] = 'utf8_general_ci';
$db['cash']['swap_pre'] = '';
$db['cash']['autoinit'] = TRUE;
$db['cash']['stricton'] = FALSE;
$db['cash']['port'] = 1433;

$active_group = 'character';
$active_record = TRUE;

$db['character']['hostname'] = '127.0.0.1';
$db['character']['username'] = 'sa';
$db['character']['password'] = 'uber';
$db['character']['database'] = 'character';
$db['character']['dbdriver'] = 'sqlsrv';
$db['character']['dbprefix'] = '';
$db['character']['pconnect'] = TRUE;
$db['character']['db_debug'] = TRUE;
$db['character']['cache_on'] = false;
$db['character']['cachedir'] = 'application/cache';
$db['character']['char_set'] = 'utf8';
$db['character']['dbcollat'] = 'utf8_general_ci';
$db['character']['swap_pre'] = '';
$db['character']['autoinit'] = TRUE;
$db['character']['stricton'] = FALSE;
$db['character']['port'] = 1433;


$active_group = 'website';
$active_record = TRUE;

$db['website']['hostname'] = '127.0.0.1';
$db['website']['username'] = 'sa';
$db['website']['password'] = 'uber';
$db['website']['database'] = 'website';
$db['website']['dbdriver'] = 'sqlsrv';
$db['website']['dbprefix'] = '';
$db['website']['pconnect'] = TRUE;
$db['website']['db_debug'] = TRUE;
$db['website']['cache_on'] = FALSE;
$db['website']['cachedir'] = '';
$db['website']['char_set'] = 'utf8';
$db['website']['dbcollat'] = 'utf8_general_ci';
$db['website']['swap_pre'] = '';
$db['website']['autoinit'] = TRUE;
$db['website']['stricton'] = FALSE;
$db['website']['port'] = 1433;


/* End of file database.php */
/* Location: ./application/config/database.php */