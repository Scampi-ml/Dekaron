<?php
if (isset($_POST) && !empty($_POST))
{
	include("engine/array_teleport.php");
	$map_id = $array_teleport[$_POST['tele_map']][0];
	$map_x = $array_teleport[$_POST['tele_map']][2];
	$map_y = $array_teleport[$_POST['tele_map']][3];

	$db->SQLquery("UPDATE character.dbo.user_character SET wMapIndex = '%s', wPosX = '%s', wPosY = '%s' WHERE character_no = '%s' ", $map_id, $map_x, $map_y, $_POST['character']);
	$POST = notice_message_admin('Character successfully teleported', '1', '0', 'index.php?get=module_teleport_character');
}
else
{
	include("engine/array_teleport.php");
	
	$mapcount_data = "";
	$mapcount = count($array_teleport);
	$i = '0';
	for($i >= '0';$i < $mapcount;)
	{
		$mapcount_data .= "<option value='".$i."'>".$array_teleport[$i][1]."</option>";
		$i++;
	}
	
	$smarty->assign("mapcount_data", $mapcount_data);
	$smarty->assign("character", $_GET['character']);

}
?>