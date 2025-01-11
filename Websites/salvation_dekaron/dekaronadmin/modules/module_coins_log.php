 
<?php    
$table = ""; 
$top = $config->get('top','settings_cash_log');
		
$result = $db->SQLquery("SELECT TOP ".$top." character_name,ip_address,item_index,intime,id,product FROM cash.dbo.user_use_log ORDER BY id DESC");  
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
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['character_name'])."</td> 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['ip_address'])."</td> 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['product'])." (".htmlspecialchars($record['item_index']).")</td> 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['intime'])."</td> 
			</tr>"; 
	}
}
$smarty->assign("TABLE", $table); 	
?>
