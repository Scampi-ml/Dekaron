<?php
if (isset($_POST) && !empty($_POST))
{
	$db->SQLquery("UPDATE account.dbo.USER_PROFILE SET login_tag = 'Y' WHERE user_no = '%s'", $_GET['account'] );	
	$POST = notice_message_admin('Account successfully unbanned', '1', '0', 'index.php?get=module_search_account');
}
else
{
	$SQLquery1 = $db->SQLquery("SELECT user_id,user_no FROM account.dbo.user_profile WHERE user_no = '".$_GET['account']."' ");
	$getAccountInfo = $db->SQLfetchArray($SQLquery1);
	
	$smarty->assign("user_id",  $getAccountInfo['user_id']);
	$smarty->assign("user_no",  $getAccountInfo['user_no']);
}
?>