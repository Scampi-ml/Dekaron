<?php /* Smarty version Smarty-3.1.13, created on 2013-12-04 00:58:21
         compiled from ".\templates\module_edit_suit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14918529ee09d70ca55-42885340%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '75a226df725aa6e49112a8baee572ff6214db94d' => 
    array (
      0 => '.\\templates\\module_edit_suit.tpl',
      1 => 1385820954,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14918529ee09d70ca55-42885340',
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
  'unifunc' => 'content_529ee09d7282a7_34648745',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529ee09d7282a7_34648745')) {function content_529ee09d7282a7_34648745($_smarty_tpl) {?><form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="8">Edit Suit</td>
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
<td align="right" class="panel_buttons" colspan="8"><input type="submit" value="Delete Suit Item" onclick="ask_url('Are you sure you want to delete those suits?','index.php?get=module_edit_suit&character=<?php echo $_smarty_tpl->tpl_vars['character']->value;?>
')"></td>
</tr>
</table>
<input type="hidden" name="character" value="<?php echo $_smarty_tpl->tpl_vars['character']->value;?>
" >	
</form>	    <?php }} ?>