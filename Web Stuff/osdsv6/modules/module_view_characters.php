<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
    <tr>
    	<td align="center" class="panel_title" colspan="3">Characters On Account</td>
    </tr>
	<tr> 
        <td align="left" class="panel_title_sub2">Character</td> 
        <td align="left" class="panel_title_sub2">Action</td> 
	</tr> 
<?php  
	flush_this();        	
	$result = $db->SQLquery("SELECT character_name,character_no,user_no FROM character.dbo.user_character WHERE user_no = '".$_GET['account']."' ");  
	$qnum1 = $db->SQLfetchNum($result);
	if ($qnum1 == '0')
	{
		echo '<tr><td align="center" class="panel_text_alt_list" colspan="5">No characters found</td></tr>';
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
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['character_name'])."</td> 
					<td align='center' class='panel_text_alt_list' width='50'><a href='index.php?get=module_action&character=". htmlspecialchars($record['character_no'])."'>[Action]</a</td>					
				</tr>"; 
		}
	}
?>
</table>