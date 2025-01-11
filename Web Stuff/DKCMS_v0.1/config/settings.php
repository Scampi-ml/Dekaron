<?php 

if(basename($_SERVER["PHP_SELF"]) == "settings.php"){
	die("403 - Access Forbidden");
}

	$properties = mssql_query("SELECT * FROM dkcms.dbo.dkcms_properties");
	$prop = mssql_fetch_array($properties);
	$ipaddress = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
	

	$style = "1";

	$getstyle = mssql_query("SELECT * FROM dkcms.dbo.dkcms_styles WHERE id=".$style."");
	$showstyle = mssql_fetch_array($getstyle);

		
	$servername 			= 			$prop['name'];
	$sitetitle 				= 			$prop['title'];
	$pb 					= 			" (Powered by dkcms)";
	$forumurl 				= 			$prop['forumurl'];
	$siteurl 				= 			$prop['siteurl'];
	$dkcmsdir 				= 			$prop['dkcmsdir'];
	$adminemail 			= 			$prop['email'];
	$exprate 				= 			$prop['exprate'];
	$moneyrate 				= 			$prop['moneyrate'];
	$droprate 				= 			$prop['droprate'];
	$mbanner 				= 			$prop['mbanner'];
	$mblink 				= 			$prop['mblink'];
	$gmlevel 				= 			$prop['gmlevel'];
	
	if(isset($_SESSION['id'])){
		$styledir = $showstyle['dir'];
	}else{
		$styledir = $prop['styledir'];
	}
	
?>