<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_edit_character' );
	}
	$smarty->assign("POST", '1');
	$smarty->assign("MESSAGE",  notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_edit_character.php'));
}
else
{
	switch ($config->get('reborn_system', 'settings_edit_character'))
	{
		case '1':
			$smarty->assign("switch", '<option value="0">No</option><option value="1" selected>Yes</option>');
			break;
		case '0':
			$smarty->assign("switch", '<option value="0" selected>No</option><option value="1">Yes</option>');
			break;
	}
	
	switch ($config->get('az09_char_check', 'settings_edit_character'))
	{
		case '1':
			$smarty->assign("switch1", '<option value="0">No</option><option value="1" selected>Yes</option>');
			break;
		case '0':
			$smarty->assign("switch1", '<option value="0" selected>No</option><option value="1">Yes</option>');
			break;
	}	
	
	$smarty->assign("reborn_column", $config->get('reborn_column', 'settings_edit_character'));
	$smarty->assign("POST", '0');
}
?>