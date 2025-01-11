<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP SQLsrv Tester</title>
</head>
<body>
<h1>PHP SQLsrv Tester</h1>
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
if (!extension_loaded('sqlsrv'))
{
	echo '<b style="color:#FF0000">Failed: The php extention "php_sqlsrv" is not loaded or setup!
		  <br>Please enable "php_sqlsrv" before i can test your connection.</b>';
}
else
{
	echo '<b style="color:#00FF00">Success: The php extention "php_mssql" is loaded!</b><br>';
	
	
	// Connect to MSSQL
	$connectionInfo = array( "Database" => "account", "UID" => $user, "PWD" => $password);
	$conn = sqlsrv_connect( $server, $connectionInfo);
	if (!$conn)
	{
		echo '<b style="color:#FF0000">Failed:<br>';
		echo "<pre>";
		print_r(sqlsrv_errors());
		echo "</pre>";		
		echo '</b><br>';
	}
	else
	{	
		echo '<b style="color:#00FF00">Successfully connected to your mssql server!</b><br>';
		
		$sql = "SELECT user_no FROM user_profile";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $conn, $sql , $params, $options );
		$row_count = sqlsrv_num_rows( $stmt );

		echo '<b style="color:#00FF00">Query Test: You have '.number_format($row_count).' accounts!</b><br>';
	}
}
echo "<br><h2>Done testing!<h2><br>"
?>
</body>
</html>