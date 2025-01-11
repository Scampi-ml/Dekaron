<form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="7">Edit Doing Quests</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">Quest Index</td> 
<td align="left" class="panel_title_sub2">Quest Count 0</td> 
<td align="left" class="panel_title_sub2">Quest Count 1</td>
<td align="left" class="panel_title_sub2">Quest Count 2</td> 
<td align="left" class="panel_title_sub2">Quest Count 3</td>
<td align="left" class="panel_title_sub2">Time</td>
<td align="left" class="panel_title_sub2">Action</td> 
</tr> 
{$TABLE}
<tr>
<td align="right" class="panel_buttons" colspan="7"><input type="submit" value="Delete Quest" onclick="ask_url('Are you sure you want to delete those quests?','index.php?get=module_edit_doing_quest&character={$character}')"></td>
</tr>
</table>
<input type="hidden" name="character" value="{$character}" >	
</form>