<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_game_server_status' );
	}
	echo notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_game_server_status.php');
}
else
{
?>
<form method="post" action="">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Game Server Status Settings</td>
	</tr>

	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Timeout</b>
        	<br>Number in seconds to timeout the connection
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<input type="text" name="timeout" size="30" value="<?php echo htmlspecialchars($config->get('timeout', 'settings_game_server_status')); ?>" />
        </td>
	</tr>
    
    <tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Dekaron Server</b>
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<input type="text" name="dekaronserver" size="30" value="<?php echo htmlspecialchars($config->get('dekaronserver', 'settings_game_server_status')); ?>" /> <= Ip Address
            <br>
            <input type="text" name="dekaronserver_port" size="30" value="<?php echo htmlspecialchars($config->get('dekaronserver_port', 'settings_game_server_status')); ?>" /> <= Port
        </td>
	</tr>
    
    <tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Login Server</b>
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<input type="text" name="loginserver" size="30" value="<?php echo htmlspecialchars($config->get('loginserver', 'settings_game_server_status')); ?>" /> <= Ip Address
            <br>
            <input type="text" name="loginserver_port" size="30" value="<?php echo htmlspecialchars($config->get('loginserver_port', 'settings_game_server_status')); ?>" /> <= Port
        </td>
	</tr>

    <tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Session Server</b>
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<input type="text" name="sessionserver" size="30" value="<?php echo htmlspecialchars($config->get('sessionserver', 'settings_game_server_status')); ?>" /> <= Ip Address
            <br>
            <input type="text" name="sessionserver_port" size="30" value="<?php echo htmlspecialchars($config->get('sessionserver_port', 'settings_game_server_status')); ?>" /> <= Port
        </td>
	</tr>
    
    <tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Cast Server</b>
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<input type="text" name="castserver" size="30" value="<?php echo htmlspecialchars($config->get('castserver', 'settings_game_server_status')); ?>" /> <= Ip Address
            <br>
            <input type="text" name="castserver_port" size="30" value="<?php echo htmlspecialchars($config->get('castserver_port', 'settings_game_server_status')); ?>" /> <= Port
        </td>
	</tr>

    <tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Messenger Server</b>
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<input type="text" name="messengerserver" size="30" value="<?php echo htmlspecialchars($config->get('messengerserver', 'settings_game_server_status')); ?>" /> <= Ip Address
            <br>
            <input type="text" name="messengerserver_port" size="30" value="<?php echo htmlspecialchars($config->get('messengerserver_port', 'settings_game_server_status')); ?>" /> <= Port
        </td>
	</tr>

    
    
    
    
    
    
    
    <tr>
    	<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Save Settings"></td>
    </tr>
</table>
</form>
<?php
}
?>