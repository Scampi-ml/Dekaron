<?php

$mysql['host'] 				= 'remote-mysql4.servage.net';
$mysql['gebruikersnaam'] 	= 'c0d3r3d10';
$mysql['wachtwoord'] 		= '7rutRUpH';
$mysql['database'] 			= 'c0d3r3d10';

$link = mysql_connect($mysql['host'],$mysql['gebruikersnaam'],$mysql['wachtwoord']) or die('Server down');
mysql_select_db($mysql['database']);

if(isset($_GET['delall']))
{
	mysql_query("DELETE FROM error_reports");
	$redirect = 'error_reporting.php';
	echo "<script type='text/javascript'>window.location='" . $redirect . "';</script>";
}


$checkp = mysql_query("SELECT date,errMessage,errFile,errLine,appid FROM error_reports");

$num_rows = mysql_num_rows($checkp);

echo '<p>Current Errors: <b>'.$num_rows.'</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="error_reporting.php?delall=delall">Delete All</a></p><br>';

echo '<table width="100%" border="1">';
	echo '<tr>';
		echo '<th>Date</th>';
		echo '<th>Message</th>';
		echo '<th>File</th>';
		echo '<th>Line</th>';
		echo '<th>appid</th>';
	echo '</tr>';

while ($rows = mysql_fetch_array($checkp))
{
	echo '<tr>';
		echo '<td>'. $rows['date'] .'</td>';
		echo '<td>'. $rows['errMessage'] .'</td>';
		echo '<td>'. $rows['errFile'] .'</td>';
		echo '<td>'. $rows['errLine'] .'</td>';
		echo '<td>'. $rows['appid'] .'</td>';
		

	echo '</tr>';
}
echo '</table>';



mysql_close($link);
?>
