<?php /* Smarty version Smarty-3.1.13, created on 2013-08-05 04:26:06
         compiled from ".\templates\module_search_guild.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2604951ff8bce700460-62177467%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4b103a699d0628312efe1fa13c3cee54532ddfa' => 
    array (
      0 => '.\\templates\\module_search_guild.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2604951ff8bce700460-62177467',
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
  'unifunc' => 'content_51ff8bce709ce0_04592732',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51ff8bce709ce0_04592732')) {function content_51ff8bce709ce0_04592732($_smarty_tpl) {?><form action="" name="form_edit" method="POST">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Search Guild</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Guild Name</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Enter the "Guild Name" of guild which you want to find
<br> Results are limited to the first <?php echo $_smarty_tpl->tpl_vars['TOP']->value;?>
 results    
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="user"></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="hidden" name="search"><input type="submit" value="Search"></td>
</tr>
</table>
</form>
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>
<?php }} ?>