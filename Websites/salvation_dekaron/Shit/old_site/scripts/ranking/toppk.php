<?php
$msconnect = mssql_connect("37.59.180.41","SaBaker1893","ImPP8pL0h");

$plist = mssql_query("SELECT TOP 20 character_name, wPKCount FROM character.dbo.user_character WHERE wPKCount > '0'order by wPKCount desc", $msconnect);

$content .= "<table width='100%' style='margin-left: 5px;'><tr valign='top'>";
$content .= "<td width='5%'><b></b></td><td width='5%'><b>Name:</b></td><td width='5%'><b>Pk Points:</b></td></tr><tr valign='top'>";

while($list = mssql_fetch_array($plist))
{

	$content .= "<td width='5%'>";
	$content .= "</td>";	
	$content .= "<td width='5%'>";
	$content .= $list['character_name'];
	$content .= "</td>";
	$content .= "<td width='5%'>";
	$content .= $list['wPKCount'];
	$content .= "</td></tr><tr>";
	
}
$content .= "</tr></table>";
?>