<?php /* Smarty version Smarty-3.1.13, created on 2013-05-20 10:51:59
         compiled from ".\templates\settings_cash_log.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2686519a62bf1105f3-41349650%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '762950c063682b5a8e9bef005490303757c339b4' => 
    array (
      0 => '.\\templates\\settings_cash_log.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2686519a62bf1105f3-41349650',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'POST' => 0,
    'MESSAGE' => 0,
    'TOP' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_519a62bf121535_57619271',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_519a62bf121535_57619271')) {function content_519a62bf121535_57619271($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['POST']->value==1){?><?php echo $_smarty_tpl->tpl_vars['MESSAGE']->value;?>
<?php }else{ ?>
<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Cash Log Settings</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Results</b><br>The amount of results to be displayed, 100 is recommended</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="top" size="30" value="<?php echo $_smarty_tpl->tpl_vars['TOP']->value;?>
" /></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Save Settings"></td>
</tr>
</table>
</form>
<?php }?><?php }} ?>