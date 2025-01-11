<form action="" name="form_edit" method="POST">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Search Account</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Search for ...</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Enter the "User ID" or "User No" or "User Ip Addr" of account which you want to find
<br> Results are limited to the first {$TOP} results    
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="user"> => input type => <select name="type"><option value="user_id">user_id</option><option value="user_no">user_no</option><option value="user_ip_addr">user_ip_addr</option></select></td>
</tr>    
<tr>
<td align="right" class="panel_buttons" colspan="2">
<input type="hidden" name="search">
<input type="submit" value="Search">
</td>
</tr>
</table>
</form>
{$TABLE}