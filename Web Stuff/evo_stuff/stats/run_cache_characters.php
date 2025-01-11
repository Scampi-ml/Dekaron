<?php
	set_time_limit(0);
	
	$fh = fopen('cache/character.cache', 'w') or die("can't open file");
	
	$query1 = $dekaron->MySQLquery("SELECT * FROM character2.dbo.user_character ");
	$rows = array();
	while($data = $dekaron->MySQLfetchArray($query1))
	{
		$rows[] = $data;
	}
	fwrite($fh, json_encode($rows));
	fclose($fh);
	
?>