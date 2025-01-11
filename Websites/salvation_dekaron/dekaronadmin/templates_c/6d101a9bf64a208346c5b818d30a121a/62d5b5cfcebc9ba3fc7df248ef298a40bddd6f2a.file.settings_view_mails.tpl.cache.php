<?php /* Smarty version Smarty-3.1.13, created on 2013-12-04 03:28:35
         compiled from ".\templates\settings_view_mails.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12178529f03d3486420-63544653%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '62d5b5cfcebc9ba3fc7df248ef298a40bddd6f2a' => 
    array (
      0 => '.\\templates\\settings_view_mails.tpl',
      1 => 1385821002,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12178529f03d3486420-63544653',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'POST' => 0,
    'MESSAGE' => 0,
    'TOP' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529f03d34b0369_85770809',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529f03d34b0369_85770809')) {function content_529f03d34b0369_85770809($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['POST']->value==1){?><?php echo $_smarty_tpl->tpl_vars['MESSAGE']->value;?>
<?php }else{ ?>
<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">View Mails Settings</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Results</b><br>The amount of results to be displayed, 100 is recommended</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="top" size="30" value="<?php echo $_smarty_tpl->tpl_vars['TOP']->value;?>
" /></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Save Settings"></td>
</tr>
</table>
</form>
<?php }?><?php }} ?>