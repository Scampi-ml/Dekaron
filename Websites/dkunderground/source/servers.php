<?php
$html_title = 'Private Servers';
include ('header.php');


$df_array = array(
'1' => "1 Time",
'2' => "2 Times a day",
'3' => "3 Times a day",
'4' => "4 Times a day",
'5' => "5 Times a day",
'6' => "6 Times a day",
'7' => "7 Times a day",
'8' => "8 Times a day",
'9' => "9 Times a day",
'10' => "10 Times a day",
'11' => "10+ Times a day",
'12' => "Every hour",
'no' => "Never");

$class_array = array(
'on' => "Yes");

$siege_array = array(
'1' => "Yes",
'2' => "Yes / Daily",
'3' => "Yes / Weekly",
'4' => "Yes / Monthly",
'5' => "No");

$coins_array = array(
'1' => "Free coins wihout vote",
'2' => "Free coins with vote",
'3' => "Free coins after register",
'4' => "Buy coins with real money",
'5' => "Exchange coins for dill",
'6' => "Exchange coins for something else",
'7' => "Vote for coins",
'8' => "No coins system");

$event_array = array(
'1' => "Daily Events",
'2' => "Weekly Events",
'3' => "Monthly Events",
'4' => "No Events");


?>
<div class="start">Private Servers</div>
			<div id="forum" class="box">
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="servers" width="100%">
					<thead>
                        <tr>
                            <th width="17%">name</th>
                            <th width="4%" class="center">Exp</th>
                            <th width="3%" class="center">Version</th>
                            <th width="12%" class="center">Size</th>
                            <th width="13%" class="center">DF</th>
                            <th width="8%" class="center">Siege</th>
                            <th width="23%" class="center">Cs</th>
                            <th width="8%" class="center">Event</th>
                          <th width="12%" class="center">A | C | S</th>
     					 </tr>
                    </thead>
                    <tbody>
                    <?php
						$odd_even = '1';
										
						$query1 = $dku->SQLquery('SELECT * FROM `pservers` ORDER BY server_name DESC');
						while($server = $dku->SQLfetchArray($query1))
						{
							if( $odd = $number%2 ){$its_odd_or_even = 'odd';}else{$its_odd_or_even = 'even';}
					?>
                        <tr class="<?php echo $its_odd_or_even; ?>">
                            <td><a href="<?php echo $server['server_url']; ?>"><?php echo $server['server_name']; ?></a></td>
                            <td class="center"><?php echo $server['server_exp']; ?>X</td>
                            <td class="center"><?php echo $server['server_version']; ?></td>
                            <td class="center"><?php echo $server['server_size']; ?>+ players</td>
                            <td class="center"><?php echo $df_array[$server['server_deadfront']]; ?></td>
                            <td class="center"><?php echo $siege_array[$server['server_siege']]; ?></td>
                            <td class="center"><?php echo $coins_array[$server['server_cs']]; ?></td>
                            <td class="center"><?php echo $event_array[$server['server_event']]; ?></td>
                          <td class="center"><?php echo $class_array[$server['server_eclassa']]; ?> | <?php echo $class_array[$server['server_eclassc']]; ?> | <?php echo $class_array[$server['server_eclasss']]; ?></td>
                        </tr>
                    <?php
						$odd_even++;
					}
					?>
                    </tbody>
              </table>
                <br />
                <br />
                <br />
                <hr />
                	<br />
                	<?php
					$member = $dku->is_logged();
					if($member['member_id'] == '0')
					{
						echo '<a href="http://www.dkunderground.org/forums/index.php?app=core&module=global&section=login&return=http://www.dkunderground.org/servers.php">Login</a> or <a href="http://www.dkunderground.org/forums/index.php?app=core&module=global&section=register&return=http://www.dkunderground.org/servers.php">register</a> to add or edit your server.';
					}
					else
					{
						echo '<a href="add_server.php">Add your server</a> or <a href="edit_server.php">edit your server</a>';
					
					}
					?>
                    <br />
                    <br />
                <hr />
                <h2>Legenda</h2>
                <table width="100%" border="0">
                  <tr>
                    <th scope="row"><div align="left">Version</div></th>
                    <td><div align="left">core version the server runs on.</div></td>
                  </tr>
                  <tr>
                    <th scope="row"><div align="left">Size</div></th>
                    <td><div align="left">estimated total number of (registerd) players on the server.</div></td>
                  </tr>
                  <tr>
                    <th scope="row"><div align="left">DF</div></th>
                    <td><div align="left">short for &quot;Dead Front&quot;</div></td>
                  </tr>
                  <tr>
                    <th scope="row"><div align="left">Cs</div></th>
                    <td><div align="left">short for &quot;Coins System&quot;, what kind of system do they use for coins</div></td>
                  </tr>
                  <tr>
                    <th scope="row"><div align="left">A | C | S</div></th>
                    <td><div align="left">
                      <p>If the server does support the following classes: </p>
                      <p>A = Aloken</p>
                      <p>C = Concerra Summoner</p>
                      <p>S = Seguriper</p>
                    </div></td>
                  </tr>
                </table>

                
</div>
<div class="end"></div>
<?php
include ('footer.php');
?>