<?php
$dekaron->mssql_host = 'localhost';
$dekaron->mssql_user = 'sa';
$dekaron->mssql_pasw = 'uber';

error_reporting(0);
date_default_timezone_set("America/Chicago");

$CONFIG['UCP_THEME'] = "default";

$CONFIG['UCP_DISABLED'] = "false";
$CONFIG['UCP_DISABLED_MSG'] = "Offline for maintenace.";
$CONFIG['UCP_VERSION'] = "6";

define('MM_BRUTE_FILE', 'logins/brute.txt');
define('MM_BRUTE_WINDOW', 15*60);
define('MM_BRUTE_ATTEMPTS', 10);

define('MM_LOGIN_FILE', 'logins/login.txt');
define('MM_LOGIN_WINDOW', 15*60);
define('MM_LOGIN_ATTEMPTS', 5);


?>

		