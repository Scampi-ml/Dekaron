<form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="{$colspan}">Edit Guild Permissions Names</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">Guild permission level</td> 
<td align="left" class="panel_title_sub2">Guild permission name</td>
{$td}
</tr> 
{$TABLE}
<tr>
<td align="right" class="panel_buttons" colspan="{$colspan}"><input type="submit" value="Update" onclick="ask_url('Are you sure you want to update?','index.php?get=module_edit_guild_permissions_names&guild={$guild}')"></td>
</tr>
</table>
</form> 