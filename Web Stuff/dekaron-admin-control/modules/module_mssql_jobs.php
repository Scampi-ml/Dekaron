<?php
if (isset($_POST) && !empty($_POST))
{
	$db->SQLquery("UPDATE msdb.dbo.sysjobs SET enabled = '%s' WHERE job_id = '%s' ", $_POST['enabled'] ,$_POST['job_id'] );
	echo notice_message_admin('Job successfully updated', '1', '0', 'index.php?get=module_mssql_jobs');
}
else
{
flush_this();
$SQLquery1 = $db->SQLquery("SELECT * FROM msdb.dbo.sysjobs ");
$qnum1 = $db->SQLfetchNum($SQLquery1);
?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
    <tr>
    	<td align="center" class="panel_title" colspan="3">MsSQL Jobs</td>
    </tr>
	<tr> 
        <td align="left" class="panel_title_sub2">Name</td> 
        <td align="left" class="panel_title_sub2">Enabled</td>
        <td align="left" class="panel_title_sub2">Job History</td> 
	</tr> 
    <?php
	if ($qnum1 == '0')
	{
		echo '<tr><td align="center" class="panel_text_alt_list" colspan="3">No jobs found</td></tr>';
	}
	else
	{
		flush_this();
		$count = 0;
		while ($record = $db->SQLfetchArray($SQLquery1)) 
		{ 
			$count++;
			$tr_color = ($count % 2) ? '' : 'even';
			
			echo "<tr class='" . $tr_color . "' > 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['name'])."</td> 
					<td align='left' class='panel_text_alt_list'>
						<form action='' method='post'>
							<select name='enabled' style='width: 200px;'>";
					
								switch ($record['enabled'])
								{
									case '1':
										echo '<option value="0">Disabled</option><option value="1" selected>Enabled</option>';
										break;
									case '0':
										echo '<option value="0" selected>Disabled</option><option value="1">Enabled</option>';
										break;
								}

					
					
			echo "			</select>
							<input type='hidden' name='job_id' value='".mssql_guid_string($record['job_id'])."' >	
							<input type='submit' value='Save'>	
						</form>
					</td>
					<td align='center' class='panel_text_alt_list'><a href='index.php?get=module_mssql_jobs_history&job_id=".mssql_guid_string($record['job_id'])."'>View History</a></td>
				</tr>"; 
		}
	}
	?>
</table>
<?php
}
?>
