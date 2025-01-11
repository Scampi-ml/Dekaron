<?php	                                       	
include("import.php");
echo "<center>";
$login = checkLoggedin($con);
if($_POST['activ'] == '1' && $login == true)
{
	$charid = anti_injection($_POST['name']);
	$token = anti_injection($_POST['token']);
	if($token < 0)
	{
		$token = 0;
	}
	$result2 = mssql_query("SELECT * FROM account.dbo.user_profile WHERE token >= ".$token." and user_no = '".$userno."'",$con);
	$row1 = mssql_num_rows($result2);
	if($row1 != 0)
	{
		$sent = 0;
		$grabSend = mssql_query("SELECT top 1 * FROM character.dbo.user_character WHERE character_name LIKE '".$charid."'",$con);
		while($get = mssql_fetch_array($grabSend))
		{
			$sent = 1;
			mssql_query("UPDATE account.dbo.user_profile SET token = token + ".$token." WHERE user_no = '".$get['user_no']."'", $con);
			mssql_query("UPDATE account.dbo.user_profile SET token = token - ".$token." WHERE user_no = '".$userno."'", $con);
			echo "Sent Tokens!<br>";
		}
		if($sent == 0)
		{
			echo "Invalid character name!<br>";
		}
	}
	else
	{
		echo "Insufficient tokens!<br>";
	}

} 
else if($login == true)
{
	
	echo "<form action='".$_SEVER['PHP_SELF']."' method='POST'>";
	echo "<center><table>";
	echo "<tr><td colspan='2' align='center'><b><u><font color = white>Gift Tokens to a Player<font></u></b></td></tr>";
	echo "<tr><td><font color=white>Character Name to send</font></td><td><input type='text' name='name' maxlength='15'></td></tr>";
	echo "<tr><td><font color=white>Tokens Amount</font></td><td><input type='text' name='token' maxlength='12'></td></tr>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td colspan='2' align='center'>
		<input type='hidden' name='activ' value='1'>
		<input type='submit' value='Send'></td></tr>";
	echo "</table></center>";
	echo "</form>";

}
else if($login == false)
{
echo "<meta http-equiv='REFRESH' content='0;url=login.php?type=sendTokens'>";

}
echo "<br><a href='index.php' style='color: #00FF00'>Return to main page</a>";
echo "</center>";
echo "</font>";

?>
