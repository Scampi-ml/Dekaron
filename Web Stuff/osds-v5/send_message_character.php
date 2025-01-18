<?php 
include "osdscore.php";
echo HEADER;

// -----------------------------------
// Get the chararacter
// ----------------------------------- 
$GET_CHARACTER_NO = $_GET['character'];
$GET_CHARACTER_NAME = $_GET['character_name'];


// -----------------------------------
// Do we have a charater no ?
// -----------------------------------
if ($GET_CHARACTER_NO == "")
{
	echo '<div class="error msg">Error getting character. Please try again.</div>';
	die();
}

// -----------------------------------
// Post the new values
// -----------------------------------
if (isset($_POST['submit']))
{
	$user_no = $_POST['user_no'];
	$from_user_no = $_SESSION['user_no'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	$viewed = 0;
	$inbox_time = date("M d - H:i");
	$inbox_time_detail = time();;

	$create_message = $db->query('INSERT INTO account.dbo.inbox 
	
		(user_no, from_user_no, subject, message, viewed, inbox_time, inbox_time_detail) 
	
	VALUES 
	
		("'.$user_no.'", "'.$from_user_no.'", "'.$subject.'", "'.$message.'", "'.$viewed.'", "'.$inbox_time.'", "'.$inbox_time_detail.'") 
		
	');
	if(!$create_message)
	{
		echo '<div class="error msg">ERROR! Message not send!</div>';
	} else {
		echo '<div class="success msg">Message send!</div>';
	}
}

// -----------------------------------
// Start HTML
// -----------------------------------
echo' 
<form method="post">
NOT FINISHED
	<div id="serverinfo">Send message to: ' . $GET_CHARACTER_NAME . '<span style="float:right;margin-top:-5px;"><input type="submit" value="Send Message" name="sendmessage"></span></div>
	<div class="group">
		<table>
			<tr class="even">
				<td style="width:200px;"><label>To</label></td>
				<td><input type="text" name="character_name" DISABLED size="50" value="'.$GET_CHARACTER_NAME.'" /></td>
			</tr>
			<tr class="even">
				<td><label>From</label></td>
				<td><input type="text" name="character_name" DISABLED size="50" value="'.$_SESSION['USER'].'" /></td>
			</tr>
			<tr class="even">
				<td><label>Subject</label></dt>
				<td><input type="text" name="free_amount" size="50" value="" /></td>
			</tr>
			
			<tr class="even">
				<td><label>Message</label></dt>
				<td><textarea name="message" cols="70" rows="5"></textarea></td>
			</tr>

		</table>
	</div>
</form>';
	
	
echo FOOTER;

?>