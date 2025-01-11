<?php /* Smarty version Smarty-3.1.13, created on 2013-08-31 22:11:20
         compiled from ".\templates\module_view_characters.tpl" */ ?>
<?php /*%%SmartyHeaderCode:160845222cc78aa1fd9-78785823%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '160845222cc78aa1fd9-78785823',
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
  'unifunc' => 'content_5222cc78aac116_43851965',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5222cc78aac116_43851965')) {function content_5222cc78aac116_43851965($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
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