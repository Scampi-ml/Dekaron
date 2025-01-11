<?php

		$msconnect = mssql_connect("162.216.114.153","sa","player14");
		$msdb = mssql_select_db("character", $msconnect);

		$q = "SELECT * FROM user_suit";
		$r = mssql_query($q);
		$sad = mssql_num_rows($r);
		echo "<b><i><u><div align=center>Salvation Dekaron's Total Costumes:</b></i></u> $sad";



?>