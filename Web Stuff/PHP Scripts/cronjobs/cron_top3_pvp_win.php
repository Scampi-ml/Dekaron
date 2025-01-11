<?php

$pvpw_top3_tpl = '';
$rank_pvpw_top3 = '1';

$query_pvpw_top3 = $db->SQLquery('SELECT TOP 3 character_name,wWinRecord,wLoseRecord,byPCClass FROM character.dbo.user_character WHERE character_name NOT LIKE "[[]%]%" ORDER BY wWinRecord DESC ');
while($array_pvpw_top3 = $db->SQLfetchArray($query_pvpw_top3))
{
	$pvpw_top3_tpl .= '<div class="span4">';
	$pvpw_top3_tpl .= '<table width="100" class="table table-striped">';
	$pvpw_top3_tpl .= '<tr>';
	$pvpw_top3_tpl .= '<td align="center"><img src="./img/class/'.$array_pvpw_top3['byPCClass'].'.png" /></td>';
	
	if($rank_pvpw_top3 == '1')
	{
		$pvpw_top3_tpl .=  '<td align="center"><b><font color="red" size="3">'.$array_pvpw_top3['character_name'].'</font></b><br>'.$array_pvpw_top3['wWinRecord'].' losses</td>';	
	}
	elseif($rank_pvpw_top3 == '2')
	{
		$pvpw_top3_tpl .=  '<td align="center"><b><font color="blue" size="3">'.$array_pvpw_top3['character_name'].'</font></b><br>'.$array_pvpw_top3['wWinRecord'].' losses</td>';
	}
	else
	{
		$pvpw_top3_tpl .=  '<td align="center"><b><font color="green" size="3">'.$array_pvpw_top3['character_name'].'</b></font><br>'.$array_pvpw_top3['wWinRecord'].' losses</td>';
	}							


	$pvpw_top3_tpl .=  '</tr>';
	$pvpw_top3_tpl .=  '</table>';
	$pvpw_top3_tpl .=  '</div>';
	$rank_pvpw_top3++;
}
$db->addfile('top_3_pvp_win.cache', $pvpw_top3_tpl);
?>