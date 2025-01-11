<?php
if (isset($_POST) && !empty($_POST))
{
	if(isset($_POST['skill']) && !empty($_POST['skill']))
	{
		if(is_array($_POST['skill']))
		{
			foreach($_POST['skill'] as $skill)
			{
				$SQLquery3 = $db->SQLquery("DELETE FROM character.dbo.user_skill WHERE character_no = '%s' AND line_no = '%s' ", $_POST['character'], $skill );
			}
		}
	}
	$POST = notice_message_admin('Skill successfully deleted', '1', '0', 'index.php?get=module_edit_skills&character='.$_POST['character'].'');
}
else
{
	$table = '';
	
	$SQLquery1 = $db->SQLquery("SELECT * FROM character.dbo.user_skill WHERE character_no = '%s'", $_GET['character']);
	$qnum1 = $db->SQLfetchNum($SQLquery1);
	
	$smarty->assign("character", $_GET['character']);

	if ($qnum1 == '0')
	{
		$table .= '<tr><td align="center" class="panel_text_alt_list" colspan="5">No skills found</td></tr>';
	}
	else
	{
		
		$count = 0;
		while ($record = $db->SQLfetchArray($SQLquery1)) 
		{ 
			$count++;
			$tr_color = ($count % 2) ? '' : 'even';
			
			$table .= "<tr class='" . $tr_color . "' > 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['line_no'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars(bin2hex($record['info']))."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['ipt_time'])."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['upt_time'])."</td>
					<td align='center' class='panel_text_alt_list'><input type='checkbox' name='skill[]' value='".htmlspecialchars($record['line_no'])."'></td>
				</tr>"; 
		}
	}
	$smarty->assign("TABLE", $table);
}
?>