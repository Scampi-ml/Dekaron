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
	$validate->check("character_name","alnum","You can only use A-Z / 0-9 characters in your character name");
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
		echo notice_message_admin('You have the following errors:<br>'.$validate->GetErrors().'', '0', '1', 'index.php?get=module_edit_character&character='.$_GET['character'].'');
    }
    else
	{
		$SQLquery1 = $db->SQLquery("UPDATE character.dbo.user_character SET character_name = '%s', dwAdv = '%s', dwPeerage = '%s', dwExp = '%s', dwMoney = '%s', dwStoreMoney = '%s', dwStorageMoney = '%s', nHP = '%s', nMP = '%s', wStr = '%s', wDex = '%s', wCon = '%s', wSpr = '%s', wPosX = '%s', wPosY = '%s', wRetPosX = '%s', wRetPosY = '%s', wMapIndex = '%s', wRetMapIndex = '%s', wStatPoint = '%s', wSkillPoint = '%s', wLevel = '%s', bySkillClearCount = '%s', byStatClearCount = '%s', wPKCount = '%s', wChaoticLevel = '%s', nShield = '%s', dwFlag = '%s', login_flag = '%s', dwPVPPoint = '%s', wWinRecord = '%s', wLoseRecord = '%s', wDrawRecord = '%s', dwSupplyPoint = '%s' WHERE character_no = '%s'", $_POST['character_name'],$_POST['dwAdv'],$_POST['dwPeerage'],$_POST['dwExp'],$_POST['dwMoney'],$_POST['dwStoreMoney'],$_POST['dwStorageMoney'],$_POST['nHP'],$_POST['nMP'],$_POST['wStr'],$_POST['wDex'],$_POST['wCon'],$_POST['wSpr'],$_POST['wPosX'],$_POST['wPosY'],$_POST['wRetPosX'],$_POST['wRetPosY'],$_POST['wMapIndex'],$_POST['wRetMapIndex'],$_POST['wStatPoint'],$_POST['wSkillPoint'],$_POST['wLevel'],$_POST['bySkillClearCount'],$_POST['byStatClearCount'],$_POST['wPKCount'],$_POST['wChaoticLevel'],$_POST['nShield'],$_POST['dwFlag'],$_POST['login_flag'],$_POST['dwPVPPoint'],$_POST['wWinRecord'],$_POST['wLoseRecord'],$_POST['wDrawRecord'],$_POST['dwSupplyPoint'],$_GET['character']);
		
		if($config->get('reborn_system', 'settings_edit_character') == '1')
		{
			$reborn_column = $config->get('reborn_column', 'settings_edit_character');
			$SQLquery1 = $db->SQLquery("UPDATE character.dbo.user_character SET ".$reborn_column." = '%s' WHERE character_no = '%s'", $_POST[$reborn_column], $_GET['character']);
		}
				
		echo notice_message_admin('Character successfully updated', '1', '0', 'index.php?get=module_edit_character&character='.$_GET['character'].'');
	}
}
else
{
	require_once ('engine/array_map.php');
	
	flush_this();
	$SQLquery1 = $db->SQLquery("SELECT * FROM character.dbo.user_character WHERE character_no = '".$_GET['character']."' ");
	$getCharacterInfo = $db->SQLfetchArray($SQLquery1);
	
?>
<form method="post" action="">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Edit Character</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>User Number</b><br>Must not be changed, for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars($getCharacterInfo['user_no']); ?></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Character Number</b><br>Must not be changed, for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars($getCharacterInfo['character_no']); ?></td>
	</tr>
	<tr class="even">	

		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Character Name</b><br>The characters name, displayed ingame as there name<br><small>0-9 A-Z Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="character_name" size="30" maxlength="40" value="<?php echo htmlspecialchars($getCharacterInfo['character_name']); ?>"  /></td>
	</tr>
	<tr class="">
	  <td align="left" class="panel_text_alt1" width="45%" valign="top"><b>Class</b><br>The class of the character, should not be changed</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars(_class($getCharacterInfo['byPCClass'])); ?></td>
	</tr>
	<tr>
		<td align="center" class="panel_title" colspan="2">Stats</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Adventure Points</b><br>Also known as 'ADV', used for raising the guild level<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwAdv" size="30"  value="<?php echo htmlspecialchars($getCharacterInfo['dwAdv']); ?>"  /></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Health Point</b><br>Life of the character based on stats (Con)<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="nHP" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['nHP']); ?>"  /></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Magic Point</b><br>Mana of the character based on stats (Spr)<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="nMP" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['nMP']); ?>"  /></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Shield</b><br>Characters shield<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="nShield" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['nShield']); ?>"  /></td>
	</tr>  
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Strenght</b><br>Also known as 'Str', physical attack<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wStr" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['wStr']); ?>"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Dexterity</b><br>Also known as 'Dex', skill<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wDex" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['wDex']); ?>"  /></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Contribution</b><br>Also known as 'Con', health point<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wCon" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['wCon']); ?>"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Spirit</b><br>Also known as 'Spr', magic attack<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wSpr" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['wSpr']); ?>"  /></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Stat Point</b><br>The amount of un-used stats points the character has left<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wStatPoint" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['wStatPoint']); ?>"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Skill Point</b><br>The amount of un-used skill points the character has left<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wSkillPoint" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['wSkillPoint']); ?>"  /></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Skill Clear Count</b><br>If the character used his skills reset<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="bySkillClearCount">
			<?php 
                switch (htmlspecialchars($getCharacterInfo['bySkillClearCount']))
				{
                    case '1':
                        echo '<option value="0">Not Used</option><option value="1" selected>Used</option>';
                        break;
                    case '0':
                        echo '<option value="0" selected>Not Used</option><option value="1">Used</option>';
                        break;
                }
			?>
            </select>
        </td>
	</tr>     
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Stat Clear Count</b><br>If the character used his stats reset<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="byStatClearCount">
			<?php 
                switch (htmlspecialchars($getCharacterInfo['byStatClearCount']))
				{
                    case '1':
                        echo '<option value="0">Not Used</option><option value="1" selected>Used</option>';
                        break;
                    case '0':
                        echo '<option value="0" selected>Not Used</option><option value="1">Used</option>';
                        break;
                }
			?>
            </select>
        </td>
	</tr>  
	<tr>
		<td align="center" class="panel_title" colspan="2">Character Progress</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Experience</b><br>Level progress<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwExp" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['dwExp']); ?>"  /></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Level</b><br>Current level of the character<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="wLevel">
            	<?php
					for($i = 1; $i < '256'; $i++)
					{
						echo '<option value="' . $i . '"';
						if ($i == $getCharacterInfo['wLevel'])
						{
							echo ' selected ';
						}						
						echo '>' . $i . '</option>';
					}
        		?>
        	</select>
        </td>
	</tr> 
    <?php
	if($config->get('reborn_system', 'settings_edit_character') == '1')
	{
		$reborn_column = $config->get('reborn_column', 'settings_edit_character');
	?>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Reborn</b><br>Number of reborn<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="<?php echo $reborn_column; ?>" size="30" value="<?php echo htmlspecialchars($getCharacterInfo[$reborn_column]); ?>"  /></td>
	</tr>
    <?php
	}
	?>   
	<tr>
		<td align="center" class="panel_title" colspan="2">Location</td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Current Map</b><br>The characters last know map<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="wMapIndex">
				<?php
					foreach ($array_map as $map_id => $map_name)
					{
						echo '<option value="' . $map_id . '"';
						
						if ($map_id == $getCharacterInfo['wMapIndex'])
						{
							echo ' selected ';
						}
						
						echo '>' . $map_name . '</option>';
					}
                ?>
        	</select>
        </td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Current Location</b><br>The characters last know X and Y cordinates<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<b>X</b> &nbsp;&nbsp;
        	<select name="wPosX">
            	<?php
					for($i = 0; $i < '513'; $i++)
					{
						echo '<option value="' . $i . '"';
						if ($i == $getCharacterInfo['wPosX'])
						{
							echo ' selected ';
						}						
						echo '>' . $i . '</option>';
					}
        		?>
        	</select>
            <br><b>Y</b> &nbsp;&nbsp;
        	<select name="wPosY">
            	<?php
					for($i = 0; $i < '513'; $i++)
					{
						echo '<option value="' . $i . '"';
						if ($i == $getCharacterInfo['wPosY'])
						{
							echo ' selected ';
						}						
						echo '>' . $i . '</option>';
					}
        		?>
        	</select>
        </td>
	</tr> 
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Return Map</b>
        	<br>The characters return map
            <br>When the character dies, he will be moved to this location
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="wRetMapIndex">
				<?php
					foreach ($array_map as $map_id => $map_name)
					{
						echo '<option value="' . $map_id . '"';
						
						if ($map_id == $getCharacterInfo['wRetMapIndex'])
						{
							echo ' selected ';
						}
						
						echo '>' . $map_name . '</option>';
					}
                ?>
        	</select>
        </td>
	</tr>  
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Return Location</b><br>The characters respawn X and Y cordinates<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<b>X</b> &nbsp;&nbsp;
        	<select name="wRetPosX">
            	<?php
					for($i = 0; $i < '513'; $i++)
					{
						echo '<option value="' . $i . '"';
						if ($i == $getCharacterInfo['wRetPosX'])
						{
							echo ' selected ';
						}						
						echo '>' . $i . '</option>';
					}
        		?>
        	</select>
            <br><b>Y</b> &nbsp;&nbsp;
        	<select name="wRetPosY">
            	<?php
					for($i = 0; $i < '513'; $i++)
					{
						echo '<option value="' . $i . '"';
						if ($i == $getCharacterInfo['wRetPosY'])
						{
							echo ' selected ';
						}						
						echo '>' . $i . '</option>';
					}
        		?>
        	</select>
        </td>
	</tr> 
	<tr>
		<td align="center" class="panel_title" colspan="2">Finacial</td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Inventory Money</b><br>Current money in the characters inventory<br><small>Numbers Only, Max 999999999</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwMoney" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['dwMoney']); ?>"  /></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Store Money</b><br>Current money in the characters personal store<br><small>Numbers Only, Max 999999999</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwStoreMoney" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['dwStoreMoney']); ?>"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Storage Money</b><br>Current money in the characters storage<br><small>Numbers Only, Max 999999999</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwStorageMoney" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['dwStorageMoney']); ?>"  /></td>
	</tr>    
	<tr>
		<td align="center" class="panel_title" colspan="2">Player Versus Player</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>PK Count</b><br>How many characters the character killed<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wPKCount" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['wPKCount']); ?>"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>PVP Point</b><br>Player versus player point<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwPVPPoint" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['dwPVPPoint']); ?>"  /></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Win Record</b><br>Amount of PVP Wins<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wWinRecord" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['wWinRecord']); ?>"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Lose Record</b><br>Amount of PVP Losses<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wLoseRecord" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['wLoseRecord']); ?>"  /></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Draw Record</b><br>Amount of PVP Draws<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wDrawRecord" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['wDrawRecord']); ?>"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Supply Point</b><br>Used in siege wars<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwSupplyPoint" size="30" value="<?php echo htmlspecialchars($getCharacterInfo['dwSupplyPoint']); ?>"  /></td>
	</tr> 
	<tr>
		<td align="center" class="panel_title" colspan="2">Access & Info</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Game Access</b><br>If the character is able to login<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="login_flag">
			<?php 
                switch (htmlspecialchars($getCharacterInfo['login_flag']))
				{
                    case 'Y':
                        echo '<option value="N">No</option><option value="Y" selected>Yes</option>';
                        break;
                    case 'N':
                        echo '<option value="N" selected>No</option><option value="Y">Yes</option>';
                        break;
                }
			?>
            </select>
        </td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Ipt Date</b><br>Unknown</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars($getCharacterInfo['ipt_date']); ?></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Ipt Time</b><br>Unknown</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars($getCharacterInfo['ipt_time']); ?></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Upt Time</b><br>Unknown</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars($getCharacterInfo['upt_time']); ?></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Login Time</b><br>Login time, for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars($getCharacterInfo['login_time']); ?></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Logout Time</b><br>Logout time, for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars($getCharacterInfo['logout_time']); ?></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Ip Address</b><br>The characters last known Ip Address</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars(decodeIp($getCharacterInfo['user_ip_addr'])); ?></td>
	</tr>    
     
    <tr>
    	<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Update" onclick="ask_url('Are you sure you want to update?','index.php?get=module_edit_character&character=<?php echo $_GET['character']; ?>')"></td>
    </tr>
</table>
</form>
<?php
}
?>