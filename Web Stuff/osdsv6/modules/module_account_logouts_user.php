<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
    <tr>
    	<td align="center" class="panel_title" colspan="5">Account Logout</td>
    </tr>
	<tr> 
        <td align="left" class="panel_title_sub2">Logout</td> 
        <td align="left" class="panel_title_sub2">Login</td> 
        <td align="left" class="panel_title_sub2">Ip Address</td>
        <td align="left" class="panel_title_sub2">User Id</td> 
        <td align="left" class="panel_title_sub2">Action</td> 
	</tr> 
<?php    
	flush_this();        	
	$result = $db->SQLquery("
	SELECT 
	  account.dbo.USER_CONNLOG_KEY.user_no,
	  account.dbo.USER_PROFILE.user_no,
	  account.dbo.USER_PROFILE.[user_id],
	  account.dbo.USER_CONNLOG_KEY.login_time,
	  account.dbo.USER_CONNLOG_KEY.logout_time,
	  account.dbo.USER_CONNLOG_KEY.conn_ip
	FROM
	  account.dbo.USER_CONNLOG_KEY
	  INNER JOIN account.dbo.USER_PROFILE ON (account.dbo.USER_CONNLOG_KEY.user_no = account.dbo.USER_PROFILE.user_no)	
	ORDER BY account.dbo.USER_CONNLOG_KEY.logout_time ASC");  
	
	$qnum1 = $db->SQLfetchNum($result);
	if ($qnum1 == '0')
	{
		echo '<tr><td align="center" class="panel_text_alt_list" colspan="5">No logouts found</td></tr>';
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
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['logout_time'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['login_time'])."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars(decodeIp($record['conn_ip']))."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['user_id'])."</td> 
					<td align='center' class='panel_text_alt_list'><a href='choose_action.php?userid=".htmlspecialchars($record['uid'])."&action=account'>Action</a></td>
				</tr>"; 
		}
	}
?>
</table>