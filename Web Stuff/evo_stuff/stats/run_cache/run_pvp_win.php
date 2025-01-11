<?php
if(stristr($_SERVER['PHP_SELF'], 'run_pvp_win.php'))
{
	die("<strong>Error: </strong>Can't be opened directly!");
}


$query1 = $dekaron->SQLquery('SELECT TOP 100 character_name,wWinRecord,wLoseRecord,byPCClass FROM character2.dbo.user_character ORDER BY wWinRecord DESC ');

$rows = array();
while($data = $dekaron->SQLfetchArray($query1))
{
	$rows[] = $data;
}

$serialized_array = serialize($rows);

unlink("cache/pvp_win.cache");

$file_name = "cache/pvp_win.cache";
$handle = fopen($file_name, 'w+');
fwrite($handle, $serialized_array);
fclose($handle);

?>