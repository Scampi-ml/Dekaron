<?php
if(ALLOW_OPEN != 1 && ALLOW_OPEN != 2) {
Header('HTTP/1.1 403');
exit(0);
}
	echo '
	<table>
	<tr><td class=header>Server Information</td></tr>
	<tr>
	<td>Experience is 1000x.
	<br><br>Argating rates are the same as 2moons
	<br><br><b>Siege Info:</b> Current siege time is 9pm (GMT-5) on Saturday.</td>
	</tr>
	</table><br><br>';
	$fp = @fsockopen ("localhost", 7880, $errno, $errstr, 1); 
	if (!$fp) 
	{ 
   	echo "Login server: <b>Maintenance</b><br>"; 
	}
	else
	{ 
		echo "Login server: <b>Online</b><br>"; 
  } 
  @fclose($fp); 
	$fp = @fsockopen ("localhost", 5005, $errno, $errstr, 1); 
	if (!$fp)
	{ 
  	echo "Game server: <b>Maintenance</b>"; 
	}
	else
	{ 
		echo "Game server: <b>Online</b>"; 
  } 
  @fclose($fp); 
  echo '<br><br>Deadfront: '; include_once("dfcounter.php");
?>