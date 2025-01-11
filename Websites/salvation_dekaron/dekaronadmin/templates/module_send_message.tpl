<form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Send Message</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>To</b><br>The character to send the message to</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">{$character_name}</td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>From</b><br>Enter your name, or a system name<br><small>0-9 A-Z Only</small></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="from_char_nm" size="30" maxlength="30" value="{$from_name}" /></td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Message Title</b><br>Keep it short</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="post_title" size="30" maxlength="30" value="" /></td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Message Text</b><br>Enter your message here</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><textarea cols="60" rows="3"  name="body_text"></textarea></td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Add Dil</b><br>If you want to add some dil to the message<br><small>Numbers only</small></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="include_dil" size="30" value=""  /></td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Add Item</b><br>If you want to add an item to the message<br><small>Numbers only</small></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="item" size="30" value=""  /></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Send Message" onclick="ask_url('Are you sure you want to send the message?','index.php?get=module_send_message&character={$character_no}')"></td>
</tr>
</table>
<input type="hidden" name="character" value="{$character_no}">
</form>
