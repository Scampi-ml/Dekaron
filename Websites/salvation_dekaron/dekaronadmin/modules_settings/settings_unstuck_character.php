<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_unstuck_character' );
	}
	$smarty->assign("POST", '1');
	$smarty->assign("MESSAGE",  notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_unstuck_character.php'));
}
else
{
	$smarty->assign("map", $config->get('map', 'settings_unstuck_character'));
	$smarty->assign("wposx", $config->get('wposx', 'settings_unstuck_character'));
	$smarty->assign("wposy", $config->get('wposy', 'settings_unstuck_character'));
	$smarty->assign("POST", '0');
}
?>