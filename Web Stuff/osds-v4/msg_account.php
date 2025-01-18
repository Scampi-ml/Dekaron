<?php
include "header.php";   

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
$getCharacterInfo = $db->fetchArray($query2);


if ($getCharsNum == 0)
{
	echo '<div class="error msg">Error getting character. No characters found on this account!</div>';
	include "footer.php";
	die();
}


if ($GET_ACCOUNT_NO == $_SESSION['user_id'])
{
	echo '<div class="error msg">You cannot send a message to yourself silly.</div>';
	include "footer.php";
	die();
}

// -----------------------------------
// Post the new values
// -----------------------------------
if (isset($_POST['submit']))
{
	$query = $db->query("EXEC character.dbo.SP_POST_SEND_OP'".$_POST['character']."','".$_POST['from']."','1','".$_POST['subject']."','".$_POST['message']."','0','0','0'");
	echo '<div class="success msg">The message was successfully send!</div>';
}

// -----------------------------------
// Start HTML
// -----------------------------------
echo' 
<article>
	<h1>Send message</h1>
	<form class="uniform" method="post">
		<fieldset>
			<dl class="inline">
				<dt><label>Send Message to</label></dt>
					<dd>';
						while($getChars = $db->fetchArray($query2))
						{
							echo '<input type="radio" name="character" value="' . $getChars['character_no'] . '" />' . $getChars['character_name'] . '<br>';
						}
					echo '	

				</dd>
				
				<dt><label>Your Name</label></dt>
				<dd><input type="text" name="from" class="medium"  size="50" value="' . $_SESSION['user_id'] . '" /></dd>
				
				<dt><label>Subject</label></dt>
				<dd><input type="text" name="subject" class="medium"  size="50" /></dd>

				<dt><label>Messages</label></dt>
				<dd><textarea name="message" class="medium"></textarea></dd>
			</dl>
		</fieldset>
		<div class="buttons">
			<button type="submit" name="submit" class="button">Submit</button>
		</div>
	</form>
	<div class="information msg">
		This message will be send to the characters ingame inbox (or mailbox)
		<br>
		It can take up to 5 minutes to recive the message.
	</div>

</article>';
			
include "footer.php";

?>