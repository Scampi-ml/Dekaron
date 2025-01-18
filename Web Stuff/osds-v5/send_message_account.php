<?php 
include "osdscore.php";

// -----------------------------------
// Get all info
// -----------------------------------
$query1 = $db->query('SELECT * FROM user_profile ');

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
	if(!create_message)
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
<article>
	<h1>Send message</h1>
	<form class="uniform" method="post">
		<fieldset>
			<dl class="inline">
				<dt><label>Send Message to</label></dt>
					<dd><select name="user_no" class="medium" size="1"> ';

						while ($row = mssql_fetch_array($query1))
						{
							echo "<option value=" . $row['user_no'] . ">" . $row['user_id'] . "</option>";
						}

					echo '	

				</select></dd>
				
				<dt><label>Your Name</label></dt>
				<dd><input type="text" name="from_user_no" class="medium" DISABLED  size="50" value="' . $_SESSION['user_id'] . '" /></dd>
				
				<dt><label>Subject</label></dt>
				<dd><input type="text" name="subject" class="medium"  size="50" /></dd>

				<dt><label>Messages</label></dt>
				<dd><textarea name="message" cols="80" rows="10"></textarea></dd>
			</dl>
		</fieldset>
		<div class="buttons">
			<button type="submit" name="submit" class="button">Submit</button>
		</div>
	</form>

</article>
<div class="information msg">
	This message will be send to the inbox of OSDS Message System.
	<br>
	Ingame Characters will nog be able to read this!
</div>


';
			
include "footer.php";

?>