<?php
include("import.php");
echo "<center>";
$charid = anti_injection($_GET['charid']);
$itemid = anti_injection($_GET['itemid']);
$login = checkLoggedin($con);
if($login == true)
{
		
		$result1 = mssql_query("SELECT * FROM account.dbo.USER_PROFILE WHERE user_no = '".$userno."'",$con);
		while($list = mssql_fetch_array($result1))
		{
				$resqtok = mssql_query("SELECT * FROM gamelog.dbo.tokenQueue WHERE user_no = ".$list['user_no'],$con);
				$queue = 0;
				while($qtok = mssql_fetch_array($resqtok))
				{
					$dater=(time() - $qtok['hour']);
					if($dater >= 180)
					{
						mssql_query("UPDATE account.dbo.USER_PROFILE set token = token + 1 WHERE user_no = '".$list['user_no']."'",$con);
						mssql_query("delete gamelog.dbo.tokenQueue where user_no = ".$list['user_no']." and hour = ".$qtok['hour']);
					}
					else
					{
						$queue = $queue + 1;
					}
				}
				echo "You have ".$list['token'];
				if($queue > 0)
				{
					echo ", and ".$queue." pending tokens.<br>";
				}
				else
				{
					echo " tokens!<br>";
				}
				if($list['login_flag']!=0)
				{
					echo "Please log out to Access Token Exchange!<br>";
				}
				else if($charid == null)
				{
					$result2 = mssql_query("SELECT * FROM character.dbo.user_character WHERE user_no = '".$list['user_no']."'",$con);
					while($char = mssql_fetch_array($result2))
					{
						echo "Upgrade <a href=?&charid=".$char['character_no']." style='color: #00FF00'>".$char['character_name']."</a>'s items with Tokens<br>";
					}
				}
				else if(isYours($list['user_no'], $charid, $con))
				{
					$name = mssql_query("SELECT * FROM character.dbo.user_character WHERE character_no = '".$charid."'",$con);
					while($charname = mssql_fetch_array($name))
					{
						echo "<font color=#00FF00>".$charname['character_name']."'s inventory</font><br>";
					}
					if ($itemid == null)
					{
						$result2 = mssql_query("SELECT * FROM character.dbo.user_bag where character_no = '".$charid."'",$con);
						while($char = mssql_fetch_array($result2))
						{
							$items = mssql_query("SELECT top 1 * FROM gamelog.dbo.tokenUpgrade where wIndex = '".$char['wIndex']."'",$con);
							while($getItem = mssql_fetch_array($items))
							{
								$pos1 = strpos($getItem['Name'], '+1');
								$pos2 = strpos($getItem['Name'], '+2');
								$pos3 = strpos($getItem['Name'], '+3');
								$pos4 = strpos($getItem['Name'], '+4');
								$pos5 = strpos($getItem['Name'], '+5');
								$pos6 = strpos($getItem['Name'], '+6');
								$pos7 = strpos($getItem['Name'], '+7');
								$pos8 = strpos($getItem['Name'], '+8');
								$pos9 = strpos($getItem['Name'], '+9');
								echo "<font color=#00FF00>".$getItem['Name']."</font> - ";
								echo "<a href=?&charid=".$char['character_no']."&itemid=".$char['wIndex']." style='color: #00FF00'>";
								if($pos1 > 0)
								{
									echo "Upgrade to +2 [Requires 12 tokens]</a>";
								}
								else if($pos2 > 0)
								{
									echo "Upgrade to +3 [Requires 15 tokens]</a>";
								}
								else if($pos3 > 0)
								{
									echo "Upgrade to +4 [Requires 30 tokens]</a>";
								}
								else if($pos4 > 0)
								{
									echo "Upgrade to +5 [Requires 50 tokens]</a>";
								}
								else if($pos5 > 0)
								{
									echo "Upgrade to +6 [Requires 75 tokens]</a>";
								}
								else if($pos6 > 0)
								{
									echo "Upgrade to +7 [Requires 100 tokens]</a>";
								}
								else if($pos7 > 0)
								{
									echo "Upgrade to +8 [Requires 150 tokens]</a>";
								}
								else if($pos8 > 0)
								{
									echo "Upgrade to +9 [Requires 250 tokens]</a>";
								}
								else if($pos9 > 0)
								{
									echo "</a><font color=#00FF00>[Maxed]</font>";
								}
								else
								{
									echo "Upgrade to +1 [Requires 10 tokens]</a>";
								}
								echo "<br>";
							}	
						}
					}
					else if(checkBag($charid, $itemid, $con))
					{
						$resultbag = mssql_query("SELECT top 1 * FROM character.dbo.user_bag where character_no = '".$charid."' and wIndex = ".$itemid,$con);
						$identity = -1;
						while($getBag = mssql_fetch_array($resultbag))
						{
							$identity = $getBag['line_no'];
						}
						$items = mssql_query("SELECT top 1 * FROM gamelog.dbo.tokenUpgrade where wIndex = '".$itemid."'",$con);
						while($getItem = mssql_fetch_array($items))
						{
							$pos1 = strpos($getItem['Name'], '+1');
							$pos2 = strpos($getItem['Name'], '+2');
							$pos3 = strpos($getItem['Name'], '+3');
							$pos4 = strpos($getItem['Name'], '+4');
							$pos5 = strpos($getItem['Name'], '+5');
							$pos6 = strpos($getItem['Name'], '+6');
							$pos7 = strpos($getItem['Name'], '+7');
							$pos8 = strpos($getItem['Name'], '+8');
							$pos9 = strpos($getItem['Name'], '+9');
							echo "<font color=#00FF00>".$getItem['Name']."</font>";
							if($list['token'] >= 5)
							{
								$tokens = $list['token'];
								if($pos1 > 0 && $tokens >= 12)
								{
									mssql_query("update account.dbo.user_profile set token = token - 12 where user_no = '".$list['user_no']."'");
									if(rand(0, 100) >= 14)
									{
										echo " successfully upgraded to +2";
										mssql_query("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['NextLevelIndex']." WHERE character_no = '".$charid."' and line_no = ".$identity);
									}
									else
									{
										echo " failed to upgrade, item is now +0";
										mssql_query("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['BeforeLevelIndex']." WHERE character_no = '".$charid."' and line_no = ".$identity);
									}
								}
								else if($pos2 > 0 && $tokens >= 15)
								{
									mssql_query("update account.dbo.user_profile set token = token - 15 where user_no = '".$list['user_no']."'");
									if(rand(0, 100) >= 23)
									{
										echo " successfully upgraded to +3";
										mssql_query("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['NextLevelIndex']." WHERE character_no = '".$charid."' and line_no = ".$identity);
									}
									else
									{
										echo " failed to upgrade, item is now +1";
										mssql_query("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['BeforeLevelIndex']." WHERE character_no = '".$charid."' and line_no = ".$identity);
									}
								}
								else if($pos3 > 0 && $tokens >= 30)
								{
									mssql_query("update account.dbo.user_profile set token = token - 30 where user_no = '".$list['user_no']."'");
									if(rand(0, 100) >= 27)
									{
										echo " successfully upgraded to +4";
										mssql_query("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['NextLevelIndex']." WHERE character_no = '".$charid."' and line_no = ".$identity);
									}
									else
									{
										echo " failed to upgrade, item is now +2";
										mssql_query("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['BeforeLevelIndex']." WHERE character_no = '".$charid."' and line_no = ".$identity);
									}
								}
								else if($pos4 > 0 && $tokens >= 50)
								{
									mssql_query("update account.dbo.user_profile set token = token - 50 where user_no = '".$list['user_no']."'");
									if(rand(0, 100) >= 33)
									{
										echo " successfully upgraded to +5";
										mssql_query("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['NextLevelIndex']." WHERE character_no = '".$charid."' and line_no = ".$identity);
									}
									else
									{
										echo " failed to upgrade, item is now +3";
										mssql_query("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['BeforeLevelIndex']." WHERE character_no = '".$charid."' and line_no = ".$identity);
									}
								}
								else if($pos5 > 0 && $tokens >= 75)
								{
									mssql_query("update account.dbo.user_profile set token = token - 75 where user_no = '".$list['user_no']."'");
									if(rand(0, 100) >= 40)
									{
										echo " successfully upgraded to +6";
										mssql_query("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['NextLevelIndex']." WHERE character_no = '".$charid."' and line_no = ".$identity);
									}
									else
									{
										echo " failed to upgrade, item is now +4";
										mssql_query("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['BeforeLevelIndex']." WHERE character_no = '".$charid."' and line_no = ".$identity);
									}
								}
								else if($pos6 > 0 && $tokens >= 100)
								{
									mssql_query("update account.dbo.user_profile set token = token - 100 where user_no = '".$list['user_no']."'");
									if(rand(0, 100) >= 55)
									{
										echo " successfully upgraded to +7";
										mssql_query("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['NextLevelIndex']." WHERE character_no = '".$charid."' and line_no = ".$identity);
									}
									else
									{
										echo " failed to upgrade, item is now +5";
										mssql_query("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['BeforeLevelIndex']." WHERE character_no = '".$charid."' and line_no = ".$identity);
									}
								}
								else if($pos7 > 0 && $tokens >= 150)
								{
									mssql_query("update account.dbo.user_profile set token = token - 150 where user_no = '".$list['user_no']."'");
									if(rand(0, 100) >= 60)
									{
										echo " successfully upgraded to +8";
										mssql_query("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['NextLevelIndex']." WHERE character_no = '".$charid."' and line_no = ".$identity);
									}
									else
									{
										echo " failed to upgrade, item is now +6";
										mssql_query("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['BeforeLevelIndex']." WHERE character_no = '".$charid."' and line_no = ".$identity);
									}
								}
								else if($pos8 > 0 && $tokens >= 250)
								{
									mssql_query("update account.dbo.user_profile set token = token - 250 where user_no = '".$list['user_no']."'");
									if(rand(0, 100) >= 70)
									{
										echo " successfully upgraded to +9";
										mssql_query("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['NextLevelIndex']." WHERE character_no = '".$charid."' and line_no = ".$identity);
									}
									else
									{
										echo " failed to upgrade, item is now +7";
										mssql_query("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['BeforeLevelIndex']." WHERE character_no = '".$charid."' and line_no = ".$identity);
									}
								}
								else if($pos9 > 0)
								{
									echo "<font color=red>This item cannot be upgraded any further!</font>";
								}
								else if($pos1 <= 0 && $pos2 <= 0 && $pos3 <= 0 && $pos4 <= 0 && $pos5 <= 0 && $pos6 <= 0 && $pos7 <= 0 && $pos8 <= 0 && $pos9 <= 0 && $tokens >= 10)
								{
									mssql_query("update account.dbo.user_profile set token = token - 10 where user_no = '".$list['user_no']."'");
									if(rand(0, 100) >= 3)
									{
										echo " successfully upgraded to +1";
										mssql_query("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['NextLevelIndex']." WHERE character_no = '".$charid."' and line_no = ".$identity);
									}
									else
									{
										echo " destroyed! Really bad luck!";
										mssql_query("DELETE character.dbo.user_bag WHERE character_no = '".$charid."' and line_no = ".$identity);
									}
								}
								else
								{
									echo "<br><font color=red>Insufficient tokens!</font><br>";
								}
								echo "<br>";
							}
							else
							{
								echo "<br><font color=red>Insufficient tokens!</font><br>";
							}
							echo "<a href=?&charid=".$charid." style='color: #00FF00'>Return to the inventory</a><br>";
						}
					}
					else
					{
						echo "You don't have this item!<br>";
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
	echo "<meta http-equiv='REFRESH' content='0;url=login.php?type=argate'>";
}
echo "<br><a href='index.php' style='color: #00FF00'>Return to main page</a>";
echo "</center>";
echo "</font>";

?>
