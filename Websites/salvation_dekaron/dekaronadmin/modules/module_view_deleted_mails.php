<?php    
$table = "";
$top = $config->get('top','settings_view_deleted_mails');        	
$result = $db->SQLquery("
SELECT TOP ".$top."
  character.dbo.USER_POSTBOX_SECEDE.character_no,
  character.dbo.user_character.character_no,
  character.dbo.USER_POSTBOX_SECEDE.post_no,
  character.dbo.USER_POSTBOX_SECEDE.from_char_nm,
  character.dbo.USER_POSTBOX_SECEDE.include_dil,
  character.dbo.USER_POSTBOX_SECEDE.wIndex,
  character.dbo.USER_POSTBOX_SECEDE.body_text,
  character.dbo.USER_POSTBOX_SECEDE.post_title,
  character.dbo.USER_POSTBOX_SECEDE.expire_time,
  character.dbo.USER_POSTBOX_SECEDE.ipt_time,
  character.dbo.USER_POSTBOX_SECEDE.del_time,
  character.dbo.user_character.character_name
FROM
  character.dbo.USER_POSTBOX_SECEDE
  INNER JOIN character.dbo.user_character ON (character.dbo.USER_POSTBOX_SECEDE.character_no = character.dbo.user_character.character_no)
ORDER BY
  character.dbo.USER_POSTBOX_SECEDE.del_time DESC");  
$qnum1 = $db->SQLfetchNum($result);
if ($qnum1 == '0')
{
	$table .= '<tr><td align="center" class="panel_text_alt_list" colspan="8">No mails found</td></tr>';
}
else
{

	$count = 0;
	while ($record = $db->SQLfetchArray($result)) 
	{ 
		$count++;
		$tr_color = ($count % 2) ? '' : 'even';
		
		$table .= "<tr class='" . $tr_color . "' > 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['from_char_nm'])."</td> 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['character_name'])."</td> 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['post_title'])."</td> 
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['body_text'])."</td>
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['wIndex'])."</td> 
				<td align='left' class='panel_text_alt_list'>".number_format(htmlspecialchars($record['include_dil']))."</td>
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['ipt_time'])."</td>
				<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['del_time'])."</td>
			</tr>"; 
	}
}
$smarty->assign("TABLE", $table);
?>