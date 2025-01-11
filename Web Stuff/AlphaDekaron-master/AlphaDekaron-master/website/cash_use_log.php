<?php
if(ALLOW_OPEN != '1') 
{
	Header('HTTP/1.1 403');
	exit(0);
}
else
{
	
	if ($_SESSION['isGM'] == '0')
	{
		Header('HTTP/1.1 403');
		exit(0);
	}
}
	if(empty($_POST['select'])) {
	$plist = "SELECT TOP 50 character_name,product,intime FROM cash.dbo.user_use_log ORDER BY intime DESC";
	$pplist = mssql_query($plist);

	echo "<table><tr><td class=header colspan=3>Last 50 Cash Items Bought</td></tr>
	<tr><td><b><u>Character Name</u></b></td><td><b><u>Item Name</u></b></td><td><b><u>Date</u></b></td></tr>";

	while($list = mssql_fetch_array($pplist)){
		
	echo "<tr><td>",htmlspecialchars($list [character_name]),"</td>";

	echo "<td>",htmlspecialchars($list [product]),"</td>";
		
	echo "<td>",htmlspecialchars($list[intime]),"</td></tr>";
	}
	echo "</table>";
}
?>