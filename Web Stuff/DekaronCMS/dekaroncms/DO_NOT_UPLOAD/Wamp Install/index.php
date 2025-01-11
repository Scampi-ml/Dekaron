<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP SQLsrv Tester</title>
</head>
<body>
<h1>PHP SQLsrv Tester</h1>
<?php
	if(!extension_loaded('sqlsrv'))
	{
		echo '<b style="color:#FF0000">Failed: The php extention "php_sqlsrv" is not loaded or setup!<br>Please enable "php_sqlsrv" before i can test your connection.</b>';
		die();
	}
?>
<form action="index.php" method="post">
	<label>Server Host</label>
	<input type="text" name="host">
	<br>
	<label>Server User</label>
	<input type="text" name="user">
	<br>
	<label>Server Password</label>
	<input type="text" name="password">
	<br>
	<input type="submit" value="submit">
</form>
<?php
// Author: 			janvier123
// Copyright:		janvier123.be
// Date:			12 Nov 2014

if(isset($_POST['host']))
{
	$server = $_POST['host'];	
	$user = $_POST['user'];
	$password = $_POST['password'];

	echo "<h2>Begin Testing ...</h2>";
	echo "----------------------------------------------------------------------------------------------<br>";
	echo '<b style="color:#00FF00">Success:</b> The php extention "php_mssql" is loaded!<br>';
	$connectionInfo = array( "Database" => "account", "UID" => $user, "PWD" => $password);
	$conn = sqlsrv_connect( $server, $connectionInfo);
	if (!$conn)
	{
		echo '<b style="color:#FF0000">Failed:</b><br>';
		echo "<pre>";
		print_r(sqlsrv_errors());
		echo "</pre>";		
		echo '<br>';
	}
	else
	{	
		echo '<b style="color:#00FF00">Successfully connected to your mssql server!</b><br>';	
		$sql = "SELECT user_no FROM user_profile";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $conn, $sql , $params, $options );
		$row_count = sqlsrv_num_rows( $stmt );
		echo '<b style="color:#00FF00">Query Test:</b> You have '.number_format($row_count).' accounts!<br>';
	}
	echo "----------------------------------------------------------------------------------------------";
	echo "<br><h2>Done testing!<h2>";
}
?>
</body>
</html>