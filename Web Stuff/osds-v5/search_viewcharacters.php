	<?php
	$query = $db_character->query("SELECT * FROM user_character WHERE user_no = '" . $search_string . "' ");
	$results = $db_character->fetchNum($query);
	

				
	if ( $results != '0' )
	{
		echo '<fieldset>
			<legend>'.LAN_search_h2.' ' . $_GET['method'] . ': &quot;' . $_GET['userid'] . '&quot; </legend>
				<table>';
		while ($result = $db_character->fetchArray($query))
		{

			preg_match('/^19999999999991/', $result['user_no'], $matches, PREG_OFFSET_CAPTURE);
			if( $matches ) 
			{
				continue;
			}
			
			$query3 = $db_account->query("SELECT * FROM user_profile WHERE user_no = '".$result['user_no']."' ");
			$getAccount = $db_account->fetchArray($query3);
			
	
			echo '<tr class="even">
					<th style="width:'.$CONFIG_TABLE_PX1.'px">';
					
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
					</th>
					<td><a href="choose_action.php?account='. $getAccount['user_no'] . '&userid='.$getAccount['user_id'].'&character=' . $result['character_no'] . '&character_name=' . $result['character_name'] . '&action=character">'.LAN_action.'</a></td>
				  </tr>';
		}
	}
	else
	{
		JavaAlert(LAN_error_no_results, 'goback');
		die();
	}




?>