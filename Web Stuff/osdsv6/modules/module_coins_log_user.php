<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
    <tr>
    	<td align="center" class="panel_title" colspan="4">Coins Use Log</td>
    </tr>
	<tr> 
        <td align="left" class="panel_title_sub2">Character</td> 
        <td align="left" class="panel_title_sub2">Ip Address</td>
        <td align="left" class="panel_title_sub2">Item / Item Id</td> 
        <td align="left" class="panel_title_sub2">Date</td> 
	</tr> 
<?php    
	flush_this();        	
	$result = $db->SQLquery("SELECT TOP 100 character_name,ip_address,item_index,intime,id,product FROM cash.dbo.user_use_log ORDER BY id DESC");  
	$qnum1 = $db->SQLfetchNum($result);
	if ($qnum1 == '0')
	{
		echo '<tr><td align="center" class="panel_text_alt_list" colspan="5">No logs found</td></tr>';
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
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['ip_address'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['product'])." (".htmlspecialchars($record['item_index']).")</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['intime'])."</td> 
				</tr>"; 
		}
	}
?>
</table>