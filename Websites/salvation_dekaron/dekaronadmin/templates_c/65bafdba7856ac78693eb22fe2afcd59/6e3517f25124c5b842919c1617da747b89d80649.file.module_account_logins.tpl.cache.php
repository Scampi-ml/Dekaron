<?php /* Smarty version Smarty-3.1.13, created on 2014-01-13 08:03:31
         compiled from ".\templates\module_account_logins.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1830252d38fc3610997-73000661%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6e3517f25124c5b842919c1617da747b89d80649' => 
    array (
      0 => '.\\templates\\module_account_logins.tpl',
      1 => 1385820939,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1830252d38fc3610997-73000661',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52d38fc3646b24_59821043',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52d38fc3646b24_59821043')) {function content_52d38fc3646b24_59821043($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="4">Account Login</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">Login</td> 
<td align="left" class="panel_title_sub2">Logout</td> 
<td align="left" class="panel_title_sub2">Ip Address</td>
<td align="left" class="panel_title_sub2">User Id</td> 
</tr> 
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>

</table><?php }} ?>