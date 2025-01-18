<?php
if (isset($_POST) && !empty($_POST))
{
	if(isset($_POST['skill']) && !empty($_POST['skill']))
	{
		if(is_array($_POST['skill']))
		{
			foreach($_POST['skill'] as $skill)
			{
				$SQLquery3 = $db->SQLquery("DELETE FROM character.dbo.user_skill WHERE character_no = '%s' AND line_no = '%s' ", $_POST['character'], $skill );
			}
		}
	}
	echo notice_message_admin('Skill successfully deleted', '1', '0', 'index.php?get=module_edit_skills&character='.$_POST['character'].'');
}
else
{
	flush_this();
	$SQLquery1 = $db->SQLquery("SELECT * FROM character.dbo.user_skill WHERE character_no = '%s'", $_GET['character']);
	$qnum1 = $db->SQLfetchNum($SQLquery1);
?>
<form action="" method="post">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
    <tr>
    	<td align="center" class="panel_title" colspan="5">Edit Skills</td>
    </tr>
	<tr> 
        <td align="left" class="panel_title_sub2">Line No</td> 
        <td align="left" class="panel_title_sub2">Info</td>
        <td align="left" class="panel_title_sub2">Ipt Time</td> 
        <td align="left" class="panel_title_sub2">Upt Time</td> 
        <td align="left" class="panel_title_sub2">Action</td> 
	</tr> 
    <?php
	if ($qnum1 == '0')
	{
		echo '<tr><td align="center" class="panel_text_alt_list" colspan="5">No skills found</td></tr>';
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
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['line_no'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars(bin2hex($record['info']))."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['ipt_time'])."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['upt_time'])."</td>
					<td align='center' class='panel_text_alt_list'><input type='checkbox' name='skill[]' value='".htmlspecialchars($record['line_no'])."'></td>
				</tr>"; 
		}
	}
	?>
    <tr>
    	<td align="right" class="panel_buttons" colspan="5"><input type="submit" value="Delete Skill" onclick="ask_url('Are you sure you want to delete those skills?','index.php?get=module_edit_skills&character=<?php echo $_GET['character']; ?>')"></td>
    </tr>
</table>
<input type="hidden" name="character" value="<?php echo htmlspecialchars($_GET['character']); ?>" >	
</form>	
<?php
}
?>