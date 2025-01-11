<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_edit_guild_permissions_names' );
	}
	$smarty->assign("POST", '1');
	$smarty->assign("MESSAGE",  notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_edit_guild_permissions_names.php'));
}
else
{
	switch ($config->get('show_default', 'settings_edit_guild_permissions_names'))
	{
		case '1':
			$smarty->assign("switch",  '<option value="0">No</option><option value="1" selected>Yes</option>');
			break;
		case '0':
			$smarty->assign("switch",  '<option value="0" selected>No</option><option value="1">Yes</option>');
			break;
	}
	$smarty->assign("POST", '0');
}
?>