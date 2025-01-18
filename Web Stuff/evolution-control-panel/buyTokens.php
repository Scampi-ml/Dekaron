<?php	                                       	
include("import.php");
echo "<center>";
$login = checkLoggedin($con);
if($_POST['activ'] == '1' && $login == true)
{
	$token = anti_injection($_POST['token']);
	if($token < 0)
	{
		$token = 1;
	}
	$deduct = $token * 15;
	$result2 = mssql_query("SELECT * FROM cash.dbo.user_cash WHERE amount >= ".$deduct." and user_no = '".$userno."'",$con);
	$row1 = mssql_num_rows($result2);
	if($row1 != 0)
	{
		mssql_query("UPDATE cash.dbo.user_cash SET amount = amount - ".$deduct." WHERE user_no = '".$userno."'", $con);
		mssql_query("UPDATE account.dbo.user_profile SET token = token + ".$token." WHERE user_no = '".$userno."'", $con);
		echo "Purchase Successful<br>";
	}
	else
	{
		echo "Insufficient coins!<br>";
	}

} 
else if($login == true)
{
	
	echo "<form action='".$_SEVER['PHP_SELF']."' method='POST'>";
	echo "<center><table>";
	echo "<tr><td colspan='2' align='center'><b><u><font color = white>Purchase Tokens<font></u></b></td></tr>";
	echo "<tr><td><font color=white>Amount (1 token = 15 coins)</font></td><td><input type='text' name='token' maxlength='12'></td></tr>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td colspan='2' align='center'>
		<input type='hidden' name='activ' value='1'>
		<input type='submit' value='Purchase'></td></tr>";
	echo "</table></center>";
	echo "</form>";
	echo "<br><font color=red>By clicking `Purchase` your coins will be charged in exchange for Tokens. Coins cannot be refunded after the transaction is made.</font>";

}
else if($login == false)
{
echo "<meta http-equiv='REFRESH' content='0;url=login.php?type=buyTokens'>";

}
echo "<br><a href='index.php' style='color: #00FF00'>Return to main page</a>";
echo "</center>";
echo "</font>";

?>
