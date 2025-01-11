<?php /* Smarty version Smarty-3.1.13, created on 2013-12-04 03:26:48
         compiled from ".\templates\settings_send_message.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10919529f0368663392-04047886%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '91e198daa5c4943729b46b26f49db6b45b865e7b' => 
    array (
      0 => '.\\templates\\settings_send_message.tpl',
      1 => 1385821001,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10919529f0368663392-04047886',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'POST' => 0,
    'MESSAGE' => 0,
    'from_name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529f036868c5b0_50678470',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529f036868c5b0_50678470')) {function content_529f036868c5b0_50678470($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['POST']->value==1){?><?php echo $_smarty_tpl->tpl_vars['MESSAGE']->value;?>
<?php }else{ ?>
<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Send Message Settings</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>From</b><br>This is the "From" name, you can leave this blank if you dont want to add THIS text / name</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="from_name" size="30" value="<?php echo $_smarty_tpl->tpl_vars['from_name']->value;?>
" /></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Save Settings"></td>
</tr>
</table>
</form>
<?php }?><?php }} ?>