<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

$uri = $_SERVER['REQUEST_URI'];
$ip = $_SERVER['REMOTE_ADDR'];
$ref = $_SERVER['HTTP_REFERER'];
$visitTime = date("r"); 

$logLine = "$visitTime - IP: $ip || Page: $uri || Referrer: $ref\r\n";
$fp = fopen("accesslog.txt", "a");
fputs($fp, $logLine);
fclose($fp);


if(extension_loaded('zlib')){
	ini_set('zlib.output_compression_level', 1);  
	ob_start('ob_gzhandler'); 
}




require_once("config.php");
require_once("functions.php");

$getosds = isset($_GET['osds']) ? $_GET['osds'] : "";
	switch($getosds){
		case NULL:
			header('Location: ?osds=main');
			break;
		case "main":
			include("header.php");
			include("public/main.php");
			include("footer.php");
			break;
		case "user":
			include("header.php");
			include("user/main.php");
			include("footer.php");
			break;
		case "gm":
			include("header.php");
			include("gm/main.php");
			include("footer.php");
			break;
		case "dev":
			include("header.php");
			include("dev/main.php");
			include("footer.php");
			break;
		case "misc":
			include("misc/main.php");
			break;
		default:
			include("header.php");
			include("public/main.php");
			include("footer.php");
			break;

}
ob_end_flush();
?>
