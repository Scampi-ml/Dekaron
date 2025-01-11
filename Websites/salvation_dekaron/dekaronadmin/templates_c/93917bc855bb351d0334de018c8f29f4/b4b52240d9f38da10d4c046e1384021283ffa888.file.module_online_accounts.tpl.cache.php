<?php /* Smarty version Smarty-3.1.13, created on 2013-09-27 22:45:17
         compiled from ".\templates\module_online_accounts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:73152466ced97ca18-63145964%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '73152466ced97ca18-63145964',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52466ced98db71_55332373',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52466ced98db71_55332373')) {function content_52466ced98db71_55332373($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
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