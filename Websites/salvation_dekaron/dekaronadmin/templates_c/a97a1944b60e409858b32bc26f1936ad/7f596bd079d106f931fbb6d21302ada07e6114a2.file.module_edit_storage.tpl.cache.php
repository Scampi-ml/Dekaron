<?php /* Smarty version Smarty-3.1.13, created on 2014-01-25 11:02:23
         compiled from ".\templates\module_edit_storage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1827952e38baf1b1046-38757905%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f596bd079d106f931fbb6d21302ada07e6114a2' => 
    array (
      0 => '.\\templates\\module_edit_storage.tpl',
      1 => 1385820954,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1827952e38baf1b1046-38757905',
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
  'unifunc' => 'content_52e38baf1da2f7_01513645',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52e38baf1da2f7_01513645')) {function content_52e38baf1da2f7_01513645($_smarty_tpl) {?><form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
    <tr>
    	<td align="center" class="panel_title" colspan="8">Edit Storage</td>
    </tr>
	<tr> 
        <td align="left" class="panel_title_sub2">Line No</td> 
        <td align="left" class="panel_title_sub2">Item Name (Index)</td> 
        <td align="left" class="panel_title_sub2">Serial Number</td> 
        <td align="left" class="panel_title_sub2">Header</td>
        <td align="left" class="panel_title_sub2">Info</td> 
        <td align="left" class="panel_title_sub2">Updated</td> 
        <td align="left" class="panel_title_sub2">Action</td> 
        <td align="left" class="panel_title_sub2">View</td> 
	</tr> 
	<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>

    <tr>
    	<td align="right" class="panel_buttons" colspan="8"><input type="submit" value="Delete Storage Item" onclick="ask_url('Are you sure you want to delete those items?','index.php?get=module_edit_storage&character=<?php echo $_smarty_tpl->tpl_vars['character']->value;?>
')"></td>
    </tr>
</table>
<input type="hidden" name="character" value="<?php echo $_smarty_tpl->tpl_vars['character']->value;?>
" >	
</form>	<?php }} ?>