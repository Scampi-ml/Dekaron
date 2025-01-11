<?php


if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

$SQL = array();

$SQL[] = "DELETE FROM core_sys_conf_settings WHERE conf_key='ipschat_account_key';";
