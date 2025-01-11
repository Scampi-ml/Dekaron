<?php
// debuglogger.php
//   used to log time stamped strings to a file

function dbg_log($msg, $logfile='_paypal_error_log.php')
{
	$buff = '';

	if(!file_exists($logfile))
		$buff = '<?php die; ?>'."\n";

	$buff .= sprintf("%s\t%s\n\n", date("Y-m-h H:i"), $msg);

	$f = fopen($logfile, 'a');
	fwrite($f, $buff);
	fclose($f);
}


?>