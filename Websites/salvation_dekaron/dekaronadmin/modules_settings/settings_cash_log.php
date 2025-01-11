<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_cash_log' );
	}
	$smarty->assign("POST", '1');
	$smarty->assign("MESSAGE",  notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_cash_log.php'));
}
else
{
	$smarty->assign("TOP", $config->get('top', 'settings_cash_log'));
	$smarty->assign("POST", '0');
}
?>