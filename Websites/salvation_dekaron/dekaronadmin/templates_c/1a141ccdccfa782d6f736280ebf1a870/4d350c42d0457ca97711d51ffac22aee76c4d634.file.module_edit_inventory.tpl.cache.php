<?php /* Smarty version Smarty-3.1.13, created on 2013-12-18 20:44:18
         compiled from ".\templates\module_edit_inventory.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1018152b1fb12a38c85-87867807%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4d350c42d0457ca97711d51ffac22aee76c4d634' => 
    array (
      0 => '.\\templates\\module_edit_inventory.tpl',
      1 => 1385820952,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1018152b1fb12a38c85-87867807',
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
  'unifunc' => 'content_52b1fb12a54749_23081595',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b1fb12a54749_23081595')) {function content_52b1fb12a54749_23081595($_smarty_tpl) {?><form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="9">Edit Inventory</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">Line No</td> 
<td align="left" class="panel_title_sub2">Bag</td> 
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
<td align="right" class="panel_buttons" colspan="9"><input type="submit" value="Delete Inventory Item" onclick="ask_url('Are you sure you want to delete those items?','index.php?get=module_edit_inventory&character=<?php echo $_smarty_tpl->tpl_vars['character']->value;?>
')"></td>
</tr>
</table>
<input type="hidden" name="character" value="<?php echo $_smarty_tpl->tpl_vars['character']->value;?>
" >	
</form>	    <?php }} ?>