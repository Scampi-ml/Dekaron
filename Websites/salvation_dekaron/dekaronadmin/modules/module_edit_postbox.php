<?php
if (isset($_POST) && !empty($_POST))
{
	if(isset($_POST['postbox']) && !empty($_POST['postbox']))
	{
		if(is_array($_POST['postbox']))
		{
			foreach($_POST['postbox'] as $postbox)
			{
				$SQLquery3 = $db->SQLquery("DELETE FROM character.dbo.USER_POSTBOX WHERE character_no = '%s' AND post_no = '%s' ", $_POST['character'], $postbox );
			}
		}
	}
	$POST = notice_message_admin('Post successfully deleted', '1', '0', 'index.php?get=module_edit_postbox&character='.$_POST['character'].'');
}
else
{
	
	$SQLquery1 = $db->SQLquery("
	SELECT 
	  character.dbo.USER_POSTBOX.character_no,
	  character.dbo.user_character.character_no,
	  character.dbo.user_character.character_name,
	  character.dbo.USER_POSTBOX.from_char_nm,
	  character.dbo.USER_POSTBOX.wIndex,
	  character.dbo.USER_POSTBOX.include_dil,
	  character.dbo.USER_POSTBOX.state_tag,
	  character.dbo.USER_POSTBOX.expire_time,
	  character.dbo.USER_POSTBOX.body_text,
	  character.dbo.USER_POSTBOX.post_title,
	  character.dbo.USER_POSTBOX.post_no,
	  character.dbo.USER_POSTBOX.ipt_time
	FROM
	  character.dbo.USER_POSTBOX
	  INNER JOIN character.dbo.user_character ON (character.dbo.USER_POSTBOX.character_no = character.dbo.user_character.character_no)
	WHERE
	  character.dbo.USER_POSTBOX.character_no = '%s'", $_GET['character']);
	$qnum1 = $db->SQLfetchNum($SQLquery1);

	$smarty->assign("character", $_GET['character']); 

	$table = '';
	if ($qnum1 == '0')
	{
		$table .= '<tr><td align="center" class="panel_text_alt_list" colspan="10">No post found</td></tr>';
	}
	else
	{
		
		$count = 0;
		require_once ('engine/array_items.php');
		while ($record = $db->SQLfetchArray($SQLquery1)) 
		{ 
			$count++;
			$tr_color = ($count % 2) ? '' : 'even';
			
			$table .= "<tr class='" . $tr_color . "' > 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['from_char_nm'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['character_name'])."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['post_title'])."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['body_text'])."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($array_items[$record['wIndex']])." (".htmlspecialchars($record['wIndex']).")</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars(number_format($record['include_dil']))."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['ipt_time'])."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['state_tag'])."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['expire_time'])."</td>
					<td align='center' class='panel_text_alt_list'><input type='checkbox' name='postbox[]' value='".htmlspecialchars($record['post_no'])."'></td>
				</tr>"; 
		}
	}
	$smarty->assign("TABLE", $table); 
}
?>