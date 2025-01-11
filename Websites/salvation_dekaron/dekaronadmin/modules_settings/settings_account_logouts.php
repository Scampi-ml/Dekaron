<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_account_logouts' );
	}
	$smarty->assign("POST", '1');
	$smarty->assign("MESSAGE",  notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_account_logouts.php'));
}
else
{
	$smarty->assign("TOP", $config->get('top', 'settings_account_logouts'));
	switch ($config->get('shownull', 'settings_account_logouts'))
	{
		case '1':
			$smarty->assign("switch", '<option value="0">No</option><option value="1" selected>Yes</option>');
			break;
		case '0':
			$smarty->assign("switch", '<option value="0" selected>No</option><option value="1">Yes</option>');
			break;
	}
	$smarty->assign("POST", '0');	
}
?>