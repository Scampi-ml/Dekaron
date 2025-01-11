<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_search_character' );
	}
	$smarty->assign("POST", '1');
	$smarty->assign("MESSAGE",  notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_search_character.php'));
}
else
{
	switch ($config->get('showdekaron', 'settings_search_character'))
	{
		case '1':
			$smarty->assign("switch", '<option value="0">No</option><option value="1" selected>Yes</option>');
			break;
		case '0':
			$smarty->assign("switch", '<option value="0" selected>No</option><option value="1">Yes</option>');
			break;
	}
	$smarty->assign("TOP", $config->get('top', 'settings_search_character'));
	$smarty->assign("POST", '0');
}
?>