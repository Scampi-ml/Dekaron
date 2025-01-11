<?php /* Smarty version Smarty-3.1.13, created on 2014-01-08 21:52:45
         compiled from ".\templates\module_account_logins_user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1597552cdba9d6d2925-50722162%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a1acb07f5071a01e3af78e1b898a4de334d7d0b9' => 
    array (
      0 => '.\\templates\\module_account_logins_user.tpl',
      1 => 1385820940,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1597552cdba9d6d2925-50722162',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52cdba9d6de177_14157938',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52cdba9d6de177_14157938')) {function content_52cdba9d6de177_14157938($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="5">Account Login</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">Login</td> 
<td align="left" class="panel_title_sub2">Logout</td> 
<td align="left" class="panel_title_sub2">Ip Address</td>
<td align="left" class="panel_title_sub2">User Id</td> 
<td align="left" class="panel_title_sub2">Action</td> 
</tr> 
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>

</table><?php }} ?>