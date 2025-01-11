<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_dac_settings' );
	}
	echo notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_dac_settings.php');
}
else
{
?>
<form method="post" action="">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">DAC Settings</td>
	</tr>
    <tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Style</b>
        <br>Lets you change the colors and style of the ACP
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="style">
			<?php 
				$directory = opendir('style');
				while ($stylefile = readdir($directory))
				{
					if (
					$stylefile != "." && 
					$stylefile != ".." && 
					$stylefile != 'error.css' && 
					$stylefile != 'login.css' &&
					$stylefile != 'index.html'
					)
					{
						if ($config->get('style', 'settings_dac_settings') == $stylefile)
						{
							echo '<option value="' . $stylefile . '" selected="selected">' . $stylefile . '</option>';
						}
						else
						{
							echo '<option value="' . $stylefile . '">' . $stylefile . '</option>';
						}
					}
				}
			?>
            </select>
        </td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Redirect message speed</b>
        	<br>The speed (in seconds) to display messages
            <br>This does not apply on errors or error messages
            <br>Default & recommended: 1
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="msg_redirect">
			<?php 
                switch ($config->get('msg_redirect', 'settings_dac_settings'))
				{
                    case '0':
                        echo '<option value="0" selected>0 Seconds (No Message)</option>
							  <option value="1">1 Second</option>
							  <option value="1">2 Seconds</option>
							  <option value="1">3 Seconds</option>
							  <option value="1">4 Seconds</option>
							  <option value="1">5 Seconds</option>
							  ';
                        break;
                    case '1':
                        echo '<option value="0">0 Seconds (No Message)</option>
							  <option value="1" selected>1 Second</option>
							  <option value="2">2 Seconds</option>
							  <option value="3">3 Seconds</option>
							  <option value="4">4 Seconds</option>
							  <option value="5">5 Seconds</option>
							  ';
                        break;
                    case '2':
                        echo '<option value="0">0 Seconds (No Message)</option>
							  <option value="1">1 Second</option>
							  <option value="2" selected>2 Seconds</option>
							  <option value="3">3 Seconds</option>
							  <option value="4">4 Seconds</option>
							  <option value="5">5 Seconds</option>
							  ';
                        break;
                    case '3':
                        echo '<option value="0">0 Seconds (No Message)</option>
							  <option value="1">1 Second</option>
							  <option value="2">2 Seconds</option>
							  <option value="3" selected>3 Seconds</option>
							  <option value="4">4 Seconds</option>
							  <option value="5">5 Seconds</option>
							  ';
                        break;
                    case '4':
                        echo '<option value="0">0 Seconds (No Message)</option>
							  <option value="1">1 Second</option>
							  <option value="2">2 Seconds</option>
							  <option value="3">3 Seconds</option>
							  <option value="4" selected>4 Seconds</option>
							  <option value="5">5 Seconds</option>
							  ';
                        break;
                    case '5':
                        echo '<option value="0">0 Seconds (No Message)</option>
							  <option value="1">1 Second</option>
							  <option value="2">2 Seconds</option>
							  <option value="3">3 Seconds</option>
							  <option value="4">4 Seconds</option>
							  <option value="5" selected>5 Seconds</option>
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