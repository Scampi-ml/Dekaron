{if $POST == 1}{$MESSAGE}{else}
<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Edit Character Settings</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Use Reborn System?</b><br>If you have a reborn system you can set it to 'yes'<br>If you set this to 'yes', you must fill in <b>reborn_column</b></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="reborn_system">{$switch}</select></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Reborn Column</b><br>The reborn column name, found in Character Database -> user_character</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="reborn_column" size="30" value="{$reborn_column}" /></td>
	</tr> 
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Use A-Z & 0-9 check on character name?</b><br>If you want to disable the check on character names, set this to 'No'<br>This is usefull when you try to edit character with special characters in there name.<br>Ex. [Gm chars], [Dev chars]</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="az09_char_check">{$switch1}</select></td>
	</tr>
    <tr>
    	<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Save Settings"></td>
    </tr>
</table>
</form>
{/if}