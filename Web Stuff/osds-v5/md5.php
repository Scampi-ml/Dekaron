<?php
include "osdscore.php"; 
echo HEADER;

// -----------------------------------
// Get the account
// ----------------------------------- 
$GET_ACCOUNT_NO = $_GET['account'];

// -----------------------------------
// -----------------------------------
// Post the new values
// -----------------------------------
if (isset($_POST['submit']))
{
	$new_md5_pass = md5($_POST['password']);
	$java_message = LAN_md5_message .': '.$_POST['password'].'\n\n';
	
	JavaAlert($java_message, 'edit_account.php?account=' . $GET_ACCOUNT_NO . '&md5='.$new_md5_pass.'');
}


// -----------------------------------
// Start HTML
// -----------------------------------
echo' 
	<form class="uniform" method="post">
		<fieldset>
			<legend>'.LAN_new.' '.LAN_password.'</legend>
				<table>	
					<tr>		
						<td><label>'.LAN_new.' '.LAN_password.'</label></td>
						<td><input type="text" name="password" class="medium" size="50" maxlength="50" /></td>
					</tr>
				</table>
				<br>
				<input type="submit" name="submit" value="'.LAN_new.' '.LAN_password.'" />
				<br>
		</fieldset>
	</form>';
			
echo FOOTER;
?>
