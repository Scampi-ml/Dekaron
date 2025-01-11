<?php 

session_start();
error_reporting(E_ALL ^ E_NOTICE);

if(!extension_loaded('zlib')){
	@ini_set('zlib.output_compression_level', 1);  
	@ob_start('ob_gzhandler'); 
}
	require_once("config/mssql.php");
	require_once("config/settings.php");
	require_once("config/afuncs.php");

	$getdkcms = isset($_GET['dkcms']) ? $_GET['dkcms'] : "";

	switch($getdkcms){
		case NULL:
			header('Location: ?dkcms=main');
			break;
		case "main":
			include($styledir."/header.php");
			include("modules/public/main.php");
			include($styledir."/footer.php");
			break;
		case "ucp":
			include($styledir."/header.php");
			include("modules/ucp/main.php");
			include($styledir."/footer.php");
			break;
		case "admin":
			include($styledir."/header.php");
			include("modules/admin/main.php");
			include($styledir."/footer.php");
			break;
		case "gmcp":
			include($styledir."/header.php");
			include("modules/gmcp/main.php");
			include($styledir."/footer.php");
			break;
		case "misc":
			include("modules/misc/main.php");
			break;
		case "style":
			include($styledir."/header.php");
			include("modules/public/styles.php");
			include($styledir."/footer.php");
			break;
		default:
			include($styledir."/header.php");
			include("modules/public/main.php");
			include($styledir."/footer.php");
			break;
}

mssql_close($conn2);


?>