<center>
<?php
$file = 'referred';
if($is_gm != '0') {
include("../config/mssql.conf.php");
$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
echo "Referred List<br><br>";


	$msdb = mssql_select_db("character", $msconnect);
	$plist = "SELECT user_id,referred FROM account.dbo.Tbl_user";
	$pplist = mssql_query($plist);

	echo "<center><table width='100%' height='1' border='1'><tr valign='top'>";
	echo "
	
	<td><b><center>User Name</center></b></td>
	<td><b><center>Referred By</center></b></td>
	</tr><tr valign='top'>";

	while($list = mssql_fetch_array($pplist)){
		
	echo "<td><center>";
	echo $list [user_id];
	echo "</td></center>";
		
	echo "<td><center>";
	echo $list[referred];
	echo "</td></center></tr>";


	}
	echo "</tr></table></center>";
}

?>
</center>