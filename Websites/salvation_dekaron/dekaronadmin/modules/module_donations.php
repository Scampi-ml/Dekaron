<?php    
$table = ""; 

		
$result = $db->SQLquery("SELECT * FROM game.dbo.donations WHERE user_no = '".$_GET['account']."' ORDER BY id DESC");  
$qnum1 = $db->SQLfetchNum($result);
if ($qnum1 == '0')
{
	$table .= '<tr><td align="center" class="panel_text_alt_list" colspan="4">No logs found</td></tr>';
}
else
{
	
	$count = 0;
	while ($record = $db->SQLfetchArray($result)) 
	{ 
		$count++;
		$tr_color = ($count % 2) ? '' : 'even';
		
		$table .= "<tr class='" . $tr_color . "' > 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['serial'])."</td> 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['type'])."</td> 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['amount'])."</td> 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['intime'])."</td> 

			</tr>"; 
	}
}
$smarty->assign("TABLE", $table); 	
?>
