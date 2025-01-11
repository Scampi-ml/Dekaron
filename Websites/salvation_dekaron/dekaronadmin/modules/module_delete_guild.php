<?php
if (isset($_POST) && !empty($_POST))
{
	$db->SQLquery("DELETE FROM character.dbo.guild_info WHERE guild_code = '%s'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_CHAR_INFO WHERE guild_code = '%s'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '0'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '1'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '2'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '3'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '4'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '5'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '6'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '7'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '8'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '9'", $_POST['guild_code']);
	
	$POST = notice_message_admin('Guild successfully deleted', '1', '0', 'index.php?get=module_search_guild');
}
else
{
	
	$SQLquery1 = $db->SQLquery("SELECT guild_name,guild_code FROM character.dbo.guild_info WHERE guild_code = '".$_GET['guild']."' ");
	$getGuildInfo = $db->SQLfetchArray($SQLquery1);
	$smarty->assign("guild_name", $getGuildInfo['guild_name']); 
	$smarty->assign("guild_code", $getGuildInfo['guild_code']); 	
}
?>