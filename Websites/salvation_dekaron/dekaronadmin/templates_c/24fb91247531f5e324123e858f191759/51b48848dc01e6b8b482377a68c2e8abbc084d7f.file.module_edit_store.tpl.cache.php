<?php /* Smarty version Smarty-3.1.13, created on 2013-07-27 13:42:11
         compiled from ".\templates\module_edit_store.tpl" */ ?>
<?php /*%%SmartyHeaderCode:325551f430a39711f4-07777755%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '51b48848dc01e6b8b482377a68c2e8abbc084d7f' => 
    array (
      0 => '.\\templates\\module_edit_store.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '325551f430a39711f4-07777755',
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
  'unifunc' => 'content_51f430a3993f68_98764376',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51f430a3993f68_98764376')) {function content_51f430a3993f68_98764376($_smarty_tpl) {?><form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="8">Edit Store</td>
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
<td align="right" class="panel_buttons" colspan="8"><input type="submit" value="Delete Store Item" onclick="ask_url('Are you sure you want to delete those items?','index.php?get=module_edit_store&character=<?php echo $_smarty_tpl->tpl_vars['character']->value;?>
')"></td>
</tr>
</table>
<input type="hidden" name="character" value="<?php echo $_smarty_tpl->tpl_vars['character']->value;?>
" >	
</form>	    <?php }} ?>