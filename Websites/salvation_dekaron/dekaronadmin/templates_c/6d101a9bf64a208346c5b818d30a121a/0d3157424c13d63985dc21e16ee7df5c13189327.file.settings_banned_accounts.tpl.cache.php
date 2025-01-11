<?php /* Smarty version Smarty-3.1.13, created on 2013-12-04 03:29:13
         compiled from ".\templates\settings_banned_accounts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5519529f03f9674ff3-75418652%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d3157424c13d63985dc21e16ee7df5c13189327' => 
    array (
      0 => '.\\templates\\settings_banned_accounts.tpl',
      1 => 1385820998,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5519529f03f9674ff3-75418652',
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
  'unifunc' => 'content_529f03f9693886_93109652',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529f03f9693886_93109652')) {function content_529f03f9693886_93109652($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['POST']->value==1){?><?php echo $_smarty_tpl->tpl_vars['MESSAGE']->value;?>
<?php }else{ ?>
<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Banned Account Settings</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Results</b><br>The amount of results to be displayed, 50 is recommended<br>The show all results enter 999</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="top" size="30" value="<?php echo $_smarty_tpl->tpl_vars['TOP']->value;?>
" /></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Save Settings"></td>
</tr>
</table>
</form>
<?php }?><?php }} ?>