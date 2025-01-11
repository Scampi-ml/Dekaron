<?php

$fortune_tpl = '';
$fortune_rank = '1';

$query_fortune = $db->SQLquery('
SELECT TOP 50 
  character.dbo.user_character.character_name,
  SUM(character.dbo.user_character.dwMoney + character.dbo.user_character.dwStoreMoney + character.dbo.user_character.dwStorageMoney) AS total,
  character.dbo.user_character.byPCClass
FROM
  character.dbo.user_character
WHERE character_name NOT LIKE "[[]%]%"
GROUP BY
  character.dbo.user_character.character_name,
  character.dbo.user_character.byPCClass
ORDER BY
  total DESC
');

while($fortune_array = $db->SQLfetchArray($query_fortune))
{
	if($fortune_rank == '1')
	{
		$fortune_rank ++;
		continue;
	}
	if($fortune_rank == '2')
	{
		$fortune_rank ++;
		continue;
	}
	if($fortune_rank == '3')
	{
		$fortune_rank ++;
		continue;
	}
	
	$fortune_tpl .= "<tr>";
	$fortune_tpl .=  '<td align="center">'.$fortune_rank.'</td>';
	$fortune_tpl .=  '<td><a style="color: #000;" href="#">'.$fortune_array['character_name'].'</a></td>';
	$fortune_tpl .=  '<td align="center">'.charclass($fortune_array['byPCClass']).'</td>';
	$fortune_tpl .=  '<td align="center">'.number_format($fortune_array['total']).'</td>';
	$fortune_tpl .=  "</tr>";
	$fortune_rank ++;
}

$db->addfile('fortune.cache', $fortune_tpl);

?>