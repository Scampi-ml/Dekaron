<form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
<tr>
<td class="cat"><div align="left"><b>Please confirm</b></div></td>
</tr>
<tr>
<td align="center" style="padding-top: 20px; padding-bottom: 20px;">
<b>Are you sure you want to delete guild "{$guild_name}" ?</b>
<br><br>This action cannot be undone!
<br>All characters will be kicked from the guild
<br><br><br><br>
<input type="hidden" name="guild_code" value="{$guild_code}" >
<input type="submit" value="Delete Guild" onclick="ask_url('Are you sure you want to delete this guild?','index.php?get=module_delete_guild')">
</td> 
</tr>
</table>	
</form>	