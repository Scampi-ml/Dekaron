<?php /* Smarty version Smarty-3.1.13, created on 2013-09-11 10:18:35
         compiled from ".\templates\module_search_account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:129235230a5ebcb54f6-57199298%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5eaae2344440d1e82da1ed624cd0c8012b907991' => 
    array (
      0 => '.\\templates\\module_search_account.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '129235230a5ebcb54f6-57199298',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TOP' => 0,
    'TABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5230a5ebcc7d94_19435795',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5230a5ebcc7d94_19435795')) {function content_5230a5ebcc7d94_19435795($_smarty_tpl) {?><form action="" name="form_edit" method="POST">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Search Account</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Search for ...</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Enter the "User ID" or "User No" or "User Ip Addr" of account which you want to find
<br> Results are limited to the first <?php echo $_smarty_tpl->tpl_vars['TOP']->value;?>
 results    
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="user"> => input type => <select name="type"><option value="user_id">user_id</option><option value="user_no">user_no</option><option value="user_ip_addr">user_ip_addr</option></select></td>
</tr>    
<tr>
<td align="right" class="panel_buttons" colspan="2">
<input type="hidden" name="search">
<input type="submit" value="Search">
</td>
</tr>
</table>
</form>
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>
<?php }} ?>