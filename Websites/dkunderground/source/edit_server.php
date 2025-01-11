<?php
$html_title = 'Edit Server';
include ('header.php');

$member = $dku->is_logged();
if($member['member_id'] == '0')
{
?>
<div class="start">Edit Server</div>
        <div class="box" id="latest-headlines">
			<div style="text-align: center;">
                You are not logged in, please 
                <a href="http://www.dkunderground.org/forums/index.php?app=core&module=global&section=login&return=http://www.dkunderground.org/edit_server.php">login</a>
                 or 
                <a href="http://www.dkunderground.org/forums/index.php?app=core&module=global&section=register&return=http://www.dkunderground.org/edit_server.php">register</a>
            </div>
        </div>
<div class="end"></div>
<?php
}
else
{


?>
<div class="start">Edit Server</div>
        <div class="box">
<?php
	if(isset($_POST['submit']))
	{
		$formerror = array();
		if(empty($_POST['server_name'])){ $formerror[] =  'Please fill in: Server Name';} 
		if(empty($_POST['server_url'])){ $formerror[] =  'Please fill in: Website or forum';} 
		if(empty($_POST['server_exp'])){ $formerror[] =  'Please fill in: Exp Rate';}
		if(empty($_POST['server_version'])){ $formerror[] =  'Please fill in: Server version';} 
		if(empty($_POST['server_size'])){ $formerror[] =  'Please fill in: Server Size';} 
		if(empty($_POST['server_deadfront'])){ $formerror[] =  'Please fill in: Deadfront';}
		if(empty($_POST['server_siege'])){ $formerror[] =  'Please fill in: Siege';} 
		if(empty($_POST['server_cs'])){ $formerror[] =  'Please fill in: Coins System';}
		if(empty($_POST['server_event'])){ $formerror[] =  'Please fill in: Events';} 
		
		if(preg_match('/[^0-9A-Za-z ]/', $_POST['server_name'])) {$formerror[] =  'You can only use: 0-9 A-Z in the Server Name'; }
		if(preg_match('/[^0-9]/', $_POST['server_exp'])) {$formerror[] =  'You can only use: 0-9 in the Exp Rate'; }
		
		if(count($formerror) != '0')
		{
			echo '<p><strong>You have the following errors:</strong><ul>';
			foreach ($formerror as $error)
			{
				echo '<li><font color="red">'.$error.'</font></li>';
			}
			echo '</ul></p>';
		}
		else
		{
			$dku->SQLconnect();	
			$sql = "UPDATE ´pservers´ SET 
						server_name  = '".mysql_real_escape_string($_POST['server_name'])."', 
						server_url = '".mysql_real_escape_string($_POST['server_url'])."',
						server_exp = '".mysql_real_escape_string($_POST['server_exp'])."', 
						server_version = '".mysql_real_escape_string($_POST['server_version'])."', 
						server_size = '".mysql_real_escape_string($_POST['server_size'])."', 
						server_deadfront = '".mysql_real_escape_string($_POST['server_deadfront'])."',
						server_siege = '".mysql_real_escape_string($_POST['server_siege'])."', 
						server_cs = '".mysql_real_escape_string($_POST['server_cs'])."',
						server_event  = '".mysql_real_escape_string($_POST['server_event'])."',
						server_eclassa = '".mysql_real_escape_string($_POST['server_eclassa'])."', 
						server_eclassc  = '".mysql_real_escape_string($_POST['server_eclassc'])."', 
						server_eclasss  = '".mysql_real_escape_string($_POST['server_eclasss'])."'
						
						WHERE server_owner = '".$member['member_id']."'";	
			
			if (!$dku->SQLquery($sql))
			{
				echo '<p><font color="red"><strong>'.mysql_error().'</strong></font></p><br>';
			}
			else
			{	
				echo '<p><font color="green"><strong>Updated your server</strong></font></p><br>';	
			}
			
		}		
	}
	$query1 = $dku->SQLquery('SELECT * FROM `pservers` WHERE `server_owner` = "'.$member['member_id'].'" ');
	$server = $dku->SQLfetchArray($query1);

	
?>

            <p>You are not allowed:</p>
            <p>
                <ul>
                    <li>Non-related dekaron servers</li>
                    <li>Advertising sites</li>
                    <li>Servers without site / forum</li>
                    <li>Non-existing servers / fake servers</li>
                </ul>
            </p>
            <br />
            <form name="theform" id="theform" action="edit_server.php" method="post">
            <table cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <td class="left" valign="top">Server Name:</td>
                        <td><input class="long" type="text" name="server_name" value="<?php echo $server['server_name']; ?>"></td>
                    </tr>
                    <tr>
                        <td class="left" valign="top">Website or forum:</td>
                        <td><input class="long" type="text" name="server_url" value="<?php echo $server['server_url']; ?>"></td>
                    </tr>
                    <tr>
                        <td class="left" valign="top">Exp Rate:</td>
                        <td><input class="long" type="text" name="server_exp" value="<?php echo $server['server_exp']; ?>"> X</td>
                    </tr>
                    <tr>
                        <td class="left top" valign="top">Server version:</td>
                        <td class="top">
                            <select name="server_version" style="width:300px;">
                                <option value="" selected="selected">Choose one</option>
                                <option value="A1" <?php if($server['server_version'] == 'A1') echo 'selected="selected"'; ?> >A1</option>
                                <option value="A2" <?php if($server['server_version'] == 'A2') echo 'selected="selected"'; ?> >A2</option>
                                <option value="A3" <?php if($server['server_version'] == 'A3') echo 'selected="selected"'; ?> >A3</option>
                                <option value="A4" <?php if($server['server_version'] == 'A4') echo 'selected="selected"'; ?> >A4</option>
                                <option value="A5" <?php if($server['server_version'] == 'A5') echo 'selected="selected"'; ?> >A5</option>
                                <option value="A6" <?php if($server['server_version'] == 'A6') echo 'selected="selected"'; ?> >A6</option>
                                <option value="A7" <?php if($server['server_version'] == 'A7') echo 'selected="selected"'; ?> >A7</option>
                                <option value="A8" <?php if($server['server_version'] == 'A8') echo 'selected="selected"'; ?> >A8</option>
                                <option value="A9" <?php if($server['server_version'] == 'A9') echo 'selected="selected"'; ?> >A9</option>
                                <option value="A10" <?php if($server['server_version'] == 'A10') echo 'selected="selected"'; ?> >A10</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="left" valign="top">Server Size:</td>
                        <td>
                            <select name="server_size" id="event_day" style="width:300px;">
                            	<option value="" selected="selected">Choose one</option>
                                <option value="10"  <?php if($server['server_size'] == '10') echo 'selected="selected"'; ?> >10+ players</option>
                                <option value="100" <?php if($server['server_size'] == '100') echo 'selected="selected"'; ?>  >100+ players</option>
                                <option value="1000" <?php if($server['server_size'] == '1000') echo 'selected="selected"'; ?>  >1.000+ players</option>
                                <option value="10000" <?php if($server['server_size'] == '10000') echo 'selected="selected"'; ?>  >10.000+ players</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="left" valign="top">Deadfront:</td>
                        <td>
                            <select name="server_deadfront" style="width:300px;">
                                <option value="1" <?php if($server['server_deadfront'] == '1') echo 'selected="selected"'; ?>  >1 Time</option>
                                <option value="2" <?php if($server['server_deadfront'] == '2') echo 'selected="selected"'; ?>  >2 Times a day</option>
                                <option value="3" <?php if($server['server_deadfront'] == '3') echo 'selected="selected"'; ?>  >3 Times a day</option>
                                <option value="4" <?php if($server['server_deadfront'] == '4') echo 'selected="selected"'; ?>  >4 Times a day</option>
                                <option value="5" <?php if($server['server_deadfront'] == '5') echo 'selected="selected"'; ?>  >5 Times a day</option>
                                <option value="6" <?php if($server['server_deadfront'] == '6') echo 'selected="selected"'; ?> >6 Times a day</option>
                                <option value="7" <?php if($server['server_deadfront'] == '7') echo 'selected="selected"'; ?>  >7 Times a day</option>
                                <option value="8" <?php if($server['server_deadfront'] == '8') echo 'selected="selected"'; ?> >8 Times a day</option>
                                <option value="9" <?php if($server['server_deadfront'] == '9') echo 'selected="selected"'; ?>  >9 Times a day</option>
                                <option value="10" <?php if($server['server_deadfront'] == '10') echo 'selected="selected"'; ?>  >10 Times a day</option>
                                <option value="11" <?php if($server['server_deadfront'] == '11') echo 'selected="selected"'; ?>  >10+ Times a day</option>
                                <option value="12" <?php if($server['server_deadfront'] == '12') echo 'selected="selected"'; ?>  >Every Hour</option>
                                <option value="no" <?php if($server['server_deadfront'] == 'no') echo 'selected="selected"'; ?> >No</option>
                            </select>
					</td>
                    </tr>
                    <tr>
                        <td class="left" valign="top">Siege:</td>
                        <td>
                            <select name="server_siege" style="width:300px;">
                                <option value="1" <?php if($server['server_siege'] == '1') echo 'selected="selected"'; ?>  >Yes</option>
                                <option value="2" <?php if($server['server_siege'] == '2') echo 'selected="selected"'; ?>  >Yes / Daily</option>
                                <option value="3" <?php if($server['server_siege'] == '3') echo 'selected="selected"'; ?>  >Yes / Weekly</option>
                                <option value="4" <?php if($server['server_siege'] == '4') echo 'selected="selected"'; ?>  >Yes / Monthly</option>
                                <option value="5" <?php if($server['server_siege'] == '5') echo 'selected="selected"'; ?>  >No</option>
                            </select>
						</td>
                    </tr>
                    <tr>
                        <td class="left" valign="top">Coins System:</td>
                        <td>
                            <select name="server_cs" style="width:300px;">
                                <option value="1" <?php if($server['server_cs'] == '1') echo 'selected="selected"'; ?> >Free coins wihout vote</option>
                                <option value="2" <?php if($server['server_cs'] == '2') echo 'selected="selected"'; ?> >Free coins with vote</option>
                                <option value="3" <?php if($server['server_cs'] == '3') echo 'selected="selected"'; ?> >Free coins after register</option>
                                <option value="4" <?php if($server['server_cs'] == '4') echo 'selected="selected"'; ?> >Buy coins with real money</option>
                                <option value="5" <?php if($server['server_cs'] == '5') echo 'selected="selected"'; ?> >Exchange coins for dill</option>
                                <option value="6" <?php if($server['server_cs'] == '6') echo 'selected="selected"'; ?> >Exchange coins for something else</option>
                                <option value="8" <?php if($server['server_cs'] == '8') echo 'selected="selected"'; ?> >Vote for coins</option>
                                <option value="7" <?php if($server['server_cs'] == '7') echo 'selected="selected"'; ?> >No coins system</option>
                            </select>
						</td>
                    </tr> 
                    <tr>
                        <td class="left" valign="top">Events:</td>
                        <td>
                            <select name="server_event" style="width:300px;">
                                <option value="1" <?php if($server['server_event'] == '1') echo 'selected="selected"'; ?>  >Daily Events</option>
                                <option value="2" <?php if($server['server_event'] == '2') echo 'selected="selected"'; ?>  >Weekly Events</option>
                                <option value="3"  <?php if($server['server_event'] == '3') echo 'selected="selected"'; ?> >Monthly Events</option>
                                <option value="4"  <?php if($server['server_event'] == '4') echo 'selected="selected"'; ?> >No Events</option>
                            </select>
						</td>
                    </tr>                    
                    <tr>
                        <td class="left" valign="top">Extra classes:</td>
                        <td>
                            <input type="checkbox" name="server_eclassa" <?php if($server['server_eclassa'] == 'on') echo 'checked="checked"'; ?>  />  Aloken<br />
                            <input type="checkbox" name="server_eclassc" <?php if($server['server_eclassc'] == 'on') echo 'checked="checked"'; ?>  />  Concerra Summoner<br />
                            <input type="checkbox" name="server_eclasss" <?php if($server['server_eclasss'] == 'on') echo 'checked="checked"'; ?>  />  Seguriper
						</td>
                    </tr>                  
                </tbody>
            </table>
            <p>All fields are required!</p>
            <p>Double check all info!</p>
            <p><input type="submit" class="button" name="submit" value="Submit"></p>
            </form>
        </div>
<div class="end"></div>
<?php
	
}
?>
<?php
include ('sidebar.php');
include ('footer.php');
?>
