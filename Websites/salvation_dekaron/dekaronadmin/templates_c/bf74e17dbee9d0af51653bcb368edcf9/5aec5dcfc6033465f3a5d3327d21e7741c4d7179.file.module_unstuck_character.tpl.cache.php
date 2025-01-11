<?php /* Smarty version Smarty-3.1.13, created on 2013-08-07 21:58:49
         compiled from ".\templates\module_unstuck_character.tpl" */ ?>
<?php /*%%SmartyHeaderCode:92945203258942daa8-02933770%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5aec5dcfc6033465f3a5d3327d21e7741c4d7179' => 
    array (
      0 => '.\\templates\\module_unstuck_character.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '92945203258942daa8-02933770',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'character' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5203258944f546_88901808',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5203258944f546_88901808')) {function content_5203258944f546_88901808($_smarty_tpl) {?><form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
<tr>
<td class="cat"><div align="left"><b>Please confirm</b></div></td>
</tr>
<tr>
<td align="center" style="padding-top: 20px; padding-bottom: 20px;">
<b>Are you sure you want to unstuck this character ?</b>
<br><br><br><br>
<input type="hidden" name="character" value="<?php echo $_smarty_tpl->tpl_vars['character']->value;?>
" >
<input type="submit" value="Unstuck Character" onclick="ask_url('Are you sure you want to unstuck this character ?','index.php?get=module_unstuck_character')">
</td> 
</tr>
</table>	
</form>	<?php }} ?>