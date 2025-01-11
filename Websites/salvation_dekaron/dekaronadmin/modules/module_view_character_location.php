<?php
$SQLquery1 = $db->SQLquery("SELECT character_no,character_name,wPosX,wPosY,wMapIndex FROM character.dbo.user_character WHERE character_no = '%s'", $_GET['character']);
$getCharacterInfo = $db->SQLfetchArray($SQLquery1);

require_once ('engine/array_map.php');
require_once ('engine/array_map_img.php');

$smarty->assign("character_name", $getCharacterInfo['character_name']);
$smarty->assign("character_no", $getCharacterInfo['character_no']);
$smarty->assign("wPosX", $getCharacterInfo['wPosX']]);
$smarty->assign("wPosY", $getCharacterInfo['wPosY']);
$smarty->assign("color", $config->get('color', 'settings_view_character_location'));
$smarty->assign("pointer", $config->get('pointer', 'settings_view_character_location'));
$smarty->assign("img", $array_map_img[$getCharacterInfo['wMapIndex']]);
$smarty->assign("wMapIndex", $getCharacterInfo['wMapIndex']);
$smarty->assign("wMapIndex2", $array_map[$getCharacterInfo['wMapIndex']]);
?>

