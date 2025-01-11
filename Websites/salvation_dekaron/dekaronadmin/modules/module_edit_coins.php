<?php
if (isset($_POST) && !empty($_POST))
{
	require_once ('engine/class_validate.php');
    $validate = new FormValidator();
	
	$validate->check("amount","req","Please fill in the acount");
	$validate->check("free_amount","req","Please fill in the free amount");
	
	$validate->check("amount","num","You can only use0-9 characters in your amount");
	$validate->check("free_amount","num","You can only use 0-9 characters in your free amount");
	
    if($validate->ValidateForm() == false)
    {
		$POST = notice_message_admin('You have the following errors:<br>'.$validate->GetErrors().'', '0', '1', 'index.php?get=module_edit_coins&account='.$_GET['account'].'');
    }
    else
	{
		$SQLquery1 = $db->SQLquery("UPDATE cash.dbo.user_cash SET amount = '%s', free_amount = '%s' WHERE user_no = '%s'", $_POST['amount'], $_POST['free_amount'], $_GET['account']);
	
		$POST = notice_message_admin('Coins successfully updated', '1', '0', 'index.php?get=module_edit_coins&account='.$_GET['account'].'');
	}
}
else
{
	$SQLquery1 = $db->SQLquery("SELECT * FROM cash.dbo.user_cash WHERE user_no = '%s'", $_GET['account']);
	$getCoinsInfo = $db->SQLfetchArray($SQLquery1);
	
	$smarty->assign("amount", $getCoinsInfo['user_no']); 
	$smarty->assign("amount", $getCoinsInfo['amount']); 
	$smarty->assign("free_amount", $getCoinsInfo['free_amount']); 
	
}
?>
