<?php
if (isset($_POST) && !empty($_POST))
{
		$db->SQLquery("DELETE FROM account.dbo.user_profile  WHERE user_no = '%s'", $_POST['account']);
		$db->SQLquery("DELETE FROM user_cash.dbo.cash WHERE user_no = '%s'", $_POST['account']);
		$db->SQLquery("DELETE FROM user_charge_log.dbo.cash WHERE user_no = '%s'", $_POST['account']);
		$db->SQLquery("DELETE FROM user_use_log.dbo.cash WHERE user_no = '%s'", $_POST['account']);
	
		$delete_this_also = $_POST['also_delete'];
		foreach($delete_this_also as $char)
		{
			$db->SQLquery("DELETE FROM character.dbo.user_character WHERE character_no = '%s'", $char);
			$db->SQLquery("DELETE FROM character.dbo.User_Quest_Done WHERE character_no = '%s'", $char);
			$db->SQLquery("DELETE FROM character.dbo.User_Quest_Doing WHERE character_no = '%s'", $char);
			$db->SQLquery("DELETE FROM character.dbo.user_bag WHERE character_no = '%s'", $char);
			$db->SQLquery("DELETE FROM character.dbo.USER_POSTBOX WHERE character_no = '%s'", $char);
			$db->SQLquery("DELETE FROM character.dbo.user_storage WHERE character_no = '%s'", $char);
			$db->SQLquery("DELETE FROM character.dbo.user_skill WHERE character_no = '%s'", $char);
			$db->SQLquery("DELETE FROM character.dbo.user_slot WHERE character_no = '%s'", $char);
			$db->SQLquery("DELETE FROM character.dbo.user_storage WHERE character_no = '%s'", $char);
			$db->SQLquery("DELETE FROM character.dbo.user_suit WHERE character_no = '%s'", $char);
	}
	$POST = notice_message_admin('Account successfully deleted', '1', '0', 'index.php?get=module_search_account');
}
else
{
	
	$SQLquery1 = $db->SQLquery("SELECT user_no,user_id FROM account.dbo.user_profile WHERE user_no = '%s'", $_GET['account']);
	$getAccountInfo = $db->SQLfetchArray($SQLquery1);
	$smarty->assign("USERID", $getAccountInfo['user_id']);
	$smarty->assign("USERNO", $getAccountInfo['user_no']);
	
	$table = '';
	
	$SQLquery2 = $db->SQLquery("SELECT character_no,character_name,user_no FROM character.dbo.user_character WHERE user_no = '%s'", $_GET['account']);
    while($getCharacterInfo = $db->SQLfetchArray($SQLquery2))
    {
    	$table .= '<p class="msg_error"><input type="checkbox" name="also_delete[]" checked value="'.$getCharacterInfo['character_no'].'">Character: '.$getCharacterInfo['character_name'].'</p>';
    }	
	
	$smarty->assign("TABLE", $table); 
}
?>