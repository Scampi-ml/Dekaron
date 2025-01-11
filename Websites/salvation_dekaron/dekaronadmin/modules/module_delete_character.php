<?php
if (isset($_POST) && !empty($_POST))
{
	$db->SQLquery("DELETE FROM character.dbo.user_character WHERE character_no = '%s'", $_POST['character']);
	$db->SQLquery("DELETE FROM character.dbo.User_Quest_Done WHERE character_no = '%s'", $_POST['character']);
	$db->SQLquery("DELETE FROM character.dbo.User_Quest_Doing WHERE character_no = '%s'", $_POST['character']);
	$db->SQLquery("DELETE FROM character.dbo.user_bag WHERE character_no = '%s'", $_POST['character']);
	$db->SQLquery("DELETE FROM character.dbo.USER_POSTBOX WHERE character_no = '%s'", $_POST['character']);
	$db->SQLquery("DELETE FROM character.dbo.user_storage WHERE character_no = '%s'", $_POST['character']);
	$db->SQLquery("DELETE FROM character.dbo.user_skill WHERE character_no = '%s'", $_POST['character']);
	$db->SQLquery("DELETE FROM character.dbo.user_slot WHERE character_no = '%s'", $_POST['character']);
	$db->SQLquery("DELETE FROM character.dbo.user_storage WHERE character_no = '%s'", $_POST['character']);
	$db->SQLquery("DELETE FROM character.dbo.user_suit WHERE character_no = '%s'", $_POST['character']);
	$POST = notice_message_admin('Character successfully deleted', '1', '0', 'index.php?get=module_search_character');
}
else
{
	
	$SQLquery1 = $db->SQLquery("SELECT character_no,character_name FROM character.dbo.user_character WHERE character_no = '%s'", $_GET['character']);
	$getCharacterInfo = $db->SQLfetchArray($SQLquery1);
	
	$smarty->assign("character_name", $getCharacterInfo['character_name']); 
	$smarty->assign("character_no", $getCharacterInfo['character_no']); 
}
?>