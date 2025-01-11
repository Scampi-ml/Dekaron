<?php

$mysql['host'] 				= 'mysql1093.servage.net';
$mysql['gebruikersnaam'] 	= 'brakug7n5Ba74xA2';
$mysql['wachtwoord'] 		= 'Da9emA95fEsufrezuSa5';
$mysql['database'] 			= 'brakug7n5Ba74xA2';

$link = mysql_connect($mysql['host'],$mysql['gebruikersnaam'],$mysql['wachtwoord']) or die('Server down');
mysql_select_db($mysql['database']);



$checkp = mysql_query("SELECT * FROM nexus_purchases");

$num_rows = mysql_num_rows($checkp);

echo '<p>Thanks to <b>'.$num_rows.'</b> members that have donated to the OSDS V5 project!</p><br>';
echo '<ul class="list">';
while ($rows = mysql_fetch_array($checkp))
{
	echo '<li>A user has donated to the OSDS V5 project. Thank you!</li>';

}
echo '</ul>';
	

mysql_close($link);
?>
