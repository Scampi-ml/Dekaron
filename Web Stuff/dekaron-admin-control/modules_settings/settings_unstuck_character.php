<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_unstuck_character' );
	}
	echo notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_unstuck_character.php');
}
else
{
?>
<form method="post" action="">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Unstuck Character Settings</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Unstuck Map Number</b>
        	<br>The map where you cant to move the character to when using unstuck
            <br>the character will be moved to this map
            <br>Map Number (id) only ! 
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<input type="text" name="map" size="30" value="<?php echo htmlspecialchars($config->get('map', 'settings_unstuck_character')); ?>" />
        </td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Unstuck Pos X</b>
        	<br>The pos X where you cant to move the character to when using unstuck
            <br>the character will be moved to this location
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<input type="text" name="wposx" size="30" value="<?php echo htmlspecialchars($config->get('wposx', 'settings_unstuck_character')); ?>" />
        </td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Unstuck Pos Y</b>
        	<br>The pos Y where you cant to move the character to when using unstuck
            <br>the character will be moved to this location
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<input type="text" name="wposy" size="30" value="<?php echo htmlspecialchars($config->get('wposy', 'settings_unstuck_character')); ?>" />
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