<?php /* Smarty version Smarty-3.1.13, created on 2013-09-13 03:02:50
         compiled from ".\templates\module_view_mails.tpl" */ ?>
<?php /*%%SmartyHeaderCode:210095232e2ca876060-56583896%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a1bd3417217a5dcd946c9b693cd9f9fc3cc61d80' => 
    array (
      0 => '.\\templates\\module_view_mails.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '210095232e2ca876060-56583896',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5232e2ca8c16f1_51102638',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5232e2ca8c16f1_51102638')) {function content_5232e2ca8c16f1_51102638($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="7">Mails</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">From</td> 
<td align="left" class="panel_title_sub2">To</td> 
<td align="left" class="panel_title_sub2">Title</td>
<td align="left" class="panel_title_sub2">Message</td>
<td align="left" class="panel_title_sub2">Item</td>  
<td align="left" class="panel_title_sub2">Dil</td>
<td align="left" class="panel_title_sub2">Date</td>
</tr> 
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>

</table><?php }} ?>