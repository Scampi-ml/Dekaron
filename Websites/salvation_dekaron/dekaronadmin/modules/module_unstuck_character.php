<?php
if (isset($_POST) && !empty($_POST))
{
	$unstuck_map = $config->get('map', 'settings_unstuck_character');
	$unstuck_wposx = $config->get('wposx', 'settings_unstuck_character');
	$unstuck_wposy = $config->get('wposy', 'settings_unstuck_character');
	
	$db->SQLquery("UPDATE character.dbo.user_character SET wMapIndex = '%s', wPosX = '%s', wPosY = '%s' WHERE character_no = '%s' ", $unstuck_map, $unstuck_wposx, $unstuck_wposy, $_POST['character']);
	$POST = notice_message_admin('Character is not stuck anymore', '1', '0', 'index.php?get=module_search_character');
}
else
{
	$smarty->assign("character",  $_GET['character']);
}
?>