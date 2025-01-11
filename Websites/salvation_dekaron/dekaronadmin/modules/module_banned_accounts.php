<?php    
$table = "";         
$top = $config->get('top','settings_banned_accounts');   


	
	$result = $db->SQLquery("SELECT TOP ".$top."
  account.dbo.USER_PROFILE.[user_id],
  account.dbo.USER_DATA.banned_reason,
  account.dbo.USER_DATA.banned_by,
  account.dbo.USER_DATA.banned_date,
  account.dbo.USER_PROFILE.user_ip_addr,
  account.dbo.USER_PROFILE.login_tag
FROM
  account.dbo.USER_PROFILE
  INNER JOIN account.dbo.USER_DATA ON (account.dbo.USER_PROFILE.user_no = account.dbo.USER_DATA.user_no)
WHERE
  (account.dbo.USER_PROFILE.login_tag = 'N')
GROUP BY
  account.dbo.USER_PROFILE.[user_id],
  account.dbo.USER_DATA.banned_reason,
  account.dbo.USER_DATA.banned_by,
  account.dbo.USER_DATA.banned_date,
  account.dbo.USER_PROFILE.user_ip_addr,
  account.dbo.USER_PROFILE.login_tag
ORDER BY
  account.dbo.USER_DATA.banned_date DESC"); 
  
  
$qnum1 = $db->SQLfetchNum($result);
if ($qnum1 == '0')
{
	$table .= '<tr><td align="center" class="panel_text_alt_list" colspan="2">No banned accounts found</td></tr>';
}
else
{
	$count = 0;
	while ($record = $db->SQLfetchArray($result)) 
	{ 
		$count++;
		$tr_color = ($count % 2) ? '' : 'even';
		
		$table .= "<tr class='" . $tr_color . "' > 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['user_id'])."</td> 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars(decodeIp($record['user_ip_addr']))."</td> 
				
				
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['banned_reason'])."</td>
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['banned_by'])."</td>
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars(date(DATE_RFC822, $record['banned_date']))."</td>				
			</tr>"; 
	}
}
$smarty->assign("TABLE", $table); 	
?>