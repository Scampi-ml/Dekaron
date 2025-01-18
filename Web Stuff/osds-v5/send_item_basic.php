<?php
include "osdscore.php";  
echo HEADER; 

$GET_CHARACTER_NO = $_GET['character'];

if ($GET_CHARACTER_NO == "")
{
	echo '<div class="error msg">Error getting character. Please try again.</div>';
}
$GET_CHARACTER_NAME = $_GET['character_name'];


// -----------------------------------
// Post the new values
// -----------------------------------
if (isset($_GET['senditem']))
{
	$db_character->query("EXEC SP_POST_SEND_OP '".$_GET['character_no']."','".$_SESSION['USER']."',1,'".$_GET['post_title']."','".$_GET['body_text']."','".$_GET['wIndex']."','".$_GET['include_dil']."',0");
	echo '<div class="success">'.LAN_send.'!</div>';
}

echo' 
<form method="get">
	<input type="hidden" name="character_no" value="'.$GET_CHARACTER_NO.'" > 
	<input type="hidden" name="character" value="'.$GET_CHARACTER_NO.'" > 
	<input type="hidden" name="character_name" value="'.$GET_CHARACTER_NAME.'" > 

	<div id="serverinfo">'.LAN_send.' '.LAN_item.' '.LAN_to.': ' . $GET_CHARACTER_NAME . '<span style="float:right;margin-top:-5px;"><input type="submit" value="'.LAN_send.'" name="senditem"></span></div>
		<div class="group" >
			<table>
				<tr class="even">
					<td style="width:300px;"><label>'.lcfirst(LAN_to).'</label></td>
					<td><input type="text" size="50" DISABLED value="' . $GET_CHARACTER_NAME . '"></td>
				</tr>
				<tr class="even">
					<td><label>'.LAN_from.'</label></td>
					<td><input name="from_char_nm" DISABLED size="50" type="text" value="' . $_SESSION['USER'] . '"></td>
				</tr>
				<tr class="even">
					<td><label>'.LAN_subject.'</label></td>
					<td><input name="post_title" size="50" type="text" value="'.LAN_sib_def_subject.'"></td>
				</tr>
				<tr class="even">
					<td><label>'.LAN_message.'</label></td>
					<td><textarea name="body_text" cols="45" rows="5" style="height: 100px;">'.LAN_sib_def_message.'</textarea></td>
				</tr>
				<tr class="even">
					<td><label>'.LAN_item.' '.LAN_id.'</label></td>
					<td><input name="wIndex" size="50" type="text" value="">
						<br>
						<div class="notice">'.LAN_sib_note.'</div>
					</td>
				</tr>
				<tr class="even">
					<td><label>'.LAN_sib_dil.'</label></td>
					<td><input name="include_dil" size="50" type="text" value="0"></td>
					
				</tr>
		</table>
	</div>
</form>';
			
echo FOOTER;

?>
