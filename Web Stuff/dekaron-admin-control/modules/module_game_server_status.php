<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
    <tr>
		<td align="center" class="panel_title" colspan="2">Game Server Status</td>
	</tr>
    <tr class="even">
        <td width="50%" align="left" class="panel_text_alt_list">Dekaron Server</td>
      	<td align="left" class="panel_text_alt_list" width="50%">
	  	<?php
		fsockopen(trim($config->get('dekaronserver', 'settings_game_server_status')), trim($config->get('dekaronserver_port', 'settings_game_server_status')), $errno, $errstr, trim($config->get('timeout', 'settings_game_server_status')));
		if($errno === 0)
		{
			echo '<b><font color="#00FF00">Online</font></b>';
		}
		else
		{
			echo '<b><font color="#FF0000">Offline</font></b>';
		}
		unset($errno);
		unset($errstr);
		?>
     	</td>
    </tr>
    <tr >
        <td width="50%" align="left" class="panel_text_alt_list">Login Server</td>
      	<td align="left" class="panel_text_alt_list" width="50%">
	  	<?php
		fsockopen(trim($config->get('loginserver', 'settings_game_server_status')), trim($config->get('loginserver_port', 'settings_game_server_status')), $errno, $errstr, trim($config->get('timeout', 'settings_game_server_status')));
		if($errno === 0)
		{
			echo '<b><font color="#00FF00">Online</font></b>';
		}
		else
		{
			echo '<b><font color="#FF0000">Offline</font></b>';
		}
		unset($errno);
		unset($errstr);
		?>
     	</td>
    </tr>
    <tr class="even">
        <td width="50%" align="left" class="panel_text_alt_list">Session Server</td>
      	<td align="left" class="panel_text_alt_list" width="50%">
	  	<?php
		fsockopen(trim($config->get('sessionserver', 'settings_game_server_status')), trim($config->get('sessionserver_port', 'settings_game_server_status')), $errno, $errstr, trim($config->get('timeout', 'settings_game_server_status')));
		if($errno === 0)
		{
			echo '<b><font color="#00FF00">Online</font></b>';
		}
		else
		{
			echo '<b><font color="#FF0000">Offline</font></b>';
		}
		unset($errno);
		unset($errstr);
		?>
     	</td>
    </tr>
    
    <tr>
        <td width="50%" align="left" class="panel_text_alt_list">Cast Server</td>
      	<td align="left" class="panel_text_alt_list" width="50%">
	  	<?php
		fsockopen(trim($config->get('castserver', 'settings_game_server_status')), trim($config->get('castserver_port', 'settings_game_server_status')), $errno, $errstr, trim($config->get('timeout', 'settings_game_server_status')));
		if($errno === 0)
		{
			echo '<b><font color="#00FF00">Online</font></b>';
		}
		else
		{
			echo '<b><font color="#FF0000">Offline</font></b>';
		}
		unset($errno);
		unset($errstr);
		?>
     	</td>
    </tr> 
    <tr class="even">
        <td width="50%" align="left" class="panel_text_alt_list">Messenger Server</td>
      	<td align="left" class="panel_text_alt_list" width="50%">
	  	<?php
		fsockopen(trim($config->get('messengerserver', 'settings_game_server_status')), trim($config->get('messengerserver_port', 'settings_game_server_status')), $errno, $errstr, trim($config->get('timeout', 'settings_game_server_status')));
		if($errno === 0)
		{
			echo '<b><font color="#00FF00">Online</font></b>';
		}
		else
		{
			echo '<b><font color="#FF0000">Offline</font></b>';
		}
		unset($errno);
		unset($errstr);
		?>
     	</td>
    </tr>           
    <tr>
    	<td align="right" class="panel_buttons" colspan="2"><input type="button" value="Refresh" onclick="ask_url('Are you sure?','index.php?get=module_game_server_status')"></td>
    </tr>
</table>
