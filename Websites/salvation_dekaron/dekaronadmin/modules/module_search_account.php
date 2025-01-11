<?php
$smarty->assign("TOP", $config->get('top', 'settings_search_account'));
$table = '';
if (isset($_POST['search']))
{
	if (!empty($_POST['user']))
	{
        $table .= '
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
        <tr>
          <td align="center" class="panel_title" colspan="5">Search Results</td>
        </tr>
        <tr>
          <td align="left" class="panel_title_sub2">User ID</td>
          <td align="center" class="panel_title_sub2" width="50">Action</td>
        </tr>';
			$userid = $_POST['user'];
			$type = $_POST['type'];
			
			
			$top = $config->get('top', 'settings_search_account');
			
			if($type == 'user_id')
			{
				$query1 = $db->SQLquery("SELECT TOP ".$top." user_id,user_no FROM account.dbo.user_profile WHERE user_id LIKE '%".$userid."%' ORDER BY user_id ASC");
			}
			elseif($type == 'user_no')
			{
				$query1 = $db->SQLquery("SELECT TOP ".$top." user_id,user_no FROM account.dbo.user_profile WHERE user_no = '".$userid."' ORDER BY user_id ASC");
			}
			elseif($type == 'user_ip_addr')
			{
				$query1 = $db->SQLquery("SELECT TOP ".$top." user_id,user_no,user_ip_addr FROM account.dbo.user_profile WHERE user_ip_addr = account.dbo.FN_IpStrToBin('".$userid."') ORDER BY user_id ASC");
			}
			else
			{
				// nothing
			}
			
			$qnum1 = $db->SQLfetchNum($query1);
			
			if ($qnum1 == '0')
			{
				$table .= '<tr><td align="center" class="panel_text_alt_list" colspan="5">No Accounts Found</td></tr>';
			}
			else
			{
				
				$count = 0;
				while ($qarray = $db->SQLfetchArray($query1))
				{
					$count++;
					$tr_color = ($count % 2) ? '' : 'even';
					$table .= '<tr class="' . $tr_color . '">
							<td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars($qarray['user_id']) . '</strong></td>
							<td align="center" class="panel_text_alt_list" width="50"><a href="index.php?get=module_action&account=' . htmlspecialchars($qarray['user_no']) . '">[Action]</a</td>
						</tr>';
				}
			}

		$table .= '</table>';
		
	}
}
$smarty->assign("TABLE", $table);
?>