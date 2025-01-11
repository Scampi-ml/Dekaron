<?php
if (isset($_POST) && !empty($_POST))
{
	require_once ('engine/class_validate.php');
    $validate = new FormValidator();
	
	$validate->check("guild_name","req","Please fill in the character name");
	$validate->check("guild_adv","req","Please fill in the adventure points");
	$validate->check("guild_adv","num","You can only use 0-9 characters in the guild adventure points");
	$validate->check("guild_effect","num","You can only use 0-9 characters in the guild effect");
	
    if($validate->ValidateForm() == false)
    {
		$POST = notice_message_admin('You have the following errors:<br>'.$validate->GetErrors().'', '0', '1', 'index.php?get=module_edit_guild&guild='.$_GET['guild'].'');
    }
    else
	{
		$SQLquery1 = $db->SQLquery("UPDATE character.dbo.guild_info SET guild_name = '%s',guild_Level = '%s',guild_adv = '%s',guild_mark1 = '%s',guild_mark2 = '%s',guild_effect = '%s', guild_notice = '%s' WHERE guild_code = '%s'", $_POST['guild_name'],$_POST['guild_Level'],$_POST['guild_adv'],$_POST['guild_mark1'],$_POST['guild_mark1'],$_POST['guild_effect'], $_POST['guild_notice'], $_GET['guild']);
		
		$POST = notice_message_admin('Guild successfully updated', '1', '0', 'index.php?get=module_edit_guild&guild='.$_GET['guild'].'');
	}
}
else
{
	
	$SQLquery1 = $db->SQLquery("SELECT * FROM character.dbo.guild_info WHERE guild_code = '".$_GET['guild']."' ");
	$getGuildInfo = $db->SQLfetchArray($SQLquery1);
	
	
	$smarty->assign("guild_code", $getGuildInfo['guild_code']); 
	$smarty->assign("guild_name", $getGuildInfo['guild_name']); 
	$smarty->assign("guild_serv_id", $getGuildInfo['guild_serv_id']); 
	
	
	switch ($getGuildInfo['guild_Level'])
	{
		case '1':
			$smarty->assign("guild_Level", '<option value="1" selected>Level 1</option><option value="2" >Level 2</option><option value="3" >Level 3</option>');
			break;
		case '2':
			$smarty->assign("guild_Level", '<option value="1" >Level 1</option><option value="2" selected>Level 2</option><option value="3" >Level 3</option>');
			break;
		case '3':
			$smarty->assign("guild_Level", '<option value="1" >Level 1</option><option value="2" >Level 2</option><option value="3" selected>Level 3</option>');
			break;
	}	
	
	$smarty->assign("guild_Dil", $getGuildInfo['guild_Dil']); 
	$smarty->assign("guild_adv", $getGuildInfo['guild_adv']); 
	$smarty->assign("guild_mark2", $getGuildInfo['guild_mark2']); 
	$smarty->assign("guild_mark1", $getGuildInfo['guild_mark1']); 
	$smarty->assign("guild_notice", $getGuildInfo['guild_notice']); 
	$smarty->assign("ipt_date", $getGuildInfo['ipt_date']); 
	
	$smarty->assign("upt_date", $getGuildInfo['upt_date']); 
	$smarty->assign("guild_effect", $getGuildInfo['guild_effect']); 
	$smarty->assign("bystate", $getGuildInfo['bystate']);
	$smarty->assign("bychannel", $getGuildInfo['bychannel']);

}
?>