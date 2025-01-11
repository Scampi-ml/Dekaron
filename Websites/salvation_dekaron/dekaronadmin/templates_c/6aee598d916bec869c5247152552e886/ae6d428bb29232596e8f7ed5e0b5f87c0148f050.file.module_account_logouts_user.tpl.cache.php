<?php /* Smarty version Smarty-3.1.13, created on 2013-07-24 16:38:36
         compiled from ".\templates\module_account_logouts_user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1381651f0657cc59f07-85638533%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae6d428bb29232596e8f7ed5e0b5f87c0148f050' => 
    array (
      0 => '.\\templates\\module_account_logouts_user.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1381651f0657cc59f07-85638533',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51f0657cc60d94_94711107',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51f0657cc60d94_94711107')) {function content_51f0657cc60d94_94711107($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="5">Account Logout</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">Logout</td> 
<td align="left" class="panel_title_sub2">Login</td> 
<td align="left" class="panel_title_sub2">Ip Address</td>
<td align="left" class="panel_title_sub2">User Id</td> 
<td align="left" class="panel_title_sub2">Action</td> 
</tr>
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>

</table> <?php }} ?>