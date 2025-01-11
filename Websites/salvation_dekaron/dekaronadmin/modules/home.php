<?php 
$SQLquery1 = $db->SQLquery("SELECT ipt_date FROM character.dbo.user_character WHERE ipt_date = '".date('Ymd')."'"); 
$SQLquery2 = $db->SQLquery("SELECT user_no FROM account.dbo.user_profile WHERE user_no LIKE '".date('ymd')."%' "); 
$SQLquery3 = $db->SQLquery("SELECT conn_no FROM account.dbo.USER_CONNLOG_KEY WHERE conn_no LIKE '".date('ymd')."%' "); 
$SQLquery4 = $db->SQLquery("SELECT user_id FROM account.dbo.user_profile WHERE login_flag = '1100'"); 



$smarty->assign("SQLquery1", number_format($db->SQLfetchNum($SQLquery1)));
$smarty->assign("SQLquery2", number_format($db->SQLfetchNum($SQLquery2)));
$smarty->assign("SQLquery3", number_format($db->SQLfetchNum($SQLquery3)));
$smarty->assign("SQLquery4", number_format($db->SQLfetchNum($SQLquery4)));

$smarty->assign("curr_date", date('d M Y'));



$current_version = @file_get_contents('engine/version.txt');
$new_version = @file_get_contents('http://www.dkunderground.org/dac_remote/version.js');

if ($current_version == $new_version)
{
	$smarty->assign("version",'<font color="green"><b>Up to date</b></font>');
}
else
{
	$smarty->assign("version", '<blink><b>UPDATE REQUIRED!</b></blink><br>Please visit <a href="http://www.dkunderground.org/forums/files/category/16-dac-dekaron-admin-control/">DAC download page</a> to download the new update');
}

?>