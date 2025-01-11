<?php /* Smarty version Smarty-3.1.13, created on 2013-12-21 11:08:20
         compiled from ".\templates\module_search_character.tpl" */ ?>
<?php /*%%SmartyHeaderCode:625352b56894bfdf70-50871235%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'db8736e8cf25f75d3c5324908e3a8fb8eaaa77d4' => 
    array (
      0 => '.\\templates\\module_search_character.tpl',
      1 => 1385820987,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '625352b56894bfdf70-50871235',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TOP' => 0,
    'TABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52b56894c13e66_83191852',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b56894c13e66_83191852')) {function content_52b56894c13e66_83191852($_smarty_tpl) {?><form action="" name="form_edit" method="POST">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Search Character</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Search for ...</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">
Enter the "Character Name" or "Character No" or "User Ip Addr" of character which you want to find
<br> Results are limited to the first <?php echo $_smarty_tpl->tpl_vars['TOP']->value;?>
 results    
</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="user"> => input type => <select name="type"><option value="character_name">character_name</option><option value="character_no">character_no</option><option value="user_ip_addr">user_ip_addr</option></select></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="hidden" name="search"><input type="submit" value="Search"></td>
</tr>
</table>
</form>
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>
<?php }} ?>