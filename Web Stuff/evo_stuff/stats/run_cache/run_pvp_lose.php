<?php
if(stristr($_SERVER['PHP_SELF'], 'run_pvp_lose.php'))
{
	die("<strong>Error: </strong>Can't be opened directly!");
}


$query1 = $dekaron->SQLquery('SELECT TOP 100 character_name,wWinRecord,wLoseRecord,byPCClass FROM character2.dbo.user_character ORDER BY wLoseRecord DESC ');

$rows = array();
while($data = $dekaron->SQLfetchArray($query1))
{
	$rows[] = $data;
}

$serialized_array = serialize($rows);

unlink("cache/pvp_lose.cache");

$file_name = "cache/pvp_lose.cache";
$handle = fopen($file_name, 'w+');
fwrite($handle, $serialized_array);
fclose($handle);

?>