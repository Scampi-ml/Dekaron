<?php
if (isset($_POST) && !empty($_POST))
{
	$file2 = @fopen($config->get('file', 'settings_versionini'), 'w');
	@fwrite($file2, $_POST['version']);
	@fclose($file2);	
	echo notice_message_admin('Version.ini successfully saved', '1', '0', 'index.php?get=module_edit_versionini');
}
else
{
?>
<form action="" method="post">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Edit Version.ini</td>
	</tr>
	<tr>
		<td align="left" class="panel_text_alt1" width="45%" valign="top"><b>Version</b><br>
        This can damage your server if you enter wrong data!
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        <?php
		$file = $config->get('file', 'settings_versionini');
		if(!file_exists($file))
		{
			$value = '';
			$disabled = 'DISABLED';
			$note = '<p class="msg_error">Your location to your version.ini is not set, please click <a href="index.php?get=module_settings&php=settings_edit_versionini.php">here</a> to set your path.</p>';
		}
		else
		{
			$value = file_get_contents($file);
			$disabled = '';
			$note = '';
		}
		?>
        <input type="text" name="version" <?php echo $disabled; ?> size="30" value="<?php echo $value; ?>" />
        <?php echo $note; ?>
        </td>
	</tr>
	<tr>
		<td align="left" class="panel_text_alt1" width="45%" valign="top"><input type="submit" value="Save version" onclick="ask_url('Save?','index.php?get=module_edit_versionini')"></td>
	</tr>
</table>
</form>	
<?php
}
?>