<?php
	set_time_limit(0);
	
	$fh = fopen('cache/account.cache', 'w') or die("can't open file");
	
	$query1 = $dekaron->MySQLquery("SELECT * FROM account2.dbo.user_profile ");
	$rows = array();
	while($data = $dekaron->MySQLfetchArray($query1))
	{
		$rows[] = $data;
	}
	fwrite($fh, json_encode($rows));
	fclose($fh);
	
?>