<?php                          				                                       	                                     			
include("import.php");
echo "<center>";
$type = $_GET['type'];
if(checkLoggedIn($con))
{
	if($type != "")
	{
		echo "<meta http-equiv='REFRESH' content='0;url=".$type.".php'>";
	}
	echo "Welcome ".$_SESSION['gdusername'].", to Dekaron Evolution Control Panel!<br><br>";
	$resqtok = mssql_query("SELECT * FROM gamelog.dbo.tokenQueue WHERE user_no = ".$userno,$con);
	$queue = 0;
	while($qtok = mssql_fetch_array($resqtok))
	{
		$dater=(time() - $qtok['hour']);
		if($dater >= 180)
		{
			mssql_query("UPDATE account.dbo.USER_PROFILE set token = token + 1 WHERE user_no = '".$userno."'",$con);
			mssql_query("delete gamelog.dbo.tokenQueue where user_no = ".$userno." and hour = ".$qtok['hour']);
		}
		else
		{
			$queue = $queue + 1;
		}
	}
	$passauth = $accpass;
	$userauth = $accname;
	INCLUDE 'links.php';
}
else if($_POST['activ'] == '1')
{
	$accname = anti_injection($_POST['accname']);
	$accpass = anti_injection(md5($_POST['accpass']));
	if(confirmUser($accname, $accpass, $con))
	{
		createsessions($accname,$accpass);
		checkLoggedIn($con);
		if($type != "")
		{
			echo "<meta http-equiv='REFRESH' content='0;url=".$type.".php'>";
		}
		echo "Welcome ".$_SESSION['gdusername'].", to Dekaron Evolution Control Panel!<br><br>";
		$resqtok = mssql_query("SELECT * FROM gamelog.dbo.tokenQueue WHERE user_no = ".$userno,$con);
		$queue = 0;
		while($qtok = mssql_fetch_array($resqtok))
		{
			$dater=(time() - $qtok['hour']);
			if($dater >= 180)
			{
				mssql_query("UPDATE account.dbo.USER_PROFILE set token = token + 1 WHERE user_no = '".$userno."'",$con);
				mssql_query("delete gamelog.dbo.tokenQueue where user_no = ".$userno." and hour = ".$qtok['hour']);
			}
			else
			{
				$queue = $queue + 1;
			}
		}
		$passauth = $accpass;
		$userauth = $accname;
		INCLUDE 'links.php';
	}
	else
	{
		clearsessionscookies();
		echo "Failed authentication!";
	}
}	
else
{
	echo "<form action='".$_SEVER['PHP_SELF']."' method='POST'>";
	echo "<center><table>";
	echo "<tr><td colspan='2' align='center'><b><u><font color = white>Account Panel<font></u></b></td></tr>";
	echo "<tr><td><font color=white>Username:</font></td><td><input type='text' name='accname' maxlength='12'></td></tr>";
	echo "<tr><td><font color=white>Password:</font></td><td><input type='password' name='accpass' maxlength='12'></td></tr>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td colspan='2' align='center'><input type='hidden' name='activ' value='1'><input type='submit' value='Login'></td></tr>";
	echo "</table></center>";
	echo "</form>";

}
echo "</center>";
echo "</font>";
?>
