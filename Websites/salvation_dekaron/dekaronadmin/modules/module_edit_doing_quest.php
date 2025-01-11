<?php
if (isset($_POST) && !empty($_POST))
{
	if(isset($_POST['quest']) && !empty($_POST['quest']))
	{
		if(is_array($_POST['quest']))
		{
			foreach($_POST['quest'] as $quest)
			{
				$SQLquery3 = $db->SQLquery("DELETE FROM character.dbo.User_Quest_Doing WHERE character_no = '%s' AND q_index = '%s' ", $_POST['character'], $quest);
			}
		}
	}
	$POST = notice_message_admin('Doing quests successfully deleted', '1', '0', 'index.php?get=module_edit_doing_quest&character='.$_POST['character'].'');
}
else
{
	
	$SQLquery1 = $db->SQLquery("SELECT * FROM character.dbo.User_Quest_Doing WHERE character_no = '%s'", $_GET['character']);
	$qnum1 = $db->SQLfetchNum($SQLquery1);
	$smarty->assign("character", $_GET['character']); 

	$table = '';
	if ($qnum1 == '0')
	{
		$table .= '<tr><td align="center" class="panel_text_alt_list" colspan="7">No quests found</td></tr>';
	}
	else
	{
		
		$count = 0;
		while ($record = $db->SQLfetchArray($SQLquery1)) 
		{ 
			$count++;
			$tr_color = ($count % 2) ? '' : 'even';
			
			$table .= "<tr class='" . $tr_color . "' > 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['q_index'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['q_count_0'])."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['q_count_1'])."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['q_count_2'])."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['q_count_3'])."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['upt_time'])."</td>
					<td align='center' class='panel_text_alt_list'><input type='checkbox' name='quest[]' value='".htmlspecialchars($record['q_index'])."'></td>
				</tr>"; 
		}
	}
	$smarty->assign("TABLE", $table); 

}
?>