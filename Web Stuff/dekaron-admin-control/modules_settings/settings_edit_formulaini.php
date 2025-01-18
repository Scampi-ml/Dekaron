<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_formulaini' );
	}
	echo notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_edit_formulaini.php');
}
else
{
?>
<form method="post" action="">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Edit formula.ini</td>
	</tr>

	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>File location</b>
        	<br>Please enter the FULL path to your formula.ini
            <br>Leave blank it you dont want to use this
            <br><small>Ex. C:\dekaron\server\share\formula.ini</small>
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<input type="text" name="file" size="70" value="<?php echo htmlspecialchars($config->get('file', 'settings_formulaini')); ?>" />
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