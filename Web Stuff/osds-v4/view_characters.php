<?php include "header.php"; 

// -----------------------------------
// Get the account
// ----------------------------------- 
$GET_ACCOUNT_NO = $_GET['account'];

// -----------------------------------
// Do we have a account no ?
// -----------------------------------
if ($GET_ACCOUNT_NO == "")
{
	echo '<div class="error msg">Error getting account. Please try again.</div>';
	include "footer.php";
	die();
}

// -----------------------------------
// Get all info
// -----------------------------------
$query1 = $db->query('SELECT * FROM account.dbo.user_profile WHERE user_no = '.$GET_ACCOUNT_NO.' ');
$getAccountInfo = $db->fetchArray($query1);

$query2 = $db->query('SELECT * FROM character.dbo.user_character WHERE user_no = '.$GET_ACCOUNT_NO.' ');
$getCharsNum= $db->fetchNum($query2);

if ($getCharsNum == 0)
{
	echo '<div class="error msg">Error getting characters. No characters found on this account!</div>';
	include "footer.php";
	die();
}

// -----------------------------------
// Start HTML
// -----------------------------------
echo '
<article>
	<h1>Characters on: ' . $getAccountInfo['user_id'] . '</h1>
		<div class="statistics">
			<hr>
		<table>';
		
			if (empty($s))
			{
			 $s = 0;
			}
		
			// begin to show results set
			$count = 1 + $s;
	
				
			while ($getCharacterInfo = $db->fetchArray($query2))
			{
					echo '<tr>
						<td align="left" width="70%">' . $getCharacterInfo['character_name'] . '</td>
						<td align="right" width="30%">
							<form class="uniform" name="navigation'.$count.'">
								<select class="small2" name="select'.$count.'" onchange="location.href=navigation'.$count.'.select'.$count.'.options[selectedIndex].value" >
										<option value="">Select Action</option>
									<optgroup label="Character">
										<option value="edit_character.php?character=' . $getCharacterInfo['character_no'] . '">Edit character</option>
										<option value="msg_character.php?character=' . $getCharacterInfo['character_no'] . '">Send message to character</option>
										<option value="">Change Class (UNDER CONTSR.)</option>
										<option value="">Show Mailbox (UNDER CONTSR.)</option>
										<option value="msg_character.php?character=' . $getCharacterInfo['character_no'] . '">Send Inbox Message</option>
										<option value="edit_inventory.php?character=' . $getCharacterInfo['character_no'] . '">View Items (Inventory)(UNDER CONTSR.)</option>
										<option value="edit_storage.php?character=' . $getCharacterInfo['character_no'] . '">View Items (Storage)(UNDER CONTSR.)</option>
										<option value="edit_store.php?character=' . $getCharacterInfo['character_no'] . '">View Items (Shop)(UNDER CONTSR.)</option>
									</optgroup>
								</select>
							</form>				
						</td>
					  </tr>
					  <tr></tr>';
				$count++;
			}
	echo '
	
		</table>
		</div>		
	<div class="clear"></div>
</article>';

include "footer.php"; 

?>
