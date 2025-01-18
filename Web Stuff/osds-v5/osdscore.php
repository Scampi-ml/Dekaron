<?php
session_start();
ob_start();
include ('dev_janvier123.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>OSDS V5 | <?php echo exo_getglobalvariable('CONFIG_REGISTERD_TO', ''); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style2.css"  />
<link rel="stylesheet" type="text/css" href="messages.css"  />
<script type="text/javascript" src="js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
</head>
<body onLoad="cacheOff()">
<?php
@include_once ( "osds_config.php" );
error_reporting(E_ALL);
include 'class.errortalk.php';
errorTalk::initialize();
errorTalk::errorTalk_Open();

//+----------------------------------------------------------------------------+
//|     Flush, speed up php and query's
//+----------------------------------------------------------------------------+
function flush_this(){
    if (ob_get_length()){           
        @ob_flush();
        @flush();
        @ob_end_flush();
    }   
    @ob_start();
}
//+----------------------------------------------------------------------------+
//|     Add language file - Set by osds_config.php
//|		=====> is removed in 5.0.0.3
//+----------------------------------------------------------------------------+
include_once ( "language/en/index.php" );

if(!exo_getglobalvariable('CONFIG_REGISTERD_TO', ''))
{
	exo_setglobalvariable('CONFIG_REGISTERD_TO', 'By Janvier123 | Unregistered version', true);
}
//+----------------------------------------------------------------------------+
//|     OSDS Version
//+----------------------------------------------------------------------------+
$osds_version = "5.0.0.3";
//+----------------------------------------------------------------------------+
//|     Decode config mssql info
//+----------------------------------------------------------------------------+
if(!isset($_SESSION['MSSQL_SERVER']))
{
	include_once ( "class_enc_dec.php" );
	$crypt = new encryption_class;
	
	$pswdlen  						= '16';
	$adj      						= '1.75';
	$crypt->setAdjustment($adj);
	$mod     						= '3';
	$crypt->setModulus($mod); 
	   
	// Speed up the decoding, once its been done, it does not need to be decoded again
	$_SESSION['MSSQL_SERVER'] = $crypt->decrypt($CONFIG_KEY, $CONFIG_MSSQL_CONNECT_SERVER);
	$_SESSION['MSSQL_USER']	= $crypt->decrypt($CONFIG_KEY, $CONFIG_MSSQL_CONNECT_USER);
	$_SESSION['MSSQL_PASSWORD']	= $crypt->decrypt($CONFIG_KEY, $CONFIG_MSSQL_CONNECT_PASSWORD);
	if($crypt->errors)
	{
		 $crypt->errors;
		 die();
	}
}
//+----------------------------------------------------------------------------+
//|     Add database class
//+----------------------------------------------------------------------------+
define("MSSQL_SERVER", $_SESSION['MSSQL_SERVER']);
define("MSSQL_USER", $_SESSION['MSSQL_USER']);
define("MSSQL_PASSWORD", $_SESSION['MSSQL_PASSWORD']);

exo_setglobalvariable('CONFIG_SERVER', MSSQL_SERVER, true);
exo_setglobalvariable('CONFIG_USER', MSSQL_USER, true);
exo_setglobalvariable('CONFIG_PASSWORD', MSSQL_PASSWORD, true);



if(!exo_getglobalvariable('CONFIG_ODBC_SETUP', '')) //  var is not set and needs to be set // php does not like that
{
	exo_setglobalvariable('CONFIG_ODBC_SETUP', 'no', true); // set it to no so it will fail the next test
}

if(exo_getglobalvariable('CONFIG_ODBC_SETUP', '') != 'yes') // it failed cuz it was set no
{
	exo_runhescriptcom ("check.registry|".MSSQL_SERVER."|".MSSQL_USER."|".MSSQL_PASSWORD.""); // run functuion an function will set it to "yes"
}

include ( "class_db_account.php" );
include ( "class_db_cash.php" );
include ( "class_db_character.php" );
include ( "class_db_osds.php" );

$db_account 		= new DbConnect_account();
$db_cash 			= new DbConnect_cash();
$db_character 		= new DbConnect_character();
$db_osds 			= new DbConnect_osds();
//+----------------------------------------------------------------------------+
//|     Check for OSDS DB, added in 5.0.0.1
//+----------------------------------------------------------------------------+
if(!exo_getglobalvariable('CONFIG_OSDS_DB_CHECK', '')) //  var is not set and needs to be set // php does not like that
{
	exo_setglobalvariable('CONFIG_OSDS_DB_CHECK', 'no', true); // set it to no so it will fail the next test
}

if(exo_getglobalvariable('CONFIG_OSDS_DB_CHECK', '') != 'yes') // it failed cuz it was set no
{
	include ( "class_db_master.php" );
	$db_master = new DbConnect_master();
	
	$query_check_db = $db_master->query("SELECT * FROM sysdatabases WHERE name = 'osdsv5' ");
	$getDBcheck = $db_master->fetchNum($query_check_db);
	if($getDBcheck == 0)
	{
		exo_setglobalvariable('CONFIG_OSDS_DB_CHECK', 'yes', true);
		echo "<script type='text/javascript'>window.location='hescript://check.osdsdb';</script>";
		die();
	}
}
//+----------------------------------------------------------------------------+
//|     Functions
//+----------------------------------------------------------------------------+
include ( 'function_createnewid.php' );
include ( 'function_decodeip.php' );
include ( 'function_getCurrentfilename.php' );
include ( 'function_isvalid.php' );
include ( 'function_javaalert.php' );
include ( 'function_userno2date.php' );
include ( 'array_files.php' );
//+----------------------------------------------------------------------------+
//|     Login functions
//+----------------------------------------------------------------------------+
if ( getCurrentFileName() != 'index.php' && getCurrentFileName() != 'osdscore.php' && getCurrentFileName() != 'login.php'  && getCurrentFileName() != 'auto_login.php')
{
	if ( !isset ( $_SESSION['USER'] ) )
	{
		JavaAlert(LAN_notlogged, 'index.php');
		die();
	}
}

if ( isset ( $_SESSION['USER'] ) ) 
{
	if( !$_SESSION['ADMIN'] == '1' )
	{
		$query_prem = $db_osds->query("SELECT * FROM groups WHERE group_name = '".$_SESSION['GROUP']."' ");
		$getGroup = $db_osds->fetchArray($query_prem);
		
		$_SESSION['canread'] = unserialize($getGroup['canread']);
		$_SESSION['canwrite'] = unserialize($getGroup['canwrite']);
		
		if( !in_array ( getCurrentFileName(), $_SESSION['canread'] ) )
		{
			if( !in_array ( getCurrentFileName(), $do_not_show_files ) )
			{
				JavaAlert('No permisions here', 'index.php');
				die();
			}
		}
	}
}
//+----------------------------------------------------------------------------+
//|     Create a onetime key
//+----------------------------------------------------------------------------+
if(exo_getglobalvariable('applicationid', '') == NULL)
{	
	include ( 'function_createsn.php' );
	$second = createsn('6','ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789');

	$this_is_the_key = 'OSDSV5-'.$second;
	
	exo_setglobalvariable('applicationid', $this_is_the_key, true);
	include ( 'function_remote_mysql.php' );
	remote_mysql('regappid', '');
}
//+----------------------------------------------------------------------------+
//|     // set default settings IF not set
//+----------------------------------------------------------------------------+
if(!exo_getglobalvariable('CONFIG_RED_ACC', ''))
{
	exo_setglobalvariable('CONFIG_RED_ACC', 'yes', true);
}

if(!exo_getglobalvariable('CONFIG_RED_CHARS', ''))
{
	exo_setglobalvariable('CONFIG_RED_CHARS', 'yes', true);
}

if(!exo_getglobalvariable('CONFIG_M_SEARCH_CHARS', ''))
{
	exo_setglobalvariable('CONFIG_M_SEARCH_CHARS', '3', true);
}

if(!exo_getglobalvariable('CONFIG_SEARCH_MAX', ''))
{
	exo_setglobalvariable('CONFIG_SEARCH_MAX', '200', true);
}

if(!exo_getglobalvariable('CONFIG_DISPLAY_VERSION', ''))
{
	exo_setglobalvariable('CONFIG_DISPLAY_VERSION', 'yes', true);
}

if(!exo_getglobalvariable('CONFIG_SEARCH_IN', ''))
{
	exo_setglobalvariable('CONFIG_SEARCH_IN', '1', true);
}




//+----------------------------------------------------------------------------+
//|     Table Width
//+----------------------------------------------------------------------------+
$CONFIG_TABLE_PX1 = '600'; // number in px! Only use numbers!
$CONFIG_TABLE_PX2 = '300'; // number in px! Only use numbers! This is HALF of PX1
//+----------------------------------------------------------------------------+
//|     HTML Stuff
// => Removed 5.0.0.4
//+----------------------------------------------------------------------------+
define("HEADER", '');
define("FOOTER", '</body></html>');
?>
