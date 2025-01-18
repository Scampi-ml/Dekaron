<?php
include "osdscore.php";  
echo HEADER; 

$GET_CHARACTER_NO = $_GET['character'];

if ($GET_CHARACTER_NO == "")
{
	echo '<div class="error msg">Error getting character. Please try again.</div>';
	include "footer.php";
	die();
}
$GET_CHARACTER_NAME = $_GET['character_name'];


// -----------------------------------
// Post the new values
// -----------------------------------
if (isset($_POST['submit']))
{
	$db_character->query("EXEC SP_POST_SEND_OP '".$_POST['character_no']."','".$_POST['from_char_nm']."',1,'".$_POST['post_title']."','".$_POST['body_text']."','".$_POST['wIndex']."',0,0");
	echo '<div class="success msg">Item has been send!</div>';
}

// -----------------------------------
// Get all info
// -----------------------------------
$query1 = $db_character->query('SELECT * FROM user_character');

// -----------------------------------
// Start HTML
// -----------------------------------
echo' 
<article>
	<h1>Send Item (Basic)</h1>
	<form class="uniform" method="post">
		<dl class="inline">
			<fieldset>
				<dt><label>Character</label></dt>
				<dd>
					<select class="medium" name="character_no" >';
					
						while ($getCharacters = $db->fetchArray($query1))
						{
							echo "<option value=" . $getCharacters['character_no'] . ">" . $getCharacters['character_name'] . "</option>";
						}
			
				echo '</select>
				</dd>

				<dt><label>Your Name</label></dt>
				<dd><input name="from_char_nm" type="text" class="required medium" id="from_char_nm" value="' . $_SESSION['user_id'] . '"></dd>
				
				<dt><label>Subject</label></dt>
				<dd><input name="post_title" type="text" class="required medium" id="post_title" value="Item for you"></dd>
				
				<dt><label>Message</label></dt>
				<dd><textarea name="body_text" class="medium">A GM send a item for you.</textarea></dd>

				<dt><label>Item ID</label></dt>
				<dd><input name="wIndex" type="text" class="required medium" id="wIndex"></dd>
			</dl>
			<div class="buttons"><button type="submit" name="submit" class="button">Submit</button></div>
		</fieldset>
	</form>
</article>
<div class="information msg">This form does not check if the Item ID even exists, so plase pay attention to that!</div>
';
			
include "footer.php";

?>
