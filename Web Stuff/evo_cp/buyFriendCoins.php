<?php
include("import.php");
echo "<center>";
$login = checkLoggedin($con);
if($_POST['activ'] == '1' && $login == true)
{
	$charno = "0";
	$charname = anti_injection($_POST['charname']);
	$result1 = mssql_query("select * from character.dbo.user_character where character_name = '".$charname."'",$con);
	while($list = mssql_fetch_array($result1))
	{
		$charno = $list['user_no'];		
	}
	if($charno == "0")
	{
		echo "Invalid character name!";
	}
	else
	{
		$resultcash = mssql_query("select * from cash.dbo.user_cash where user_no = '".$charno."'",$con);
		$activate = "false";
		while($list = mssql_fetch_array($resultcash))
		{
			$activate = "true";
			echo "Select the amount you wish to purchase for your friend ".$charname;
			echo preg_replace('/99776644313aa/', 'DJFXMEBJ4L7J2', preg_replace('/1233a445597/', $charno, file_get_contents("paypal.html")));
		}
		if($activate == "false")
		{
			echo "Your friend needs to open the D-SHOP on his account at least once in order for him to receive his coins.";
		}
	}
}
else if($login == true)
{
	echo "<form action='".$_SEVER['PHP_SELF']."' method='POST'>";
	echo "<center><table>";
	echo "<tr><td colspan='2' align='center'><b><u><font color = white>Enter the character name<font></u></b></td></tr>";
	echo "<tr><td><font color=white>Character</font></td><td><input type='text' name='charname' maxlength='15'></td></tr>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td colspan='2' align='center'>
		<input type='hidden' name='activ' value='1'>
		<input type='submit' value='Confirm'></td></tr>";
	echo "</table></center>";
	echo "</form>";
}
else
{
	echo "<meta http-equiv='REFRESH' content='0;url=login.php?type=buyFriendCoins'>";
}

?>