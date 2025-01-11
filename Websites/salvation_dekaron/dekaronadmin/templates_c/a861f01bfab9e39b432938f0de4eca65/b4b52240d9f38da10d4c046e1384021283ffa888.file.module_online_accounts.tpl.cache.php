<?php /* Smarty version Smarty-3.1.13, created on 2013-08-08 15:01:34
         compiled from ".\templates\module_online_accounts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:159705204153e3dc961-44133014%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4b52240d9f38da10d4c046e1384021283ffa888' => 
    array (
      0 => '.\\templates\\module_online_accounts.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '159705204153e3dc961-44133014',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5204153e3e56b7_19839119',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5204153e3e56b7_19839119')) {function content_5204153e3e56b7_19839119($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="6"><<?php ?>?php echo $qnum1 ;?<?php ?>> Online Accounts</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">Account</td> 
<td align="left" class="panel_title_sub2">Character</td> 
<td align="left" class="panel_title_sub2">Level</td>
<td align="left" class="panel_title_sub2">Map</td>
<td align="left" class="panel_title_sub2">Class</td> 
<td align="left" class="panel_title_sub2">IP</td>
</tr> 
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>

</table>    <?php }} ?>