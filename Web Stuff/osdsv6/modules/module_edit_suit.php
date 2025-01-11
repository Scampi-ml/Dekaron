<?php
if (isset($_POST) && !empty($_POST))
{
	if(isset($_POST['suit']) && !empty($_POST['suit']))
	{
		if(is_array($_POST['suit']))
		{
			foreach($_POST['suit'] as $suit)
			{
				$SQLquery3 = $db->SQLquery("DELETE FROM character.dbo.user_suit WHERE character_no = '%s' AND line_no = '%s' ", $_POST['character'], $suit );
			}
		}
	}
	echo notice_message_admin('Suit successfully deleted', '1', '0', 'index.php?get=module_edit_suit&character='.$_POST['character'].'');
}
else
{
	flush_this();
	$SQLquery1 = $db->SQLquery("SELECT * FROM character.dbo.user_suit WHERE character_no = '%s'", $_GET['character']);
	$qnum1 = $db->SQLfetchNum($SQLquery1);
?>
<form action="" method="post">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
    <tr>
    	<td align="center" class="panel_title" colspan="7">Edit Suit</td>
    </tr>
	<tr> 
        <td align="left" class="panel_title_sub2">Line No</td> 
        <td align="left" class="panel_title_sub2">By Header</td> 
        <td align="left" class="panel_title_sub2">Item Index</td> 
        <td align="left" class="panel_title_sub2">Serial Number</td> 
        <td align="left" class="panel_title_sub2">Info</td> 
        <td align="left" class="panel_title_sub2">Upt Time</td> 
        <td align="left" class="panel_title_sub2">Action</td> 
	</tr> 
    <?php
	if ($qnum1 == '0')
	{
		echo '<tr><td align="center" class="panel_text_alt_list" colspan="7">No suit found</td></tr>';
	}
	else
	{
		flush_this();
		$count = 0;
		require_once ('engine/array_items.php');
		while ($record = $db->SQLfetchArray($SQLquery1)) 
		{ 
			$count++;
			$tr_color = ($count % 2) ? '' : 'even';
			
			echo "<tr class='" . $tr_color . "' > 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['line_no'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['byHeader'])."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($array_items[$record['wIndex']])." (".htmlspecialchars($record['wIndex']).")</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars(bin2hex($record['dwSerialNumber']))."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars(bin2hex($record['info']))."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['upt_time'])."</td>
					<td align='center' class='panel_text_alt_list'><input type='checkbox' name='suit[]' value='".htmlspecialchars($record['line_no'])."'></td>
				</tr>"; 
		}
	}
	?>
    <tr>
    	<td align="right" class="panel_buttons" colspan="7"><input type="submit" value="Delete Suit Item" onclick="ask_url('Are you sure you want to delete those suits?','index.php?get=module_edit_suit&character=<?php echo $_GET['character']; ?>')"></td>
    </tr>
</table>
<input type="hidden" name="character" value="<?php echo htmlspecialchars($_GET['character']); ?>" >	
</form>	
<?php
}
?>