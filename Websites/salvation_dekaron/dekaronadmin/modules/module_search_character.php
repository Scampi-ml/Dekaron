<?php

$smarty->assign("TOP", $config->get('top', 'settings_search_character'));
$table = '';
if (isset($_POST['search']))
{
	if (!empty($_POST['user']))
	{
		$character_name = $_POST['user'];
		$type = $_POST['type'];
		$table .= '
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
        <tr>
          <td align="center" class="panel_title" colspan="5">Search Results</td>
        </tr>
        <tr>
          <td align="left" class="panel_title_sub2">Character Name</td>
          <td align="left" class="panel_title_sub2">User Name</td>
          <td align="center" class="panel_title_sub2" width="100">Controls</td>
        </tr>';

			
			$top = $config->get('top','settings_search_character');
			
			if($type == 'character_name')
			{
				$query1 = $db->SQLquery("SELECT TOP ".$top." character_name,character_no,user_no FROM character.dbo.user_character WHERE character_name LIKE '%".$character_name."%' ORDER BY character_name ASC");
			}
			elseif($type == 'character_no')
			{
				$query1 = $db->SQLquery("SELECT TOP ".$top." character_name,character_no,user_no FROM character.dbo.user_character WHERE character_no = '".$character_name."' ORDER BY character_name ASC");
			}
			elseif($type = 'user_ip_addr')
			{
				$query1 = $db->SQLquery("SELECT TOP ".$top." character_name,character_no,user_no,user_ip_addr FROM character.dbo.user_character WHERE user_ip_addr = account.dbo.FN_IpStrToBin'".$character_name."' ORDER BY character_name ASC");
			}
			else
			{
				// do nothing
			}
			
			
			
			
			$qnum1 = $db->SQLfetchNum($query1);
			
			if ($qnum1 == '0')
			{
				$table .= '<tr><td align="center" class="panel_text_alt_list" colspan="5">No Characters Found</td></tr>';
			}
			else
			{
				
				$count = 0;
				while ($qarray = $db->SQLfetchArray($query1))
				{
					if($config->get('showdekaron','settings_search_character') == '0')
					{
						preg_match('/^19999999999991/', $qarray['character_no'], $matches, PREG_OFFSET_CAPTURE);
						if( $matches ) 
						{
							continue;
						}	
					}
							
					$query2 = $db->SQLquery("SELECT user_id,user_no FROM account.dbo.user_profile WHERE user_no = '".$qarray['user_no']."'");
					$qarray2 = $db->SQLfetchArray($query2);		
								
					$count++;
					$tr_color = ($count % 2) ? '' : 'even';
					$table .= '<tr class="' . $tr_color . '">
							<td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars($qarray['character_name']) . '</strong></td>
							<td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars($qarray2['user_id']) . '</strong></td>
							<td align="center" class="panel_text_alt_list" width="50"><a href="index.php?get=module_action&character='. htmlspecialchars($qarray['character_no']).'&acc='.htmlspecialchars($qarray['user_no']).'">[Action]</a</td>
						</tr>';
				}
			}
		
		$table .= '</table>';
	}
	
}
$smarty->assign("TABLE", $table);
?>