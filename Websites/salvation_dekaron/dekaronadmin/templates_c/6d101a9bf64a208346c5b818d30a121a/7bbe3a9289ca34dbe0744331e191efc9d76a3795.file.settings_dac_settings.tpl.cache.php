<?php /* Smarty version Smarty-3.1.13, created on 2013-12-04 03:29:07
         compiled from ".\templates\settings_dac_settings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13237529f03f37aa7e4-65910002%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7bbe3a9289ca34dbe0744331e191efc9d76a3795' => 
    array (
      0 => '.\\templates\\settings_dac_settings.tpl',
      1 => 1385820998,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13237529f03f37aa7e4-65910002',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'POST' => 0,
    'MESSAGE' => 0,
    'msg_redirect' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529f03f37c9309_76951582',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529f03f37c9309_76951582')) {function content_529f03f37c9309_76951582($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['POST']->value==1){?><?php echo $_smarty_tpl->tpl_vars['MESSAGE']->value;?>
<?php }else{ ?>
<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">DAC Settings</td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Redirect message speed</b><br>The speed (in seconds) to display messages<br>This does not apply on errors or error messages<br>Default & recommended: 1</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="msg_redirect" size="30" value="<?php echo $_smarty_tpl->tpl_vars['msg_redirect']->value;?>
" /></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Save Settings"></td>
</tr>
</table>
</form>
<?php }?>
<?php }} ?>