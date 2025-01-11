<?php

if (isset($_POST) && !empty($_POST))
{
	
	require_once ('engine/class_validate.php');
    $validate = new FormValidator();
	
	$validate->check("user_id","req","Please fill in the user id");
	$validate->check("user_pwd","req","Please fill in the password");
	
	$validate->check("user_id","alnum","You can only use A-Z / 0-9 characters in your user id");
	$validate->check("user_pwd","alnum","You can only use A-Z / 0-9 characters in your password");
	
    if($validate->ValidateForm() == false)
    {
		$POST = notice_message_admin('You have the following errors:<br>'.$validate->GetErrors().'', '0', '1', 'index.php?get=module_edit_account&account='.$_GET['account'].'');
    }
    else
	{
		$SQLquery1 = $db->SQLquery("UPDATE account.dbo.USER_PROFILE SET user_id = '%s', user_pwd = '%s', login_flag = '%s' WHERE user_no = '%s'", $_POST['user_id'], $_POST['user_pwd'], $_POST['login_flag'], $_GET['account'] );	
		$SQLquery1 = $db->SQLquery("UPDATE account.dbo.USER_DATA SET email = '%s', credits = '%s', can_vote = '%s', can_newspaper = '%s', isgm = '%s' WHERE user_no = '%s'", $_POST['email'], $_POST['credits'], $_POST['can_vote'], $_POST['can_newspaper'], $_POST['isgm'],$_GET['account']);	
		$POST = notice_message_admin('Account successfully updated', '0', '1', 'index.php?get=module_edit_account&account='.$_GET['account'].'');
	}
	
}
else
{
	$SQLquery1 = $db->SQLquery("
	SELECT 
	  account.dbo.USER_PROFILE.user_no,
	  account.dbo.USER_PROFILE.[user_id],
	  account.dbo.USER_PROFILE.user_pwd,
	  account.dbo.USER_PROFILE.login_flag,
	  account.dbo.USER_PROFILE.login_tag,
	  account.dbo.USER_PROFILE.ipt_time,
	  account.dbo.USER_PROFILE.login_time,
	  account.dbo.USER_PROFILE.logout_time,
	  account.dbo.USER_PROFILE.user_ip_addr
	FROM
	  account.dbo.USER_PROFILE
	WHERE
	  account.dbo.USER_PROFILE.user_no = '%s'", $_GET['account']
	  );
	$getAccountInfo = $db->SQLfetchArray($SQLquery1);
	
	$SQLquery2 = $db->SQLquery("SELECT * FROM account.dbo.USER_DATA WHERE user_no = '%s'", $_GET['account']);
	$getAccountData = $db->SQLfetchArray($SQLquery2);
	
	$smarty->assign("user_no", $getAccountInfo['user_no']); 
	$smarty->assign("user_id", $getAccountInfo['user_id']); 
	$smarty->assign("user_pwd", $getAccountInfo['user_pwd']); 
	
	
	$smarty->assign("credits", $getAccountData['credits']); 
	$smarty->assign("email", trim($getAccountData['email'])); 

	
	
	switch ($getAccountInfo['login_tag'])
	{
		case 'Y':
			$smarty->assign("login_tag", 'Yes');
			break;
		case 'N':
			$smarty->assign("login_tag", 'No');
			$smarty->assign("banned_reason", $getAccountData['banned_reason']);
			$smarty->assign("banned_by", $getAccountData['banned_by']);
			$smarty->assign("banned_date", date(DATE_RFC822,$getAccountData['banned_date']));
			break;
	}	
	
	
		
	switch ($getAccountInfo['login_flag'])
	{
		case '1100':
			$smarty->assign("login_flag", '<option value="0">No</option><option value="1100" selected>Yes</option>');
			break;
		case '0':
			$smarty->assign("login_flag", '<option value="0" selected>No</option><option value="1100">Yes</option>');
			break;
	}	
	
	
	switch ($getAccountData['can_vote'])
	{
		case '1':
			$smarty->assign("can_vote", '<option value="0">No</option><option value="1" selected>Yes</option>');
			break;
		case '0':
			$smarty->assign("can_vote", '<option value="0" selected>No</option><option value="1">Yes</option>');
			break;
	}
	
	switch ($getAccountData['can_newspaper'])
	{
		case '1':
			$smarty->assign("can_newspaper", '<option value="0">No</option><option value="1" selected>Yes</option>');
			break;
		case '0':
			$smarty->assign("can_newspaper", '<option value="0" selected>No</option><option value="1">Yes</option>');
			break;
	}	
	
	switch ($getAccountData['isgm'])
	{
		case '1':
			$smarty->assign("isgm", '<option value="0">No</option><option value="1" selected>Yes</option>');
			break;
		case '0':
			$smarty->assign("isgm", '<option value="0" selected>No</option><option value="1">Yes</option>');
			break;
	}	
	
	$smarty->assign("login_time", $getAccountInfo['login_time']); 
	$smarty->assign("logout_time", $getAccountInfo['logout_time']); 
	$smarty->assign("user_ip_addr", decodeIp($getAccountInfo['user_ip_addr'])); 
}

?>
