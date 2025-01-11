
<?php    
	$table = "";  
	$top = $config->get('top','settings_deleted_characters');      	
	$result = $db->SQLquery("SELECT TOP ".$top." character_name,del_time FROM character.dbo.user_character_secede ORDER BY del_time ASC");  
	$qnum1 = $db->SQLfetchNum($result);
	if ($qnum1 == '0')
	{
		$table .= '<tr><td align="center" class="panel_text_alt_list" colspan="2">No deleted characters found</td></tr>';
	}
	else
	{
		
		$count = 0;
		while ($record = $db->SQLfetchArray($result)) 
		{ 
			$count++;
			$tr_color = ($count % 2) ? '' : 'even';
			
			$table .= "<tr class='" . $tr_color . "' > 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['character_name'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['del_time'])."</td> 
				</tr>"; 
		}
	}
	$smarty->assign("TABLE", $table); 
?>
