<?php
$html_title = 'Add Server';
include ('header.php');

$member = $dku->is_logged();
if($member['member_id'] == '0')
{
?>
<div class="start">Add Server</div>
        <div class="box" id="latest-headlines">
			<div style="text-align: center;">
                You are not logged in, please 
                <a href="http://www.dkunderground.org/forums/index.php?app=core&module=global&section=login&return=http://www.dkunderground.org/add_server.php">login</a>
                 or 
                <a href="http://www.dkunderground.org/forums/index.php?app=core&module=global&section=register&return=http://www.dkunderground.org/add_server.php">register</a>
            </div>
        </div>
<div class="end"></div>
<?php
}
elseif($dku->get_servers($member['member_id'], 'count') == '1')
{
?>
<div class="start">Add Server</div>
        <div class="box" id="latest-headlines">
			<div style="text-align: center;">
                <font color="red">You are only allowed to have 1 server per account.</font> 
            </div>
        </div>
<div class="end"></div>
<?php
}
else
{
?>
<div class="start">Add Server</div>
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
			$sql = "INSERT INTO pservers (server_name, server_url, server_exp, server_version, server_size, server_deadfront, server_siege, server_cs, server_event, server_eclassa, server_eclassc, server_eclasss, server_owner)
			VALUES
			(
			'".mysql_real_escape_string($_POST['server_name'])."', 
			'".mysql_real_escape_string($_POST['server_url'])."', 
			'".mysql_real_escape_string($_POST['server_exp'])."', 
			'".mysql_real_escape_string($_POST['server_version'])."', 
			'".mysql_real_escape_string($_POST['server_size'])."', 
			'".mysql_real_escape_string($_POST['server_deadfront'])."', 
			'".mysql_real_escape_string($_POST['server_siege'])."', 
			'".mysql_real_escape_string($_POST['server_cs'])."', 
			'".mysql_real_escape_string($_POST['server_event'])."', 
			'".mysql_real_escape_string($_POST['server_eclassa'])."', 
			'".mysql_real_escape_string($_POST['server_eclassc'])."', 
			'".mysql_real_escape_string($_POST['server_eclasss'])."', 
			'".mysql_real_escape_string($member['member_id'])."'
			
			)";	
			
			if (!$dku->SQLquery($sql))
			{
				echo '<p><font color="red"><strong>'.mysql_error().'</strong></font></p><br>';
			}
			else
			{	
				echo '<p><font color="green"><strong>Added your server</strong></font></p><br>';	
			}
		}		
	}
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
            <form name="theform" id="theform" action="add_server.php" method="post">
            <table cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <td class="left" valign="top">Server Name:</td>
                        <td><input class="long" type="text" name="server_name"></td>
                    </tr>
                    <tr>
                        <td class="left" valign="top">Website or forum:</td>
                        <td><input class="long" type="text" name="server_url"></td>
                    </tr>
                    <tr>
                        <td class="left" valign="top">Exp Rate:</td>
                        <td><input class="long" type="text" name="server_exp"> X</td>
                    </tr>
                    <tr>
                        <td class="left top" valign="top">Server version:</td>
                        <td class="top">
                            <select name="server_version" style="width:300px;">
                                <option value="" selected="selected">Choose one</option>
                                <option value="A1">A1</option>
                                <option value="A2">A2</option>
                                <option value="A3">A3</option>
                                <option value="A4">A4</option>
                                <option value="A5">A5</option>
                                <option value="A6">A6</option>
                                <option value="A7">A7</option>
                                <option value="A8">A8</option>
                                <option value="A9">A9</option>
                                <option value="A10">A10</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="left" valign="top">Server Size:</td>
                        <td>
                            <select name="server_size" id="event_day" style="width:300px;">
                            	<option value="" selected="selected">Choose one</option>
                                <option value="10" >10+ players</option>
                                <option value="100" >100+ players</option>
                                <option value="1000" >1.000+ players</option>
                                <option value="10000" >10.000+ players</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="left" valign="top">Deadfront:</td>
                        <td>
                            <select name="server_deadfront" style="width:300px;">
                                <option value="1" selected="selected" >1 Time</option>
                                <option value="2" >2 Times a day</option>
                                <option value="3" >3 Times a day</option>
                                <option value="4" >4 Times a day</option>
                                <option value="5" >5 Times a day</option>
                                <option value="6" >6 Times a day</option>
                                <option value="7" >7 Times a day</option>
                                <option value="8" >8 Times a day</option>
                                <option value="9" >9 Times a day</option>
                                <option value="10" >10 Times a day</option>
                                <option value="11" >10+ Times a day</option>
                                <option value="12" >Every Hour</option>
                                <option value="no" >No</option>
                            </select>
					</td>
                    </tr>
                    <tr>
                        <td class="left" valign="top">Siege:</td>
                        <td>
                            <select name="server_siege" style="width:300px;">
                            	<option value="" selected="selected">Choose one</option>
                                <option value="1" >Yes</option>
                                <option value="2" >Yes / Daily</option>
                                <option value="3" >Yes / Weekly</option>
                                <option value="4" >Yes / Monthly</option>
                                <option value="5" >No</option>
                            </select>
						</td>
                    </tr>                   
                    <tr>
                        <td class="left" valign="top">Coins System:</td>
                        <td>
                            <select name="server_cs" style="width:300px;">
                            	<option value="" selected="selected">Choose one</option>
                                <option value="1" >Free coins wihout vote</option>
                                <option value="2" >Free coins with vote</option>
                                <option value="3" >Free coins after register</option>
                                <option value="4" >Buy coins with real money</option>
                                <option value="5" >Exchange coins for dill</option>
                                <option value="6" >Exchange coins for something else</option>
                                <option value="8" >Vote for coins</option>
                                <option value="7" >No coins system</option>
                            </select>
						</td>
                    </tr> 
                    <tr>
                        <td class="left" valign="top">Events:</td>
                        <td>
                            <select name="server_event" style="width:300px;">
                            	<option value="" selected="selected">Choose one</option>
                                <option value="1" >Daily Events</option>
                                <option value="2" >Weekly Events</option>
                                <option value="3" >Monthly Events</option>
                                <option value="4" >No Events</option>
                            </select>
						</td>
                    </tr>                    
                    <tr>
                        <td class="left" valign="top">Extra classes:</td>
                        <td>
                            <input type="checkbox" name="server_eclassa" />  Aloken<br />
                            <input type="checkbox" name="server_eclassc" />  Concerra Summoner<br />
                            <input type="checkbox" name="server_eclasss" />  Seguriper
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
