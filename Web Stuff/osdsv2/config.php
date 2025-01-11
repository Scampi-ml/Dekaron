<?php

$site_root = "";
$site_email = "info@dkunderground.org";
$site_name = "OsDs V2";
$site_title = "OsDs V2";


$site_name = "OsDs V2";
$email_from = "info@dkunderground.org";
$sitehome = "/";
$lang = "en";
$log = "1";


// Fill in you mssql info here
$mssql = array(
				'host' => "localhost",	// Your host name
				'user' => "sa",			// Your username
				'pass' => "server"		// Your password
				);
				
							
//-------------------------- DONT CHANGE ANYTHING BELOW HERE -------------------------- 			
$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);

?>
