<?php

$pk_top3_tpl = '';
$rank_pk_top3 = '1';

$query_pk_top3 = $db->SQLquery('SELECT TOP 50 character_name,wPKCount,byPCClass FROM character.dbo.user_character WHERE character_name NOT LIKE "[[]%]%" ORDER BY wPKCount DESC ');
while($pk_array_top3 = $db->SQLfetchArray($query_pk_top3))
{

	if($rank_pk_top3 == '1')
	{
		$rank_pk_top3 ++;
		continue;
	}
	if($rank_pk_top3 == '2')
	{
		$rank_pk_top3 ++;
		continue;
	}
	if($rank_pk_top3 == '3')
	{
		$rank_pk_top3 ++;
		continue;
	}
	
	$pk_top3_tpl .= "<tr>";
	$pk_top3_tpl .=  '<td align="center">'.$rank_pk_top3.'</td>';
	$pk_top3_tpl .=  '<td><a style="color: #000;" href="#">'.$pk_array_top3['character_name'].'</a></td>';
	$pk_top3_tpl .=  '<td align="center">'.charclass($pk_array_top3['byPCClass']).'</td>';
	$pk_top3_tpl .=  '<td align="center">'.$pk_array_top3['wPKCount'].'</td>';
	$pk_top3_tpl .=  "</tr>";
	
	$rank_pk_top3 ++;
}

$db->addfile('top_3_pk.cache', $pk_top3_tpl);
?>