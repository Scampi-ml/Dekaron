<?php /* Smarty version Smarty-3.1.13, created on 2013-08-08 20:53:43
         compiled from ".\templates\module_view_characters.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27250520467c7c90b80-47306171%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f1a558a6b62141c0f045c0f62147757c785a544c' => 
    array (
      0 => '.\\templates\\module_view_characters.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27250520467c7c90b80-47306171',
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
  'unifunc' => 'content_520467c7c9c172_31562130',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_520467c7c9c172_31562130')) {function content_520467c7c9c172_31562130($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
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