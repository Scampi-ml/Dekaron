<?php    
$table = "";
$result = $db->SQLquery("

SELECT TOP 100 
  character.dbo.GUILD_CHAR_INFO.guild_code,
  character.dbo.GUILD_CHAR_INFO.character_name,
  character.dbo.GUILD_CHAR_INFO.peerage_code,
  character.dbo.GUILD_CHAR_INFO.ipt_time,
  character.dbo.GUILD_CHAR_INFO.upt_time,
  character.dbo.GUILD_PEERAGE.guild_code,
  character.dbo.GUILD_PEERAGE.peerage_name,
  character.dbo.GUILD_PEERAGE.peerage_code
FROM
  character.dbo.GUILD_CHAR_INFO
  INNER JOIN character.dbo.GUILD_PEERAGE ON (character.dbo.GUILD_CHAR_INFO.guild_code = character.dbo.GUILD_PEERAGE.guild_code)	
  AND (character.dbo.GUILD_CHAR_INFO.peerage_code = character.dbo.GUILD_PEERAGE.peerage_code)
WHERE character.dbo.GUILD_CHAR_INFO.guild_code = '%s'
ORDER BY character.dbo.GUILD_PEERAGE.peerage_code ASC
", $_GET['guild']);

$qnum1 = $db->SQLfetchNum($result);
if ($qnum1 == '0')
{
	$table .= '<tr><td align="center" class="panel_text_alt_list" colspan="5">No logins found</td></tr>';
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
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['peerage_name'])."</td> 
			</tr>"; 
	}
}
$smarty->assign("TABLE", $table);
?>
