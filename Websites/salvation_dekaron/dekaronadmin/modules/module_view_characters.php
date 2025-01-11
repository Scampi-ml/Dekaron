<?php
$table = '';
$query1 = $db->SQLquery("SELECT user_id,user_no FROM account.dbo.user_profile WHERE user_no = '".$_GET['account']."'");
$qarray = $db->SQLfetchArray($query1);

$smarty->assign("user_id", $qarray['user_id']);

        	
$result = $db->SQLquery("SELECT character_name,character_no,user_no FROM character.dbo.user_character WHERE user_no = '".$_GET['account']."' ");  
$qnum1 = $db->SQLfetchNum($result);
if ($qnum1 == '0')
{
	$table .= '<tr><td align="center" class="panel_text_alt_list" colspan="5">No characters found</td></tr>';
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
				<td align='center' class='panel_text_alt_list' width='50'><a href='index.php?get=module_action&character=". htmlspecialchars($record['character_no'])."'>[Action]</a</td>					
			</tr>"; 
	}
}
$smarty->assign("TABLE", $table);
?>
