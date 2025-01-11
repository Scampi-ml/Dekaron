<?php

		$msconnect = mssql_connect("66.85.155.186","DeadDekaron","elitenate");
		$msdb = mssql_select_db("character", $msconnect);

		$q = "SELECT * FROM user_character_secede";
		$r = mssql_query($q);
		$sad = mssql_num_rows($r);
		echo "<b><i><u><div align=center>Dead Dekaron's Total Deleted Characters:</b></i></u> $sad";



?>