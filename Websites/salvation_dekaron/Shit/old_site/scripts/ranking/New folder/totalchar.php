<?php

		$msconnect = mssql_connect("162.216.114.153","sa","player14");
		$msdb = mssql_select_db("character", $msconnect);

		$q = "SELECT * FROM user_character";
		$r = mssql_query($q);
		$sad = mssql_num_rows($r);
		echo "<b><i><u><div align=center>Dead Dekaron's Total In-Game Characters:</b></i></u> $sad";


?>