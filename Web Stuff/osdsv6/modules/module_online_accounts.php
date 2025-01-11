<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
    <tr>
    	<td align="center" class="panel_title" colspan="5">Online Accounts</td>
    </tr>
	<tr> 
        <td align="left" class="panel_title_sub2">Account</td> 
        <td align="left" class="panel_title_sub2">Character</td> 
        <td align="left" class="panel_title_sub2">Level</td>
        <td align="left" class="panel_title_sub2">Class</td> 
        <td align="left" class="panel_title_sub2">Map</td> 
	</tr> 
<?php    
	flush_this();        	
	$result = $db->SQLquery("select p.user_id as uid, c.character_name as cnm, c.wlevel as clvl, c.wmapindex cmapi, c.bypcclass as ccls, c.login_time FROM character.dbo.user_character c join account.dbo.user_profile p ON c.user_no = p.user_no WHERE c.login_time IN (SELECT max(login_time) FROM character.dbo.user_character GROUP BY user_no) AND p.login_flag = '1100' and c.login_time is not null order by c.wmapindex desc", "");  
	$qnum1 = $db->SQLfetchNum($result);
	if ($qnum1 == '0')
	{
		echo '<tr><td align="center" class="panel_text_alt_list" colspan="5">No online accounts found</td></tr>';
	}
	else
	{
		require_once ('engine/array_map.php');
		flush_this();
		$count = 0;
		while ($record = $db->SQLfetchArray($result)) 
		{ 
			$count++;
			$tr_color = ($count % 2) ? '' : 'even';
			
			echo "<tr class='" . $tr_color . "' > 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['uid'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['cnm'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['clvl'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars(_class($record['ccls']))."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($array_map[$record['cmapi']])."</td>
				</tr>"; 
		}
	}
?>
</table>