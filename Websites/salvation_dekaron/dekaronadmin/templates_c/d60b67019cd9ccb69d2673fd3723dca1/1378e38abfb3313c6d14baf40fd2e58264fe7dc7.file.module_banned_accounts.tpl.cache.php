<?php /* Smarty version Smarty-3.1.13, created on 2013-08-20 11:52:09
         compiled from ".\templates\module_banned_accounts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:47035213bad93fff76-92245167%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1378e38abfb3313c6d14baf40fd2e58264fe7dc7' => 
    array (
      0 => '.\\templates\\module_banned_accounts.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '47035213bad93fff76-92245167',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5213bad9408339_84209127',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5213bad9408339_84209127')) {function content_5213bad9408339_84209127($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="2">Banned Accounts</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">Account</td> 
<td align="left" class="panel_title_sub2">Ip Address</td>
</tr> 
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>

</table><?php }} ?>