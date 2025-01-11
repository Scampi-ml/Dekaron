<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP MSSQL Tester</title>
</head>
<body>
<h1>PHP MSSQL Tester</h1>
<?php
// Author: 			janvier123
// Copyright:		janvier123.be
// Date:			17 Feb 2012

// MSSQL Connection Settings
$server = '<YOUR_IP_HERE>';	
$user = '<YOUR_USER_HERE>';
$password = '<YOUR_PASSWORD_HEE>';

echo "<h2>Begin Testing ...</h2><br><br>";

// Do not edit this!
if (!extension_loaded('mssql'))
{
	echo '<b style="color:#FF0000">Failed: The php extention "php_mssql" is not loaded or setup!
		  <br>Please enable "php_mssql" before i can test your connection.</b>';
}
else
{
	echo '<b style="color:#00FF00">Success: The php extention "php_mssql" is loaded!</b><br>';
	
	// Connect to MSSQL
	$connect = mssql_connect($server, $user, $password);
	
	if (!$connect)
	{
		echo '<b style="color:#FF0000">Failed:' . mssql_get_last_message().'</b><br>';
	}
	else
	{	
		echo '<b style="color:#00FF00">Successfully connected to your mssql server!</b><br>';
		$query = mssql_query("SELECT user_no FROM account.dbo.user_profile") or die(mssql_get_last_message());
		$rows = mssql_num_rows($query) or die(mssql_get_last_message());
		echo '<b style="color:#00FF00">Query Test: You have '.number_format($rows).' accounts!</b><br>';
	}
}
echo "<br><h2>Done testing!<h2><br>"
?>
</body>
</html>