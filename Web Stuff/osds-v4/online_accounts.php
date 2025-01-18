<?php
include "header.php"; 

// -----------------------------------
// Get all info
// -----------------------------------
$setLogin = "1100";
$query1 = $db->query('SELECT * FROM account.dbo.user_profile WHERE login_flag = '.$setLogin.' ');


echo '
<article>
	<h1>Online Accounts</h1>
	<div class="statistics">
		<hr>
		<table>';
				
		if (empty($s))
		{
		 $s = 0;
		}
	
		// begin to show results set
		$count = 1 + $s;

			
		while ($getOnlineAccountInfo = $db->fetchArray($query1))
		{
				$query2 = $db->query('SELECT * FROM character.dbo.user_character WHERE user_no = '.$getOnlineAccountInfo['user_no'].' ');
				$getCharacterNameNum = $db->fetchNum($query2);


				echo '<tr>
						<td align="left" width="70%">
						' . $getOnlineAccountInfo['user_id'] . '
						<small> ( ' . $getCharacterNameNum . ' )</small>
					</td>
					<td align="right" width="30%">
					
						<form class="uniform" name="navigation'.$count.'">
							<select class="small2" name="select'.$count.'" onchange="location.href=navigation'.$count.'.select'.$count.'.options[selectedIndex].value" >
									<option value="">Select action</option>
								<optgroup label="Account">
									<option value="edit_account.php?account=' . $getOnlineAccountInfo['user_no'] . '">Edit Account</option>
									<option value="warn_account.php?account=' . $getOnlineAccountInfo['user_no'] . '">Warn Account</option>
									<option value="ban_account.php?account=' . $getOnlineAccountInfo['user_no'] . '">Ban Account</option>
									<option value="delete_account.php?account=' . $getOnlineAccountInfo['user_no'] . '">Delete Account</option>
									<option value="email.php?account=' . $getOnlineAccountInfo['user_no'] . '">Email Account</option>
									<option value="disconnect.php?account=' . $getOnlineAccountInfo['user_id'] . '">Disconnect</option>
								</optgroup>	';
								
								if (!$getCharacterNameNum == 0)
								{
									echo '<optgroup label="Character">';
									// lets make a loop for each char IF any found
									echo '<option value="view_characters.php?account=' . $getOnlineAccountInfo['user_no'] . '">View Characters</option>';										
									echo '</optgroup>';
								}
								echo ' 

								<optgroup label="Cash">
									<option value="edit_coins.php?account=' . $getOnlineAccountInfo['user_no'] . '">Edit Coins</option>
									<option value="view_coins_log.php?account=' . $getOnlineAccountInfo['user_no'] . '">View Coins Log</option>
								</optgroup>	
								
								
									
								
							</select>
						</form>				
					</td>
				  </tr>
				  <tr></tr>';
			$count++;
		}
		
	echo '</table>
	</div>	
	<div class="clear"></div>
</article>

<div class="information msg">
	<b>Information</b>
	<br>
	Account name ( Total Characters )
</div>';


include "footer.php"; 

?>
