<?php /* Smarty version Smarty-3.1.13, created on 2013-12-04 03:29:01
         compiled from ".\templates\settings_search_account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24306529f03eddb7799-97424918%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '594d0c93e9ea806b480c60b1171785486855ce83' => 
    array (
      0 => '.\\templates\\settings_search_account.tpl',
      1 => 1385821000,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24306529f03eddb7799-97424918',
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
  'unifunc' => 'content_529f03ede14050_57137849',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529f03ede14050_57137849')) {function content_529f03ede14050_57137849($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['POST']->value==1){?><?php echo $_smarty_tpl->tpl_vars['MESSAGE']->value;?>
<?php }else{ ?>
<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Seach Account Settings</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Results</b><br>The amount of results to be displayed, 50 is recommended</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="top" size="30" value="<?php echo $_smarty_tpl->tpl_vars['TOP']->value;?>
" /></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Save Settings"></td>
</tr>
</table>
</form>
<?php }?><?php }} ?>