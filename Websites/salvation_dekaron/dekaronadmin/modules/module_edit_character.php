<?php
if (isset($_POST) && !empty($_POST))
{
	require_once ('engine/class_validate.php');
    $validate = new FormValidator();
	
	// Required
	$validate->check("character_name","req","Please fill in the character name");
	$validate->check("dwAdv","req","Please fill in the adventure points");
	$validate->check("nHP","req","Please fill in the health point");
	$validate->check("nMP","req","Please fill in the magic point");
	$validate->check("nShield","req","Please fill in the shield");
	$validate->check("wStr","req","Please fill in the strenght");
	$validate->check("wDex","req","Please fill in the dexterity");
	$validate->check("wCon","req","Please fill in the contribution");
	$validate->check("wSpr","req","Please fill in the spirit");
	$validate->check("wStatPoint","req","Please fill in the stat point");
	$validate->check("wSkillPoint","req","Please fill in the skill point");
	$validate->check("dwExp","req","Please fill in the experience");
	
	if($config->get('reborn_system', 'settings_edit_character') == '1')
	{
		$reborn_column = $config->get('reborn_column', 'settings_edit_character');
		$validate->check($reborn_column,"req","Please fill in the reborn"); 
	}
	
	$validate->check("dwMoney","req","Please fill in the inventory money");
	$validate->check("dwStoreMoney","req","Please fill in the store money");
	$validate->check("dwStorageMoney","req","Please fill in the storage money");
	$validate->check("wPKCount","req","Please fill in the pk point");
	$validate->check("dwPVPPoint","req","Please fill in the pvp point");
	$validate->check("wWinRecord","req","Please fill in the win record");
	$validate->check("wLoseRecord","req","Please fill in the lose record");
	$validate->check("wDrawRecord","req","Please fill in the draw record");
	$validate->check("dwSupplyPoint","req","Please fill in the supply point");
	
	// check for specific values
	
	if($config->get('az09_char_check', 'settings_edit_character') == '1')
	{
		$validate->check("character_name","alnum","You can only use A-Z / 0-9 characters in your character name");
	}
	$validate->check("dwAdv","num","You can only use 0-9 characters in the adventure points");
	$validate->check("nHP","num","You can only use 0-9 characters in the health point");
	$validate->check("nMP","num","You can only use 0-9 characters in the magic point");
	$validate->check("nShield","num","You can only use 0-9 characters in the shield");
	$validate->check("wStr","num","You can only use 0-9 characters in the strenght");
	$validate->check("wDex","num","You can only use 0-9 characters in the dexterity");
	$validate->check("wCon","num","You can only use 0-9 characters in the contribution");
	$validate->check("wSpr","num","You can only use 0-9 characters in the spirit");
	$validate->check("wStatPoint","num","You can only use 0-9 characters in the stat point");
	$validate->check("wSkillPoint","num","You can only use 0-9 characters in the skill point");
	$validate->check("dwExp","num","You can only use 0-9 characters in the experience");
	
	if($config->get('reborn_system', 'settings_edit_character') == '1')
	{
		$reborn_column = $config->get('reborn_column', 'settings_edit_character');
		$validate->check($reborn_column,"num","You can only use 0-9 characters in the reborn"); 
	}
	
	$validate->check("dwMoney","num","You can only use 0-9 characters in inventory money");
	$validate->check("dwStoreMoney","num","You can only use 0-9 characters in the store money");
	$validate->check("dwStorageMoney","num","You can only use 0-9 characters in the storage money");
	$validate->check("wPKCount","num","You can only use 0-9 characters in the pk point");
	$validate->check("dwPVPPoint","num","You can only use 0-9 characters in the pvp point");
	$validate->check("wWinRecord","num","You can only use 0-9 characters in the win record");
	$validate->check("wLoseRecord","num","You can only use 0-9 characters in the lose record");
	$validate->check("wDrawRecord","num","You can only use 0-9 characters in the draw record");
	$validate->check("dwSupplyPoint","num","You can only use 0-9 characters in the supply point");
	
	$validate->check("dwMoney","maxlen=9", "Max 999999999 in inventory money");
	$validate->check("dwStoreMoney","maxlen=9","Max 999999999 in the store money");
	$validate->check("dwStorageMoney","maxlen=9","Max 999999999 in the storage money");

    if($validate->ValidateForm() == false)
    {
		$POST = notice_message_admin('You have the following errors:<br>'.$validate->GetErrors().'', '0', '1', 'index.php?get=module_edit_character&character='.$_GET['character'].'');
    }
    else
	{
		$SQLquery1 = $db->SQLquery("UPDATE character.dbo.user_character SET character_name = '%s', dwAdv = '%s', dwPeerage = '%s', dwExp = '%s', dwMoney = '%s', dwStoreMoney = '%s', dwStorageMoney = '%s', nHP = '%s', nMP = '%s', wStr = '%s', wDex = '%s', wCon = '%s', wSpr = '%s', wPosX = '%s', wPosY = '%s', wRetPosX = '%s', wRetPosY = '%s', wMapIndex = '%s', wRetMapIndex = '%s', wStatPoint = '%s', wSkillPoint = '%s', wLevel = '%s', bySkillClearCount = '%s', byStatClearCount = '%s', wPKCount = '%s', wChaoticLevel = '%s', nShield = '%s', dwFlag = '%s', login_flag = '%s', dwPVPPoint = '%s', wWinRecord = '%s', wLoseRecord = '%s', wDrawRecord = '%s', dwSupplyPoint = '%s' WHERE character_no = '%s'", $_POST['character_name'],$_POST['dwAdv'],$_POST['dwPeerage'],$_POST['dwExp'],$_POST['dwMoney'],$_POST['dwStoreMoney'],$_POST['dwStorageMoney'],$_POST['nHP'],$_POST['nMP'],$_POST['wStr'],$_POST['wDex'],$_POST['wCon'],$_POST['wSpr'],$_POST['wPosX'],$_POST['wPosY'],$_POST['wRetPosX'],$_POST['wRetPosY'],$_POST['wMapIndex'],$_POST['wRetMapIndex'],$_POST['wStatPoint'],$_POST['wSkillPoint'],$_POST['wLevel'],$_POST['bySkillClearCount'],$_POST['byStatClearCount'],$_POST['wPKCount'],$_POST['wChaoticLevel'],$_POST['nShield'],$_POST['dwFlag'],$_POST['login_flag'],$_POST['dwPVPPoint'],$_POST['wWinRecord'],$_POST['wLoseRecord'],$_POST['wDrawRecord'],$_POST['dwSupplyPoint'],$_GET['character']);
		
		if($config->get('reborn_system', 'settings_edit_character') == '1')
		{
			$reborn_column = $config->get('reborn_column', 'settings_edit_character');
			$SQLquery1 = $db->SQLquery("UPDATE character.dbo.user_character SET ".$reborn_column." = '%s' WHERE character_no = '%s'", $_POST[$reborn_column], $_GET['character']);
		}
				
		$POST = notice_message_admin('Character successfully updated', '1', '0', 'index.php?get=module_edit_character&character='.$_GET['character'].'');
	}
}
else
{
	require_once ('engine/array_map.php');
	require_once ('engine/array_class.php');
	
	
	$SQLquery1 = $db->SQLquery("SELECT * FROM character.dbo.user_character WHERE character_no = '".$_GET['character']."' ");
	$getCharacterInfo = $db->SQLfetchArray($SQLquery1);
	
	$SQLquery2 = $db->SQLquery("SELECT * FROM account.dbo.user_profile WHERE user_no = '".$getCharacterInfo['user_no']."' ");
	$getAccInfo = $db->SQLfetchArray($SQLquery2);
	
	
	
	$smarty->assign("user_id", $getAccInfo['user_id']); 
	$smarty->assign("user_no", $getCharacterInfo['user_no']); 
	$smarty->assign("character_no", $getCharacterInfo['character_no']); 
	$smarty->assign("character_name", $getCharacterInfo['character_name']); 
	$smarty->assign("byPCClass", $array_class[$getCharacterInfo['byPCClass']]); 
	$smarty->assign("dwAdv", $getCharacterInfo['dwAdv']); 
	$smarty->assign("nHP", $getCharacterInfo['nHP']); 
	$smarty->assign("nMP", $getCharacterInfo['nMP']); 
	$smarty->assign("nShield", $getCharacterInfo['nShield']); 
	$smarty->assign("wStr", $getCharacterInfo['wStr']); 
	$smarty->assign("wDex", $getCharacterInfo['wDex']); 
	$smarty->assign("wCon", $getCharacterInfo['wCon']); 
	$smarty->assign("wSpr", $getCharacterInfo['wSpr']); 
	$smarty->assign("wStatPoint", $getCharacterInfo['wStatPoint']); 
	$smarty->assign("wSkillPoint", $getCharacterInfo['wSkillPoint']); 
	
	switch ($getCharacterInfo['bySkillClearCount'])
	{
		case '1':
			$smarty->assign("bySkillClearCount", '<option value="0">Not Used</option><option value="1" selected>Used</option>'); 
			break;
		case '0':
			$smarty->assign("bySkillClearCount", '<option value="0" selected>Not Used</option><option value="1">Used</option>'); 
			break;
	}	
	
	switch ($getCharacterInfo['byStatClearCount'])
	{
		case '1':
			$smarty->assign("byStatClearCount", '<option value="0">Not Used</option><option value="1" selected>Used</option>'); 
			break;
		case '0':
			$smarty->assign("byStatClearCount", '<option value="0" selected>Not Used</option><option value="1">Used</option>');
			break;
	}	
	
	$smarty->assign("dwExp", $getCharacterInfo['dwExp']); 
	
	$wLevel = '';
	for($i = 1; $i < '256'; $i++)
	{
		$wLevel .= '<option value="' . $i . '"';
		if ($i == $getCharacterInfo['wLevel'])
		{
			$wLevel .= ' selected ';
		}						
		$wLevel .= '>' . $i . '</option>';
	}
	$smarty->assign("wLevel", $wLevel);
	
	$reborn = '';
	if($config->get('reborn_system', 'settings_edit_character') == '1')
	{
		$reborn_column = $config->get('reborn_column', 'settings_edit_character');
		$reborn = '
		<tr class="even">
			<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Reborn</b><br>Number of reborn<br><small>Numbers Only</small></td>
			<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="'.$reborn_column.'" size="30" value="'.$getCharacterInfo[$reborn_column].'"  /></td>
		</tr>';

	}	
	$smarty->assign("reborn", $reborn); 
	
	$wMapIndex = '';
	foreach ($array_map as $map_id => $map_name)
	{
		$wMapIndex .= '<option value="' . $map_id . '"';
		
		if ($map_id == $getCharacterInfo['wMapIndex'])
		{
			$wMapIndex .= ' selected ';
		}
		
		$wMapIndex .= '>' . $map_name . '</option>';
	}
	$smarty->assign("wMapIndex", $wMapIndex);
	
	$wPosX = '';
	for($i = 0; $i < '513'; $i++)
	{
		$wPosX .= '<option value="' . $i . '"';
		if ($i == $getCharacterInfo['wPosX'])
		{
			$wPosX .= ' selected ';
		}						
		$wPosX .= '>' . $i . '</option>';
	}	
	$smarty->assign("wPosX", $wPosX);
	
	$wPosY = '';
	for($i = 0; $i < '513'; $i++)
	{
		$wPosY .= '<option value="' . $i . '"';
		if ($i == $getCharacterInfo['wPosY'])
		{
			$wPosY .= ' selected ';
		}						
		$wPosY .= '>' . $i . '</option>';
	}	
	$smarty->assign("wPosY", $wPosY); 
	
	$wRetMapIndex = '';
	foreach ($array_map as $map_id => $map_name)
	{
		$wRetMapIndex .= '<option value="' . $map_id . '"';
		
		if ($map_id == $getCharacterInfo['wRetMapIndex'])
		{
			$wRetMapIndex .= ' selected ';
		}
		
		$wRetMapIndex .= '>' . $map_name . '</option>';
	}	
	$smarty->assign("wRetMapIndex", $wRetMapIndex);
	
	$wRetPosX = '';
	for($i = 0; $i < '513'; $i++)
	{
		$wRetPosX .= '<option value="' . $i . '"';
		if ($i == $getCharacterInfo['wRetPosX'])
		{
			$wRetPosX .= ' selected ';
		}						
		$wRetPosX .= '>' . $i . '</option>';
	}	
	$smarty->assign("wRetPosX", $wRetPosX);
	
	$wRetPosY = '';
	for($i = 0; $i < '513'; $i++)
	{
		$wRetPosY .= '<option value="' . $i . '"';
		if ($i == $getCharacterInfo['wRetPosY'])
		{
			$wRetPosY .= ' selected ';
		}						
		$wRetPosY .= '>' . $i . '</option>';
	}
	$smarty->assign("wRetPosY", $wRetPosY);
	
	
	$smarty->assign("dwMoney", $getCharacterInfo['dwMoney']);
	$smarty->assign("dwStoreMoney", $getCharacterInfo['dwStoreMoney']);
	$smarty->assign("dwStorageMoney", $getCharacterInfo['dwStorageMoney']);
	$smarty->assign("wPKCount", $getCharacterInfo['wPKCount']);
	$smarty->assign("dwPVPPoint", $getCharacterInfo['dwPVPPoint']);
	$smarty->assign("wWinRecord", $getCharacterInfo['wWinRecord']);
	$smarty->assign("wLoseRecord", $getCharacterInfo['wLoseRecord']);
	$smarty->assign("wDrawRecord", $getCharacterInfo['wDrawRecord']);
	$smarty->assign("dwSupplyPoint", $getCharacterInfo['dwSupplyPoint']);
	
	switch ($getCharacterInfo['login_flag'])
	{
		case 'Y':
			$smarty->assign("login_flag", '<option value="N">No</option><option value="Y" selected>Yes</option>');
			break;
		case 'N':
			$smarty->assign("login_flag", '<option value="N" selected>No</option><option value="Y">Yes</option>');
			break;
	}	
	
	$smarty->assign("ipt_date", $getCharacterInfo['ipt_date']);
	$smarty->assign("ipt_time", $getCharacterInfo['ipt_time']);
	$smarty->assign("upt_time", $getCharacterInfo['upt_time']);
	$smarty->assign("login_time", $getCharacterInfo['login_time']);
	$smarty->assign("logout_time", $getCharacterInfo['logout_time']);
	$smarty->assign("user_ip_addr", decodeIp($getCharacterInfo['user_ip_addr']));
}
?>