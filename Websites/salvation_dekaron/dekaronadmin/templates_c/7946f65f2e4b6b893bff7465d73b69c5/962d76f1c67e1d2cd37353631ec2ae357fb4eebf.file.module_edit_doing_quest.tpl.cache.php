<?php /* Smarty version Smarty-3.1.13, created on 2013-09-02 21:55:55
         compiled from ".\templates\module_edit_doing_quest.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1285752256bdbe7c8f0-76692878%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '962d76f1c67e1d2cd37353631ec2ae357fb4eebf' => 
    array (
      0 => '.\\templates\\module_edit_doing_quest.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1285752256bdbe7c8f0-76692878',
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
  'unifunc' => 'content_52256bdbead706_43235437',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52256bdbead706_43235437')) {function content_52256bdbead706_43235437($_smarty_tpl) {?><form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="7">Edit Doing Quests</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">Quest Index</td> 
<td align="left" class="panel_title_sub2">Quest Count 0</td> 
<td align="left" class="panel_title_sub2">Quest Count 1</td>
<td align="left" class="panel_title_sub2">Quest Count 2</td> 
<td align="left" class="panel_title_sub2">Quest Count 3</td>
<td align="left" class="panel_title_sub2">Time</td>
<td align="left" class="panel_title_sub2">Action</td> 
</tr> 
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>

<tr>
<td align="right" class="panel_buttons" colspan="7"><input type="submit" value="Delete Quest" onclick="ask_url('Are you sure you want to delete those quests?','index.php?get=module_edit_doing_quest&character=<?php echo $_smarty_tpl->tpl_vars['character']->value;?>
')"></td>
</tr>
</table>
<input type="hidden" name="character" value="<?php echo $_smarty_tpl->tpl_vars['character']->value;?>
" >	
</form><?php }} ?>