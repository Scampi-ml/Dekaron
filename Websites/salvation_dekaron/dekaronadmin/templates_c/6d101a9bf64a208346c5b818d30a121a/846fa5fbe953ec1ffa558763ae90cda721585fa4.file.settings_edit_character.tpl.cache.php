<?php /* Smarty version Smarty-3.1.13, created on 2013-12-04 03:28:58
         compiled from ".\templates\settings_edit_character.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15307529f03ea8fd973-15619990%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '846fa5fbe953ec1ffa558763ae90cda721585fa4' => 
    array (
      0 => '.\\templates\\settings_edit_character.tpl',
      1 => 1385820999,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15307529f03ea8fd973-15619990',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'POST' => 0,
    'MESSAGE' => 0,
    'switch' => 0,
    'reborn_column' => 0,
    'switch1' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529f03ea9277c7_07749001',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529f03ea9277c7_07749001')) {function content_529f03ea9277c7_07749001($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['POST']->value==1){?><?php echo $_smarty_tpl->tpl_vars['MESSAGE']->value;?>
<?php }else{ ?>
<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Edit Character Settings</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Use Reborn System?</b><br>If you have a reborn system you can set it to 'yes'<br>If you set this to 'yes', you must fill in <b>reborn_column</b></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="reborn_system"><?php echo $_smarty_tpl->tpl_vars['switch']->value;?>
</select></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Reborn Column</b><br>The reborn column name, found in Character Database -> user_character</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="reborn_column" size="30" value="<?php echo $_smarty_tpl->tpl_vars['reborn_column']->value;?>
" /></td>
	</tr> 
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Use A-Z & 0-9 check on character name?</b><br>If you want to disable the check on character names, set this to 'No'<br>This is usefull when you try to edit character with special characters in there name.<br>Ex. [Gm chars], [Dev chars]</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="az09_char_check"><?php echo $_smarty_tpl->tpl_vars['switch1']->value;?>
</select></td>
	</tr>
    <tr>
    	<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Save Settings"></td>
    </tr>
</table>
</form>
<?php }?><?php }} ?>