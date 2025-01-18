<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_edit_character' );
	}
	echo notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_edit_character.php');
}
else
{
?>
<form method="post" action="">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Edit Character Settings</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Use Reborn System?</b>
        	<br>If you have a reborn system you can set it to 'yes'
            <br>If you set this to 'yes', you must fill in <b>reborn_column</b>
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="reborn_system">
			<?php 
                switch ($config->get('reborn_system', 'settings_edit_character'))
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
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Reborn Column</b>
        	<br>The reborn column name, found in Character Database -> user_character
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<input type="text" name="reborn_column" size="30" value="<?php echo htmlspecialchars($config->get('reborn_column', 'settings_edit_character')); ?>" />
        </td>
	</tr> 
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Use A-Z & 0-9 check on character name?</b>
        	<br>If you want to disable the check on character names, set this to 'No'
            <br>This is usefull when you try to edit character with special characters in there name.
            <br>Ex. [Gm chars], [Dev chars]
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="az09_char_check">
			<?php 
                switch ($config->get('az09_char_check', 'settings_edit_character'))
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