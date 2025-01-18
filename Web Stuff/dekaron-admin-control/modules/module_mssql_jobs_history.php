<?php
if (isset($_POST) && !empty($_POST))
{
	$SQLquery3 = $db->SQLquery("DELETE FROM msdb.dbo.sysjobhistory WHERE job_id = '%s' ", $_POST['job_id'] );
	echo notice_message_admin('Job history successfully deleted', '1', '0', 'index.php?get=module_mssql_jobs');
}
else
{

flush_this();
$SQLquery1 = $db->SQLquery("SELECT TOP 100 * FROM msdb.dbo.sysjobhistory WHERE job_id = '%s' AND sql_message_id = '0' ORDER BY instance_id DESC",$_GET['job_id']);
$qnum1 = $db->SQLfetchNum($SQLquery1);
?>
<form action="" method="post">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
    <tr>
    	<td align="center" class="panel_title" colspan="6">MsSQL Job History</td>
    </tr>
	<tr> 
        <td align="left" class="panel_title_sub2">Time</td> 
        <td align="left" class="panel_title_sub2">Date</td> 
        <td align="left" class="panel_title_sub2">Step Name</td> 
        <td align="left" class="panel_title_sub2">Message</td> 
        <td align="left" class="panel_title_sub2">Duration</td>
        <td align="left" class="panel_title_sub2">Retries Attempted</td>
	</tr> 
    <?php
	if ($qnum1 == '0')
	{
		echo '<tr><td align="center" class="panel_text_alt_list" colspan="6">There is no history information for this job.</td></tr>';
	}
	else
	{
		flush_this();
		$count = 0;
		while ($record = $db->SQLfetchArray($SQLquery1)) 
		{ 
			$count++;
			$tr_color = ($count % 2) ? '' : 'even';
			
			$date = str_split($record['run_date'], 4);
			$date2 = str_split($record['run_date'], 2);
			if(strlen($record['run_time']) == '5')
			{
				$curr_time = '0'.$record['run_time'];
				$time = str_split($curr_time, 2);
			}
			else
			{
				$time = str_split($record['run_time'], 2);
			}
			
			echo "<tr class='" . $tr_color . "' >";
			echo "<td align='left' class='panel_text_alt_list' >".$time[0].":".$time[1].":".$time[2]."</td>";
			echo "<td align='left' class='panel_text_alt_list' >".$date2[3]." / ".$date2[2]." / ".$date[0]."</td>";
			echo "<td align='left' class='panel_text_alt_list' >".htmlspecialchars($record['step_name'])."</td>";
			echo "<td align='left' class='panel_text_alt_list' >".htmlspecialchars($record['message'])."</td>";
			echo "<td align='left' class='panel_text_alt_list' >".htmlspecialchars($record['run_duration'])." second(s)</td>";
			echo "<td align='left' class='panel_text_alt_list' >".htmlspecialchars($record['retries_attempted'])."</td>";
		}
	}
	?>
    <tr>
    	<td align="right" class="panel_buttons" colspan="5"><input type="submit" value="Delete Skill" onclick="ask_url('Are you sure you want to delete all job history?','index.php?get=module_mssql_jobs_history&job=<?php echo $_GET['job_id']; ?>')"></td>
    </tr>
</table>
<input type="hidden" name="character" value="<?php echo htmlspecialchars($_GET['character']); ?>" >	
</form>	
<?php
}
?>