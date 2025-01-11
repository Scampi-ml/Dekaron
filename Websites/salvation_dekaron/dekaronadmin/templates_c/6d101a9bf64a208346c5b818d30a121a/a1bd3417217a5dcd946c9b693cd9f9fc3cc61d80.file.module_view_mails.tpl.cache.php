<?php /* Smarty version Smarty-3.1.13, created on 2013-12-04 11:31:02
         compiled from ".\templates\module_view_mails.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26520529f046696d657-24111974%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a1bd3417217a5dcd946c9b693cd9f9fc3cc61d80' => 
    array (
      0 => '.\\templates\\module_view_mails.tpl',
      1 => 1385820996,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26520529f046696d657-24111974',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529f04669c8476_99477510',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529f04669c8476_99477510')) {function content_529f04669c8476_99477510($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
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