<?php /* Smarty version Smarty-3.1.13, created on 2013-12-04 11:31:28
         compiled from ".\templates\module_view_deleted_mails.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14283529f0480a9f374-34222213%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '24d99d376d9effa2309cd8f1ac9b8a7bc0d6d679' => 
    array (
      0 => '.\\templates\\module_view_deleted_mails.tpl',
      1 => 1385820995,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14283529f0480a9f374-34222213',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529f0480ad1851_11845894',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529f0480ad1851_11845894')) {function content_529f0480ad1851_11845894($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="8">Deleted Mails</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">From</td> 
<td align="left" class="panel_title_sub2">To</td> 
<td align="left" class="panel_title_sub2">Title</td>
<td align="left" class="panel_title_sub2">Message</td>
<td align="left" class="panel_title_sub2">Item</td>  
<td align="left" class="panel_title_sub2">Dil</td>
<td align="left" class="panel_title_sub2">Date</td>
<td align="left" class="panel_title_sub2">Deleted</td>
</tr> 
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>

</table><?php }} ?>