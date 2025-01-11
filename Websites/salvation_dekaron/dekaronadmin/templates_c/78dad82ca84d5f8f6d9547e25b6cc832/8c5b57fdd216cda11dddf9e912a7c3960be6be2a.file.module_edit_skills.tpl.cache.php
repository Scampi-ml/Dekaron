<?php /* Smarty version Smarty-3.1.13, created on 2013-05-20 17:27:29
         compiled from ".\templates\module_edit_skills.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15785519abf714489e1-67112070%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c5b57fdd216cda11dddf9e912a7c3960be6be2a' => 
    array (
      0 => '.\\templates\\module_edit_skills.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15785519abf714489e1-67112070',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TABLE' => 0,
    'character' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_519abf714651f8_35628437',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_519abf714651f8_35628437')) {function content_519abf714651f8_35628437($_smarty_tpl) {?><form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="5">Edit Skills</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">Line No</td> 
<td align="left" class="panel_title_sub2">Info</td>
<td align="left" class="panel_title_sub2">Ipt Time</td> 
<td align="left" class="panel_title_sub2">Upt Time</td> 
<td align="left" class="panel_title_sub2">Action</td> 
</tr> 
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>

<tr>
<td align="right" class="panel_buttons" colspan="5"><input type="submit" value="Delete Skill" onclick="ask_url('Are you sure you want to delete those skills?','index.php?get=module_edit_skills&character=<?php echo $_smarty_tpl->tpl_vars['character']->value;?>
')"></td>
</tr>
</table>
<input type="hidden" name="character" value="<?php echo $_smarty_tpl->tpl_vars['character']->value;?>
" >	
</form>	
<?php }} ?>