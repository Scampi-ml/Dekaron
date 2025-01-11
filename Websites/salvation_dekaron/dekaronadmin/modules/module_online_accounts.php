<?php
$table = '';
$result = $db->SQLquery("select p.user_id as uid, c.character_name as cnm, c.wlevel as clvl, c.wmapindex cmapi, c.bypcclass as ccls, c.login_time, p.user_ip_addr as ip FROM character.dbo.user_character c join account.dbo.user_profile p  ON c.user_no = p.user_no WHERE c.login_time IN (SELECT max(login_time) FROM character.dbo.user_character GROUP BY user_no) AND p.login_flag = '1100' and c.login_time is not null order by c.wmapindex desc", "");  
$qnum1 = $db->SQLfetchNum($result);


$ipArray = array();

include ('engine/array_class.php');
include ('engine/array_map.php');


if ($qnum1 == '0')
{
	$table .= '<tr><td align="center" class="panel_text_alt_list" colspan="6">No online accounts found</td></tr>';
}
else
{

	//require_once ('engine/array_map.php');
	
	$count = 0;
	while ($record = $db->SQLfetchArray($result)) 
	{ 
	
		$table .= "</tr>";

		$count++;
		$tr_color = ($count % 2) ? '' : 'even';
		
		$table .= "<tr class='" . $tr_color . "' > 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['uid'])."</td> 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['cnm'])."</td> 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['clvl'])."</td> 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($array_map[$record['cmapi']])." (".$record['cmapi'].")</td>
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($array_class[$record['ccls']])."</td> 
				";
				
		if (in_array(decodeIp($record['ip']), $ipArray))
		{
			$table .= "<td align='left' class='panel_text_alt_list' style='color: red'>".htmlspecialchars(decodeIp($record['ip']))."</td>";
		}
		else
		{
			$table .= "<td align='left' class='panel_text_alt_list'>".htmlspecialchars(decodeIp($record['ip']))."</td>";
		}		
					
		$ipArray[] = decodeIp($record['ip']);
				
		$table .= "</tr>"; 
	}
	
}
$smarty->assign("TABLE", $table);
?>
