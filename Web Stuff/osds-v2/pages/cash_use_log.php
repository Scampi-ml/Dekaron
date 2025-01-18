
<center>
<?php
	if (ALLOW_OPEN != 1){
	exit("<br><img src='images/error_access.png'>");
	}
include "../config/mssql.conf.php";
if($is_gm != '0') {
	if(empty($_POST['select'])) {
	
	$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
	echo "Last 50 Crash Items bought<br><br>";

	$msdb = mssql_select_db("character", $ms_con);
	$plist = "SELECT TOP 50 character_name,product,intime FROM cash.dbo.user_use_log ORDER BY intime DESC";
	$pplist = mssql_query($plist);

	echo "<center><table width='100%' height='1' border='0'><tr valign='top'>";
	echo "
	
	<td><b>---- Character Name ----</b></td>
	<td><b>----- Item Name -----</b></td>
	<td><b>---- Date / Time ----</b></td>


	</tr><tr valign='top'>";

	while($list = mssql_fetch_array($pplist)){
		
	echo "<td>";
	echo $list [character_name];
	echo "</td>";

	echo "<td>";
	echo $list [product];
	echo "</td>";
		
	echo "<td>";
	echo $list[intime];
	echo "</td></tr>";
	}
	echo "</tr></table></center>";
	} else {
	echo "<br><img src='images/error_access.png'>";
	}
}
?>
</center>