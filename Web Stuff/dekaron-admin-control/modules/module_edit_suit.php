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
    	<td align="center" class="panel_title" colspan="8">Edit Suit</td>
    </tr>
	<tr> 
        <td align="left" class="panel_title_sub2">Line No</td> 
        <td align="left" class="panel_title_sub2">Item Name (Index)</td> 
        <td align="left" class="panel_title_sub2">Serial Number</td> 
        <td align="left" class="panel_title_sub2">Header</td>
        <td align="left" class="panel_title_sub2">Info</td> 
        <td align="left" class="panel_title_sub2">Updated</td> 
        <td align="left" class="panel_title_sub2">Action</td> 
        <td align="left" class="panel_title_sub2">View</td> 
	</tr> 
    <?php
	if ($qnum1 == '0')
	{
		echo '<tr><td align="center" class="panel_text_alt_list" colspan="8">No suit items found</td></tr>';
	}
	else
	{
		flush_this();
		$count = 0;
				
		$f_itemetc = fopen("csv/itemetc.csv", "r") or exit("csv/itemetc.csv not found!");
		$f_item_cash = fopen("csv/itemcash.csv","r") or exit("csv/itemcash.csv not found!");
		$f_item_armor = fopen("csv/itemarmor.csv","r") or exit("csv/itemarmor.csv not found!");
		$f_item_weapon = fopen("csv/itemweapon.csv","r") or exit("csv/itemweapon.csv not found!");
		
		// Parse all the files to prep them for use
		$itemetc = ParseCSVFile($f_itemetc);
		$item_cash = ParseCSVFile($f_item_cash);
		$item_armor = ParseCSVFile($f_item_armor);
		$item_weapon = ParseCSVFile($f_item_weapon);
		
		fclose($f_itemetc);
		fclose($f_item_cash);
		fclose($f_item_armor);
		fclose($f_item_weapon);
		
		
		while ($record = $db->SQLfetchArray($SQLquery1)) 
		{ 
		
			$itemID = $record['wIndex'];
			
			if(GetItemData($itemetc, $itemID, 0, 1) != '')
			{
				$item_name = GetItemData($itemetc, $itemID, 0, 1);
			}
			elseif(GetItemData($item_cash, $itemID, 0, 1) != '')
			{
				$item_name = GetItemData($item_cash, $itemID, 0, 1);
			}
			elseif(GetItemData($item_armor, $itemID, 0, 1) != '')
			{
				$item_name = GetItemData($item_armor, $itemID, 0, 1);
			}
			elseif(GetItemData($item_weapon, $itemID, 0, 1) != '')
			{
				$item_name = GetItemData($item_weapon, $itemID, 0, 1);
			}
			else
			{
				$item_name = 'unknown';
			}
		
		
			$count++;
			$tr_color = ($count % 2) ? '' : 'even';
			
			echo "<tr class='" . $tr_color . "' > 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['line_no'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($item_name)." (".htmlspecialchars($record['wIndex']).")</td>
					<td align='left' class='panel_text_alt_list'>0x".htmlspecialchars(bin2hex($record['dwSerialNumber']))."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['byHeader'])."</td>
					<td align='left' class='panel_text_alt_list'>0x".htmlspecialchars(bin2hex($record['info']))."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['upt_time'])."</td>
					<td align='center' class='panel_text_alt_list'><input type='checkbox' name='suit[]' value='".htmlspecialchars($record['line_no'])."'></td>
					<td align='left' class='panel_text_alt_list'><a href='index.php?get=module_view_item&header=".$record['byHeader']."&item=0x".bin2hex($record['info'])."&item_name=".urlencode($item_name)."&windex=".$record['wIndex']."'>View</a></td>
				</tr>"; 
		}
	}
	?>
    <tr>  
    	<td align="right" class="panel_buttons" colspan="8"><input type="submit" value="Delete Suit Item" onclick="ask_url('Are you sure you want to delete those suits?','index.php?get=module_edit_suit&character=<?php echo $_GET['character']; ?>')"></td>
    </tr>
</table>
<input type="hidden" name="character" value="<?php echo htmlspecialchars($_GET['character']); ?>" >	
</form>	
<?php
}
?>