<?php
include "header.php";   

// -----------------------------------
// Get the character
// ----------------------------------- 
$GET_CHARACTER_NO = $_GET['character'];

// -----------------------------------
// Do we have a character no ?
// -----------------------------------
if ($GET_CHARACTER_NO == "")
{
	echo '<div class="error msg">Error getting character. Please try again.</div>';
	include "footer.php";
	die();
}

// -----------------------------------
// Get all info
// -----------------------------------
$query2 = $db->query('SELECT * FROM character.dbo.user_character WHERE character_no = "'.$GET_CHARACTER_NO.'" ');
$getCharsNum= $db->fetchNum($query2);
$getCharacterInfo = $db->fetchArray($query2);


if ($getCharsNum == 0)
{
	echo '<div class="error msg">Error getting character. No characters found on this account!</div>';
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
				<dd><input type="text" DISABLED name="character" value="' . $getCharacterInfo['character_name'] . '" /></dd>
				
				<dt><label>Your Name</label></dt>
				<dd><input type="text" name="from" class="medium"  size="50" value="' . $_SESSION['user_id'] . '" /></dd>
				
				<dt><label>Subject</label></dt>
				<dd><input type="text" name="subject" class="medium"  size="50" /></dd>

				<dt><label>Messages</label></dt>
				<dd><textarea name="message" class="medium"></textarea></dd>
			</dl>
		</fieldset>
		<div class="buttons">
			<button type="submit" class="button">Submit</button>
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