<?php
$query_siege_win1 = $db->SQLquery("SELECT * FROM character.dbo.SIEGE_INFO WHERE CHANNEL_NO = '1' AND SIEGE_TAG = 'Y'");
$array_siege_win1 = $db->SQLfetchArray($query_siege_win1);
$db->addfile('siege_win_name.cache', $array_siege_win1['GUILD_NAME']);

$query_siege_win2 = $db->SQLquery("SELECT * FROM character.dbo.SIEGE_RESULT_LOG WHERE SIEGE_NO = '".$array_siege_win1['SIEGE_NO']."' ");
$array_siege_win2 = $db->SQLfetchArray($query_siege_win2);
$db->addfile('siege_win_master.cache', $array_siege_win2['GUILD_MASTER']);

$query_siege_win3 = $db->SQLquery("SELECT * FROM character.dbo.guild_info WHERE guild_code = '".$array_siege_win2['GUILD_CODE']."'");
$array_siege_win3 = $db->SQLfetchArray($query_siege_win3);
$db->addfile('siege_win_mark1.cache', $array_siege_win3['guild_mark1']);
$db->addfile('siege_win_mark2.cache', $array_siege_win3['guild_mark2']);
?>