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
// Post the new values
// -----------------------------------
if (isset($_POST['submit']))
{
	$insert_warning = $db->query('INSERT INTO account.dbo.user_warning (user_no, from_user_no, subject, message, warning_time, warning_time_detail) VALUES ("'.$GET_ACCOUNT_NO.'","'.$_SESSION['user_id'].'","'.$_POST['subject'].'","'.$_POST['message'].'","'.date("M d - H:i").'","'.time().'" ) ');

	if (isset($_POST['send_character']))
	{
		$query = $db->query("EXEC character.dbo.SP_POST_SEND_OP'".$_POST['send_character']."','".$_SESSION['user_id']."','1','".$_POST['subject']."','".$_POST['message']."','0','0','0'");
	}
	echo '<div class="success msg">The warning was successfully send!</div>';
	
}
// -----------------------------------
// Get all info
// -----------------------------------
$query1 = $db->query('SELECT * FROM account.dbo.user_profile WHERE user_no = '.$GET_ACCOUNT_NO.' ');
$getAccountInfo = $db->fetchArray($query1);

$query2 = $db->query('SELECT * FROM character.dbo.user_character WHERE user_no = '.$GET_ACCOUNT_NO.' ');
$getCharsNum= $db->fetchNum($query2);


if ($getAccountInfo['user_id'] == $_SESSION['user_id'])
{
	echo '<div class="error msg">You cannot give yourself a warning silly.</div>';
	include "footer.php";
	die();
}

if ($getCharsNum == 0)
{
	echo '<div class="warning msg">No characters found on this account!</div>';
}

// -----------------------------------
// Start HTML
// -----------------------------------
echo '
<article>
	<h1>Warn Account: ' . $getAccountInfo['user_id'] . '</h1>
    <form class="uniform" method="post">
		<dl class="inline">
			<dt><label>From</label></dt>
			<dd><input type="text" name="from" class="medium required" DISABLED size="50" value="' . $_SESSION['user_id'] . '" /></dd>
			
			<dt><label>Subject</label></dt>
			<dd><input type="text" name="subject" class="medium required"  size="50" /></dd>

			<dt><label>Additional Info</label></dt>
			<dd><textarea class="medium" name="message"></textarea></dd>
			
			<dt><label>Send Message to</label></dt>
			<dd>';
				if($getCharsNum == 0){
				
					echo 'No Characters Found!';
					
				} else {
				
					while($getChars = $db->fetchArray($query2)) {
					
						echo '<input type="radio" name="send_character" value="' . $getChars['character_no'] . '" />' . $getChars['character_name'] . '<br>';
						
					}
				}
				echo '	
			
		</dl>
		<div class="buttons">
			<button type="submit" name="submit" class="button">Submit</button>
		</div>
		<div class="information msg">
			This message will be send to the characters ingame inbox (or mailbox)
			<br>
			It can take up to 5 minutes to recive the message.
		</div>
	</form>
</article>';
include "footer.php";
?>
