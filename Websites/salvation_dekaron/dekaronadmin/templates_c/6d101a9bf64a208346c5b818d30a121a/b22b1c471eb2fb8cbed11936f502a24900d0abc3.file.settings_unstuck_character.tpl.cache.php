<?php /* Smarty version Smarty-3.1.13, created on 2013-12-04 03:28:21
         compiled from ".\templates\settings_unstuck_character.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1356529f03c59fa799-65955036%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b22b1c471eb2fb8cbed11936f502a24900d0abc3' => 
    array (
      0 => '.\\templates\\settings_unstuck_character.tpl',
      1 => 1385821001,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1356529f03c59fa799-65955036',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'POST' => 0,
    'MESSAGE' => 0,
    'map' => 0,
    'wposx' => 0,
    'wposy' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529f03c5a25638_20169935',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529f03c5a25638_20169935')) {function content_529f03c5a25638_20169935($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['POST']->value==1){?><?php echo $_smarty_tpl->tpl_vars['MESSAGE']->value;?>
<?php }else{ ?>
<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Unstuck Character Settings</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Unstuck Map Number</b><br>The map where you cant to move the character to when using unstuck<br>the character will be moved to this map<br>Map Number (id) only ! </td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="map" size="30" value="<?php echo $_smarty_tpl->tpl_vars['map']->value;?>
" /></td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Unstuck Pos X</b><br>The pos X where you cant to move the character to when using unstuck<br>the character will be moved to this location</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wposx" size="30" value="<?php echo $_smarty_tpl->tpl_vars['wposx']->value;?>
" /></td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Unstuck Pos Y</b><br>The pos Y where you cant to move the character to when using unstuck<br>the character will be moved to this location</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wposy" size="30" value="<?php echo $_smarty_tpl->tpl_vars['wposy']->value;?>
" /></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Save Settings"></td>
</tr>
</table>
</form>
<?php }?><?php }} ?>