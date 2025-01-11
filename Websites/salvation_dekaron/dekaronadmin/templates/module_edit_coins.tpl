<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Edit Coins</td>
</tr>  
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Current Amount</b><br><small>Numbers Only</small></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="amount" size="30" maxlength="20" value="{$amount}" /></td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Current Free Amount</b><br><small>Numbers Only</small></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="free_amount" size="30" value="{$free_amount}"  /></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Update" onclick="ask_url('Are you sure you want to update?','index.php?get=module_edit_coins&account={$user_no}')"></td>
</tr>
</table>
<input type="hidden" name="account" value="{$user_no}" >
</form>