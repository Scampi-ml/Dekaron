<?php /* Smarty version Smarty-3.1.13, created on 2013-12-04 03:28:52
         compiled from ".\templates\settings_edit_guild_permissions_names.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13348529f03e415f924-08329320%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1a83233bbd841c1d1a5b518c3f747357766cfbd4' => 
    array (
      0 => '.\\templates\\settings_edit_guild_permissions_names.tpl',
      1 => 1385820999,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13348529f03e415f924-08329320',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'POST' => 0,
    'MESSAGE' => 0,
    'switch' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529f03e41b1e15_39603462',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529f03e41b1e15_39603462')) {function content_529f03e41b1e15_39603462($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['POST']->value==1){?><?php echo $_smarty_tpl->tpl_vars['MESSAGE']->value;?>
<?php }else{ ?>
<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Edit Guild Permissions Names</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Show default names?</b><br>Show the default names for guild permission name?</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="show_default"><?php echo $_smarty_tpl->tpl_vars['switch']->value;?>
</select></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Save Settings"></td>
</tr>
</table>
</form>
<?php }?><?php }} ?>