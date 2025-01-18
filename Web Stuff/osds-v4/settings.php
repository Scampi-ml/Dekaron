<?php 
include "header.php";

// -----------------------------------
// Lets see if a setting is set, if not set default
// -----------------------------------
if (!isset($_GET['setting']))
{
	header('Location: settings.php?setting=default');
}

// -----------------------------------
// lets write it to the config file
// -----------------------------------
if (isset($_POST['submit']))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		if ($key == 'submit') {
			continue;
		}

		$Config->set( $key, $val, 'GENERAL' );
	}

	echo '<div class="success msg">Settings have been updated!</div>';
}
	
// -----------------------------------
// Get the forums
// -----------------------------------
switch($_GET['setting']) {
		
	#############################################################################
	case "main":
		$form = '
			<fieldset>
				<dt><label for="site_title">Site Title</label></dt>
				<dd>
					<input type="text" name="site_title" class="medium" value="' . $Config->get( 'site_title', 'GENERAL') . '" />
					<small>The title of your website. (Browser Window)</small>
				</dd>

				<dt><label for="tagline">Site Name</label></dt>
				<dd>
					<input type="text" name="site_name" class="medium" value="' . $Config->get( 'site_name', 'GENERAL') . '" />
					<small>The name of your website. (Header of the CP)</small>
				</dd>
				
				<dt><label>Show "Your site"</label></dt>
				<dd>
					<select size="1" name="show_site_url" class="medium" value="' . $Config->get( 'show_site_url', 'GENERAL') . '">
						<option value="true">Enabled</option>
						<option value="false">Disabled</option>
					</select>
					<small>Optional</small>
				</dd>

				<dt><label for="site_url">Website URL</label></dt>
				<dd>
					<input type="text" name="site_url" class="medium" value="' . $Config->get( 'site_url', 'GENERAL') . '" />
					<small>Your website address. Include http://</small>
				</dd>
				
				<dt><label>Show username</label></dt>
				<dd>
					<select size="1" name="show_username" class="medium" value="' . $Config->get( 'show_username', 'GENERAL') . '">
						<option value="true">Enabled</option>
						<option value="false">Disabled</option>
					</select>
					<small>Optional</small>
				</dd>
			</fieldset>
			<div class="information msg">
				A page refresh may be needed to make the changes visible.
			</div>';
		break;
	
	#############################################################################	
	case "server_status":
		$form = '
			<fieldset>
				<dt><label>Server Check Login Page</label></dt>
				<dd>
					<select size="1" name="check_server_status_login" class="medium" value="' . $Config->get( 'check_server_status_login', 'GENERAL') . '">
						<option value="true">Enabled</option>
						<option value="false">Disabled</option>
					</select>
					<small>Recommended</small>
				</dd>
				
				<dt><label>Server Check All pages</label></dt>
				<dd>
					<select size="1" name="check_server_status_all_pages" class="medium" value="' . $Config->get( 'check_server_status_all_pages', 'GENERAL') . '">
						<option value="true">Enabled</option>
						<option value="false">Disabled</option>
					</select>
					<small>This will really show down your page loading!</small>
				</dd>

				<dt><label>Check Server Timeout</label></dt>
				<dd>
					<select size="1" name="check_server_status_timeout" class="medium" value="' . $Config->get( 'check_server_status_timeout', 'GENERAL') . '">
						<option value="1">1 Second</option>
						<option value="2">2 Seconds</option>
						<option value="3">3 Seconds</option>
						<option value="4">4 Seconds</option>
						<option value="5">5 Seconds</option>
						<option value="6">6 Seconds</option>
						<option value="7">7 Seconds</option>
						<option value="8">8 Seconds</option>
						<option value="9">9 Seconds</option>
						<option value="10">10 Seconds</option>
					</select>
					<small>Number in seconds when it needs to timeout!</small>
				</dd>

				<dt><label>Check Server Port</label></dt>
				<dd>
					<select size="1" name="check_server_status_port" class="medium" value="' . $Config->get( 'check_server_status_port', 'GENERAL') . '">
						<option value="21">Port 21 = Ftp</option>
						<option value="22">Port 22 = Ssh</option>
						<option value="23">Port 23 = Telnet</option>
						<option value="25">Port 25 = Smtp</option>
						<option value="80">Port 80 = Http</option>
						<option value="110">Port 110 = Pop3</option>
						<option value="443">Port 443 = Https</option>
						<option value="1433">Port 1433 = MSSQL</option>
						<option value="3306">Port 3306 = MySQL</option>
						<option value="8080">Port 8080 = Http (Alternative)</option>
					</select>
					<small>The port you want to check.</small>
				</dd>

				<dt><label for="site_keyword">MSSQL Server IP</label></dt>
				<dd>
					<input type="text" name="mssql_server_ip" class="medium" value="' . $Config->get( 'mssql_server_ip', 'GENERAL') . '" />
					<small>You can use: localhost, 127.0.0.1, ...</small>
				</dd>
			</fieldset>
			
			<div class="information msg">
				This setting is used for general use, this part can be used in the login page:
				<br>
				<b>Example:</b> If your mssql server is offline you wont be able to login. That seems normal to me.
				<br>
				This is to prevent a shitload of errors and ending up with a failed login that whould mess up the osds cp.
				<br>
				You can also use this to check every page if the server is running. But not recommneded.
			</div>
			';
		break;
	
	#############################################################################	
	case "server_info_block":
		$form = '
			<fieldset>
					<dt><label >Server info block</label></dt>
					<dd>
						<select size="1" class="medium" name="server_info" value="' . $Config->get( 'server_info', 'GENERAL') . '">
							<option value="true">Enabled</option>
							<option value="false">Disabled</option>
						</select>
					</dd>
					
						
					<dt><label >Server info time</label></dt>
					<dd>
						<select size="1" class="medium" name="server_info_time" value="' . $Config->get( 'server_info_time', 'GENERAL') . '">
							<option value="true">Enabled</option>
							<option value="false">Disabled</option>
						</select>
					</dd>
					
					<dt><label >Server info disk</label></dt>
					<dd>
						<select size="1" class="medium" name="server_info_disk" value="' . $Config->get( 'server_info_disk', 'GENERAL') . '">
							<option value="true">Enabled</option>
							<option value="false">Disabled</option>
						</select>
					</dd>
					
					<dt><label >Server info disk bar</label></dt>
					<dd>
						<select size="1" class="medium" name="server_info_disk_bar" value="' . $Config->get( 'server_info_disk_bar', 'GENERAL') . '">
							<option value="true">Enabled</option>
							<option value="false">Disabled</option>
						</select>
					</dd>
				
					<dt><label >Server info cpu</label></dt>
					<dd>
						<select size="1" class="medium" name="server_info_cpu" value="' . $Config->get( 'server_info_cpu', 'GENERAL') . '">
							<option value="true">Enabled</option>
							<option value="false">Disabled</option>
						</select>
					</dd>
					
					<dt><label >Server info cpu bar</label></dt>
					<dd>
						<select size="1" class="medium" name="server_info_cpu_bar" value="' . $Config->get( 'server_info_cpu_bar', 'GENERAL') . '">
							<option value="true">Enabled</option>
							<option value="false">Disabled</option>
						</select>
					</dd>
			</fieldset>
			<div class="warning msg">If this you set "<b>Server info block</b>" to Disabled, the settings below will be ignored!</div>
		';
		break;
	
	#############################################################################	
	case "server_version_block":
		$form = '
			<fieldset>
				<dt><label >Show Server Version</label></dt>
				<dd>
					<select size="1" name="server_version_ini" class="medium" value="' . $Config->get( 'server_version_ini', 'GENERAL') . '">
						<option value="true">Enabled</option>
						<option value="false">Disabled</option>
					</select>
					<small>If you wish to use this please set in <a href="settings.php?setting=path_settings">Path Settings</a> your path to your dekaron share folder.</small>
				</dd>
				
				<dt><label >Allow version edit</label></dt>
				<dd>
					<select size="1" name="server_version_ini_edit" class="medium" value="' . $Config->get( 'server_version_ini_edit', 'GENERAL') . '">
						<option value="true">Enabled</option>
						<option value="false">Disabled</option>
					</select>
					<small>If set to "Enabled" this will allow to change the version.ini file! Below the version you will see [Change Version] </small>
				</dd>
			</fieldset>
			<div class="warning msg">
		<h1>WARNING!</h1>
		<br>
		If you "<b>Allow version edit</b>" you can update your version.ini file, be sure you know what you are doing
		<br>
		This is made for fast access to re-write version.ini
	</div>

		';
		
		break;
		
	#############################################################################	
	case "error_reporting":
		$form = '
			<fieldset>				
				<dt><label >Error Level</label></dt>
				<dd>
					<select size="1" name="error_reporting" class="medium" value="' . $Config->get( 'error_reporting', 'GENERAL') . '">
						<option value="0">Level 0 ( Turn off all error reporting ) </option>
						<option value="1">Level 1 ( Report simple running errors )</option>
						<option value="2">Level 2 ( Reporting E_NOTICE )</option>
						<option value="3">Level 3 ( Report all errors except E_NOTICE )</option>
						<option value="4">Level 4 ( Report all PHP errors )</option>
					</select>
					<small>Sets which PHP errors are reported</small>
				</dd>
			</fieldset>
			<div class="information msg">
				See <a href="http://php.net/manual/en/function.error-reporting.php"> PHP: error_reporting </a> for more details.
			</div>

		';
		break;
		
	#############################################################################	
	case "path_settings":
		$form = '
			<fieldset>
				<dt><label >Share Folder</label></dt>
				<dd>
					<input type="text" name="share_root" class="medium" value="' . $Config->get( 'share_root', 'GENERAL') . '" />
					<small>Please enter an ending slash => "/"!</small>
				</dd>
			</fieldset>
		';
		break;
		
	#############################################################################	
	case "source_path_settings":
		$form = '
			<fieldset>
				<dt><label >Source Path</label></dt>
				<dd>
					<input type="text" name="source_root" class="medium" value="' . $Config->get( 'source_root', 'GENERAL') . '" />
					<small>Default: source.dkunderground.org</small>
				</dd>
			</fieldset>
		';
		break;

	#############################################################################	
	case "disconnect_settings":
		$form = '
			<fieldset>
				<dt><label>Use Disconnect System</label></dt>
				<dd>
					<select size="1" name="disconnect_settings" class="medium" value="' . $Config->get( 'disconnect_settings', 'GENERAL') . '">
						<option value="true">Enabled</option>
						<option value="false">Disabled</option>
					</select>
					<small>It provides a way to disconnect players in-game without being in-game with a program called currports. Thanks to Oishi</small>
				</dd>
				
				<dt><label>Login Port</label></dt>
				<dd>
					<input type="text" name="curr_login_port" class="medium" value="' . $Config->get( 'curr_login_port', 'GENERAL') . '" />
					<small>Fill this in with the port from loginlist.csv. <br><b>Default:</b> 7880</small>
				</dd>
				
				<dt><label>Channel Port</label></dt>
				<dd>
					<input type="text" name="curr_channel_port" class="medium" value="' . $Config->get( 'curr_channel_port', 'GENERAL') . '" />
					<small>Fill this is with the port from channelist.csv. <br><b>Default:</b> 50005</small>
				</dd>

				<dt><label>Curr Path</label></dt>
				<dd>
					<input type="text" name="curr_path" class="medium" value="' . $Config->get( 'curr_path', 'GENERAL') . '" />
					<small>Fill this in with the path to your currports executable. <br><b>Example:</b> "cports/cports.exe"</small>
				</dd>

			</fieldset>
			<div class="information msg">
				<a href="http://www.nirsoft.net/utils/cports.html" target="_blank">Cports Website</a>
			</div>

		';
		break;
		
		
	#############################################################################	
	case "email_settings":
		$form = '
			<fieldset>
				<dt><label>Email Table</label></dt>
				<dd>
					<select size="1" name="email_settings" class="medium" value="' . $Config->get( 'email_settings', 'GENERAL') . '">
						<option value="user_profile">User_profile Table</option>
						<option value="Tbl_user">Tbl_user Table</option>
					</select>
					<small>Default: Tbl_user </small>
				</dd>
				
			</fieldset>
			<div class="information msg">
				Its recommneded that you DONT use the "<b>Tbl_user</b>" becuz its contains un-encrypted passwords.
				<br>
				If you ever get hacked, the hacker has all your passwords!
				<br>
				You can copy the emails from the Tbl_user to the user_profile table using the <a href="copy_email.php">Copy Email tool</a>
				<br>
				Use the <a href="copy_email.php">Copy Email tool</a> then change the setting
				<br>
				Your emails will NOT be deleted from the Tbl_user table
				
			</div>

		';
		break;

	#############################################################################	
	case "recent_login_block":
		$form = '
			<fieldset>
				<dt><label >Show Recent Logins</label></dt>
				<dd>
					<select size="1" name="recent_login_block" class="medium" value="' . $Config->get( 'recent_login_block', 'GENERAL') . '">
						<option value="true">Enabled</option>
						<option value="false">Disabled</option>
					</select>
					<small>Show the "recent login" block in the sidebar, usefull to see who has logged in to your account.</small>
				</dd>
				<dt><label >Show X Logins</label></dt>
				<dd>
					<select size="1" name="recent_login_block_top" class="medium" value="' . $Config->get( 'recent_login_block_top', 'GENERAL') . '">
						<option value="3">3</option>
						<option value="5">5</option>
						<option value="7">7</option>
						<option value="10">10</option>
						<option value="15">15</option>
					</select>
					<small>Show the X of recent logins.</small>
				</dd>

			</fieldset>
		';
		break;
		
	#############################################################################	
	case "version_check_block":
		$form = '
			<fieldset>
				<dt><label >Show Version Check</label></dt>
				<dd>
					<select size="1" name="version_check_block" class="medium" value="' . $Config->get( 'version_check_block', 'GENERAL') . '">
						<option value="true">Enabled</option>
						<option value="false">Disabled</option>
					</select>
					<small>If manual selected, new users must be approved by admin</small>
				</dd>
			</fieldset>
		';
		break;

	#############################################################################	
	case "getDkuNews_block":
		$form = '
			<fieldset>
				<dt><label>Show Dku (OSDS) News</label></dt>
				<dd>
					<select size="1" name="getDkuNews_block" class="medium" value="' . $Config->get( 'getDkuNews_block', 'GENERAL') . '">
						<option value="true">Enabled</option>
						<option value="false">Disabled</option>
					</select>
				</dd>
			</fieldset>
			<div class="information msg">
				It is HIGHLY RECOMMNEDED that you leave this on!
				<br>
				<br> 
				If you Disabled this block you will NOT recive any news from dkunderground OSDS.
				<br>
				You will not recive new or updates about current updates for your OSDS Control Panel.
				<br>
				Only Janvier123 will update this panel, and is not open to the public!
			</div>
		';
		break;
		
	#############################################################################	
	case "inbox_settings":	
			// added in R3
			$query = $db->query('SELECT * FROM account.dbo.inbox ');
			$getInboxData = $db->fetchNum($query);

		$form = '
			<fieldset>
				<dt><label>Use Inbox System</label></dt>
				<dd>
					<select size="1" name="inbox_settings" class="medium" value="' . $Config->get( 'inbox_settings', 'GENERAL') . '">
						<option value="true">Enabled</option>
						<option value="false">Disabled</option>
					</select>
				</dd>
				<dt><label>Notify Me on New</label></dt>
				<dd>
					<select size="1" name="inbox_settings_check" class="medium" value="' . $Config->get( 'inbox_settings_check', 'GENERAL') . '">
						<option value="true">Enabled</option>
						<option value="false">Disabled</option>
					</select>
				</dd>
			</fieldset>
			<div class="information msg">
				A page refresh may be needed to make the "inbox" button visible.
			</div>
			<div class="information msg">
				Total Messages in the inbox system: <b>' . $getInboxData .'</b>
			</div>
		';
		break;
		
	#############################################################################	
	case "reborn_settings":
		$form = '
			<fieldset>
				<dt><label >Use Reborn System</label></dt>
				<dd>
					<select size="1" name="reborn_settings" class="medium" value="' . $Config->get( 'reborn_settings', 'GENERAL') . '">
						<option value="true">Enabled</option>
						<option value="false">Disabled</option>
					</select>
					<small>Is your server using a reborn system?</small>
				</dd>
				
				<dt><label>MSSQL Table Name</label></dt>
				<dd>
					<input type="text" name="reborn_table" class="medium" value="' . $Config->get( 'reborn_table', 'GENERAL') . '" />
					<small>Fill in the name of your table in mssql. Example: reborn</small>
				</dd>
			
				<dt><label>Max Reborn (Times)</label></dt>
				<dd>
					<input type="text" name="reborn_times" class="medium" value="' . $Config->get( 'reborn_times', 'GENERAL') . '" />
					<small>Set the number of the max X times that a character can reborn</small>
				</dd>
			</fieldset>
			<div class="warning msg">
				The "MSSQL Reborn Table" is case sensitive !!
			</div>

		';
		break;
		
	#############################################################################	
	case "mssql_settings":
		$form = '
			<fieldset>
				<dt><label >MSSQL Host</label></dt>
				<dd><input type="text" name="mssql_settings_host" class="medium" value="' . $Config->get( 'mssql_settings_host', 'GENERAL') . '" /></dd>
				
				<dt><label>MSSQL User</label></dt>
				<dd>
					<input type="text" name="mssql_settings_user" class="medium" value="' . $Config->get( 'mssql_settings_user', 'GENERAL') . '" />
				</dd>
			
				<dt><label>MSSQL Passw</label></dt>
				<dd>
					<input type="password" name="mssql_settings_passw" class="medium" value="' . $Config->get( 'mssql_settings_passw', 'GENERAL') . '" />
				</dd>

				<dt><label >Log Queries</label></dt>
				<dd>
					<select size="1" name="mssql_settings_log" class="medium" value="' . $Config->get( 'mssql_settings_log', 'GENERAL') . '">
						<option value="true">Enabled</option>
						<option value="false">Disabled</option>
					</select>
					<small>Do you want to log every query? Info read below.</small>
				</dd>
				


			</fieldset>
			<div class="information msg">
				MSSQL Query Log
				<ul>
					<li>- Log every query</li>
					<li>- Logs are saved in: "<b>logs/</b>"</li>
				</ul>
			</div>';
		break;
		
	#############################################################################	
	case "log_settings":
		$form = '
			<fieldset>
				<dt><label>Log clear button</label></dt>
				<dd>
					<select size="1" name="mssql_settings_log_clear" class="medium" value="' . $Config->get( 'mssql_settings_log_clear', 'GENERAL') . '">
						<option value="true">Enabled</option>
						<option value="false">Disabled</option>
					</select>
					<small>Do you want to add a button "<b>Clear log</b>" to the page? This button can clear the log of any entrys.</small>
				</dd>
				<dt><label>Delete All Logs button</label></dt>
				<dd>
					<select size="1" name="del_logs" class="medium" value="' . $Config->get( 'del_logs', 'GENERAL') . '">
						<option value="true">Enabled</option>
						<option value="false">Disabled</option>
					</select>
					<small>Do you want to add a button "<b>Delete logs</b>" to the page? This button will delete all the log of entrys.</small>
				</dd>
			</fieldset>';
	break;
	#############################################################################
	// nothing is set, so do nothing, but give some info
	default:
		$form = '
			<div class="information msg">
				<h6>Choose A Setting.</h6>
				<br>
				<br>
				<b>Good to know!</b>
				<ul>
					<li>- A page refresh may be needed to make the setting active.</li>
					<li>- Some setting will change your layout, be cure to keep that in mind!</li>
					<li>- Additional info can be found inside the setting.</li>
					<li>- All settings can be edited in the "<b>config.ini</b>" file, with a true or false.</li>
					<li>- Still have questions? Use the "<b>Online Help</b>" button.</li>
				</ul>
			</div>

		';
		break;
		
}

// -----------------------------------
// Start HTML
// -----------------------------------
echo '
<article id="settings">
	<h1>Settings</h1>
	<form class="uniform" name="navigation">
		<select class="medium" name="select1" onchange="location.href=navigation.select1.options[selectedIndex].value" value="settings.php?setting=' . $_GET['setting'] . '">
			<option value="settings.php?setting=default">					Please select Setting</option>
				<optgroup label="Settings">
			<option value="settings.php?setting=main">						Main CP Settings</option>
			<option value="settings.php?setting=disconnect_settings">		Disconnect Settings</option>
			<option value="settings.php?setting=path_settings">				Server Path Settings</option>
			<option value="settings.php?setting=mssql_settings">			MSSQL Settings</option>
			<option value="settings.php?setting=reborn_settings">			Reborn Settings</option>
			<option value="settings.php?setting=source_path_settings">		Source Settings</option>
			<option value="settings.php?setting=email_settings">			Email Settings</option>
			<option value="settings.php?setting=inbox_settings">			Inbox Settings</option>
			<option value="settings.php?setting=server_status">				Server Status</option>
			<option value="settings.php?setting=error_reporting">			Error Reporting</option>
			<option value="settings.php?setting=log_settings">				Log Settings</option>
				</optgroup>
				<optgroup label="Blocks">
			<option value="settings.php?setting=server_info_block">			Server Info Block</option>
			<option value="settings.php?setting=server_version_block">		Server Version Block</option>
			<option value="settings.php?setting=recent_login_block">		Recent Login Block</option>
			<option value="settings.php?setting=version_check_block">		Version Check Block</option>
			<option value="settings.php?setting=getDkuNews_block">			Show Dku News Block</option>
					</optgroup>
				</select>
			</form>
			<hr>';
			
			// -----------------------------------
			// Display the forums but only if its set
			// -----------------------------------
			if (!$form == "")
			{
				echo '
					<form action="settings.php?setting=' . $_GET['setting'] . '" method="post" class="uniform">
						<dl class="inline">
							' . $form . '
						</dl>';
						
					// -----------------------------------
					// Do some stuff to the "save" button
					// -----------------------------------
					if($_GET['setting'] == 'default')
					{
						// hide button !
						// who wants to save a blank page ???
						
					} else {
						echo '<div class="buttons"><button type="submit" name="submit" class="button">Save Settings</button></div>';
					}
				echo '</form>';
			}
echo '</article>';
include "footer.php";
?>
