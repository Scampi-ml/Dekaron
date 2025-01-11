<?php

$pvpl_top3_tpl = '';
$rank_pvpl_top3 = '1';

$query_pvpl_top3 = $db->SQLquery('SELECT TOP 3 character_name,wWinRecord,wLoseRecord,byPCClass FROM character.dbo.user_character WHERE character_name NOT LIKE "[[]%]%" ORDER BY wLoseRecord DESC ');
while($array_pvpl_top3 = $db->SQLfetchArray($query_pvpl_top3))
{
	$pvpl_top3_tpl .= '<div class="span4">';
	$pvpl_top3_tpl .= '<table width="100" class="table table-striped">';
	$pvpl_top3_tpl .= '<tr>';
	$pvpl_top3_tpl .= '<td align="center"><img src="./img/class/'.$array_pvpl_top3['byPCClass'].'.png" /></td>';
	
	if($rank_pvpl_top3 == '1')
	{
		$pvpl_top3_tpl .=  '<td align="center"><b><font color="red" size="3">'.$array_pvpl_top3['character_name'].'</font></b><br>'.$array_pvpl_top3['wLoseRecord'].' losses</td>';	
	}
	elseif($rank_pvpl_top3 == '2')
	{
		$pvpl_top3_tpl .=  '<td align="center"><b><font color="blue" size="3">'.$array_pvpl_top3['character_name'].'</font></b><br>'.$array_pvpl_top3['wLoseRecord'].' losses</td>';
	}
	else
	{
		$pvpl_top3_tpl .=  '<td align="center"><b><font color="green" size="3">'.$array_pvpl_top3['character_name'].'</b></font><br>'.$array_pvpl_top3['wLoseRecord'].' losses</td>';
	}							


	$pvpl_top3_tpl .=  '</tr>';
	$pvpl_top3_tpl .=  '</table>';
	$pvpl_top3_tpl .=  '</div>';
	$rank_pvpl_top3++;
}
$db->addfile('top_3_pvp_lose.cache', $pvpl_top3_tpl);
?>