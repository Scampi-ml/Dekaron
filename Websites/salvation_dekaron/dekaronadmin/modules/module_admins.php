<?php
$table = "";
$SQLquery1 = $db->SQLquery("SELECT * FROM master.dbo.sysxlogins");
$qnum1 = $db->SQLfetchNum($SQLquery1);

if ($qnum1 == '0')
{
	$table .= '<tr><td align="center" class="panel_text_alt_list" colspan="5">No admins found ???</td></tr>';
}
else
{
	$count = 0;
	while ($record = $db->SQLfetchArray($SQLquery1)) 
	{ 
		$count++;
		$tr_color = ($count % 2) ? '' : 'even';
		
		if($record['xstatus'] == '192')
		{
			continue;
		}
	$table .= "<tr class='" . $tr_color . "' > 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['name'])."</td> 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['xdate1'])."</td>
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['xstatus'])."</td>
		";		
		$table .= "</tr>"; 
	}
}
$smarty->assign("TABLE", $table); 
?>