<?php
include ( 'osdscore.php' );

if (isset($_GET['settings']))
{
	if(isset($_GET['CONFIG_REBORN']))
	{
		exo_setglobalvariable('CONFIG_REBORN', 'yes', true);
	}
	else
	{
		exo_setglobalvariable('CONFIG_REBORN', 'no', true);
	} 

	exo_setglobalvariable('CONFIG_REBORN_TABLE', $_GET['CONFIG_REBORN_TABLE'], true);
	
	if(isset($_GET['CONFIG_RED_CHARS']))
	{
		exo_setglobalvariable('CONFIG_RED_CHARS', 'yes', true);
	}
	else
	{
		exo_setglobalvariable('CONFIG_RED_CHARS', 'no', true);
	} 
	
	if(isset($_GET['CONFIG_DISPLAY_VERSION']))
	{
		exo_setglobalvariable('CONFIG_DISPLAY_VERSION', 'yes', true);
	}
	else
	{
		exo_setglobalvariable('CONFIG_DISPLAY_VERSION', 'no', true);
	} 

	
	if(isset($_GET['CONFIG_REGISTERD_TO']))
	{
		exo_setglobalvariable('CONFIG_REGISTERD_TO', $_GET['CONFIG_REGISTERD_TO'], true);
	}
	
	
	
	
	if(isset($_GET['CONFIG_SEARCH_IN']))
	{
		exo_setglobalvariable('CONFIG_SEARCH_IN', $_GET['CONFIG_SEARCH_IN'], true);
	}
		
	
	if(isset($_GET['CONFIG_LICKEY']) && $_GET['CONFIG_LICKEY'] != '')
	{
		$appid = exo_getglobalvariable('applicationid', '');
		$md5_appid = md5($appid);
		$lickey = $_GET['CONFIG_LICKEY'];
		
		$back = str_replace('-', '', $lickey);
		$final = strtolower($back);		
		
		
		if( $md5_appid == $final )
		{
			echo '<div class="success">Your license key is valid!</div>';
			exo_setglobalvariable('CONFIG_REGISTERD', 'yes', true);
		}
		else
		{
			echo '<div class="error">Invalid license key</div>';
			exo_setglobalvariable('CONFIG_REGISTERD', '', true);
		}
	}

	exo_setglobalvariable('CONFIG_M_SEARCH_CHARS', $_GET['CONFIG_M_SEARCH_CHARS'], true);
	exo_setglobalvariable('CONFIG_SEARCH_MAX', $_GET['CONFIG_SEARCH_MAX'], true);

	echo '<div class="response-msg success">Settings Updated!</div>';
}


echo '
	<form method="get">
	<div id="serverinfo">Settings<span><input type="submit" value="'.LAN_save.'" name="settings"></span></div>
	<div id="main_pane_left">
		<div class="group">
		<h2>Reborn</h2>
			<table>
				<tr  >
					<td><b>Use reborn system?</b><br><small><i>Allows you to use a reborn system</i></small></td>
					<td>';
					if(exo_getglobalvariable('CONFIG_REBORN', '') == 'yes')
					{
						echo '<input type="checkbox" name="CONFIG_REBORN" checked value="Yes" />';
					}
					else
					{
						echo '<input type="checkbox" name="CONFIG_REBORN" value="Yes" />';
					}
echo '						
					</td>
				</tr>
				<tr  >
					<td><b>Reborn table</b><br><small><i>If "Use reborn system" is checked</i></small></td>
					<td ><input type="text" value="'.exo_getglobalvariable('CONFIG_REBORN_TABLE', '').'" name="CONFIG_REBORN_TABLE" size="15"></td>
				</tr>
				</table>
				</div>
				</div>
				
				
								<div id="main_pane_left">
						<div class="group">
					<h2>Donating</h2>
				<table>

				
				';
				
			if(exo_getglobalvariable('CONFIG_REGISTERD', '') == 'yes')
			{
				echo '<tr  >';
				echo '<td ><b>Remove Branding</b><br><small>&nbsp;</small></td>';
				echo '<td><span style="background-color:#00FF00; color: #FFFFFF;">&nbsp; ACTIVE, Thank you! &nbsp;</span> </td>';
				echo '</tr>';
				
				echo '<tr  >';
				echo '<td><b>Title Text</b><br><small><i>You may need to refresh the page before your title will be displayd</i></small></td>';
				echo '<td><input type="text" value="'.exo_getglobalvariable('CONFIG_REGISTERD_TO', '').'" name="CONFIG_REGISTERD_TO" size="30"></td>';
				echo '</tr>';
			}
			else
			{
				echo '<tr  >';
				echo '<td><b>'.LAN_remove.' '.LAN_pf_bra.'</b><br><small><i>'.LAN_pf_remit.' <a href="http://osds.dkunderground.org/donate.php" target="_heexternal">here</a>.</i></small></td>';
				echo '<td><span style="background-color:#FF0000; color: #FFFFFF;">&nbsp; INACTIVE &nbsp;</span> </td>';
				echo '</tr>';
				
				echo '<tr  >';
				echo '<td><b>License Key</b><br><small></small></td>';
				echo '<td><input type="text" value="'.exo_getglobalvariable('CONFIG_LICKEY', '').'" name="CONFIG_LICKEY" size="30"></td>';
				echo '</tr>';

			}
					
		echo '
				</table>
				</div>
				</div>
		
						
								<div id="main_pane_left">
						<div class="group">
					<h2>Searching</h2>
				<table>
												<tr  >
					<td><b>Red Characters names?</b><br><small><i>Give characters with login_time = NULL a red </i></small></td>
					<td>';
					if(exo_getglobalvariable('CONFIG_RED_ACC', '') == 'yes')
					{
						echo '<input type="checkbox" name="CONFIG_RED_ACC" checked value="Yes" />';
					}
					else
					{
						echo '<input type="checkbox" name="CONFIG_RED_ACC" value="Yes" />';
					}
echo '						
					</td>
				</tr>	

				<tr  >
					<td><b>Red Account names?</b><br><small><i>Give accounts with login_time = NULL a red name</i></small></td>
					<td>';
					if(exo_getglobalvariable('CONFIG_RED_CHARS', '') == 'yes')
					{
						echo '<input type="checkbox" name="CONFIG_RED_CHARS" checked value="Yes" />';
					}
					else
					{
						echo '<input type="checkbox" name="CONFIG_RED_CHARS" value="Yes" />';
					}
echo '						
					</td>
				</tr>


		
				<tr  >
					<td><b>Minimal search characters</b><br><small>&nbsp;</small></td>
					<td><input type="text" value="'.exo_getglobalvariable('CONFIG_M_SEARCH_CHARS', '').'" name="CONFIG_M_SEARCH_CHARS" size="5"></td>
				</tr>
				
				<tr  >
					<td><b>Maximum search results</b><br><small>&nbsp;</small></td>
					<td><input type="text" value="'.exo_getglobalvariable('CONFIG_SEARCH_MAX', '').'" name="CONFIG_SEARCH_MAX" size="5"></td>
				</tr>
				
				
				<tr>
				<td><b>Default "Search in" ?</b><br><small><i>This can be found on the homepage</i></small></td>
					<td><select name="CONFIG_SEARCH_IN" />';
						
							if( exo_getglobalvariable('CONFIG_SEARCH_IN', '') == '1')
							{
								echo '<option value="1" selected >Character Database</option>';
							}
							else
							{
								echo '<option value="1">Character Database</option>';
							}
							
							if( exo_getglobalvariable('CONFIG_SEARCH_IN', '') == '2')
							{
								echo '<option value="2" selected >Account Database</option>';
							}
							else
							{
								echo '<option value="2">Account Database</option>';
							}
							
							if( exo_getglobalvariable('CONFIG_SEARCH_IN', '')== '3')
							{
								echo '<option value="3" selected >Ip on Character</option>';
							}
							else
							{
								echo '<option value="3">Ip on Character</option>';
							}
							
							if( exo_getglobalvariable('CONFIG_SEARCH_IN', '')== '4')
							{
								echo '<option value="4" selected >Ip in Account</option>';
							}
							else
							{
								echo '<option value="4">Ip in Account</option>';
							}
							
							if( exo_getglobalvariable('CONFIG_SEARCH_IN', '')== '5')
							{
								echo '<option value="5" selected >Email Database</option>';
							}
							else
							{
								echo '<option value="5">Email Database</option>';
							}
							
							if( exo_getglobalvariable('CONFIG_SEARCH_IN', '')== '6')
							{
								echo '<option value="6" selected >Guild Database</option>';
							}
							else
							{
								echo '<option value="6">Guild Database</option>';
							}
							

						echo '

						</select>
					</td>

				</tr>

				
				
				
			</table>
			</div>
			</div>
			
			<div id="main_pane_right">
				<div class="group">
					<h2>General</h2>
						<table>
							<tr  >
								<td><b>Display version block?</b><br><small><i>Recommended</i></small></td>
								<td>';
								if(exo_getglobalvariable('CONFIG_DISPLAY_VERSION', '') == 'yes')
								{
									echo '<input type="checkbox" name="CONFIG_DISPLAY_VERSION" checked value="Yes" />';
								}
								else
								{
									echo '<input type="checkbox" name="CONFIG_DISPLAY_VERSION" value="Yes" />';
								}
			echo '						
								</td>
							</tr>
						</table>
						</div>
						</div>


				

	</form>
';


?>
