<?php /* Smarty version Smarty-3.1.13, created on 2013-07-24 21:38:34
         compiled from ".\templates\module_edit_postbox.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2519051f0abcad82088-62924684%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e3ddbaa5dbc3388749f179a6ae724cca823eb5dc' => 
    array (
      0 => '.\\templates\\module_edit_postbox.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2519051f0abcad82088-62924684',
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
  'unifunc' => 'content_51f0abcad91052_15614639',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51f0abcad91052_15614639')) {function content_51f0abcad91052_15614639($_smarty_tpl) {?><form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="10">Edit Postbox</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">From</td> 
<td align="left" class="panel_title_sub2">To</td>
<td align="left" class="panel_title_sub2">Title</td>
<td align="left" class="panel_title_sub2">Text</td>
<td align="left" class="panel_title_sub2">Item</td> 
<td align="left" class="panel_title_sub2">Dil</td> 
<td align="left" class="panel_title_sub2">Date</td> 
<td align="left" class="panel_title_sub2">State</td> 
<td align="left" class="panel_title_sub2">Expire</td> 
<td align="left" class="panel_title_sub2">Action</td> 
</tr> 
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>

<tr>
<td align="right" class="panel_buttons" colspan="10"><input type="submit" value="Delete Post" onclick="ask_url('Are you sure you want to delete those posts?','index.php?get=module_edit_postbox&character=<?php echo $_smarty_tpl->tpl_vars['character']->value;?>
')"></td>
</tr>
</table>
<input type="hidden" name="character" value="<?php echo $_smarty_tpl->tpl_vars['character']->value;?>
" >	
</form>	    <?php }} ?>