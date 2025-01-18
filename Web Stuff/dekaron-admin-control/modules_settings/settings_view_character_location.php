<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_cash_log' );
	}
	echo notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_view_character_location.php');
}
else
{
?>
<form method="post" action="">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">View Character Location Settings</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Pointer</b>
        	<br>The color of the pointer, X is recommended
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="pointer">
			<?php 
                switch ($config->get('pointer', 'settings_view_character_location'))
				{
                    case 'X':
                        echo '
						<option value="X" selected>X</option>
						<option value="0">0</option>
						<option value="°">°</option>
						<option value="o">o</option>
						<option value="*">*</option>
						';
                        break;
                    case '0':
                        echo '
						<option value="X">X</option>
						<option value="0" selected>0</option>
						<option value="°">°</option>
						<option value="o">o</option>
						<option value="*">*</option>
						';
						break;
                    case 'o':
                        echo '
						<option value="X">X</option>
						<option value="0">0</option>
						<option value="°" selected>°</option>
						<option value="o">o</option>
						<option value="*">*</option>
						';
						break;
                    case '°':
                        echo '
						<option value="X" >X</option>
						<option value="0">0</option>
						<option value="°">°</option>
						<option value="o" selected>o</option>
						<option value="*">*</option>
						';
						break;
                    case '*':
                        echo '
						<option value="X" >X</option>
						<option value="0">0</option>
						<option value="°>°</option>
						<option value="o">o</option>
						<option value="*" selected>*</option>
						';
                        break;
                }
			?>
            </select>
        </td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Color</b>
        	<br>The color of the pointer
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="color">
			<?php 
                switch ($config->get('color', 'settings_view_character_location'))
				{
                    case 'WHITE':
                        echo '
						<option value="WHITE" selected>WHITE</option>
						<option value="YELLOW">YELLOW</option>
						<option value="RED">RED</option>
						<option value="BLUE">BLUE</option>
						<option value="GREEN">GREEN</option>
						';
                        break;
                    case 'YELLOW':
                        echo '
						<option value="WHITE">WHITE</option>
						<option value="YELLOW" selected>YELLOW</option>
						<option value="RED">RED</option>
						<option value="BLUE">BLUE</option>
						<option value="GREEN">GREEN</option>
						';
						break;
                    case 'RED':
                        echo '
						<option value="WHITE">WHITE</option>
						<option value="YELLOW">YELLOW</option>
						<option value="RED" selected>RED</option>
						<option value="BLUE">BLUE</option>
						<option value="GREEN">GREEN</option>
						';
						break;
                    case 'BLUE':
                        echo '
						<option value="WHITE">WHITE</option>
						<option value="YELLOW">YELLOW</option>
						<option value="RED">RED</option>
						<option value="BLUE" selected>BLUE</option>
						<option value="GREEN">GREEN</option>
						';
						break;
                    case 'GREEN':
                        echo '
						<option value="WHITE">WHITE</option>
						<option value="YELLOW">YELLOW</option>
						<option value="RED">RED</option>
						<option value="BLUE">BLUE</option>
						<option value="GREEN" selected>GREEN</option>
						';
                        break;
                }
			?>
            </select>
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