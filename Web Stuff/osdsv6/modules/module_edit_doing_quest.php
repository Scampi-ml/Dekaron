<?php
if (isset($_POST) && !empty($_POST))
{
	if(isset($_POST['quest']) && !empty($_POST['quest']))
	{
		if(is_array($_POST['quest']))
		{
			foreach($_POST['quest'] as $quest)
			{
				$SQLquery3 = $db->SQLquery("DELETE FROM character.dbo.User_Quest_Doing WHERE character_no = '%s' AND q_index = '%s' ", $_POST['character'], $quest);
			}
		}
	}
	echo notice_message_admin('Doing quests successfully deleted', '1', '0', 'index.php?get=module_edit_doing_quest&character='.$_POST['character'].'');
}
else
{
	flush_this();
	$SQLquery1 = $db->SQLquery("SELECT * FROM character.dbo.User_Quest_Doing WHERE character_no = '%s'", $_GET['character']);
	$qnum1 = $db->SQLfetchNum($SQLquery1);
?>
<form action="" method="post">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
    <tr>
    	<td align="center" class="panel_title" colspan="7">Edit Doing Quests</td>
    </tr>
	<tr> 
        <td align="left" class="panel_title_sub2">Quest Index</td> 
        <td align="left" class="panel_title_sub2">Quest Count 0</td> 
        <td align="left" class="panel_title_sub2">Quest Count 1</td>
        <td align="left" class="panel_title_sub2">Quest Count 2</td> 
        <td align="left" class="panel_title_sub2">Quest Count 3</td>
        <td align="left" class="panel_title_sub2">Time</td>
        <td align="left" class="panel_title_sub2">Action</td> 
	</tr> 
    <?php
	if ($qnum1 == '0')
	{
		echo '<tr><td align="center" class="panel_text_alt_list" colspan="7">No quests found</td></tr>';
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
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['q_index'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['q_count_0'])."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['q_count_1'])."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['q_count_2'])."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['q_count_3'])."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['upt_time'])."</td>
					<td align='center' class='panel_text_alt_list'><input type='checkbox' name='quest[]' value='".htmlspecialchars($record['q_index'])."'></td>
				</tr>"; 
		}
	}
	?>
    <tr>
    	<td align="right" class="panel_buttons" colspan="7"><input type="submit" value="Delete Quest" onclick="ask_url('Are you sure you want to delete those quests?','index.php?get=module_edit_doing_quest&character=<?php echo $_GET['character']; ?>')"></td>
    </tr>
</table>
<input type="hidden" name="character" value="<?php echo htmlspecialchars($_GET['character']); ?>" >	
</form>	
<?php
}
?>