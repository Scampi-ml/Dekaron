<?php /* Smarty version Smarty-3.1.13, created on 2014-02-22 20:15:24
         compiled from ".\templates\module_view_characters.tpl" */ ?>
<?php /*%%SmartyHeaderCode:40485308f74cc39351-10941054%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f1a558a6b62141c0f045c0f62147757c785a544c' => 
    array (
      0 => '.\\templates\\module_view_characters.tpl',
      1 => 1385820995,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '40485308f74cc39351-10941054',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user_id' => 0,
    'TABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5308f74cc4ff07_12789926',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5308f74cc4ff07_12789926')) {function content_5308f74cc4ff07_12789926($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="3">Characters On Account: <?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">Character</td> 
<td align="left" class="panel_title_sub2">Action</td> 
</tr> 
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>

</table><?php }} ?>