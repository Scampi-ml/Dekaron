<?php /* Smarty version Smarty-3.1.13, created on 2014-01-29 23:14:01
         compiled from ".\templates\module_teleport_character.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1023252e97d292d8274-09755182%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8efa6422907ee865d0d0d22eb4c475949134bf49' => 
    array (
      0 => '.\\templates\\module_teleport_character.tpl',
      1 => 1385820993,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1023252e97d292d8274-09755182',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mapcount_data' => 0,
    'character' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52e97d29311170_04732155',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52e97d29311170_04732155')) {function content_52e97d29311170_04732155($_smarty_tpl) {?><form action="" method="post">
<table width="100q%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
<tr>
<td class="cat"><div align="left"><b>Choose a location</b></div></td>
</tr>
<tr>
<td align="center" style="padding-top: 20px; padding-bottom: 20px;">
<b>Pleas select the location you want to teleport the character to</b>
<br><br>
<select name="tele_map" style="width: 150px;"><?php echo $_smarty_tpl->tpl_vars['mapcount_data']->value;?>
</select>
<br><br>
<input type="hidden" name="character" value="<?php echo $_smarty_tpl->tpl_vars['character']->value;?>
" >
<input type="submit" value="teleport Character" onclick="ask_url('Are you sure you want to teleport this character ?','index.php?get=module_teleport_character')">
</td>
</tr>
</table>	
</form>
<?php }} ?>