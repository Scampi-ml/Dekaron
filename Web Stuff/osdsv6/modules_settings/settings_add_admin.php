<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_add_admin' );
	}
	echo notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_add_admin.php');
}
else
{
?>
<form method="post" action="">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Add Admin Settings</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Type of form input</b>
        	<br>You can use this settings to display the password in plain text (Text),
            <br>or hide the password while typing (Password)
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="form_type">
			<?php 
			switch ($config->get('form_type', 'settings_add_admin'))
				{
                    case 'text':
                        echo '<option value="password">Password</option><option value="text" selected>Text</option>';
                        break;
                    case 'password':
                        echo '<option value="password" selected>Password</option><option value="text">Text</option>';
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