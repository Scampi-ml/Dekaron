<?php
$pk_tpl = '';
$rank_pk = '1';

$query_pk = $db->SQLquery('SELECT TOP 3 character_name,wPKCount,byPCClass FROM character.dbo.user_character WHERE character_name NOT LIKE "[[]%]%" ORDER BY wPKCount DESC');
while($pk_array = $db->SQLfetchArray($query_pk))
{
	$pk_tpl .= '<div class="span4">';
	$pk_tpl .= '<table width="100" class="table table-striped">';
	$pk_tpl .= '<tr>';
	$pk_tpl .= '<td align="center"><img src="./img/class/'.$pk_array['byPCClass'].'.png" /></td>';
	
	if($rank_pk == '1')
	{
		$pk_tpl .=  '<td align="center"><b><font color="red" size="3">'.$pk_array['character_name'].'</font></b><br>'.$pk_array['wPKCount'].' kills</td>';	
	}
	elseif($rank_pk == '2')
	{
		$pk_tpl .=  '<td align="center"><b><font color="blue" size="3">'.$pk_array['character_name'].'</font></b><br>'.$pk_array['wPKCount'].' kills</td>';
	}
	else
	{
		$pk_tpl .=  '<td align="center"><b><font color="green" size="3">'.$pk_array['character_name'].'</b></font><br>'.$pk_array['wPKCount'].' kills</td>';
	}							

	$pk_tpl .=  '</tr>';
	$pk_tpl .=  '</table>';
	$pk_tpl .=  '</div>';
	$rank_pk++;
}
$db->addfile('pk.cache', $pk_tpl);
?>