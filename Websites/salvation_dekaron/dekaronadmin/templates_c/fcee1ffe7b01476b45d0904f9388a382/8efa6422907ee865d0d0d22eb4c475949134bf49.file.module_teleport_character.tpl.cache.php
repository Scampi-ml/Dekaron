<?php /* Smarty version Smarty-3.1.13, created on 2013-09-11 07:34:50
         compiled from ".\templates\module_teleport_character.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1744452307f8ac9b494-68757442%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8efa6422907ee865d0d0d22eb4c475949134bf49' => 
    array (
      0 => '.\\templates\\module_teleport_character.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1744452307f8ac9b494-68757442',
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
  'unifunc' => 'content_52307f8acaeb00_96793030',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52307f8acaeb00_96793030')) {function content_52307f8acaeb00_96793030($_smarty_tpl) {?><form action="" method="post">
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