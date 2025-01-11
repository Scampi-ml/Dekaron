<?php
if (isset($_POST) && !empty($_POST))
{	
	
	if(empty($_POST['banned_reason']))
	{
		$reason = "None";
	}
	else
	{
		$reason = $_POST['banned_reason'];
	}
	$db->SQLquery("UPDATE account.dbo.USER_DATA SET banned_reason = '".$reason."', banned_by = '".$_SESSION['admin_name']."', banned_date = '".time()."' WHERE user_no = '%s'", $_POST['account'] );
	$db->SQLquery("UPDATE account.dbo.USER_PROFILE SET login_tag = 'N' WHERE user_no = '%s'", $_POST['account'] );
	
	
	// add cf ban
	$SQLquery1 = $db->SQLquery("SELECT user_ip_addr,user_no FROM account.dbo.user_profile WHERE user_no = '".$_POST['account']."' ");
	$getAccountInfo = $db->SQLfetchArray($SQLquery1);	
	
	
	$POST =  notice_message_admin('Account successfully banned', '1', '0', 'index.php?get=module_search_account');
}
else
{
	$SQLquery1 = $db->SQLquery("SELECT user_id,user_no FROM account.dbo.user_profile WHERE user_no = '".$_GET['account']."' ");
	$getAccountInfo = $db->SQLfetchArray($SQLquery1);
	$smarty->assign("USERNO", $getAccountInfo['user_no']); 
	$smarty->assign("USERID", $getAccountInfo['user_id']); 
}
?>