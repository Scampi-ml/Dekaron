<?php

$mssql_query = $db->SQLquery("SELECT SERVERPROPERTY('productversion'), SERVERPROPERTY('productlevel'), SERVERPROPERTY('edition')");
$mssql_info = $db->SQLfetchArray($mssql_query);

$smarty->assign("PHP_VERSION", PHP_VERSION);
$smarty->assign("SERVER_SOFTWARE", $_SERVER['SERVER_SOFTWARE']);
$smarty->assign("memory_limit", convertbytes(memory_get_usage(true)).' / '.ini_get( "memory_limit" ).'b');
$smarty->assign("display_errors", ini_get('display_errors'));
$smarty->assign("mssql_info0", $mssql_info[0]);
$smarty->assign("mssql_info1", $mssql_info[1]);
$smarty->assign("mssql_info2", $mssql_info[2]);
$smarty->assign("date", date(DATE_RFC822));
$smarty->assign("timezone", date_default_timezone_get());
?>