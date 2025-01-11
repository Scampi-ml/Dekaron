<?php /* Smarty version Smarty-3.1.13, created on 2014-01-14 12:30:09
         compiled from ".\templates\module_edit_coins.tpl" */ ?>
<?php /*%%SmartyHeaderCode:145452d51fc18e4e28-35858976%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '398b5ba7e4b12e20f602ae6335542416e16c3c5e' => 
    array (
      0 => '.\\templates\\module_edit_coins.tpl',
      1 => 1385820950,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '145452d51fc18e4e28-35858976',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'amount' => 0,
    'free_amount' => 0,
    'user_no' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52d51fc1908bd9_38744227',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52d51fc1908bd9_38744227')) {function content_52d51fc1908bd9_38744227($_smarty_tpl) {?><form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Edit Coins</td>
</tr>  
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Current Amount</b><br><small>Numbers Only</small></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="amount" size="30" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['amount']->value;?>
" /></td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Current Free Amount</b><br><small>Numbers Only</small></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="free_amount" size="30" value="<?php echo $_smarty_tpl->tpl_vars['free_amount']->value;?>
"  /></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Update" onclick="ask_url('Are you sure you want to update?','index.php?get=module_edit_coins&account=<?php echo $_smarty_tpl->tpl_vars['user_no']->value;?>
')"></td>
</tr>
</table>
<input type="hidden" name="account" value="<?php echo $_smarty_tpl->tpl_vars['user_no']->value;?>
" >
</form><?php }} ?>