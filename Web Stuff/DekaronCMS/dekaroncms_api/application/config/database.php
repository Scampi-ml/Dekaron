<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$MSSQL_HOST = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$MSSQL_USER = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$MSSQL_PASW = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$MSSQL_DRIV = 'sqlsrv';


$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$db['default']['username'] = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$db['default']['password'] = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$db['default']['database'] = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
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