<?php /* Smarty version Smarty-3.1.13, created on 2013-08-01 14:38:05
         compiled from ".\templates\module_settings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1806351fad53dcbcee3-80214500%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aab12365c31b1661daad0a477020f53d19270599' => 
    array (
      0 => '.\\templates\\module_settings.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1806351fad53dcbcee3-80214500',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'DATA' => 0,
    'tpl' => 0,
    'file' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51fad53dccffe8_46266925',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51fad53dccffe8_46266925')) {function content_51fad53dccffe8_46266925($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="right" class="panel_buttons" colspan="1"><b>Select a setting</b>&nbsp;&nbsp; <?php echo $_smarty_tpl->tpl_vars['DATA']->value;?>
</td>
</tr>
</table>
<br>
<?php if ($_smarty_tpl->tpl_vars['tpl']->value=='1'){?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['file']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

<?php }?><?php }} ?>