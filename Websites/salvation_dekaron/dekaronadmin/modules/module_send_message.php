<?php

$smarty->assign("from_name", $config->get('from_name', 'settings_send_message'));
if (isset($_POST) && !empty($_POST))
{
	require_once ('engine/class_validate.php');
    $validate = new FormValidator();
	
	$validate->check("from_char_nm","req","Please fill in the from");
	$validate->check("post_title","req","Please fill in the message title");
	$validate->check("body_text","req","Please fill in the message text");
	
	if(!empty($_POST['include_dil']))
	{
		$validate->check("include_dil","num","You can only use 0-9 characters in the add dil");
	}
	
	if(empty($_POST['include_dil']))
	{
		$dil = '0';
	}
	else
	{
		$dil = $_POST['include_dil'];
	}
	
    if($validate->ValidateForm() == false)
    {
		$POST = notice_message_admin('You have the following errors:<br>'.$validate->GetErrors().'', '0', '1', 'index.php?get=module_send_message&character='.$_POST['character'].'');
    }
    else
	{
		$db->SQLquery("EXEC character.dbo.SP_POST_SEND_OP '%s','%s',1,'%s','%s','%s','%s', 0", $_POST['character'], $_POST['from_char_nm'], $_POST['post_title'], $_POST['body_text'], $_POST['item'], $dil);
		$POST = notice_message_admin('Message successfully send', '1', '0', 'index.php?get=module_send_message&character='.$_POST['character'].'');
	}
}
else
{
	
	$SQLquery1 = $db->SQLquery("SELECT character_name,character_no FROM character.dbo.user_character WHERE character_no = '%s' ", $_GET['character']);
	$getCharInfo = $db->SQLfetchArray($SQLquery1);
	
	$smarty->assign("character_name", $getCharInfo['character_name']);
	$smarty->assign("character_no", $getCharInfo['character_no']);
}
?>