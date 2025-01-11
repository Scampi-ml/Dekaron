<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP ODBC Tester</title>
</head>
<body>
<h1>PHP ODBC Tester</h1>
<?php
// Author: 			janvier123
// Copyright:		janvier123.be
// Date:			27 Feb 2012

// MYSQL Connection Settings
$server = '<YOUR_IP_HERE>';	
$user = '<YOUR_USER_HERE>';
$password = '<YOUR_PASSWORD_HEE>';
$database = '<YOUR_DATABASE_HEE>';

echo "<h2>Begin Testing ...</h2><br><br>";

// Do not edit this!
if (!extension_loaded('odbc'))
{
	echo '<b style="color:#FF0000">Failed: The php extention "php_odbc" is not loaded or setup!
		  <br>Please enable "php_odbc" before i can test your connection.</b>';
}
else
{
	echo '<b style="color:#00FF00">Success: The php extention "php_odbc" is loaded!</b><br>';
	
	// Connect to ODBC
	$connect = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$server;Database=$database;", $user, $password);
	if (!$connect)
	{
		echo '<b style="color:#FF0000">Failed:' . odbc_errormsg().'</b><br>';
	}
	else
	{	
		echo '<b style="color:#00FF00">Successfully connected to your mysql server!</b><br>';
	}
}
echo "<br><h2>Done testing!<h2><br>"
?>
</body>
</html>