<?php

$query_stats1 = $db->SQLquery("SELECT character_no FROM character.dbo.user_character");
$array_stats1 = $db->SQLfetchNum($query_stats1);
$db->addfile('stats_chars.cache', $array_stats1);


$query_stats2 = $db->SQLquery("SELECT user_id FROM account.dbo.user_profile");
$array_stats2 = $db->SQLfetchNum($query_stats2);
$db->addfile('stats_accs.cache', $array_stats2);


$query_stats3 = $db->SQLquery("SELECT user_id FROM account.dbo.user_profile WHERE login_flag = '1100' ");
$array_stats3 = $db->SQLfetchNum($query_stats3);
$db->addfile('stats_online.cache', $array_stats3);


$query_stats4 = $db->SQLquery("SELECT user_id FROM account.dbo.user_profile WHERE login_tag = 'N' ");
$array_stats4 = $db->SQLfetchNum($query_stats4);
$db->addfile('stats_banned.cache', $array_stats4);


$query_stats5 = $db->SQLquery("SELECT guild_code FROM character.dbo.guild_info ");
$array_stats5 = $db->SQLfetchNum($query_stats5);
$db->addfile('stats_guild.cache', $array_stats5);



?>