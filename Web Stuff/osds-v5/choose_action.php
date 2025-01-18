<?php
include ('osdscore.php');

if(isset($_GET['character']))
{
	$GET_CHARACTER_NO = $_GET['character'];
}
else
{
	$GET_CHARACTER_NO = '';
}

if(isset($_GET['character_name']))
{
	$GET_CHARACTER_NAME = $_GET['character_name'];
}
else
{
	$GET_CHARACTER_NAME = '';
}


if(isset($_GET['account']))
{
	$GET_ACCOUNT_NO = $_GET['account'];
}
else
{
	$GET_ACCOUNT_NO = '';
}

if(isset($_GET['userid']))
{
	$GET_USER_ID = $_GET['userid'];
}
else
{
	$GET_USER_ID = '';
}

$GET_ACTION = $_GET['action'];

//----------------------------------------------
// Thx to pieter for this

if (isset($_GET['savenote']))
{
	reset ($_GET);
	while (list ($key, $val) = each ($_GET))
	{
		if ($key == 'savenote') {
			continue;
		}
		if ($key == 'action') {
			continue;
		}
		if ($key == 'userid') {
			continue;
		}
		if ($key == 'account') {
			continue;
		}


		
		$update = $db_account->query("UPDATE user_warning SET ".$key." = '".$val."' WHERE user_no = '" . $GET_ACCOUNT_NO . "' ");
	}
	echo "<div class='response-msg success'>".LAN_updated."</div>";
}





//----------------------------------------------

if($GET_ACTION == 'account')
{
	$query1 = $db_account->query("SELECT * FROM user_warning WHERE user_no = '".$GET_ACCOUNT_NO."' ");
	$getWarning = $db_account->fetchArray($query1);
	$getWarningRow = $db_account->fetchNum($query1);
	// No row found, create one
	if($getWarningRow == '0')
	{
		$insert_warning_row = $db_account->query("
									INSERT INTO user_warning
										(
											user_no,
											from_user_no,
											subject,
											message,
											warning_time,
											warning_time_detail
										) 
									VALUES 
										(
											 '".$GET_ACCOUNT_NO."',
											 '',
											 '',
											 '',
											 '',
											 ''
										)  
									");
	
		if(!$insert_warning_row)
		{
			echo "Failed to insert user_warning";
		}
	}


	echo '<div id="serverinfo">'.LAN_account.' '.LAN_action.' '.LAN_for.': '.$GET_USER_ID.'</div>
			<table>
				<tr>
					<td style="width:50%;">
						<ul id="topmenu2">
							<li><a class="tab" href="edit_account.php?account='. $GET_ACCOUNT_NO . '&userid='.$GET_USER_ID.'">'.LAN_edit.' '.LAN_account.'</a></li>
							<li><a class="tab" href="coins.php?method=editcoins&account='.$GET_ACCOUNT_NO . '&userid='.$GET_USER_ID.'">'.LAN_edit.' '.LAN_coins.'</a></li>
							<li><a class="tab" href="delete_account.php?account='. $GET_ACCOUNT_NO . '&userid='.$GET_USER_ID.'">'.LAN_delete.' '.LAN_account.'</a></li>
							<li><a class="tab" href="search.php?method=viewcharacters&search_string=' . $GET_ACCOUNT_NO . '&userid='.$GET_USER_ID.'">'.LAN_view.' '.LAN_characters.'</a></li>
							<li><a class="tab" href="exchange.php?account=' . $GET_ACCOUNT_NO . '&userid='.$GET_USER_ID.'">'.LAN_exchange.'</a></li>
							<li><a class="tab" href="view_account_login.php?account='.$GET_ACCOUNT_NO.'&userid='.$GET_USER_ID.'">'.LAN_view.' '.LAN_account.' '.LAN_login.'</a></li>
							<li><a class="tab" href="view_account_logout.php?account='.$GET_ACCOUNT_NO.'&userid='.$GET_USER_ID.'">'.LAN_view.' '.LAN_account.' '.LAN_logout.'</a></li>
						</ul>
					</td>
					<td style="width:50%;">
						<form method="get">
							
							<input type="hidden" value="account" name="action">
							<input type="hidden" value="'.$GET_USER_ID.'" name="userid">
							<input type="hidden" value="'.$GET_ACCOUNT_NO.'" name="account">
							<input type="hidden" value="'.$_SESSION['USER'].'" name="from_user_no">
							<input type="hidden" value="'.date("d M Y -- H:i").'" name="warning_time">
							<input type="hidden" value="'.time().'" name="warning_time_detail">
							
							<fieldset style="margin-top:1px;">
									<textarea rows="18" cols="50" name="message">'.$getWarning['message'].'</textarea>
									<small>'.LAN_edit.': '.$getWarning['warning_time'].' <br>'.LAN_from.': '.$getWarning['from_user_no'].'</small><input type="submit" value="'.LAN_save.'" name="savenote" style="float:right;">
							</fieldset>
						</form>

					</td>
				</tr>
			</table>';
			
}
elseif ($GET_ACTION == 'character')
{
	echo '<div id="serverinfo">'.LAN_character.' '.LAN_action.' '.LAN_for.': '.$GET_CHARACTER_NAME.'</div>
			<table>
				<tr>
					<td style="width:50%;">
						<ul id="topmenu2">
							<li><a class="tab" href="edit_character.php?character=' . $GET_CHARACTER_NO . '">'.LAN_edit.' '.LAN_character.'</a></li>
							<li><a class="tab" href="edit_account.php?account='. $GET_ACCOUNT_NO . '&userid='.$GET_USER_ID.'">'.LAN_edit.' '.LAN_account.'</a></li>
							<li><a class="tab" href="edit_doing_quest.php?character=' . $GET_CHARACTER_NO . '&character_name=' . $GET_CHARACTER_NAME . '">'.LAN_edit.' '.LAN_doing.' '.LAN_quest.'</a></li>
							<li><a class="tab" href="edit_done_quest.php?character=' . $GET_CHARACTER_NO . '&character_name=' . $GET_CHARACTER_NAME . '">'.LAN_edit.' '.LAN_done.' '.LAN_quest.'</a></li>
							<li><a class="tab" href="edit_inventory.php?character=' . $GET_CHARACTER_NO . '&character_name=' . $GET_CHARACTER_NAME . '">'.LAN_edit.' '.LAN_inventory.'</a></li>
							<li><a class="tab" href="edit_storage.php?character=' . $GET_CHARACTER_NO . '&character_name=' . $GET_CHARACTER_NAME . '">'.LAN_edit.' '.LAN_storage.'</a></li>
							<li><a class="tab" href="edit_store.php?character=' . $GET_CHARACTER_NO . '&character_name=' . $GET_CHARACTER_NAME . '">'.LAN_edit.' '.LAN_store.'</a></li>
							<li><a class="tab" href="edit_suit.php?character=' . $GET_CHARACTER_NO . '&character_name=' . $GET_CHARACTER_NAME . '">'.LAN_edit.' '.LAN_suit.'</a></li>
							<li><a class="tab" href="edit_skills.php?character=' . $GET_CHARACTER_NO . '&character_name=' . $GET_CHARACTER_NAME . '">'.LAN_edit.' '.LAN_skills.'</a></li>
							<li><a class="tab" href="edit_postbox.php?character=' . $GET_CHARACTER_NO . '&character_name=' . $GET_CHARACTER_NAME . '">'.LAN_edit.' '.LAN_postbox.'</a></li>
						</ul>
					</td>
					<td style="width:50%;">
						<ul id="topmenu2">
							<li><a class="tab" href="delete_character.php?character=' . $GET_CHARACTER_NO . '&character_name=' . $GET_CHARACTER_NAME . '">'.LAN_delete.' '.LAN_character.'</a></li>
							<li><a class="tab" href="delete_skills.php?character=' . $GET_CHARACTER_NO . '&character_name=' . $GET_CHARACTER_NAME . '">'.LAN_delete.' '.LAN_skills.'</a></li>
							<li><a class="tab" href="delete_skillbar.php?character=' . $GET_CHARACTER_NO . '&character_name=' . $GET_CHARACTER_NAME . '">'.LAN_delete.' '.LAN_skillbar.'</a></li>
							<li><a class="tab" href="send_message_character.php?character=' . $GET_CHARACTER_NO . '&character_name=' . $GET_CHARACTER_NAME . '">'.LAN_send.' '.LAN_message.'</a></li>
							<li><a class="tab" href="send_item_basic.php?character=' . $GET_CHARACTER_NO . '&character_name=' . $GET_CHARACTER_NAME . '">'.LAN_send.' '.LAN_item.'</a></li>
							<li><a class="tab" href="send_armor.php?character=' . $GET_CHARACTER_NO . '&character_name=' . $GET_CHARACTER_NAME . '">'.LAN_send.' '.LAN_armor.'</a></li>
							<li><a class="tab" href="send_weapon.php?character=' . $GET_CHARACTER_NO . '&character_name=' . $GET_CHARACTER_NAME . '">'.LAN_send.' '.LAN_weapon.'</a></li>
							<li><a class="tab" href="teleport.php?character=' . $GET_CHARACTER_NO . '&character_name=' . $GET_CHARACTER_NAME . '">'.LAN_teleport.' '.LAN_character.'</a></li>
							<li><a class="tab" href="view_map.php?character=' . $GET_CHARACTER_NO . '&character_name=' . $GET_CHARACTER_NAME . '">'.LAN_view.' '.LAN_map.' '.LAN_location.'</a></li>
							<li><a class="tab" href="view_retmap.php?character=' . $GET_CHARACTER_NO . '&character_name=' . $GET_CHARACTER_NAME . '">'.LAN_view.' '.LAN_return.' '.LAN_map.' '.LAN_location.'</a></li>
						</ul>
					</td>
				</tr>
			</table>';

}
else
{

	echo LAN_search_no_method;
	die();
}


echo FOOTER;
?>
