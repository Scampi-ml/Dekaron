<?php
	$query = $db_account->query("SELECT * FROM user_profile WHERE login_tag = 'N' "); 
	$results = $db_account->fetchNum($query);
	
	echo '<h2>'.LAN_search_h2.': &quot;' . LAN_vba_string . '&quot; </h2>';
	echo '<hr>';
	echo '<table style="width:100%;">';

	if ( $results != '0' )
	{
		while ($result = $db_account->fetchArray($query))
		{
			$query2 = $db_character->query("SELECT * FROM user_character WHERE user_no = '".$result['user_no']."' ");
			$getCharacterNum = $db_character->fetchNum($query2);
	
			echo '<tr>
					<td style="width:50%;">' . $result['user_id'] . '</td>
					<td style="width:50%; float:right; margin-right:10px;">
						<form id="data" name="navigation'.$count.'">
							<select name="select'.$count.'" onchange="location.href=navigation'.$count.'.select'.$count.'.options[selectedIndex].value" style="width:200px;">
									<option value="">'.LAN_search_select_action.'</option>
								<optgroup label="'.LAN_search_optgroup_account.'">
									<option value="edit_account.php?account=' . $result['user_no'] . '">'.LAN_search_option_editaccount.'</option>
									<option value="warn_account.php?account=' . $result['user_no'] . '">'.LAN_search_option_warnaccount.'</option>
									<option value="delete_account.php?account=' . $result['user_no'] . '&userid='.$result['user_id'].'">'.LAN_search_option_deleteaccount.'</option>
									<option value="email.php?account=' . $result['user_no'] . '">'.LAN_search_option_emailaccount.'</option>
								</optgroup>';
								
								if ($getCharacterNum != 0)
								{
									echo '<optgroup label="'.LAN_search_optgroup_account.'">';
									echo '<option value="search.php?method=viewcharacters&search_string=' . $result['user_no'] . '&user_id=' . $result['user_id'] . '">'.LAN_search_option_viewcharacters.'</option>';										
									echo '</optgroup>';
								}
								echo '
								<optgroup label="'.LAN_search_optgroup_cash.'">
									<option value="edit_coins.php?account=' . $result['user_no'] . '">'.LAN_search_option_editcoins.'</option>
									<option value="view_coins_log.php?account=' . $result['user_no'] . '&userid='.$result['user_id'].'">'.LAN_search_option_viewconslog.'</option>
								</optgroup>
								
							</select>
						</form>
					</td>
				  </tr>
				  <tr></tr>';
			$count++;
		}
	}
	else
	{
		JavaAlert(LAN_error_no_results, 'goback');
		die();
	}

?>