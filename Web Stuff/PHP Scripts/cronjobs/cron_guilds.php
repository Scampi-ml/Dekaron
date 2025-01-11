<?php

$guilds_tpl = '';
$query_guilds = $db->SQLquery("SELECT * FROM character.dbo.guild_info");
while($guild_array = $db->SQLfetchArray($query_guilds))
{
	if($guild_array['guild_name'] == 'MASTERCODE')
	{
		continue;
	}

	$guilds_tpl .= '<tr>';
	$guilds_tpl .= '<td >'.$guild_array['guild_name'].'</td>';
	$guilds_tpl .= '<td align="center">'.$guild_array['guild_Level'].'</td>';
	$guilds_tpl .= '<td align="center"><img src="emblem/emblem.php?cbg='.$guild_array['guild_mark2'].'&cemblem='.$guild_array['guild_mark1'].'"  height="30" width="30" /></td>';
	$guilds_tpl .= '</tr>';
}
$db->addfile('guilds.cache', $guilds_tpl);
?>