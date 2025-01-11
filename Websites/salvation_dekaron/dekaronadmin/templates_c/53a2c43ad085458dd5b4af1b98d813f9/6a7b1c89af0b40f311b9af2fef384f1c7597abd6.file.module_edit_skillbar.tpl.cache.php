<?php /* Smarty version Smarty-3.1.13, created on 2013-09-07 16:51:19
         compiled from ".\templates\module_edit_skillbar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17667522bbbf74d38b4-26122513%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a7b1c89af0b40f311b9af2fef384f1c7597abd6' => 
    array (
      0 => '.\\templates\\module_edit_skillbar.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17667522bbbf74d38b4-26122513',
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
  'unifunc' => 'content_522bbbf750ff45_95201746',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_522bbbf750ff45_95201746')) {function content_522bbbf750ff45_95201746($_smarty_tpl) {?><form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="5">Edit Skillbar</td>
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
<td align="right" class="panel_buttons" colspan="5"><input type="submit" value="Delete Skillbar Item" onclick="ask_url('Are you sure you want to delete those items?','index.php?get=module_edit_skillbar&character=<?php echo $_smarty_tpl->tpl_vars['character']->value;?>
')"></td>
</tr>
</table>
<input type="hidden" name="character" value="<?php echo $_smarty_tpl->tpl_vars['character']->value;?>
" >	
</form>	    <?php }} ?>