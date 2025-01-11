<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_edit_guild_permissions_names' );
	}
	echo notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_edit_guild_permissions_names.php');
}
else
{
?>
<form method="post" action="">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Edit Guild Permissions Names</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Show default names?</b>
        	<br>Show the default names for guild permission name?
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="show_default">
			<?php 
                switch ($config->get('show_default', 'settings_edit_guild_permissions_names'))
				{
                    case '1':
                        echo '<option value="0">No</option><option value="1" selected>Yes</option>';
                        break;
                    case '0':
                        echo '<option value="0" selected>No</option><option value="1">Yes</option>';
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