<form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="10">Edit Postbox</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">From</td> 
<td align="left" class="panel_title_sub2">To</td>
<td align="left" class="panel_title_sub2">Title</td>
<td align="left" class="panel_title_sub2">Text</td>
<td align="left" class="panel_title_sub2">Item</td> 
<td align="left" class="panel_title_sub2">Dil</td> 
<td align="left" class="panel_title_sub2">Date</td> 
<td align="left" class="panel_title_sub2">State</td> 
<td align="left" class="panel_title_sub2">Expire</td> 
<td align="left" class="panel_title_sub2">Action</td> 
</tr> 
{$TABLE}
<tr>
<td align="right" class="panel_buttons" colspan="10"><input type="submit" value="Delete Post" onclick="ask_url('Are you sure you want to delete those posts?','index.php?get=module_edit_postbox&character={$character}')"></td>
</tr>
</table>
<input type="hidden" name="character" value="{$character}" >	
</form>	    