<?php /* Smarty version Smarty-3.1.13, created on 2013-08-26 09:48:50
         compiled from ".\templates\home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28741521b86f28f7fa9-73016710%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97d060df136bc68287855ad0037b446ebb85b73d' => 
    array (
      0 => '.\\templates\\home.tpl',
      1 => 1375391777,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28741521b86f28f7fa9-73016710',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'curr_date' => 0,
    'SQLquery1' => 0,
    'SQLquery2' => 0,
    'SQLquery3' => 0,
    'SQLquery4' => 0,
    'version' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_521b86f29106c0_16888760',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_521b86f29106c0_16888760')) {function content_521b86f29106c0_16888760($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="2">Online Players</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" valign="top"><center><img src="online/index.php" border="0" /></center></td>
</tr>
</table>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
<td align="center" class="panel_title" colspan="2">Statistics for <?php echo $_smarty_tpl->tpl_vars['curr_date']->value;?>
</td>
</tr>
<tr class="even">
<td width="50%" align="left" class="panel_text_alt_list">New Characters</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery1']->value;?>
</td>
</tr>
<tr>
<td width="50%" align="left" class="panel_text_alt_list">New Accounts</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery2']->value;?>
</td>
</tr>
<tr class="even">
<td width="50%" align="left" class="panel_text_alt_list">Game Logins</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery3']->value;?>
</td>
</tr>
<tr>
<td width="50%" align="left" class="panel_text_alt_list">Online Accounts</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery4']->value;?>
</td>
</tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
<td align="center" class="panel_title" colspan="2">DAC Version</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">DAC Version Status</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['version']->value;?>
 | Custom Version for Dead  Dekaron</td>
</tr>
</table><?php }} ?>