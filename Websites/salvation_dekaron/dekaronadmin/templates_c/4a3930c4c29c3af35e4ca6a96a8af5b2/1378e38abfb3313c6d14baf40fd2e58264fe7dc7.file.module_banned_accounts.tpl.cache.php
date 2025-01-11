<?php /* Smarty version Smarty-3.1.13, created on 2013-09-19 16:44:19
         compiled from ".\templates\module_banned_accounts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3761523b8c53ca43b0-80169319%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1378e38abfb3313c6d14baf40fd2e58264fe7dc7' => 
    array (
      0 => '.\\templates\\module_banned_accounts.tpl',
      1 => 1379450571,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3761523b8c53ca43b0-80169319',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_523b8c53cb0249_91234713',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523b8c53cb0249_91234713')) {function content_523b8c53cb0249_91234713($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="5">Banned Accounts</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">Account</td> 
<td align="left" class="panel_title_sub2">Ip Address</td>
<td align="left" class="panel_title_sub2">Reason</td>
<td align="left" class="panel_title_sub2">By</td>
<td align="left" class="panel_title_sub2">Date</td>
</tr> 
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>

</table><?php }} ?>