<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
    <tr>
    	<td align="center" class="panel_title" colspan="2">Database Info</td>
    </tr>
	<tr> 
        <td align="left" class="panel_title_sub2">Database Name</td> 
        <td align="left" class="panel_title_sub2">File Size</td> 
	</tr>
    <?php 
	flush_this();
	$count = 0;
	$db_info = $db->SQLquery("SELECT name,filename FROM master.dbo.sysdatabases");		
	while ($dbs = $db->SQLfetchArray($db_info))
	{
		$count++;
		$tr_color = ($count % 2) ? '' : 'even';	
		echo '<tr class="' . $tr_color . '">
				<td align="left" class="panel_text_alt_list" width="50%">' . $dbs['name'] . '</td>
				<td align="left" class="panel_text_alt_list">'.convertbytes(filesize($dbs['filename'])).'</td>
			</tr>';
	}
	?>
</table>    
    