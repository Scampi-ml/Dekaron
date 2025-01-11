<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_send_message' );
	}
	$smarty->assign("POST", '1');
	$smarty->assign("MESSAGE",  notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_send_message.php'));
}
else
{
	$smarty->assign("from_name", $config->get('from_name', 'settings_send_message'));
	$smarty->assign("POST", '0');
}
?>