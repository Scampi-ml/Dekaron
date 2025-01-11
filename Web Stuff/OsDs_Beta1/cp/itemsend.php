<?php
$file = 'itemsend';
	echo "<center>";
	echo "Send items<br><br>";
	echo "This list includes also items that players recived in D-Shop. <br><br>";
	echo "</center>";
$con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']) or die($language['mssql_e1']);

	$msdb = mssql_select_db("character", $con);
	$plist = "SELECT character_no,from_char_nm,post_title,wIndex,ipt_time FROM [USER_POSTBOX]";
	$pplist = mssql_query($plist);
	

	echo "<table width='100%' height='1' border '1'><tr valign='top'>";
	echo "<td><b>Character No.</b></td><td><b>From</b></td><td><b>Title</b></td><td><b>Item Index</b></td><td><b>When</b></td></tr><tr valign='top'>";

	while($list = mssql_fetch_array($pplist)){
	
	echo "<td>";
	echo $list[character_no];
	echo "</td>";	
	
	echo "<td>";
	echo $list [from_char_nm];
	echo "</td>";
	
	echo "<td>";
	echo $list[post_title];
	echo "</td>";
	
	echo "<td>";
	echo $list[wIndex];
	echo "</td>";
	
	echo "<td>";
	echo $list[ipt_time];
	echo "</td></tr><tr>";


	}
	echo "</tr></table>";
	

?>
