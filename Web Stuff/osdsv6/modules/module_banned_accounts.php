<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
    <tr>
    	<td align="center" class="panel_title" colspan="2">Banned Accounts</td>
    </tr>
	<tr> 
        <td align="left" class="panel_title_sub2">Account</td> 
        <td align="left" class="panel_title_sub2">Ip Address</td> 
	</tr> 
<?php    
	flush_this();     
	$top = $config->get('top','settings_banned_accounts');   	
	$result = $db->SQLquery("SELECT TOP ".$top." * FROM account.dbo.user_profile WHERE login_tag = 'N' ORDER BY user_id DESC");  
	$qnum1 = $db->SQLfetchNum($result);
	if ($qnum1 == '0')
	{
		echo '<tr><td align="center" class="panel_text_alt_list" colspan="2">No banned accounts found</td></tr>';
	}
	else
	{
		flush_this();
		$count = 0;
		while ($record = $db->SQLfetchArray($result)) 
		{ 
			$count++;
			$tr_color = ($count % 2) ? '' : 'even';
			
			echo "<tr class='" . $tr_color . "' > 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['user_id'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars(decodeIp($record['user_ip_addr']))."</td> 
				</tr>"; 
		}
	}
?>
</table>