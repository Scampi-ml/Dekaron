<?php
$fortune_top3_tpl = '';
$fortune_top3_rank = '1';


$query_fortune_top3 = $db->SQLquery("
SELECT TOP 3 
  character.dbo.user_character.character_name,
  SUM(character.dbo.user_character.dwMoney + character.dbo.user_character.dwStoreMoney + character.dbo.user_character.dwStorageMoney) AS total,
  character.dbo.user_character.byPCClass
FROM
  character.dbo.user_character
WHERE character_name NOT LIKE '[[]%]%'
GROUP BY
  character.dbo.user_character.character_name,
  character.dbo.user_character.byPCClass
ORDER BY
  total DESC 
");

while($fortune_array_top3 = $db->SQLfetchArray($query_fortune_top3))
{
	$fortune_top3_tpl .= '<div class="span4">';
	$fortune_top3_tpl .= '<table width="100" class="table table-striped">';
	$fortune_top3_tpl .= '<tr>';
	$fortune_top3_tpl .= '<td align="center"><img src="./img/class/'.$fortune_array_top3['byPCClass'].'.png" /></td>';
	
	if($fortune_top3_rank == '1')
	{
		$fortune_top3_tpl .=  '<td align="center"><b><font color="red" size="3">'.$fortune_array_top3['character_name'].'</font></b><br>'.number_format($fortune_array_top3['total']).' dil</td>';	
	}
	elseif($fortune_top3_rank == '2')
	{
		$fortune_top3_tpl .=  '<td align="center"><b><font color="blue" size="3">'.$fortune_array_top3['character_name'].'</font></b><br>'.number_format($fortune_array_top3['total']).' dil</td>';
	}
	else
	{
		$fortune_top3_tpl .=  '<td align="center"><b><font color="green" size="3">'.$fortune_array_top3['character_name'].'</b></font><br>'.number_format($fortune_array_top3['total']).' dil</td>';
	}							


	$fortune_top3_tpl .=  '</tr>';
	$fortune_top3_tpl .=  '</table>';
	$fortune_top3_tpl .=  '</div>';
	$fortune_top3_rank++;
}
$db->addfile('top_3_fortune.cache', $fortune_top3_tpl);

?>