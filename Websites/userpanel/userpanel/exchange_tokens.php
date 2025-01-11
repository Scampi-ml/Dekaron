<?php
include ('header.php');
include ('sidebar.php');
?>  
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Exchange Tokens</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
				<?php
				$dekaron->flushthis();
				$result1 = $dekaron->SQLquery("SELECT * FROM account.dbo.user_profile WHERE user_no = '".$_SESSION['USERNO']."' ");
				$list = $dekaron->SQLfetchArray($result1);
				
				$resqtok = $dekaron->SQLquery("SELECT * FROM gamelog.dbo.tokenQueue WHERE user_no = '".$_SESSION['USERNO']."' ");
				$queue = 0;
				while($qtok = $dekaron->SQLfetchArray($resqtok))
				{
					$dater = time() - $qtok['hour'];
					if($dater >= 180)
					{
						$dekaron->SQLquery("UPDATE account.dbo.user_profile SET token = token + 1 WHERE user_no = '".$_SESSION['USERNO']."' ");
						$dekaron->SQLquery("DELETE gamelog.dbo.tokenQueue WHERE user_no = '".$_SESSION['USERNO']."' AND hour = '".$qtok['hour']."' ");
					}
					else
					{
						$queue = $queue + 1;
					}
				}
				if($queue > '0')
				{
					$_SESSION['current_tokens'] = $list['token'] + $queue;
				}
				else
				{
					$_SESSION['current_tokens'] = $list['token'];
				}
				
				echo '<div class="message info ac"><h3>You have '.number_format($_SESSION['current_tokens']).' tokens</h3></div>';
				if ($dekaron->checklogged($_SESSION['USERNO']))
				{
					echo '<div class="message error"><h3>Error!</h3>Your account is still online. You need to logout before you can exchange tokens.</div>';
				}
				elseif($_SESSION['CHARACTERSNUM'] == '0')
				{
					echo '<div class="message error"><h3>Error!</h3>You dont have any chracters. You need to have atleast 1 character before you can exchange tokens.</div>';
				}
				else
				{
					?>
					<form method="get" action="exchange_tokens.php">
						<select name="character"  size="1"  style="width: 205px;">
						<option value="">Select character</option>
						<?php
							foreach($_SESSION['CHARACTERS'] as $character)
							{
								$name_no = explode("-", $character);						
								if (isset($_GET['character']) && $dekaron->isValid($_GET['character']) == true && strlen($_GET['character']) == '18' && $_GET['character'] == $name_no[0])
								{
									echo '<option value="'.$name_no[0].'" selected>'.$name_no[1].'</option>';
								}
								else
								{
									echo '<option value="'.$name_no[0].'">'.$name_no[1].'</option>';
								}
								
							}
						?>
						</select>
						<button type="submit" class="button button-gray" style="padding-top: 1px;">Use Character</button>
					</form>
					<?php
					if(isset($_GET['character']) && !isset($_GET['item']))
					{
						if($dekaron->isValid($_GET['character']) == false && strlen($_GET['character']) != '40' && preg_match('/[^0-9A-Za-z]/', $_GET['character']) )
						{
							echo '<div class="message error"><h3>Error!</h3>Invalid Character</div>';
						}
						else
						{
							?>
                            <br />
                            <table class="datatable full sortable">
                                <thead>
                                    <tr>
                                        <th >Item Name</th>
                                        <th >Upgrade</th>
                                        <th >Required Tokens</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
							
							//$result2 = $dekaron->SQLquery("SELECT * FROM character.dbo.user_bag WHERE character_no = '".$_GET['character']."' ");
							$result2 = $dekaron->SQLquery("
							SELECT 
							  character.dbo.user_bag.character_no,
							  character.dbo.user_bag.line_no,
							  character.dbo.user_bag.wIndex,
							  gamelog.dbo.tokenUpgrade.wIndex,
							  gamelog.dbo.tokenUpgrade.Name,
							  gamelog.dbo.tokenUpgrade.BeforeLevelIndex,
							  gamelog.dbo.tokenUpgrade.NextLevelIndex
							FROM
							 character.dbo.user_bag
							 INNER JOIN gamelog.dbo.tokenUpgrade ON (character.dbo.user_bag.wIndex=gamelog.dbo.tokenUpgrade.wIndex)
							WHERE
							  (character.dbo.user_bag.character_no = '".$_GET['character']."')	
							  
							 ");						
							while($char = $dekaron->SQLfetchArray($result2))
							{
								echo "<tr>";
									$pos1 = strpos($char['Name'], '+1');
									$pos2 = strpos($char['Name'], '+2');
									$pos3 = strpos($char['Name'], '+3');
									$pos4 = strpos($char['Name'], '+4');
									$pos5 = strpos($char['Name'], '+5');
									$pos6 = strpos($char['Name'], '+6');
									$pos7 = strpos($char['Name'], '+7');
									$pos8 = strpos($char['Name'], '+8');
									$pos9 = strpos($char['Name'], '+9');
									
									
									echo "<td>".$char['Name']."</td>";
									if($pos1 > 0)
									{
										echo "<td align='center'><a class='button button-green' href='exchange_tokens.php?character=".$_GET['character']."&item=".$char['wIndex']."'>Upgrade to +2</a></td>";
										echo "<td align='center'>12</td>";
									}
									else if($pos2 > 0)
									{
										echo "<td align='center'><a class='button button-green' href='exchange_tokens.php?character=".$_GET['character']."&item=".$char['wIndex']."'>Upgrade to +3</a></td>";
										echo "<td align='center'>15</td>";
									}
									else if($pos3 > 0)
									{
										echo "<td align='center'><a class='button button-green' href='exchange_tokens.php?character=".$_GET['character']."&item=".$char['wIndex']."'>Upgrade to +4</a></td>";
										echo "<td align='center'>30</td>";
									}
									else if($pos4 > 0)
									{
										echo "<td align='center'><a class='button button-green' href='exchange_tokens.php?character=".$_GET['character']."&item=".$char['wIndex']."'>Upgrade to +5</a></td>";
										echo "<td align='center'>50</td>";
									}
									else if($pos5 > 0)
									{
										echo "<td align='center'><a class='button button-green' href='exchange_tokens.php?character=".$_GET['character']."&item=".$char['wIndex']."'>Upgrade to +6</a></td>";
										echo "<td align='center'>75</td>";
									}
									else if($pos6 > 0)
									{
										echo "<td align='center'><a class='button button-green' href='exchange_tokens.php?character=".$_GET['character']."&item=".$char['wIndex']."'>Upgrade to +7</a></td>";
										echo "<td align='center'>100</td>";
									}
									else if($pos7 > 0)
									{
										echo "<td align='center'><a class='button button-green' href='exchange_tokens.php?character=".$_GET['character']."&item=".$char['wIndex']."'>Upgrade to +8</a></td>";
										echo "<td align='center'>150</td>";
									}
									else if($pos8 > 0)
									{
										echo "<td align='center'><a class='button button-green' href='exchange_tokens.php?character=".$_GET['character']."&item=".$char['wIndex']."'>Upgrade to +9</a></td>";
										echo "<td align='center'>250</td>";
									}
									else if($pos9 > 0)
									{
										echo "<td align='center'><a class='button button-red'>[Maxed]</a></td>";
										echo "<td align='center'>-</td>";
									}
									else
									{
										echo "<td align='center'><a class='button button-green' href='exchange_tokens.php?character=".$_GET['character']."&item=".$char['wIndex']."'>Upgrade to +1</a></td>";
										echo "<td align='center'>10</td>";
									}
									
									
								echo "</tr>";
								?>
                                
                                
                                <?php
							}
							?>
                                	</tbody>
                                </table>
							
                            <?php						
						}	// end check
					}
					elseif(isset($_GET['character']) && isset($_GET['item']) )
					{
						if(!is_numeric($_GET['item']) && $dekaron->isValid($_GET['item']) == false)
						{
							echo '<div class="message error"><h3>Error!</h3>Invalid Item ID</div>';
						}
						else
						{
							echo "<br><br>";
							$resultbag = $dekaron->SQLquery("SELECT character_no,wIndex,line_no FROM character.dbo.user_bag WHERE character_no = '".$_GET['character']."' AND wIndex = '".$_GET['item']."' ");							
							$identity = -1;
							while($getBag = $dekaron->SQLfetchArray($resultbag))
							{
								$identity = $getBag['line_no'];
							}
							
							$items = $dekaron->SQLquery("SELECT * FROM gamelog.dbo.tokenUpgrade WHERE wIndex = '".$_GET['item']."' ");
							while($getItem = $dekaron->SQLfetchArray($items))
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
								
								//echo "<font color=#00FF00>".$getItem['Name']."</font>";
								if($_SESSION['current_tokens'] > 5)
								{
									$tokens = $_SESSION['current_tokens'];
									if($pos1 > 0 && $tokens >= 12)
									{
										$dekaron->SQLquery("UPDATE account.dbo.user_profile SET token = token - 12 WHERE user_no = '".$_SESSION['USERNO']."'");
										if(rand(0, 100) >= 14)
										{
											$dekaron->SQLquery("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['NextLevelIndex']." WHERE character_no = '".$_GET['character']."' and line_no = '".$identity."' ");
											$dekaron->user_action(''.$_GET['character'].' upgraded '.$_GET['item'].' to +2');
											echo "<center><h1><font color='#00FF00'>Successfully upgraded to +2</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
										}
										else
										{
											$dekaron->SQLquery("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['BeforeLevelIndex']." WHERE character_no = '".$_GET['character']."' and line_no = '".$identity."' ");
											$dekaron->user_action(''.$_GET['character'].' failed '.$_GET['item'].' to +2');
											echo "<center><h1><font color='red'>Failed to upgrade, item is now +0</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
										}
									}
									else if($pos2 > 0 && $tokens >= 15)
									{
										$dekaron->SQLquery("update account.dbo.user_profile set token = token - 15 where user_no = '".$_SESSION['USERNO']."'");
										if(rand(0, 100) >= 23)
										{
											$dekaron->SQLquery("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['NextLevelIndex']." WHERE character_no = '".$_GET['character']."' and line_no = '".$identity."' ");
											$dekaron->user_action(''.$_GET['character'].' upgraded '.$_GET['item'].' to +3');
											echo "<center><h1><font color='#00FF00'>Successfully upgraded to +3</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
										}
										else
										{
											$dekaron->SQLquery("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['BeforeLevelIndex']." WHERE character_no = '".$_GET['character']."' and line_no = '".$identity."' ");
											$dekaron->user_action(''.$_GET['character'].' failed '.$_GET['item'].' to +3');
											echo "<center><h1><font color='red'>Failed to upgrade, item is now +1</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
										}
									}
									else if($pos3 > 0 && $tokens >= 30)
									{
										$dekaron->SQLquery("update account.dbo.user_profile set token = token - 30 where user_no = '".$_SESSION['USERNO']."'");
										if(rand(0, 100) >= 27)
										{
											$dekaron->SQLquery("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['NextLevelIndex']." WHERE character_no = '".$_GET['character']."' and line_no = '".$identity."' ");
											$dekaron->user_action(''.$_GET['character'].' upgraded '.$_GET['item'].' to +4');
											echo "<center><h1><font color='#00FF00'>Successfully upgraded to +4</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
										}
										else
										{
											$dekaron->SQLquery("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['BeforeLevelIndex']." WHERE character_no = '".$_GET['character']."' and line_no = '".$identity."' ");
											$dekaron->user_action(''.$_GET['character'].' failed '.$_GET['item'].' to +4');
											echo "<center><h1><font color='red'>Failed to upgrade, item is now +2</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
										}
									}
									else if($pos4 > 0 && $tokens >= 50)
									{
										$dekaron->SQLquery("update account.dbo.user_profile set token = token - 50 where user_no = '".$_SESSION['USERNO']."'");
										if(rand(0, 100) >= 33)
										{
											$dekaron->SQLquery("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['NextLevelIndex']." WHERE character_no = '".$_GET['character']."' and line_no = '".$identity."' ");
											$dekaron->user_action(''.$_GET['character'].' upgraded '.$_GET['item'].' to +5');
											echo "<center><h1><font color='#00FF00'>Successfully upgraded to +5</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
										}
										else
										{
											$dekaron->SQLquery("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['BeforeLevelIndex']." WHERE character_no = '".$_GET['character']."' and line_no = '".$identity."' ");
											$dekaron->user_action(''.$_GET['character'].' failed '.$_GET['item'].' to +5');
											echo "<center><h1><font color='red'>Failed to upgrade, item is now +3</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
										}
									}
									else if($pos5 > 0 && $tokens >= 75)
									{
										$dekaron->SQLquery("update account.dbo.user_profile set token = token - 75 where user_no = '".$_SESSION['USERNO']."'");
										if(rand(0, 100) >= 40)
										{
											$dekaron->SQLquery("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['NextLevelIndex']." WHERE character_no = '".$_GET['character']."' and line_no = '".$identity."' ");
											$dekaron->user_action(''.$_GET['character'].' upgraded '.$_GET['item'].' to +6');
											echo "<center><h1><font color='#00FF00'>Successfully upgraded to +6</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
										}
										else
										{
											$dekaron->SQLquery("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['BeforeLevelIndex']." WHERE character_no = '".$_GET['character']."' and line_no = '".$identity."' ");
											$dekaron->user_action(''.$_GET['character'].' failed '.$_GET['item'].' to +6');
											echo "<center><h1><font color='red'>Failed to upgrade, item is now +4</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
										}
									}
									else if($pos6 > 0 && $tokens >= 100)
									{
										$dekaron->SQLquery("update account.dbo.user_profile set token = token - 100 where user_no = '".$_SESSION['USERNO']."'");
										if(rand(0, 100) >= 55)
										{
											$dekaron->SQLquery("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['NextLevelIndex']." WHERE character_no = '".$_GET['character']."' and line_no = '".$identity."' ");
											$dekaron->user_action(''.$_GET['character'].' upgraded '.$_GET['item'].' to +7');
											echo "<center><h1><font color='#00FF00'>Successfully upgraded to +7</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
										}
										else
										{
											$dekaron->SQLquery("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['BeforeLevelIndex']." WHERE character_no = '".$_GET['character']."' and line_no = '".$identity."' ");
											$dekaron->user_action(''.$_GET['character'].' upgraded '.$_GET['item'].' to +7');
											echo "<center><h1><font color='red'>Failed to upgrade, item is now +5</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
										}
									}
									else if($pos7 > 0 && $tokens >= 150)
									{
										$dekaron->SQLquery("update account.dbo.user_profile set token = token - 150 where user_no = '".$_SESSION['USERNO']."'");
										if(rand(0, 100) >= 60)
										{
											$dekaron->SQLquery("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['NextLevelIndex']." WHERE character_no = '".$_GET['character']."' and line_no = '".$identity."' ");
											$dekaron->user_action(''.$_GET['character'].' upgraded '.$_GET['item'].' to +8');
											echo "<center><h1><font color='#00FF00'>Successfully upgraded to +8</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
										}
										else
										{
											$dekaron->SQLquery("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['BeforeLevelIndex']." WHERE character_no = '".$_GET['character']."' and line_no = '".$identity."' ");
											$dekaron->user_action(''.$_GET['character'].' failed '.$_GET['item'].' to +7');
											echo "<center><h1><font color='red'>Failed to upgrade, item is now +6</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
										}
									}
									else if($pos8 > 0 && $tokens >= 250)
									{
										$dekaron->SQLquery("update account.dbo.user_profile set token = token - 250 where user_no = '".$_SESSION['USERNO']."'");
										if(rand(0, 100) >= 70)
										{
											$dekaron->SQLquery("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['NextLevelIndex']." WHERE character_no = '".$_GET['character']."' and line_no = '".$identity."' ");
											$dekaron->user_action(''.$_GET['character'].' upgraded '.$_GET['item'].' to +9');
											echo "<center><h1><font color='#00FF00'>Successfully upgraded to +9</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
										}
										else
										{
											$dekaron->SQLquery("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['BeforeLevelIndex']." WHERE character_no = '".$_GET['character']."' and line_no = '".$identity."' ");
											$dekaron->user_action(''.$_GET['character'].' failed '.$_GET['item'].' to +9');
											echo "<center><h1><font color='red'>Failed to upgrade, item is now +7</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
										}
									}
									else if($pos9 > 0)
									{
										echo "<center><h1><font color='red'>This item cannot be upgraded any further!</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
									}
									else if($pos1 <= 0 && $pos2 <= 0 && $pos3 <= 0 && $pos4 <= 0 && $pos5 <= 0 && $pos6 <= 0 && $pos7 <= 0 && $pos8 <= 0 && $pos9 <= 0 && $tokens >= 10)
									{
										$dekaron->SQLquery("UPDATE account.dbo.user_profile SET token = token - 10 WHERE user_no = '".$_SESSION['USERNO']."'");
										if(rand(0, 100) >= 3)
										{
											$dekaron->SQLquery("UPDATE character.dbo.user_bag SET wIndex = ".$getItem['NextLevelIndex']." WHERE character_no = '".$_GET['character']."' AND line_no = '".$identity."' ");
											$dekaron->user_action(''.$_GET['character'].' upgraded '.$_GET['item'].' to +1');
											echo "<center><h1><font color='#00FF00'>Successfully upgraded to +1</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
										}
										else
										{
											$dekaron->SQLquery("DELETE character.dbo.user_bag WHERE character_no = '".$_GET['character']."' AND line_no = '".$identity."' ");
											$dekaron->user_action(''.$_GET['character'].' destroyed '.$_GET['item'].'');
											echo "<center><h1><font color='red'>Destroyed! Really bad luck!</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
										}
									}
									else
									{
										echo "<center><h1><font color='red'>Insufficient tokens!</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
									}
									echo "<br>";
								}
								else
								{
									echo "<center><h1><font color='red'>Insufficient tokens!</font></h1><br><br><br><a href='exchange_tokens.php?character=".$_GET['character']."'>Back to your inventory</a></center>";
								}
								
							}
						}
					}
					else
					{
						
					}
					//----------------------
				}
				?>
 						   <br /><br />
                           <div class="message warning" style="color:#000000;"><strong>NOTE:</strong> All transactions are final and will not be reversed.</div>                    
            </div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>