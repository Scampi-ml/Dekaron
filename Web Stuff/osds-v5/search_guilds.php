<?php


	$query = $db_character->query("SELECT guild_name,guild_code FROM guild_info ORDER BY guild_name ASC");
	$results = $db_character->fetchNum($query);
	
	
	echo '<fieldset>
		<legend>'.LAN_search_h2.' ' . $_GET['method'] . '</legend>
			<table>';
	
	
	if ( $results != '0' )
	{
		while ($result = $db_character->fetchArray($query))
		{
			// Remove the mastercode becuz it should never be edited!		
			if ($result['guild_code'] == 'MASTERCODE') {
				continue;
			}
			
			echo '<tr class="even">
					<th style="width:'.$CONFIG_TABLE_PX1.'px">' . $result['guild_name'] . '</th>
					<td><a href="edit_guild.php?guild=' . $result['guild_code'] . '">'.LAN_edit.'</a></td>
					<td><a href="view_guild.php?guild=' . $result['guild_code'] . '">'.LAN_chars.'</a></td>
				  </tr>
				 ';
		}
		echo '</table></fieldset>';
	}
	else
	{
		JavaAlert(LAN_error_no_results, 'goback');
		die();
	}


?>