<?php	                                       		                                       	                                     		
include("import.php");
echo "<center>";
$login = checkLoggedin($con);
if($login == true)
{
	echo "<table width='800' height='1'><tr valign='top'>";
	echo "<td width='5%'><b><font color = white>Character Name</font></b></td><td width='15%'><b><font color = white>Item Name</font></b></td><td width='5%'><b><font color = white>Cost</font></b></td><td width='15%'><b><font color = white>Purchase Date</font></b></td></tr><tr valign='top'>";
	$cost = 0;
	$am = 0;
	$totalCharge = mssql_query("select SUM(charge_amt) as CoinsUsed from cash.dbo.user_use_log where user_no = ".$userno,$con);
	while($getTotal = mssql_fetch_array($totalCharge))
	{
		$cost = $getTotal['CoinsUsed'];
	}
	echo "<b>In total, you have <u>used</u> <font color=red>".$cost." coin(s)</font>.</b><br>";
	$totalCharge = mssql_query("select * from cash.dbo.user_cash where user_no = ".$userno,$con);
	while($getTotal = mssql_fetch_array($totalCharge))
	{
		$am = ($getTotal['amount']+$getTotal['free_amount']);
	}
	echo "<b>You currently <u>have</u> <font color=green>".$am." coin(s)</font> in your account.</b><br>";
	$tot = ($cost + $am);
	echo "<b>You have <u>purchased or obtained</u> <font color=orange>".$tot." coin(s)</font> in total.</b>";
	$getCharge = mssql_query("SELECT character_name,item_index,product,charge_amt,intime FROM cash.dbo.user_use_log WHERE user_no = ".$userno,$con);
	while($chargeList = mssql_fetch_array($getCharge))
	{
		echo "<td width='5%'><font color = white>".$chargeList['character_name']."</font></td>";
		echo "<td width='15%'><font color = white>".$chargeList['product']."</font></td>";
		echo "<td width='5%'><font color = white>".$chargeList['charge_amt']."</font></td>";
		echo "<td width='15%'><font color = white>".$chargeList['intime']."</font></td></tr><tr>";
	}
	echo "</tr></table></font>";
	echo "<font color=white size=1>This page updates every ten minutes.</font><br>";
}
else if($login == false)
{
	echo "<meta http-equiv='REFRESH' content='0;url=login.php?type=coinsinfo'>";
}
echo "<a href='login.php' style='color: #00FF00'>Return to main page</a>";
echo "</center>";
echo "</font>";

?>
