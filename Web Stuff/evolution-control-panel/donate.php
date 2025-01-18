<?php
include("import.php");                                    				                                       	                                     			
echo "<center>";
$charid = anti_injection($_GET['charid']);
$login = checkLoggedin($con);
if($login == true)
{
	$result1 = mssql_query("SELECT * FROM account.dbo.USER_PROFILE WHERE user_no = '".$userno."'",$con);
	while($list = mssql_fetch_array($result1))
	{
		if($list['login_flag']!=0)
		{
			echo "Please log out to Donate!<br>";
		}
		else if($charid == null)
		{
			$getCharRes = mssql_query("SELECT * FROM character.dbo.user_character WHERE user_no = '".$userno."'",$con);
			while($list1 = mssql_fetch_array($getCharRes))
			{
				echo "Donate with <a href=?&charid=".$list1['character_no']." style='color: #00FF00'>".$list1['character_name']."</a> - ".$list1['donate']." donated, and ".$list1['dwMoney']." in inventory to donate with.";
				echo "<br>";
			}
			echo "<br>";
		}
		else if(isYours($userno,$charid, $con))
		{
			$getCharRes = mssql_query("SELECT * FROM character.dbo.user_character WHERE character_no = '".$charid."'",$con);
			while($list1 = mssql_fetch_array($getCharRes))
			{
				if($_POST['activ'] == '1')
				{
					$dilDonate = anti_injection($_POST['dil']);
					if($dilDonate > $list1['dwMoney'] || $dilDonate < 0)
					{
						echo "<form action='".$_SEVER['PHP_SELF']."' method='POST'>";
						echo "<center><table>";
						echo "<tr><td colspan='2' align='center'><b><u><font color = white>Welcome ".$list1['character_name'].", enter amount to donate<font></u></b></td></tr>";
						echo "<tr><td><font color=red>Dil(s) (Incorrect Dil cannot be greater than ".$list1['dwMoney'].")</font></td><td><input type='text' value= '0' name='dil' maxlength='9'></td></tr>";
						echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
						echo "<tr><td colspan='2' align='center'>
						<input type='hidden' name='activ' value='1'>
						<input type='submit' value='Donate Dil!'></td></tr>";
						echo "</table></center>";
						echo "</form>";
					}
					else
					{
						mssql_query("UPDATE character.dbo.user_character set dwMoney = (dwMoney - CAST('".$dilDonate."' AS bigint)), donate = (donate + CAST('".$dilDonate."' AS bigint)) where character_no = '".$list1['character_no']."'",$con);
						echo "Donated ".$dilDonate." thanks for such a generous donation!<br>";
					}
				}
				else
				{
					echo "<form action='".$_SEVER['PHP_SELF']."' method='POST'>";
					echo "<center><table>";
					echo "<tr><td colspan='2' align='center'><b><u><font color = white>Welcome ".$list1['character_name'].", enter amount to donate<font></u></b></td></tr>";
					echo "<tr><td><font color=white>Dil(s) (".$list1['dwMoney'].")</font></td><td><input type='text' value= '0' name='dil' maxlength='9'></td></tr>";
					echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
					echo "<tr><td colspan='2' align='center'>
					<input type='hidden' name='activ' value='1'>
					<input type='submit' value='Donate Dil!'></td></tr>";
					echo "</table></center>";
					echo "</form>";
				}
			}
		}
		else
		{
			echo "This character is not yours!<br>";
		}
	}
}
else if($login == false)
{
	echo "<meta http-equiv='REFRESH' content='0;url=login.php?type=donate'>";
}
echo "<br><a href='index.php' style='color: #00FF00'>Return to main page</a>";
echo "</center>";
echo "</font>";
?>
