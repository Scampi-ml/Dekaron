<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_dac_settings' );
	}
	$smarty->assign("POST", '1');
	$smarty->assign("MESSAGE", notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_dac_settings.php'));
}
else
{
	$smarty->assign("msg_redirect", $config->get('msg_redirect', 'settings_dac_settings'));
	$smarty->assign("POST", '0');
}
?>