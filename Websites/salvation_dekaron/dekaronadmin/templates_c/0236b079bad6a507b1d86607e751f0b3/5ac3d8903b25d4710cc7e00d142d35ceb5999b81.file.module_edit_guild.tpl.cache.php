<?php /* Smarty version Smarty-3.1.13, created on 2013-08-13 13:11:12
         compiled from ".\templates\module_edit_guild.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10258520a92e0949a64-32839543%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5ac3d8903b25d4710cc7e00d142d35ceb5999b81' => 
    array (
      0 => '.\\templates\\module_edit_guild.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10258520a92e0949a64-32839543',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'guild_code' => 0,
    'guild_name' => 0,
    'guild_serv_id' => 0,
    'guild_Level' => 0,
    'guild_Dil' => 0,
    'guild_adv' => 0,
    'guild_mark1' => 0,
    'guild_mark2' => 0,
    'guild_notice' => 0,
    'ipt_date' => 0,
    'upt_date' => 0,
    'guild_effect' => 0,
    'bystate' => 0,
    'bychannel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_520a92e0985520_10829921',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_520a92e0985520_10829921')) {function content_520a92e0985520_10829921($_smarty_tpl) {?><form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Edit Guild</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Code</b><br>Must not be changed, for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['guild_code']->value;?>
</td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Name</b><br>This is the login for the account</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="guild_name" size="30" maxlength="30" value="<?php echo $_smarty_tpl->tpl_vars['guild_name']->value;?>
" /></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Server Id</b><br>Must not be changed, only for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['guild_serv_id']->value;?>
</td>
	</tr>
	<tr class="">
	  <td align="left" class="panel_text_alt1" width="45%" valign="top"><b>Guild Level</b><br>The current guild level<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="guild_Level"><?php echo $_smarty_tpl->tpl_vars['guild_Level']->value;?>
</select></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Dil</b><br>Not used</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['guild_Dil']->value;?>
</td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Adventure Points</b><br>Also known as guild adv, used for raising the guild level<br><small>Numbers only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="guild_adv" size="30" value="<?php echo $_smarty_tpl->tpl_vars['guild_adv']->value;?>
"  /></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Emblem</b><br><small>Numbers only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<b>Guild Mark 1</b>&nbsp;&nbsp;<input type="text" name="guild_mark1" size="30" value="<?php echo $_smarty_tpl->tpl_vars['guild_mark1']->value;?>
"  />
            <br>
			<b>Guild Mark 2</b>&nbsp;&nbsp;<input type="text" name="guild_mark2" size="30" value="<?php echo $_smarty_tpl->tpl_vars['guild_mark2']->value;?>
"  />
         </td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Notice</b><br>The guild notice for all members to see<br>use \\ for a breakline<br><small>MAX 500 characters, Special characters and spaces also count!</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><textarea cols="60" rows="3"  name="guild_notice"><?php echo $_smarty_tpl->tpl_vars['guild_notice']->value;?>
</textarea></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Ipt Date</b><br>For info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['ipt_date']->value;?>
</td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Upt Date</b><br>For info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['upt_date']->value;?>
</td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Effect</b><br>The effect around the guild emblem <br>Only edit this if you know what you are doing<br><small>Numbers only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="guild_effect" size="30" value="<?php echo $_smarty_tpl->tpl_vars['guild_effect']->value;?>
"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild State</b><br>Unknown</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['bystate']->value;?>
</td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Channel</b><br>Unknown</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['bychannel']->value;?>
</</td>
	</tr>    
        
    <tr>
    	<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Update" onclick="ask_url('Are you sure you want to update?','index.php?get=module_edit_guild&guild=<?php echo $_smarty_tpl->tpl_vars['guild_code']->value;?>
')"></td>
    </tr>
</table>
</form><?php }} ?>