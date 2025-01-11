<?php

$mysql['host'] 				= 'remote-mysql4.servage.net';
$mysql['gebruikersnaam'] 	= 'c0d3r3d10';
$mysql['wachtwoord'] 		= '7rutRUpH';
$mysql['database'] 			= 'c0d3r3d10';

$link = mysql_connect($mysql['host'],$mysql['gebruikersnaam'],$mysql['wachtwoord']) or die('Server down');
mysql_select_db($mysql['database']);



$checkp = mysql_query("SELECT * FROM appids");

$num_rows = mysql_num_rows($checkp);

echo '<p>We have <b>'.$num_rows.'</b> installed OSDS V5 applications at this time, why dont you give it a try ?</p><br>';
echo '<ul class="list">';

while ($rows = mysql_fetch_array($checkp))
{
	echo '<li>A user has installed OSDS V5 on <b>'. $rows['when'] .'</b>, have fun with OSDS V5!</li>';

}
echo '</ul>';



mysql_close($link);
?>
