<div id="serverinfo">Search for: &quot;<?php echo $search_string; ?>&quot; </div>
<table>
    <tr>
        <th>Character Name</th>
        <th>&nbsp;</th>
    </tr>
<?php
	flush_this();
	$query = $db_character->query("SELECT character_name,character_no,login_time FROM user_character WHERE character_name LIKE '" . $search_string . "%' ORDER BY character_name ASC");
	$results = $db_character->fetchNum($query);
	
	if ( $results != '0' )
	{
		while ($result = $db_character->fetchArray($query))
		{
			preg_match('/^19999999999991/', $result['character_no'], $matches, PREG_OFFSET_CAPTURE);
			if( $matches ) 
			{
				continue;
			}
			
			echo '<tr class="even">
					<td>';
					
					if(exo_getglobalvariable('CONFIG_RED_CHARS', '') == 'yes')
					{
						if( $result['login_time'] == NULL )
						{
							echo '<font color="#ff5e5e">'.$result['character_name'].'</font>';
						}
						else
						{
							echo $result['character_name'];
						}
					}
					else
					{
						echo $result['character_name'];
					}
					
					
			echo '		
					</td>
					<td><a href="choose_action.php?&character=' . $result['character_no'] . '&character_name=' . $result['character_name'] . '&action=character">'.LAN_action.'</a></td>
				  </tr>';
		}
	}
	else
	{
		JavaAlert(LAN_error_no_results, 'goback');
		die();
	}
?>