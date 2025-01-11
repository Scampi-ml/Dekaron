<?php
if (isset($_POST) && !empty($_POST))
{
	if(isset($_POST['inventory']) && !empty($_POST['inventory']))
	{
		if(is_array($_POST['inventory']))
		{
			foreach($_POST['inventory'] as $inventory)
			{
				$SQLquery3 = $db->SQLquery("DELETE FROM character.dbo.user_bag WHERE character_no = '%s' AND line_no = '%s' ", $_POST['character'], $inventory );
			}
		}
	}
	$POST = notice_message_admin('Inventory item successfully deleted', '1', '0', 'index.php?get=module_edit_inventory&character='.$_POST['character'].'');
}
else
{
	$table = '';
	
	$SQLquery1 = $db->SQLquery("SELECT * FROM character.dbo.user_bag WHERE character_no = '%s'", $_GET['character']);
	$qnum1 = $db->SQLfetchNum($SQLquery1);
	
	
	$smarty->assign("character", $_GET['character']); 

	if ($qnum1 == '0')
	{
		$table .= '<tr><td align="center" class="panel_text_alt_list" colspan="9">No inventory items found</td></tr>';
	}
	else
	{
		
		$count = 0;
				
		$f_itemetc = fopen("csv/itemetc.csv", "r") or die("csv/itemetc.csv not found!");
		$f_item_cash = fopen("csv/itemcash.csv","r") or die("csv/itemcash.csv not found!");
		$f_item_armor = fopen("csv/itemarmor.csv","r") or die("csv/itemarmor.csv not found!");
		$f_item_weapon = fopen("csv/itemweapon.csv","r") or die("csv/itemweapon.csv not found!");
		
		// Parse all the files to prep them for use
		$itemetc = ParseCSVFile($f_itemetc);
		$item_cash = ParseCSVFile($f_item_cash);
		$item_armor = ParseCSVFile($f_item_armor);
		$item_weapon = ParseCSVFile($f_item_weapon);
		
		fclose($f_itemetc);
		fclose($f_item_cash);
		fclose($f_item_armor);
		fclose($f_item_weapon);
		
		require_once ('engine/array_definebag.php');
		
		
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
			
			$table .= "<tr class='" . $tr_color . "' > 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['line_no'])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($array_definebag[$record['line_no']])."</td> 
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($item_name)." (".htmlspecialchars($record['wIndex']).")</td>
					<td align='left' class='panel_text_alt_list'>0x".htmlspecialchars(bin2hex($record['dwSerialNumber']))."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['byHeader'])."</td>
					<td align='left' class='panel_text_alt_list'>0x".htmlspecialchars(bin2hex($record['info']))."</td>
					<td align='left' class='panel_text_alt_list'>".htmlspecialchars($record['upt_time'])."</td>
					<td align='center' class='panel_text_alt_list'><input type='checkbox' name='inventory[]' value='".htmlspecialchars($record['line_no'])."'></td>
					<td align='left' class='panel_text_alt_list'><a href='index.php?get=module_view_item&header=".$record['byHeader']."&item=0x".bin2hex($record['info'])."&item_name=".$item_name."&windex=".$record['wIndex']."'>View</a></td>
				</tr>"; 
		}
	}
	$smarty->assign("TABLE", $table); 
}
?>