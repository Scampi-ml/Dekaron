<form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="5">Edit Skillbar</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">Line No</td> 
<td align="left" class="panel_title_sub2">Info</td>
<td align="left" class="panel_title_sub2">Ipt Time</td> 
<td align="left" class="panel_title_sub2">Upt Time</td> 
<td align="left" class="panel_title_sub2">Action</td> 
</tr>
{$TABLE}
<tr>
<td align="right" class="panel_buttons" colspan="5"><input type="submit" value="Delete Skillbar Item" onclick="ask_url('Are you sure you want to delete those items?','index.php?get=module_edit_skillbar&character={$character}')"></td>
</tr>
</table>
<input type="hidden" name="character" value="{$character}" >	
</form>	    