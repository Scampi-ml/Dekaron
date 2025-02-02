<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
    <tr>
    	<td align="center" class="panel_title" colspan="7">Mails</td>
    </tr>
	<tr> 
        <td align="left" class="panel_title_sub2">From</td> 
        <td align="left" class="panel_title_sub2">To</td> 
        <td align="left" class="panel_title_sub2">Title</td>
        <td align="left" class="panel_title_sub2">Message</td>
        <td align="left" class="panel_title_sub2">Item</td>  
        <td align="left" class="panel_title_sub2">Dil</td>
        <td align="left" class="panel_title_sub2">Date</td>
	</tr> 
<?php    
	flush_this(); 
	$top = $config->get('top','settings_view_mails');        	
	$result = $db->SQLquery("
	SELECT TOP ".$top."
	  character.dbo.USER_POSTBOX.character_no,
	  character.dbo.user_character.character_no,
	  character.dbo.USER_POSTBOX.post_no,
	  character.dbo.USER_POSTBOX.from_char_nm,
	  character.dbo.USER_POSTBOX.include_dil,
	  character.dbo.USER_POSTBOX.wIndex,
	  character.dbo.USER_POSTBOX.body_text,
	  character.dbo.USER_POSTBOX.post_title,
	  character.dbo.USER_POSTBOX.expire_time,
	  character.dbo.USER_POSTBOX.ipt_time,
	  character.dbo.user_character.character_name
	FROM
	  character.dbo.USER_POSTBOX
	  INNER JOIN character.dbo.user_character ON (character.dbo.USER_POSTBOX.character_no = character.dbo.user_character.character_no)
	ORDER BY
	  character.dbo.USER_POSTBOX.post_no ASC	
	");  
	$qnum1 = $db->SQLfetchNum($result);
	if ($qnum1 == '0')
	{
		echo '<tr><td align="center" class="panel_text_alt_list" colspan="7">No mails found</td></tr>';
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
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['from_char_nm'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['character_name'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['post_title'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['body_text'])."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['wIndex'])."</td> 
					<td align='left' class='panel_text_alt_list'>".number_format(htmlspecialchars($record['include_dil']))."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['ipt_time'])."</td>
				</tr>"; 
		}
	}
?>
</table>