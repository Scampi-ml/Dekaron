<?php
session_start();

// get current page
$currentFile = $_SERVER["PHP_SELF"];
$parts = explode('/', $currentFile);	
	
// is logged in ?
if(empty($_SESSION['admin_name']) && !isset($_SESSION['admin_name']))
{
	if ( preg_match ('/login.php/', $parts[count($parts) - 1] ))
	{
		// do nothing
	}
	else
	{
		echo "<script type='text/javascript'>window.location='login.php'; </script>";
		die();
	}
}

// Date and Time Settings
// List of Supported Timezones => http://www.php.net/manual/en/timezones.php
date_default_timezone_set("Europe/Paris");

// MSSQL Server settings
$MSSQL_DATABASE_IP = "37.59.180.41"; // Your server IP or NAME
$MSSQL_DATABASE_USER = "SaBaker1893"; // Your mssql username
$MSSQL_DATABASE_PASW = "ImPP8pL0h";	// Your mssql password
$MSSQL_DATABASE_PORT = "1433"; // Your mssql port (Default: 1433)

// Error reporting
error_reporting(0); // 0 = off | E_ALL = all errors
ini_set( "display_errors", "Off" ); // On = on | Off = off


//-------------------------- DO NOT EDIT BELOW THIS LINE! -----------------------------------------------

// Include SMARTY
require_once('libs/Smarty.class.php');

// Start Smarty & Smarty Settings
$smarty = new Smarty;
$smarty->debugging = false;
$smarty->caching = true;
$smarty->cache_lifetime = 240;
$smarty->force_compile = true;
$smarty->setTemplateDir('./templates')
	   ->setCompileDir('./templates_c/'.session_id())
	   ->setCacheDir('./cache/'.session_id());
		
// version in footer 
$smarty->assign("current_version_footer", @file_get_contents('engine/version.txt')); 
?>
