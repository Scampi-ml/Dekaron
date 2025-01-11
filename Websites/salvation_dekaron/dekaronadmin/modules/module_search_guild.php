<?php
$smarty->assign("TOP", $config->get('top', 'settings_search_guild'));
$table = '';
if (isset($_POST['search']))
{
	if (!empty($_POST['user']))
	{
		$guild_name = safe_input($_POST['user'], '');
		$table .= '
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
        <tr>
          <td align="center" class="panel_title" colspan="5">Search Results</td>
        </tr>
        <tr>
          <td align="left" class="panel_title_sub2">Guild Name</td>
          <td align="center" class="panel_title_sub2" width="100">Controls</td>
        </tr>';

			$top = $config->get('top', 'settings_search_guild');
			$query1 = $db->SQLquery("SELECT TOP ".$top." guild_code,guild_name,guild_Level FROM character.dbo.guild_info WHERE guild_name LIKE '%" . $guild_name . "%' ORDER BY guild_name ASC");
			$qnum1 = $db->SQLfetchNum($query1);
			
			if ($qnum1 == '0')
			{
				$table .= '<tr><td align="center" class="panel_text_alt_list" colspan="5">No Guilds Found</td></tr>';
			}
			else
			{
				
				$count = 0;
				while ($qarray = $db->SQLfetchArray($query1))
				{
					if($config->get('mastercode', 'settings_search_guild') == 0)
					{
						preg_match('/^MASTERCODE/', $qarray['guild_name'], $matches, PREG_OFFSET_CAPTURE);
						if( $matches ) 
						{
							continue;
						}
					}	
			
					$count++;
					$tr_color = ($count % 2) ? '' : 'even';
					$table .= '<tr class="' . $tr_color . '">
							<td align="left" class="panel_text_alt_list"><strong>' . htmlspecialchars($qarray['guild_name']) . '</strong></td>
							<td align="center" class="panel_text_alt_list" width="50"><a href="index.php?get=module_action&guild=' . htmlspecialchars($qarray['guild_code']) . '">[Action]</a</td>
						</tr>';
				}
			}
		$table .= '</table>';
	}
	
}
$smarty->assign("TABLE", $table);
?>