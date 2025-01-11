<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_view_mails' );
	}
	echo notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_view_mails.php');
}
else
{
?>
<form method="post" action="">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">View Mails Settings</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Results</b>
        	<br>The amount of results to be displayed, 100 is recommended
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<input type="text" name="top" size="30" value="<?php echo htmlspecialchars($config->get('top', 'settings_view_mails')); ?>" />
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