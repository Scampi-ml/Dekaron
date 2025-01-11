<?php
$file = 'cash';
	echo "<center>";
	echo "User Cash<br><br>";
	echo "</center>";
$con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']) or die($language['mssql_e1']);

	$msdb = mssql_select_db("cash", $con);
	$plist = "SELECT user_no,amount,free_amount FROM [user_cash]";
	$pplist = mssql_query($plist);
	

	echo "<table width='100%' height='1' border '1'><tr valign='top'>";
	echo "<td><b>User No.</b></td><td><b>Amount</b></td><td><b>Free Amount</b></td></tr><tr valign='top'>";

	while($list = mssql_fetch_array($pplist)){
	
	echo "<td>";
	echo $list[user_no];
	echo "</td>";	
	
	echo "<td>";
	echo $list [amount];
	echo "</td>";
	
	echo "<td>";
	echo $list[free_amount];
	echo "</td></tr><tr>";
	}
	echo "</tr></table>";
	

?>
