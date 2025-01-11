<?php /* Smarty version Smarty-3.1.13, created on 2013-08-14 22:16:05
         compiled from ".\templates\module_delete_character.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12827520c64153403a9-03946167%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f23addff13e69980ba3c915963e71b6363812002' => 
    array (
      0 => '.\\templates\\module_delete_character.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12827520c64153403a9-03946167',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'character_name' => 0,
    'character_no' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_520c641534a795_75270824',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_520c641534a795_75270824')) {function content_520c641534a795_75270824($_smarty_tpl) {?><form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
<tr>
<td class="cat"><div align="left"><b>Please confirm</b></div></td>
</tr>
<tr>
<td align="center" style="padding-top: 20px; padding-bottom: 20px;">
<b>Are you sure you want to delete character "<?php echo $_smarty_tpl->tpl_vars['character_name']->value;?>
" ?</b>
<br>

<br><br>This action cannot be undone!
<br>
Deleting character(s) will also delete all of there info, quests, inventory, skills, ... ect
<br><br><br>
<input type="hidden" name="character" value="<?php echo $_smarty_tpl->tpl_vars['character_no']->value;?>
" >
<input type="submit" value="Delete character" onclick="ask_url('Are you sure you want to delete this character?','index.php?get=module_delete_character')">
</td> 
</tr>
</table>	
</form>	<?php }} ?>