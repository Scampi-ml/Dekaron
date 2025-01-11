<?php
if(!file_exists('start.php'))
{
	die("Please rename '<b>start.php.example</b>' to '<b>start.php</b>' and fill in your mssql info!");
}
require_once ('start.php');

require_once ('engine/class_config.php');
require_once ('engine/global_functions4.php');
require_once ('engine/class_mssql.php');
require_once ('navigation.php');



$config = new ConfigMagik("engine/settings.php");
$config->PROCESS_SECTIONS = true;
$config->PROTECTED_MODE   = true;
$config->SYNCHRONIZE      = true;

$db = new database_class();
$db->mssql_host = $MSSQL_DATABASE_IP;
$db->mssql_user = $MSSQL_DATABASE_USER;
$db->mssql_pasw = $MSSQL_DATABASE_PASW;

	
$GLOBALS["msg_redirect"] = $config->get('msg_redirect', 'settings_dac_settings');
$GLOBALS["admin_name"] = $_SESSION['admin_name'];

// default values to prevent errors | DO NOT EDIT
$POST = '';



if ( isset( $_GET['get'] ) ) 
{
	$m_am = $_GET['get'];
	include( "modules/".$m_am.".php" );
	$smarty->assign("POST", $POST); 
	$smarty->assign("m_am", $m_am);
	$smarty->display('index.tpl');
}
else
{
	$smarty->assign("POST", $POST); 
	$smarty->assign("m_am", 'home');
	include( "modules/home.php" );
	$smarty->display('index.tpl');
}

?>