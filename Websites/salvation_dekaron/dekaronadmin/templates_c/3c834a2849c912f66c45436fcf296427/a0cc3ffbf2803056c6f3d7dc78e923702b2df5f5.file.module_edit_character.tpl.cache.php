<?php /* Smarty version Smarty-3.1.13, created on 2013-12-11 15:51:13
         compiled from ".\templates\module_edit_character.tpl" */ ?>
<?php /*%%SmartyHeaderCode:352952a87be121ee47-85201141%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0cc3ffbf2803056c6f3d7dc78e923702b2df5f5' => 
    array (
      0 => '.\\templates\\module_edit_character.tpl',
      1 => 1385820950,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '352952a87be121ee47-85201141',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user_id' => 0,
    'user_no' => 0,
    'character_no' => 0,
    'character_name' => 0,
    'byPCClass' => 0,
    'dwAdv' => 0,
    'nHP' => 0,
    'nMP' => 0,
    'nShield' => 0,
    'wStr' => 0,
    'wDex' => 0,
    'wCon' => 0,
    'wSpr' => 0,
    'wStatPoint' => 0,
    'wSkillPoint' => 0,
    'bySkillClearCount' => 0,
    'byStatClearCount' => 0,
    'dwExp' => 0,
    'wLevel' => 0,
    'reborn' => 0,
    'wMapIndex' => 0,
    'wPosX' => 0,
    'wPosY' => 0,
    'wRetMapIndex' => 0,
    'wRetPosX' => 0,
    'wRetPosY' => 0,
    'dwMoney' => 0,
    'dwStoreMoney' => 0,
    'dwStorageMoney' => 0,
    'wPKCount' => 0,
    'dwPVPPoint' => 0,
    'wWinRecord' => 0,
    'wLoseRecord' => 0,
    'wDrawRecord' => 0,
    'dwSupplyPoint' => 0,
    'login_flag' => 0,
    'ipt_date' => 0,
    'ipt_time' => 0,
    'upt_time' => 0,
    'login_time' => 0,
    'logout_time' => 0,
    'user_ip_addr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a87be1352086_71082483',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a87be1352086_71082483')) {function content_52a87be1352086_71082483($_smarty_tpl) {?><form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Edit Character</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>User ID / Number</b><br>Must not be changed, for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['user_no']->value;?>
</td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Character Number</b><br>Must not be changed, for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['character_no']->value;?>
</td>
	</tr>
	<tr class="even">	

		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Character Name</b><br>The characters name, displayed ingame as there name<br><small>0-9 A-Z Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="character_name" size="30" maxlength="40" value="<?php echo $_smarty_tpl->tpl_vars['character_name']->value;?>
"  /></td>
	</tr>
	<tr class="">
	  <td align="left" class="panel_text_alt1" width="45%" valign="top"><b>Class</b><br>The class of the character, should not be changed</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['byPCClass']->value;?>
</td>
	</tr>
	<tr>
		<td align="center" class="panel_title" colspan="2">Stats</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Adventure Points</b><br>Also known as 'ADV', used for raising the guild level<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwAdv" size="30"  value="<?php echo $_smarty_tpl->tpl_vars['dwAdv']->value;?>
"  /></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Health Point</b><br>Life of the character based on stats (Con)<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="nHP" size="30" value="<?php echo $_smarty_tpl->tpl_vars['nHP']->value;?>
"  /></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Magic Point</b><br>Mana of the character based on stats (Spr)<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="nMP" size="30" value="<?php echo $_smarty_tpl->tpl_vars['nMP']->value;?>
"  /></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Shield</b><br>Characters shield<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="nShield" size="30" value="<?php echo $_smarty_tpl->tpl_vars['nShield']->value;?>
"  /></td>
	</tr>  
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Strenght</b><br>Also known as 'Str', physical attack<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wStr" size="30" value="<?php echo $_smarty_tpl->tpl_vars['wStr']->value;?>
"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Dexterity</b><br>Also known as 'Dex', skill<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wDex" size="30" value="<?php echo $_smarty_tpl->tpl_vars['wDex']->value;?>
"  /></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Contribution</b><br>Also known as 'Con', health point<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wCon" size="30" value="<?php echo $_smarty_tpl->tpl_vars['wCon']->value;?>
"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Spirit</b><br>Also known as 'Spr', magic attack<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wSpr" size="30" value="<?php echo $_smarty_tpl->tpl_vars['wSpr']->value;?>
"  /></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Stat Point</b><br>The amount of un-used stats points the character has left<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wStatPoint" size="30" value="<?php echo $_smarty_tpl->tpl_vars['wStatPoint']->value;?>
"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Skill Point</b><br>The amount of un-used skill points the character has left<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wSkillPoint" size="30" value="<?php echo $_smarty_tpl->tpl_vars['wSkillPoint']->value;?>
"  /></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Skill Clear Count</b><br>If the character used his skills reset<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="bySkillClearCount"><?php echo $_smarty_tpl->tpl_vars['bySkillClearCount']->value;?>
</select></td>
	</tr>     
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Stat Clear Count</b><br>If the character used his stats reset<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="byStatClearCount"><?php echo $_smarty_tpl->tpl_vars['byStatClearCount']->value;?>
</select></td>
	</tr>  
	<tr>
		<td align="center" class="panel_title" colspan="2">Character Progress</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Experience</b><br>Level progress<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwExp" size="30" value="<?php echo $_smarty_tpl->tpl_vars['dwExp']->value;?>
"  /></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Level</b><br>Current level of the character<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="wLevel"><?php echo $_smarty_tpl->tpl_vars['wLevel']->value;?>
</select></td>
	</tr> 
	<?php echo $_smarty_tpl->tpl_vars['reborn']->value;?>
 
	<tr>
		<td align="center" class="panel_title" colspan="2">Location</td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Current Map</b><br>The characters last know map<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="wMapIndex"><?php echo $_smarty_tpl->tpl_vars['wMapIndex']->value;?>
</select>
        </td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Current Location</b><br>The characters last know X and Y cordinates<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><b>X</b> &nbsp;&nbsp;<select name="wPosX"><?php echo $_smarty_tpl->tpl_vars['wPosX']->value;?>
</select><br><b>Y</b> &nbsp;&nbsp;<select name="wPosY"><?php echo $_smarty_tpl->tpl_vars['wPosY']->value;?>
</select></td>
	</tr> 
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Return Map</b>
        	<br>The characters return map
            <br>When the character dies, he will be moved to this location
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="wRetMapIndex"><?php echo $_smarty_tpl->tpl_vars['wRetMapIndex']->value;?>
</select></td>
	</tr>  
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Return Location</b><br>The characters respawn X and Y cordinates<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><b>X</b> &nbsp;&nbsp;<select name="wRetPosX"><?php echo $_smarty_tpl->tpl_vars['wRetPosX']->value;?>
</select><br><b>Y</b> &nbsp;&nbsp;<select name="wRetPosY"><?php echo $_smarty_tpl->tpl_vars['wRetPosY']->value;?>
</select></td>
	</tr> 
	<tr>
		<td align="center" class="panel_title" colspan="2">Finacial</td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Inventory Money</b><br>Current money in the characters inventory<br><small>Numbers Only, Max 999999999</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwMoney" size="30" value="<?php echo $_smarty_tpl->tpl_vars['dwMoney']->value;?>
"  /></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Store Money</b><br>Current money in the characters personal store<br><small>Numbers Only, Max 999999999</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwStoreMoney" size="30" value="<?php echo $_smarty_tpl->tpl_vars['dwStoreMoney']->value;?>
"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Storage Money</b><br>Current money in the characters storage<br><small>Numbers Only, Max 999999999</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwStorageMoney" size="30" value="<?php echo $_smarty_tpl->tpl_vars['dwStorageMoney']->value;?>
"  /></td>
	</tr>    
	<tr>
		<td align="center" class="panel_title" colspan="2">Player Versus Player</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>PK Count</b><br>How many characters the character killed<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wPKCount" size="30" value="<?php echo $_smarty_tpl->tpl_vars['wPKCount']->value;?>
"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>PVP Point</b><br>Player versus player point<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwPVPPoint" size="30" value="<?php echo $_smarty_tpl->tpl_vars['dwPVPPoint']->value;?>
"  /></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Win Record</b><br>Amount of PVP Wins<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wWinRecord" size="30" value="<?php echo $_smarty_tpl->tpl_vars['wWinRecord']->value;?>
"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Lose Record</b><br>Amount of PVP Losses<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wLoseRecord" size="30" value="<?php echo $_smarty_tpl->tpl_vars['wLoseRecord']->value;?>
"  /></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Draw Record</b><br>Amount of PVP Draws<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wDrawRecord" size="30" value="<?php echo $_smarty_tpl->tpl_vars['wDrawRecord']->value;?>
"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Supply Point</b><br>Used in siege wars<br><small>Numbers Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="dwSupplyPoint" size="30" value="<?php echo $_smarty_tpl->tpl_vars['dwSupplyPoint']->value;?>
"  /></td>
	</tr> 
	<tr>
		<td align="center" class="panel_title" colspan="2">Access & Info</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Game Access</b><br>If the character is able to login<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="login_flag"><?php echo $_smarty_tpl->tpl_vars['login_flag']->value;?>
</select></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Ipt Date</b><br>Unknown</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['ipt_date']->value;?>
</td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Ipt Time</b><br>Unknown</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['ipt_time']->value;?>
</td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Upt Time</b><br>Unknown</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['upt_time']->value;?>
</td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Login Time</b><br>Login time, for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['login_time']->value;?>
</td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Logout Time</b><br>Logout time, for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['logout_time']->value;?>
</td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Ip Address</b><br>The characters last known Ip Address</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['user_ip_addr']->value;?>
</td>
	</tr>    
     
    <tr>
    	<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Update" onclick="ask_url('Are you sure you want to update?','index.php?get=module_edit_character&character=<?php echo $_smarty_tpl->tpl_vars['character_no']->value;?>
')"></td>
    </tr>
</table>
</form>
<?php }} ?>