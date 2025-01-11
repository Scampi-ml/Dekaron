<?php	                                       				                                       	                                     			
include("import.php");
echo "<center>";
$charid = anti_injection($_GET['charid']);
$type = anti_injection($_GET['type']);
$login = checkLoggedin($con);
if($login == true)
{
	$result1 = mssql_query("SELECT * FROM account.dbo.USER_PROFILE WHERE user_no = '".$userno."'",$con);
	while($list = mssql_fetch_array($result1))
	{
		if($list['login_flag']!=0)
		{
			echo "Please log out to Access web storage!<br>";
		}
		else if($charid == null)
		{
			$getCharRes = mssql_query("SELECT * FROM character.dbo.user_character WHERE user_no = '".$list['user_no']."'",$con);
			while($list1 = mssql_fetch_array($getCharRes))
			{
				echo "<a href=?&charid=".$list1['character_no']."&type=0 style='color: #00FF00'>[Deposit]</a> <a href=?&charid=".$list1['character_no']."&type=1 style='color: #00FF00'>[Withdraw]</a> - ".$list1['character_name']."</a>";
				echo "<br>";
			}
			echo "<br>";
		}
		else if(isYours($list['user_no'],$charid, $con))
		{
			$getCharRes = mssql_query("SELECT * FROM character.dbo.user_character WHERE character_no = '".$charid."'",$con);
			while($list1 = mssql_fetch_array($getCharRes))
			{
				if($_POST['activ'] == '1')
				{
					$dil = anti_injection($_POST['dil']);
					if(($dil < 0 || $dil > 999999999) || ($type==1 && $dil > $list1['webStorage']) || ($type==0 && $dil > $list1['dwMoney']))
					{
						echo "<form action='".$_SEVER['PHP_SELF']."' method='POST'>";
						echo "<center><table>";
						if($type==0)
						{
							echo "<tr><td colspan='2' align='center'><b><u><font color = white>Welcome ".$list1['character_name'].", enter amount to deposit<font></u></b></td></tr>";
							echo "<tr><td><font color=red>Dil(s) (Incorrect Amount must be smaller than 1B and greater than 0)</font></td><td><input type='text' value= '0' name='dil' maxlength='9'></td></tr>";
							echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
							echo "<tr><td colspan='2' align='center'>
							<input type='hidden' name='activ' value='1'>
							<input type='submit' value='Deposit Dil!'></td></tr>";
						}
						else if($type==1)
						{
							echo "<tr><td colspan='2' align='center'><b><u><font color = white>Welcome ".$list1['character_name'].", enter amount to withdraw<font></u></b></td></tr>";
							echo "<tr><td><font color=red>Dil(s) (Incorrect Amount must be smaller than 1B and greater than 0)</font></td><td><input type='text' value= '0' name='dil' maxlength='9'></td></tr>";
							echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
							echo "<tr><td colspan='2' align='center'>
							<input type='hidden' name='activ' value='1'>
							<input type='submit' value='Withdraw Dil'></td></tr>";
						}
						echo "</table></center>";
						echo "</form>";
					}
					else if($type==0)
					{
						mssql_query("UPDATE character.dbo.user_character set dwMoney = (dwMoney - CAST('".$dil."' AS bigint)), webStorage = (webStorage + CAST('".$dil."' AS bigint)) where character_no = '".$list1['character_no']."'",$con);
						echo "Deposited ".$dil." dil(s)!<br>";
					}
					else if($type==1 && ($dil+$list1['dwMoney']) < 999999999)
					{
						mssql_query("UPDATE character.dbo.user_character set dwMoney = (dwMoney + CAST('".$dil."' AS bigint)), webStorage = (webStorage - CAST('".$dil."' AS bigint)) where character_no = '".$list1['character_no']."'",$con);
						echo "Withdrew ".$dil." dil(s)!<br>";
					}
					else
					{
						echo "You do not have enough room in your inventory to withdraw that much! You can only hold 1 Billion Maximum in your inventory!<br>Try storing your dills in game instead<br>";
					}
				}
				else
				{
					echo "<form action='".$_SEVER['PHP_SELF']."' method='POST'>";
					echo "<center><table>";
					if($type==0)
					{
						echo "<tr><td colspan='2' align='center'><b><u><font color = white>Welcome ".$list1['character_name'].", enter amount to deposit<font></u></b></td></tr>";
						echo "<tr><td><font color=white>Dil(s) (Inventory: ".$list1['dwMoney']." Storage: ".$list1['webStorage'].")</font></td><td><input type='text' value= '0' name='dil' maxlength='9'></td></tr>";
						echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
						echo "<tr><td colspan='2' align='center'>
						<input type='hidden' name='activ' value='1'>
						<input type='submit' value='Deposit Dil!'></td></tr>";
					}
					else if($type==1)
					{
						echo "<tr><td colspan='2' align='center'><b><u><font color = white>Welcome ".$list1['character_name'].", enter amount to withdraw<font></u></b></td></tr>";
						echo "<tr><td><font color=white>Dil(s) (Inventory: ".$list1['dwMoney']." Storage: ".$list1['webStorage'].")</font></td><td><input type='text' value= '0' name='dil' maxlength='9'></td></tr>";
						echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
						echo "<tr><td colspan='2' align='center'>
						<input type='hidden' name='activ' value='1'>
						<input type='submit' value='Withdraw Dil!'></td></tr>";
					}
					echo "</table></center>";
					echo "</form>";
				}
			}
		}
		else
		{
			echo "This character isn't yours!<br>";
		}
	}
}
else if($login == false)
{
	echo "<meta http-equiv='REFRESH' content='0;url=login.php?type=bank'>";
}
echo "<br><a href='index.php' style='color: #00FF00'>Return to main page</a>";
echo "</center>";
echo "</font>";

?>
