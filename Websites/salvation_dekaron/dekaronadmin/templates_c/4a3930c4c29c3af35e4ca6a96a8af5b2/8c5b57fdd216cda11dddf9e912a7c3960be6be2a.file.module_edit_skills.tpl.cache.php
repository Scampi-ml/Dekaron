<?php /* Smarty version Smarty-3.1.13, created on 2013-09-19 18:03:49
         compiled from ".\templates\module_edit_skills.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16387523b9ef5e69915-19531481%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '16387523b9ef5e69915-19531481',
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
  'unifunc' => 'content_523b9ef5e90991_62327504',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523b9ef5e90991_62327504')) {function content_523b9ef5e90991_62327504($_smarty_tpl) {?><form action="" method="post">
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