<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP MYSQL Tester</title>
</head>
<body>
<h1>PHP MYSQL Tester</h1>
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
if (!extension_loaded('mysql'))
{
	echo '<b style="color:#FF0000">Failed: The php extention "php_mysql" is not loaded or setup!
		  <br>Please enable "php_mysql" before i can test your connection.</b>';
}
else
{
	echo '<b style="color:#00FF00">Success: The php extention "php_mysql" is loaded!</b><br>';
	
	// Connect to MYSQL
	$connect = mysql_connect($server, $user, $password);
	mysql_select_db($database, $connect);
	
	if (!$connect)
	{
		echo '<b style="color:#FF0000">Failed:' . mysql_error().'</b><br>';
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