<?php /* Smarty version Smarty-3.1.13, created on 2013-12-04 03:28:39
         compiled from ".\templates\settings_search_character.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9941529f03d7853ee4-47941551%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a2b0999eb064fb2dc1b0c558c1708101895e0be7' => 
    array (
      0 => '.\\templates\\settings_search_character.tpl',
      1 => 1385821000,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9941529f03d7853ee4-47941551',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'POST' => 0,
    'MESSAGE' => 0,
    'switch' => 0,
    'TOP' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529f03d78798b6_61340254',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529f03d78798b6_61340254')) {function content_529f03d78798b6_61340254($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['POST']->value==1){?><?php echo $_smarty_tpl->tpl_vars['MESSAGE']->value;?>
<?php }else{ ?>
<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Seach Character Settings</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Dekaron Characters</b><br>If set to 'yes' it will show the dekaron characters, this is not recommended</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="showdekaron"><?php echo $_smarty_tpl->tpl_vars['switch']->value;?>
</select></td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Results</b><br>The amount of results to be displayed, 50 is recommended</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="top" size="30" value="<?php echo $_smarty_tpl->tpl_vars['TOP']->value;?>
" /></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Save Settings"></td>
</tr>
</table>
</form>
<?php }?><?php }} ?>