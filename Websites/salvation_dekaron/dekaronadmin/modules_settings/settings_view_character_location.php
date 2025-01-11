<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_cash_log' );
	}
	$smarty->assign("POST", '1');
	$smarty->assign("MESSAGE",  notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_view_character_location.php'));
}
else
{
	switch ($config->get('pointer', 'settings_view_character_location'))
	{
		case 'X':
			$smarty->assign("switch", '
			<option value="X" selected>X</option>
			<option value="0">0</option>
			<option value="°">°</option>
			<option value="o">o</option>
			<option value="*">*</option>
			';
			break;
		case '0':
			$smarty->assign("switch", '
			<option value="X">X</option>
			<option value="0" selected>0</option>
			<option value="°">°</option>
			<option value="o">o</option>
			<option value="*">*</option>
			';
			break;
		case 'o':
			$smarty->assign("switch", '
			<option value="X">X</option>
			<option value="0">0</option>
			<option value="°" selected>°</option>
			<option value="o">o</option>
			<option value="*">*</option>
			';
			break;
		case '°':
			$smarty->assign("switch", '
			<option value="X" >X</option>
			<option value="0">0</option>
			<option value="°">°</option>
			<option value="o" selected>o</option>
			<option value="*">*</option>
			';
			break;
		case '*':
			$smarty->assign("switch", '
			<option value="X" >X</option>
			<option value="0">0</option>
			<option value="°>°</option>
			<option value="o">o</option>
			<option value="*" selected>*</option>
			';
			break;
	}
	
	switch ($config->get('color', 'settings_view_character_location'))
	{
		case 'WHITE':
			$smarty->assign("switch1", '
			<option value="WHITE" selected>WHITE</option>
			<option value="YELLOW">YELLOW</option>
			<option value="RED">RED</option>
			<option value="BLUE">BLUE</option>
			<option value="GREEN">GREEN</option>
			';
			break;
		case 'YELLOW':
			$smarty->assign("switch1", '
			<option value="WHITE">WHITE</option>
			<option value="YELLOW" selected>YELLOW</option>
			<option value="RED">RED</option>
			<option value="BLUE">BLUE</option>
			<option value="GREEN">GREEN</option>
			';
			break;
		case 'RED':
			$smarty->assign("switch1", '
			<option value="WHITE">WHITE</option>
			<option value="YELLOW">YELLOW</option>
			<option value="RED" selected>RED</option>
			<option value="BLUE">BLUE</option>
			<option value="GREEN">GREEN</option>
			';
			break;
		case 'BLUE':
			$smarty->assign("switch1", '
			<option value="WHITE">WHITE</option>
			<option value="YELLOW">YELLOW</option>
			<option value="RED">RED</option>
			<option value="BLUE" selected>BLUE</option>
			<option value="GREEN">GREEN</option>
			';
			break;
		case 'GREEN':
			$smarty->assign("switch1", '
			<option value="WHITE">WHITE</option>
			<option value="YELLOW">YELLOW</option>
			<option value="RED">RED</option>
			<option value="BLUE">BLUE</option>
			<option value="GREEN" selected>GREEN</option>
			';
			break;
	}
	$smarty->assign("POST", '0');

}
?>