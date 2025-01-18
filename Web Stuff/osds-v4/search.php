<?php include "header.php"; 


$search_string = $_POST['what'];

if ($search_string == "")
{
	echo '<div class="error msg">You must enter something to search by. Please try again.</div>';
	include "footer.php";
	die();
}
	
// This can be better, but i works, so why change it ?
// => IF you want to add a other option just add it
// => see sidebar.php for search box
// => $_POST var is "what"
// => Hos is "method" 
if ($_POST['method'] == "account" ) // Search for Username
{
	$method = 1;
	$method_name = $_POST['method'];
	$query = $db->query('SELECT * FROM account.dbo.user_profile WHERE user_id LIKE "%' . $search_string . '%" '); 
}
elseif ($_POST['method'] == "character" ) // Search for User No
{
	$method = 2;
	$method_name = $_POST['method'];
	$query = $db->query('SELECT * FROM character.dbo.user_character WHERE character_name LIKE "%' . $search_string . '%" ');
}
else 
{
	echo '<div class="error msg">No method selected! Please try again.</div>';
	include "footer.php";
	die();
}

$results = $db->fetchNum($query);
if ($results == 0)
{
	echo '<div class="error msg">Sorry, your search: &quot;' . $search_string . '&quot; returned no results. Please try again.</div>';
	include "footer.php";
	die();
}

// next determine if s has been passed to script, if not use 0
if (empty($s))
{
 $s = 0;
}

// begin to show results set
$count = 1 + $s;


echo'
<article>
	<h1>Search</h1>';
				
	
	echo "<div class='statistics'>";
	echo '<h4>You searched for ' . $method_name . ': &quot;' . $search_string . '&quot;</h4>';
	echo '<hr>';
	echo '<table>';
	
	if($method == 1) // account 
	{
		while ($result = $db->fetchArray($query))
		{
			$query2 = $db->query('SELECT * FROM character.dbo.user_character WHERE user_no = "'.$result['user_no'].'" ');
			$getCharacterNum = $db->fetchNum($query2);

			echo '<tr>
					<td align="left" width="70%">' . $result['user_id'] . '</td>
					<td align="right" width="30%">
						<form class="uniform" name="navigation'.$count.'">
							<select class="small2" name="select'.$count.'" onchange="location.href=navigation'.$count.'.select'.$count.'.options[selectedIndex].value" >
									<option value="">Select action</option>
								<optgroup label="Account">
									<option value="edit_account.php?account=' . $result['user_no'] . '">Edit Account</option>
									<option value="warn_account.php?account=' . $result['user_no'] . '">Warn Account</option>
									<option value="ban_account.php?account=' . $result['user_no'] . '">Ban Account</option>
									<option value="delete_account.php?account=' . $result['user_no'] . '">Delete Account</option>
									<option value="email.php?account=' . $result['user_no'] . '">Email Account</option>
									<option value="disconnect.php?account=' . $result['user_id'] . '">Disconnect</option>
									<option value="edit_coins.php?account=' . $result['user_no'] . '">Edit Coins</option>
									<option value="view_coins_log.php?account=' . $result['user_no'] . '">View Coins Log</option>
								</optgroup>';
								
								if (!$getCharacterNum == 0)
								{
									echo '<optgroup label="Character">';
									// lets make a loop for each char IF any found
									echo '<option value="view_characters.php?account=' . $result['user_no'] . '">View Characters</option>';										
									echo '</optgroup>';
								}
								echo '
								<optgroup label="Cash">
									<option value="edit_coins.php?account=' . $result['user_no'] . '">Edit Coins</option>
									<option value="view_coins_log.php?account=' . $result['user_no'] . '">View Coins Log</option>
								</optgroup>
								
							</select>
						</form>
					</td>
				  </tr>
				  <tr></tr>';
			$count++;
		}
	}
	elseif ($method == 2) // character
	{
		while ($result = $db->fetchArray($query))
		{
			$query3 = $db->query('SELECT * FROM account.dbo.user_profile WHERE user_no = '.$result['user_no'].' ');
			$getAccount = $db->fetchArray($query3);

			echo '<tr>
					<td align="left" width="80%">' . $result['character_name'] . '</td>
					<td align="right" width="20%">
						<form  class="uniform " name="navigation'.$count.'">
							<select class="small2" name="select'.$count.'" onchange="location.href=navigation'.$count.'.select'.$count.'.options[selectedIndex].value" >
									<option value="">Select action</option>
									<optgroup label="Account">
									<option value="edit_account.php?account=' . $getAccount['user_no'] . '">Edit Account</option>
									<option value="warn_account.php?account=' . $getAccount['user_no'] . '">Warn Account</option>
									<option value="ban_account.php?account=' . $getAccount['user_no'] . '">Ban Account</option>
									<option value="delete_account.php?account=' . $getAccount['user_no'] . '">Delete Account</option>
									<option value="email.php?account=' . $getAccount['user_no'] . '">Email Account</option>
									<option value="disconnect.php?account=' . $getAccount['user_id'] . '">Disconnect</option>
								</optgroup>

								<optgroup label="Character">
									<option value="edit_character.php?character=' . $result['character_no'] . '">Edit Character</option>
									<option value="warn_character.php?character=' . $result['character_no'] . '">Ban Character</option>
									<option value="delete_character.php?character=' . $result['character_no'] . '">Delete Character</option>
									<option value="">Change Class (UNDER CONTSR.)</option>
									<option value="">Show Mailbox (UNDER CONTSR.)</option>
									<option value="msg_character.php?character=' . $result['character_no'] . '">Send Inbox Message</option>
									<option value="edit_inventory.php?character=' . $result['character_no'] . '">View Items (Inventory)</option>
									<option value="edit_storage.php?character=' . $result['character_no'] . '">View Items (Storage)</option>
									<option value="edit_store.php?character=' . $result['character_no'] . '">View Items (Shop)</option>
								</optgroup>						
								
								<optgroup label="Cash">
									<option value="edit_coins.php?account=' . $getAccount['user_no'] . '">Edit Coins</option>
									<option value="view_coins_log.php?account=' . $getAccount['user_no'] . '">View Coins Log</option>
								</optgroup>

							</select>
						</form>
					</td>
				  </tr>
				  <tr></tr>';
			$count++;
		}
	} else {	
	
		echo '<div class="error msg">Error selecting method. Please try again.</div>';
		echo '</article>';
		include "footer.php";
		die();
	
	}
	echo '		
		</table>
	</div>
	<div class="clear"></div>
</article>';
include "footer.php"; 

?>