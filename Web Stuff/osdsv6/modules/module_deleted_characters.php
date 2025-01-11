<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
    <tr>
    	<td align="center" class="panel_title" colspan="2">Deleted Characters</td>
    </tr>
	<tr> 
        <td align="left" class="panel_title_sub2">Character</td> 
        <td align="left" class="panel_title_sub2">Delete Date</td>
	</tr> 
<?php    
	flush_this();  
	$top = $config->get('top','settings_deleted_characters');      	
	$result = $db->SQLquery("SELECT TOP ".$top." character_name,del_time FROM character.dbo.user_character_secede ORDER BY del_time ASC");  
	$qnum1 = $db->SQLfetchNum($result);
	if ($qnum1 == '0')
	{
		echo '<tr><td align="center" class="panel_text_alt_list" colspan="2">No deleted characters found</td></tr>';
	}
	else
	{
		flush_this();
		$count = 0;
		while ($record = $db->SQLfetchArray($result)) 
		{ 
			$count++;
			$tr_color = ($count % 2) ? '' : 'even';
			
			echo "<tr class='" . $tr_color . "' > 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['character_name'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['del_time'])."</td> 
				</tr>"; 
		}
	}
?>
</table>