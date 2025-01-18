<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$MSSQL_HOST = 'SERVER-PC\SQLEXPRESS';
$MSSQL_USER = 'sa';
$MSSQL_PASW = 'uber';
$MSSQL_DRIV = 'sqlsrv';


$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root2';
$db['default']['password'] = 'uber';
$db['default']['database'] = 'api';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;


$active_group = 'account';
$active_record = TRUE;
$db['account']['hostname'] = $MSSQL_HOST;
$db['account']['username'] = $MSSQL_USER;
$db['account']['password'] = $MSSQL_PASW;
$db['account']['database'] = 'account';
$db['account']['dbdriver'] = $MSSQL_DRIV;
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


$active_group = 'cash';
$active_record = TRUE;
$db['cash']['hostname'] = $MSSQL_HOST;
$db['cash']['username'] = $MSSQL_USER;
$db['cash']['password'] = $MSSQL_PASW;
$db['cash']['database'] = 'cash';
$db['cash']['dbdriver'] = $MSSQL_DRIV;
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

$active_group = 'character';
$active_record = TRUE;
$db['character']['hostname'] = $MSSQL_HOST;
$db['character']['username'] = $MSSQL_USER;
$db['character']['password'] = $MSSQL_PASW;
$db['character']['database'] = 'character';
$db['character']['dbdriver'] = $MSSQL_DRIV;
$db['character']['dbprefix'] = '';
$db['character']['pconnect'] = TRUE;
$db['character']['db_debug'] = TRUE;
$db['character']['cache_on'] = FALSE;
$db['character']['cachedir'] = '';
$db['character']['char_set'] = 'utf8';
$db['character']['dbcollat'] = 'utf8_general_ci';
$db['character']['swap_pre'] = '';
$db['character']['autoinit'] = TRUE;
$db['character']['stricton'] = FALSE;

$active_group = 'game';
$active_record = TRUE;
$db['game']['hostname'] = $MSSQL_HOST;
$db['game']['username'] = $MSSQL_USER;
$db['game']['password'] = $MSSQL_PASW;
$db['game']['database'] = 'game';
$db['game']['dbdriver'] = $MSSQL_DRIV;
$db['game']['dbprefix'] = '';
$db['game']['pconnect'] = TRUE;
$db['game']['db_debug'] = TRUE;
$db['game']['cache_on'] = FALSE;
$db['game']['cachedir'] = '';
$db['game']['char_set'] = 'utf8';
$db['game']['dbcollat'] = 'utf8_general_ci';
$db['game']['swap_pre'] = '';
$db['game']['autoinit'] = TRUE;
$db['game']['stricton'] = FALSE;

$active_group = 'website';
$active_record = TRUE;
$db['website']['hostname'] = $MSSQL_HOST;
$db['website']['username'] = $MSSQL_USER;
$db['website']['password'] = $MSSQL_PASW;
$db['website']['database'] = 'website';
$db['website']['dbdriver'] = $MSSQL_DRIV;
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