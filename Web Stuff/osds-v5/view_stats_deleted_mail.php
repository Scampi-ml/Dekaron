<?php
include ('osdscore.php');
echo HEADER;

if (file_exists('array_items.php')) 
{
include ( "array_items.php" ); 
}
else
{
	include ("array_items_int.php" );
}


if ( isset($_GET['task']) == 'Delete All' )
{
	$db_character->query("DELETE FROM USER_POSTBOX_SECEDE ");
	JavaAlert('Deleted all data, back to index', 'index.php');
	die();
}

echo '<form method="get" >
			<span style="float:right;margin-top:2px;"><input type="submit" value="Delete All" name="task"></span>
		</form>
		<br>';

	$query = $db_character->query("SELECT * FROM USER_POSTBOX_SECEDE ");
	
	while ($result = $db_character->fetchArray($query))
	{
		$query2 = $db_character->query("SELECT * FROM user_character WHERE character_no = '" . $result['character_no'] . "' ");
		$result2 = $db_character->fetchArray($query2);
	
		echo '<fieldset >';
		echo '<legend>From '.$result['from_char_nm'].' to '.$result2['character_name'].'</legend>';
		echo '<table>';
		
			echo '<tr class="even">';	
			echo '<td style="width:'.$CONFIG_TABLE_PX2.'px">Post title:</td>';
			echo '<td>'.$result['post_title'].'</td>';
			echo '</tr>';
			
			echo '<tr class="even">';	
			echo '<td style="width:'.$CONFIG_TABLE_PX2.'px">Item</td>';
				if (array_key_exists($result['wIndex'], $item_names))
				{
					echo '<td>'.$item_names[$result['wIndex']].'</td>';
				}
				else
				{
					echo "<td><font style='background-color:#FF0000; color:#FFFFFF;'>&nbsp;" . $result['wIndex'] . "&nbsp;</font></td>";
				}
			echo '</tr>';
			
			echo '<tr class="even">';	
			echo '<td style="width:'.$CONFIG_TABLE_PX2.'px">Post message:</td>';
			echo '<td>'.$result['body_text'].'</td>';
			echo '</tr>';

			echo '<tr class="even">';	
			echo '<td style="width:'.$CONFIG_TABLE_PX2.'px">Added dil:</td>';
			echo '<td>'.$result['include_dil'].'</td>';
			echo '</tr>';
			
			echo '<tr class="even">';	
			echo '<td style="width:'.$CONFIG_TABLE_PX2.'px">Date</td>';
			echo '<td>'.$result['ipt_time'].'</td>';
			echo '</tr>';



			
		echo '</table>';	
		echo '</fieldset>';
	
	}



echo FOOTER;
?>