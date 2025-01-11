<?php /* Smarty version Smarty-3.1.13, created on 2014-01-13 10:31:45
         compiled from ".\templates\module_account_logins_user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:167152d3b281256b88-58592252%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '167152d3b281256b88-58592252',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52d3b2812632e8_13236297',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52d3b2812632e8_13236297')) {function content_52d3b2812632e8_13236297($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
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