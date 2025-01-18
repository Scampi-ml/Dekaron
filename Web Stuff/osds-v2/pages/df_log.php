
<center>
<?php
	if (ALLOW_OPEN != 1){
	exit("<br><img src='images/error_access.png'>");
	}
include "../config/mssql.conf.php";
if($is_gm != '0') {
	if(empty($_POST['select'])) {
	
	$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
	echo "Dead Front List<br><br>";

	$msdb = mssql_select_db("character", $ms_con);
	$plist = "SELECT TOP 50 bcd_id,sort_nm,orderby_no,use_tag FROM character.dbo.CM_BCD_ITEM ORDER BY orderby_no DESC";
	$pplist = mssql_query($plist);

	echo "<center><table width='500' height='1' border='0'><tr valign='top'>";
	echo "
	
	<td><b>Name</b></td>
	<td><b>Active</b></td>
	<td><b>Time to start</b></td>
	</tr><tr valign='top'>";

	while($list = mssql_fetch_array($pplist)){
		
	echo "<td>";
	echo $list [bcd_id];
	echo "</td>";
	
	echo "<td>";
	echo $list [use_tag];
	echo "</td>";

	echo "<td>";
	echo $list[sort_nm];
	echo "</td></tr>";
	}
	echo "</tr></table></center>";
	} else {
	echo "<br><img src='images/error_access.png'>";
	}
}
?>
</center>