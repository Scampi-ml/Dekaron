<?php
	$database = "c0d3r3d10";
	$mysql_user = "c0d3r3d10";
	$mysql_password = "c0d3r3d101"; 
	$mysql_host = "mysql1063.servage.net";
	$mysql_table_prefix = "";



	$success = mysql_pconnect ($mysql_host, $mysql_user, $mysql_password);
	if (!$success)
		die ("<b>Cannot connect to database, check if username, password and host are correct.</b>");
    $success = mysql_select_db ($database);
	if (!$success) {
		print "<b>Cannot choose database, check if database name is correct.";
		die();
	}
?>

