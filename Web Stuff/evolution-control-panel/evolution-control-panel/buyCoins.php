<?php
include("import.php");
echo "<center>";
$login = checkLoggedin($con);
if($login == true)
{
	$coins = 0;
	$result1 = mssql_query("select * from cash.dbo.user_cash WHERE user_no = '".$userno."'",$con);
	$active = "false";
	while($list = mssql_fetch_array($result1))
	{
		$active = "true";
		$coins = $list['amount'] + $list['free_amount'];
		echo "Hello ".$_SESSION['gdusername'].". You currently have ".$coins." coin(s).<br>Select the amount you wish to purchase.";
		echo preg_replace('/99776644313aa/', 'DJFXMEBJ4L7J2', preg_replace('/1233a445597/', $userno, file_get_contents("paypal.html")));		
	}
	if($active == "false")
	{
		echo "Please log into this account and open the D-Shop at least once, then try purchasing your coins.";
	}
}
else
{
	echo "<meta http-equiv='REFRESH' content='0;url=login.php?type=buyCoins'>";
}

?>