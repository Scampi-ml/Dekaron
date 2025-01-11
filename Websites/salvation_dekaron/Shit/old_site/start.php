<?php
include "scripts/bancheck.php";
session_start();
error_reporting(E_ALL);
// Start SMARTY
require_once('libs/Smarty.class.php');

// Date and Time Settings
date_default_timezone_set("America/Phoenix");

// Start Smarty
$smarty = new Smarty;
$smarty->debugging = false;
$smarty->caching = true;
$smarty->cache_lifetime = 240;
$smarty->force_compile = true;
$smarty->setTemplateDir('./templates')
	   ->setCompileDir('./templates_c')
	   ->setCacheDir('./cache');

// for DF and Time.js
require_once('scripts/script_df_counter.php');
require_once('scripts/script_timejs.php');

// get server status
$mssql = file_get_contents('cache/server_status/mssql.txt');
if($mssql == 'ERROR')
{
	$smarty->assign("SERVER_MSSQL", '<p class="srv-off"></p>');
}
else
{
	$smarty->assign("SERVER_MSSQL", '<p class="srv-on"></p>');
}



// top 5 at the side
$top5 = file_get_contents('cache/ranking/topplayers5.txt');
$smarty->assign("TOP5", $top5);

// online
require_once('scripts/online.php');


// for SEO
$smarty->assign("KEYWORDS", "");
$smarty->assign("DESCRIPTION", "");

// Get page for SEO title
$currentFile = $_SERVER["PHP_SELF"];
$parts = explode('/', $currentFile);

if(isset($_GET['refid']) && !empty($_GET['refid']) && is_numeric($_GET['refid']))
{
	// Ex. 12081614262230
	$_SESSION['refid'] = trim($_GET['refid']);
}

// give pages a nice title
require_once('seo_page_title.php');


?>