<form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
<tr>
<td class="cat"><div align="left"><b>Please confirm</b></div></td>
</tr>
<tr>
<td align="center" style="padding-top: 20px; padding-bottom: 20px;">
<b>Are you sure you want to delete account "{$USERID}" ?</b>
<br>
<br>
{$TABLE}
<br><br>This action cannot be undone!
<br>
Deleting character(s) will also delete all of there info, quests, inventory, skills, ... ect
<br><br><br>
<input type="hidden" name="account" value="{$USERNO}" >
<input type="submit" value="Delete account" onclick="ask_url('Are you sure you want to delete this account?','index.php?get=module_delete_account')">
</td> 
</tr>
</table>	
</form>	