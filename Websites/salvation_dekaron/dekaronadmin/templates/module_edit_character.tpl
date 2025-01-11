<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Edit Character</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>User ID / Number</b><br>Must not be changed, for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">{$user_id} / {$user_no}</td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Character Number</b><br>Must not be changed, for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">{$character_no}</td>
	</tr>
	<tr class="even">	

		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Character Name</b><br>The characters name, displayed ingame as there name<br><small>0-9 A-Z Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="character_name" size="30" maxlength="40" value="{$character_name}"  /></td>
	</tr>
	<tr class="">
	  <td align="left" class="panel_text_alt1" width="45%" valign="top"><b>Class</b><br>The class of the character, should not be changed</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">{$byPCClass}</td>
	</tr>
	<tr>
		<td align="center" class="panel_title" colspan="2">Stats</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Adventure Points</b><br>Also known as 'ADV', used for raising the guild level<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwAdv" size="30"  value="{$dwAdv}"  /></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Health Point</b><br>Life of the character based on stats (Con)<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="nHP" size="30" value="{$nHP}"  /></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Magic Point</b><br>Mana of the character based on stats (Spr)<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="nMP" size="30" value="{$nMP}"  /></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Shield</b><br>Characters shield<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="nShield" size="30" value="{$nShield}"  /></td>
	</tr>  
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Strenght</b><br>Also known as 'Str', physical attack<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wStr" size="30" value="{$wStr}"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Dexterity</b><br>Also known as 'Dex', skill<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wDex" size="30" value="{$wDex}"  /></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Contribution</b><br>Also known as 'Con', health point<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wCon" size="30" value="{$wCon}"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Spirit</b><br>Also known as 'Spr', magic attack<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wSpr" size="30" value="{$wSpr}"  /></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Stat Point</b><br>The amount of un-used stats points the character has left<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wStatPoint" size="30" value="{$wStatPoint}"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Skill Point</b><br>The amount of un-used skill points the character has left<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wSkillPoint" size="30" value="{$wSkillPoint}"  /></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Skill Clear Count</b><br>If the character used his skills reset<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="bySkillClearCount">{$bySkillClearCount}</select></td>
	</tr>     
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Stat Clear Count</b><br>If the character used his stats reset<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="byStatClearCount">{$byStatClearCount}</select></td>
	</tr>  
	<tr>
		<td align="center" class="panel_title" colspan="2">Character Progress</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Experience</b><br>Level progress<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwExp" size="30" value="{$dwExp}"  /></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Level</b><br>Current level of the character<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="wLevel">{$wLevel}</select></td>
	</tr> 
	{$reborn} 
	<tr>
		<td align="center" class="panel_title" colspan="2">Location</td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Current Map</b><br>The characters last know map<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="wMapIndex">{$wMapIndex}</select>
        </td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Current Location</b><br>The characters last know X and Y cordinates<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><b>X</b> &nbsp;&nbsp;<select name="wPosX">{$wPosX}</select><br><b>Y</b> &nbsp;&nbsp;<select name="wPosY">{$wPosY}</select></td>
	</tr> 
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Return Map</b>
        	<br>The characters return map
            <br>When the character dies, he will be moved to this location
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="wRetMapIndex">{$wRetMapIndex}</select></td>
	</tr>  
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Return Location</b><br>The characters respawn X and Y cordinates<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><b>X</b> &nbsp;&nbsp;<select name="wRetPosX">{$wRetPosX}</select><br><b>Y</b> &nbsp;&nbsp;<select name="wRetPosY">{$wRetPosY}</select></td>
	</tr> 
	<tr>
		<td align="center" class="panel_title" colspan="2">Finacial</td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Inventory Money</b><br>Current money in the characters inventory<br><small>Numbers Only, Max 999999999</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwMoney" size="30" value="{$dwMoney}"  /></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Store Money</b><br>Current money in the characters personal store<br><small>Numbers Only, Max 999999999</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwStoreMoney" size="30" value="{$dwStoreMoney}"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Storage Money</b><br>Current money in the characters storage<br><small>Numbers Only, Max 999999999</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwStorageMoney" size="30" value="{$dwStorageMoney}"  /></td>
	</tr>    
	<tr>
		<td align="center" class="panel_title" colspan="2">Player Versus Player</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>PK Count</b><br>How many characters the character killed<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wPKCount" size="30" value="{$wPKCount}"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>PVP Point</b><br>Player versus player point<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwPVPPoint" size="30" value="{$dwPVPPoint}"  /></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Win Record</b><br>Amount of PVP Wins<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wWinRecord" size="30" value="{$wWinRecord}"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Lose Record</b><br>Amount of PVP Losses<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wLoseRecord" size="30" value="{$wLoseRecord}"  /></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Draw Record</b><br>Amount of PVP Draws<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wDrawRecord" size="30" value="{$wDrawRecord}"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Supply Point</b><br>Used in siege wars<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwSupplyPoint" size="30" value="{$dwSupplyPoint}"  /></td>
	</tr> 
	<tr>
		<td align="center" class="panel_title" colspan="2">Access & Info</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Game Access</b><br>If the character is able to login<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="login_flag">{$login_flag}</select></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Ipt Date</b><br>Unknown</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">{$ipt_date}</td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Ipt Time</b><br>Unknown</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">{$ipt_time}</td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Upt Time</b><br>Unknown</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">{$upt_time}</td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Login Time</b><br>Login time, for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">{$login_time}</td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Logout Time</b><br>Logout time, for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">{$logout_time}</td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Ip Address</b><br>The characters last known Ip Address</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">{$user_ip_addr}</td>
	</tr>    
     
    <tr>
    	<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Update" onclick="ask_url('Are you sure you want to update?','index.php?get=module_edit_character&character={$character_no}')"></td>
    </tr>
</table>
</form>
