<?php /* Smarty version Smarty-3.1.13, created on 2013-12-10 06:18:02
         compiled from ".\templates\module_coins_log_user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2296452a6a40a7361e3-29108279%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9dbb3ca12a52b76b694024f9d70975c15e634ffd' => 
    array (
      0 => '.\\templates\\module_coins_log_user.tpl',
      1 => 1385820943,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2296452a6a40a7361e3-29108279',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a6a40a750516_83780602',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a6a40a750516_83780602')) {function content_52a6a40a750516_83780602($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="4">Coins Use Log</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">Character</td> 
<td align="left" class="panel_title_sub2">Ip Address</td>
<td align="left" class="panel_title_sub2">Item / Item Id</td> 
<td align="left" class="panel_title_sub2">Date</td> 
</tr> 
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>

</table><?php }} ?>